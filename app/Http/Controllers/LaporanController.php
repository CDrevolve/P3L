<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailPemesanan;
use App\Models\PemakaianBahanBaku;
use App\Models\BahanBaku;
use App\Models\Pemesanan;
use Carbon\Carbon;
use PDF;

class LaporanController extends Controller
{
    public function laporanPenjualanTahunan(Request $request)
    {
        $tahun = $request->input('tahun') ?: Carbon::now()->year;

  
        $penjualanBulanan = Pemesanan::selectRaw('MONTH(tanggal) as bulan, COUNT(*) as jumlah_transaksi, SUM(jumlah_pembayaran) as total_uang')
            ->whereYear('tanggal', $tahun)
            ->groupByRaw('MONTH(tanggal)')
            ->orderByRaw('MONTH(tanggal)')
            ->get();

        $totalKeseluruhan = $penjualanBulanan->sum('total_uang');

        return view('mo.laporan.penjualan_tahunan', compact('penjualanBulanan', 'totalKeseluruhan', 'tahun'));
    }

    public function laporanPenjualanTahunanOwner(Request $request)
    {
        $tahun = $request->input('tahun') ?: Carbon::now()->year;

 
        $penjualanBulanan = Pemesanan::selectRaw('MONTH(tanggal) as bulan, COUNT(*) as jumlah_transaksi, SUM(jumlah_pembayaran) as total_uang')
            ->whereYear('tanggal', $tahun)
            ->groupByRaw('MONTH(tanggal)')
            ->orderByRaw('MONTH(tanggal)')
            ->get();

        $totalKeseluruhan = $penjualanBulanan->sum('total_uang');

        return view('owner.laporan.penjualan_tahunan', compact('penjualanBulanan', 'totalKeseluruhan', 'tahun'));
    }

    public function downloadPDFOwner(Request $request)
    {
        $tahun = $request->input('tahun') ?: Carbon::now()->year;

        $penjualanBulanan = Pemesanan::selectRaw('MONTH(tanggal) as bulan, COUNT(*) as jumlah_transaksi, SUM(jumlah_pembayaran) as total_uang')
            ->whereYear('tanggal', $tahun)
            ->groupByRaw('MONTH(tanggal)')
            ->orderByRaw('MONTH(tanggal)')
            ->get();

        $totalKeseluruhan = $penjualanBulanan->sum('total_uang');

        $pdf = PDF::loadView('owner.laporan.penjualan_tahunan_pdf', compact('penjualanBulanan', 'totalKeseluruhan', 'tahun'));
        return $pdf->download('Laporan_Penjualan_Tahunan_' . $tahun . '.pdf');
    }

    public function downloadPDF(Request $request)
{
    $tahun = $request->input('tahun') ?: Carbon::now()->year;
    $chartImage = $request->input('chartImage');

    $penjualanBulanan = Pemesanan::selectRaw('MONTH(tanggal) as bulan, COUNT(*) as jumlah_transaksi, SUM(jumlah_pembayaran) as total_uang')
        ->whereYear('tanggal', $tahun)
        ->groupByRaw('MONTH(tanggal)')
        ->orderByRaw('MONTH(tanggal)')
        ->get();

    $totalKeseluruhan = $penjualanBulanan->sum('total_uang');

    $pdf = PDF::loadView('mo.laporan.penjualan_tahunan_pdf', compact('penjualanBulanan', 'totalKeseluruhan', 'tahun', 'chartImage'));
    return $pdf->download('Laporan_Penjualan_Tahunan_' . $tahun . '.pdf');
}


    public function laporanPenggunaanBahanBaku(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $penggunaanBahanBaku = PemakaianBahanBaku::with('bahan_baku')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->get();

        return view('mo.laporan.penggunaan_bahan_baku', compact('penggunaanBahanBaku', 'startDate', 'endDate'));
    }

    public function downloadPenggunaanBahanBakuPDF(Request $request)
{
    $startDate = $request->input('start_date');
    $endDate = $request->input('end_date');

    $penggunaanBahanBaku = PemakaianBahanBaku::with('bahan_baku')
        ->whereBetween('created_at', [$startDate, $endDate])
        ->get();

    $pdf = PDF::loadView('mo.laporan.penggunaan_bahan_baku_pdf', compact('penggunaanBahanBaku', 'startDate', 'endDate'));
    return $pdf->download('Laporan_Penggunaan_Bahan_Baku_' . $startDate . '_to_' . $endDate . '.pdf');
}

public function laporanPenggunaanBahanBakuOwner(Request $request)
{
    $startDate = $request->input('start_date');
    $endDate = $request->input('end_date');

    $penggunaanBahanBaku = PemakaianBahanBaku::with('bahan_baku')
        ->whereBetween('created_at', [$startDate, $endDate])
        ->get();

    return view('owner.laporan.penggunaan_bahan_baku', compact('penggunaanBahanBaku', 'startDate', 'endDate'));
}

public function downloadPenggunaanBahanBakuPDFOwner(Request $request)
{
$startDate = $request->input('start_date');
$endDate = $request->input('end_date');

$penggunaanBahanBaku = PemakaianBahanBaku::with('bahan_baku')
    ->whereBetween('created_at', [$startDate, $endDate])
    ->get();

$pdf = PDF::loadView('owner.laporan.penggunaan_bahan_baku_pdf', compact('penggunaanBahanBaku', 'startDate', 'endDate'));
return $pdf->download('Laporan_Penggunaan_Bahan_Baku_' . $startDate . '_to_' . $endDate . '.pdf');
}

}
