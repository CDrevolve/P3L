<?php

namespace App\Http\Controllers;

use App\Models\LaporanTransaksiPenitip;
use App\Models\Pemesanan;
use App\Models\DetailPemesanan;
use Illuminate\Http\Request;

class LaporanTransaksiPenitipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

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
