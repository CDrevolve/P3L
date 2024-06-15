<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DetailPemesanan;
use App\Models\PemakaianBahanBaku;
use App\Models\Pemesanan;
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
