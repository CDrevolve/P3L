<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DetailPemesanan;
use App\Models\BahanBaku;
use Illuminate\Http\Request;
use PDF;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function laporanPenjualanBulanan(Request $request)
    {
        $bulan = $request->input('bulan') ?: Carbon::now()->month;
        $tahun = $request->input('tahun') ?: Carbon::now()->year;
        $tanggalCetak = Carbon::now()->format('d F Y');
    
        $penjualan = DetailPemesanan::with('produk')
            ->join('pemesanans', 'detail_pemesanans.id_pemesanan', '=', 'pemesanans.id')
            ->selectRaw('id_produk, SUM(jumlah) as total_terjual, SUM(jumlah * harga) as total_uang')
            ->whereYear('pemesanans.tanggal', $tahun)
            ->whereMonth('pemesanans.tanggal', $bulan)
            ->groupBy('id_produk')
            ->get();
    
        $totalPenjualan = $penjualan->sum('total_uang');
    
        if ($request->has('download')) {
            $pdf = PDF::loadView('mo.laporan.penjualan_pdf', compact('penjualan', 'bulan', 'tahun', 'totalPenjualan', 'tanggalCetak'));
            return $pdf->download('laporan_penjualan_bulanan.pdf');
        }
    
        return view('mo.laporan.penjualan', compact('penjualan', 'bulan', 'tahun', 'totalPenjualan', 'tanggalCetak'));
    }

public function laporanStokBahanBaku(Request $request)
{
    // Fetch the necessary data from the database
    $data = BahanBaku::all(['nama', 'satuan', 'stok']);

    $tanggalCetak = Carbon::now()->format('d F Y');

    if ($request->has('download')) {
        $pdf = PDF::loadView('mo.laporan.stok_bahan_baku_pdf', compact('data', 'tanggalCetak'));
        return $pdf->download('laporan_stok_bahan_baku.pdf');
    }

    return view('mo.laporan.bahan_baku', compact('data', 'tanggalCetak'));
}
}
