<?php

namespace App\Http\Controllers;

use App\Models\LaporanPemasukandanPengeluaran;
use App\Models\LaporanPresensi;
use App\Models\Pembelian;
use App\Models\PengeluaranLain;
use App\Models\Pemesanan;
use App\Models\Presensi;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class LaporanPemasukandanPengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('MO.laporan.laporanPemasukandanPengeluaran');
    }

    public function laporan(Request $request)
    {

        $bulan = date('m', strtotime($request->dates));
        $tahun = date('Y', strtotime($request->dates));

        // Pemasukan
        $pemasukan = Pemesanan::whereYear('tanggal', $tahun)
            ->whereMonth('tanggal', $bulan)
            ->where('status', 'Selesai')
            ->get(['tanggal', 'jumlah_pembayaran', 'tips', 'status']);

        // Pengeluaran
        $pengeluaranlain = PengeluaranLain::whereYear('tanggal', $tahun)
            ->whereMonth('tanggal', $bulan)
            ->get(['tanggal', 'nama', 'jumlah', 'harga', DB::raw('(jumlah * harga) as total')]);

        $pengeluaran = Pembelian::whereYear('tanggal', $tahun)
            ->whereMonth('tanggal', $bulan)
            ->get(['tanggal', 'nama', 'harga', 'jumlah', DB::raw('(harga * jumlah) as total')]);
        $totalbahanbaku = 0;

        foreach ($pengeluaran as $pengeluaran) {
            $totalbahanbaku += $pengeluaran->total;
        }



        $gaji = $this->getGaji($bulan, $tahun);

        // dd($pengeluaran);
        if ($pemasukan->isEmpty() && $pengeluaran->isEmpty() && $gaji->isEmpty()) {
            return redirect()->route('laporanPemasukandanPengeluaran.index')->with('error', 'Data tidak ditemukan');
        }


        // Format bulan untuk tampilan
        $bulanFormatted = Carbon::parse($request->datePemasukan)->format('F');

        // Menghitung total pemasukan dan pengeluaran
        $totalPemasukan = $pemasukan->sum('jumlah_pembayaran') + $pemasukan->sum('tips');
        $totalPengeluaran = $pengeluaranlain->sum('total') + $totalbahanbaku + $gaji;

        // dd($pemasukan, $pengeluaran, $totalPemasukan, $totalPengeluaran, $bulanFormatted, $tahun);

        return view('MO.laporan.laporanPemasukandanPengeluaran', compact('pemasukan', 'totalbahanbaku', 'pengeluaranlain', 'totalPemasukan', 'totalPengeluaran', 'bulanFormatted', 'tahun', 'gaji'));
    }

    public function getGaji($bulan, $tahun)
    {
        $presensi = Presensi::whereYear('tanggal', $tahun)
            ->whereMonth('tanggal', $bulan)
            ->get();

        if ($presensi->isEmpty()) {
            return 0;
        }

        $absen = [];

        foreach ($presensi as $p) {
            if (!isset($absen[$p->id_karyawan])) {
                if ($p->status == 'masuk') {
                    $absen[$p->id_karyawan] = [
                        'nama' => $p->karyawan->nama,
                        'masuk' => 1,
                        'bolos' => 0,
                        'honor_harian' => $p->karyawan->gaji,
                        'bonus_rajin' => 0,
                        'total' => $p->karyawan->gaji
                    ];
                } else {
                    $absen[$p->id_karyawan] = [
                        'nama' => $p->karyawan->nama,
                        'masuk' => 0,
                        'bolos' => 1,
                        'honor_harian' => 0,
                        'bonus_rajin' => 0,
                        'total' => 0
                    ];
                }
            } else {
                if ($p->status == 'masuk') {
                    $absen[$p->id_karyawan]['masuk']++;
                    $absen[$p->id_karyawan]['honor_harian'] += $p->karyawan->gaji;
                    $absen[$p->id_karyawan]['total'] = $absen[$p->id_karyawan]['honor_harian'] + $absen[$p->id_karyawan]['bonus_rajin'];
                } else {
                    $absen[$p->id_karyawan]['bolos']++;
                }
            }
        }
        $total = 0;
        foreach ($absen as &$a) {
            if ($a['bolos'] <= 4) {
                $a['bonus_rajin'] = $a['honor_harian'] * 0.2;
                $a['total'] = $a['honor_harian'] + $a['bonus_rajin'];
            }
            $total += $a['total'];
        }
        unset($a);
        // dd($absen);

        return $total;
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        //menghitung pengeluaran bahan baku
        $pembelian = Pembelian::where('tanggal', 'like', '%' . $request->bulan . '/' . $request->tahun)->get();
        $totalbahanbaku = 0;
        $laporan = new LaporanPemasukandanPengeluaran;
        $laporan->bulan = $request->bulan;
        $laporan->tahun = $request->tahun;
        $laporan->nama = 'Bahan Baku';
        foreach ($pembelian as $pembelian) {
            $totalbahanbaku += $pembelian->harga;
        }
        $laporan->pengeluaran = $totalbahanbaku;
        $laporan->save();

        //menghitung pengeluaran lain
        $pengeluaranlain = PengeluaranLain::where('tanggal', 'like', '%' . $request->bulan . '/' . $request->tahun)->get();
        foreach ($pengeluaranlain as $pengeluaranlain) {
            $laporanCheck = LaporanPemasukandanPengeluaran::where('bulan', $request->bulan)->where('tahun', $request->tahun)->where('nama', $pengeluaranlain->nama)->get();

            if ($laporanCheck->isnotEmpty()) {
                foreach ($laporanCheck as $laporanCheck) {
                    $laporanCheck->pengeluaran += $pengeluaranlain->harga;
                    $laporanCheck->save();
                }
            } else {
                $laporan = new LaporanPemasukandanPengeluaran;
                $laporan->bulan = $request->bulan;
                $laporan->tahun = $request->tahun;
                $laporan->nama = $pengeluaranlain->nama;
                $laporan->pengeluaran = $pengeluaranlain->harga;
                $laporan->save();
            }
        }

        //menghitung pengeluaran gaji
        $totalGaji = LaporanPresensi::where('bulan', $request->bulan)->where('tahun', $request->tahun)->sum('total');

        $laporanCheck = LaporanPemasukandanPengeluaran::where('bulan', $request->bulan)->where('tahun', $request->tahun)->where('nama', 'Gaji Karyawan')->first();
        if ($laporanCheck->isnotEmpty()) {
            $laporanCheck->delete();
        }
        $laporan = new LaporanPemasukandanPengeluaran;
        $laporan->bulan = $request->bulan;
        $laporan->tahun = $request->tahun;
        $laporan->nama = 'Gaji Karyawan';
        $laporan->pengeluaran = $totalGaji;
        $laporan->save();


        //menghitung pemasukan pesanan
        $pesanan = Pemesanan::where('tanggal', 'like', '%' . $request->bulan . '/' . $request->tahun)->where('status', 'selesai')->get();

        $laporanCheck = LaporanPemasukandanPengeluaran::where('bulan', $request->bulan)->where('tahun', $request->tahun)->where('nama', 'Penjualan')->first();
        if ($laporanCheck->isnotEmpty()) {
            $laporanCheck->delete();
        }

        $laporan = new LaporanPemasukandanPengeluaran;
        $laporan->bulan = $request->bulan;
        $laporan->tahun = $request->tahun;
        $laporan->nama = 'Penjualan';
        $totalpenjualan = 0;
        foreach ($pesanan as $pesanan) {
            $totalpenjualan += $pesanan->total;
        }
        $laporan->pemasukan = $totalpenjualan;

        return redirect()->route('laporanPemasukandanPengeluaran.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(LaporanPemasukandanPengeluaran $laporanPemasukandanPengeluaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LaporanPemasukandanPengeluaran $laporanPemasukandanPengeluaran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LaporanPemasukandanPengeluaran $laporanPemasukandanPengeluaran)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LaporanPemasukandanPengeluaran $laporanPemasukandanPengeluaran)
    {
        //
    }
}
