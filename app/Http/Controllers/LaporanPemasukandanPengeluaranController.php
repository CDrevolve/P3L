<?php

namespace App\Http\Controllers;

use App\Models\LaporanPemasukandanPengeluaran;
use App\Models\LaporanPresensi;
use App\Models\Pembelian;
use App\Models\PengeluaranLain;
use App\Models\Pemesanan;
use Illuminate\Http\Request;

class LaporanPemasukandanPengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $laporan = LaporanPemasukandanPengeluaran::all();
        return view('owner.laporanPemasukandanPengeluaran', compact('laporan'));
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
