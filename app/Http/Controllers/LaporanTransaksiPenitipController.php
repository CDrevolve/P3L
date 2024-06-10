<?php

namespace App\Http\Controllers;

use App\Models\LaporanTransaksiPenitip;
use App\Models\Pemesanan;
use App\Models\DetailPemesanan;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LaporanTransaksiPenitipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('MO.laporan.laporanTransaksiPenitip');
    }

    public function laporan(Request $request)
    {
        $bulan = date('m', strtotime($request->dates));
        $tahun = date('Y', strtotime($request->dates));

        $pemesanan = Pemesanan::whereYear('tanggal', $tahun)
            ->whereMonth('tanggal', $bulan)
            ->where('status', 'Selesai')
            ->get();

        if ($pemesanan->isEmpty()) {
            return redirect()->route('laporanTransaksiPenitip.index')->with('error', 'Data tidak ditemukan');
        }

        $penitipData = [];
        $produkdata = [];

        foreach ($pemesanan as $p) {
            foreach ($p->detail_pemesanan as $dp) {
                if ($dp->produk->id_penitip != null) {
                    $penitipId = $dp->produk->penitip->id;
                    if (!isset($penitipData[$penitipId])) {
                        $penitipData[$penitipId] = [
                            'id_penitip' => $dp->produk->penitip->id,
                            'nama_penitip' => $dp->produk->penitip->nama,
                            'total' => 0,
                        ];
                    }

                    if (!isset($produkdata[$dp->produk->id])) {
                        $produkdata[$dp->produk->id] = [
                            'id_penitip' => $penitipId,
                            'nama_produk' => $dp->produk->nama,
                            'qty' => $dp->jumlah,
                            'harga_jual' => $dp->produk->harga,
                            'total' => $dp->jumlah * $dp->produk->harga,
                            'komisi' => $dp->jumlah * $dp->produk->harga * 0.2,
                            'yang_diterima' => $dp->jumlah * $dp->produk->harga * 0.8,
                        ];
                        $penitipData[$penitipId]['total'] += $dp->jumlah * $dp->produk->harga * 0.8;
                    } else {
                        $produkdata[$dp->produk->id]['qty'] += $dp->jumlah;
                        $produkdata[$dp->produk->id]['total'] += $dp->jumlah * $dp->produk->harga;
                        $produkdata[$dp->produk->id]['komisi'] += $dp->jumlah * $dp->produk->harga * 0.2;
                        $produkdata[$dp->produk->id]['yang_diterima'] += $dp->jumlah * $dp->produk->harga * 0.8;
                        $penitipData[$penitipId]['total'] += $dp->jumlah * $dp->produk->harga * 0.8;
                    }
                }
            }
        }

        // dd($penitipData, $produkdata);

        $bulan = Carbon::parse($request->tanggal)->format('F');
        // dd($penitipData, $bulan, $tahun, $produkdata);

        return view('MO.laporan.laporanTransaksiPenitip', compact('penitipData', 'bulan', 'tahun', 'produkdata'));
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
        //cari pesanan dengan penjualan produk penitip

        $pesanan = Pemesanan::where('tanggal', 'like', '%' . $request->bulan . '/' . $request->tahun)->get();
        foreach ($pesanan as $pesanan) {
            $detail = DetailPemesanan::where('id_pemesanan', $pesanan->id)->get();
            $total_transaksi = 0;
            foreach ($detail as $detail) {
                if ($detail->produk->penitip->id == $request->id_penitip) {
                    $total_transaksi += $detail->jumlah * $detail->produk->harga;
                }
            }
        }



        $laporan = new LaporanTransaksiPenitip;
        $laporan->bulan = $request->bulan;
        $laporan->tahun = $request->tahun;
        $laporan->nama = 'Transaksi Penitip';
        $laporan->id_penitip = $request->id_penitip;
        $laporan->total_transaksi = $total_transaksi;
        $laporan->save();
    }

    /**
     * Display the specified resource.
     */
    public function show(LaporanTransaksiPenitip $laporanTransaksiPenitip)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LaporanTransaksiPenitip $laporanTransaksiPenitip)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LaporanTransaksiPenitip $laporanTransaksiPenitip)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LaporanTransaksiPenitip $laporanTransaksiPenitip)
    {
        //
    }
}
