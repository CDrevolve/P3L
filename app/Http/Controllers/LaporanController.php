<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailPemesanan;
use App\Models\BahanBaku;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function laporanPenjualanBulanan(Request $request)
    {
        $bulan = $request->input('bulan') ?: Carbon::now()->month;
        $tahun = $request->input('tahun') ?: Carbon::now()->year;

        $penjualan = DetailPemesanan::with('produk')
            ->selectRaw('id_produk, SUM(jumlah) as total_terjual')
            ->whereYear('created_at', $tahun)
            ->whereMonth('created_at', $bulan)
            ->groupBy('id_produk')
            ->get();

        return view('mo.laporan.penjualan', compact('penjualan', 'bulan', 'tahun'));
    }

    public function laporanStokBahanBaku()
    {
        $bahanBaku = BahanBaku::all();
        return view('mo.laporan.bahan_baku', compact('bahanBaku'));
    }
}
