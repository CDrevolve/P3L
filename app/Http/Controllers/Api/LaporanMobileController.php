<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\DetailPemesanan;
use App\Models\PemakaianBahanBaku;
use App\Models\Pemesanan;
use Carbon\Carbon;
use PDF;

class LaporanMobileController extends Controller
{

    public function laporanPenggunaanBahanBaku(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $penggunaanBahanBaku = PemakaianBahanBaku::with('bahan_baku')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->get();

        return response()->json([
            'penggunaanBahanBaku' => $penggunaanBahanBaku,
            'startDate' => $startDate,
            'endDate' => $endDate
        ]);
    }

    public function downloadPenggunaanBahanBakuPDF(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $penggunaanBahanBaku = PemakaianBahanBaku::with('bahan_baku')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->get();

        $pdf = PDF::loadView('mo.laporan.penggunaan_bahan_baku_pdf', compact('penggunaanBahanBaku', 'startDate', 'endDate'));

        $output = $pdf->output();
        $fileName = 'Laporan_Penggunaan_Bahan_Baku_' . $startDate . '_to_' . $endDate . '.pdf';

        return response()->streamDownload(
            fn() => print($output),
            $fileName,
            ['Content-Type' => 'application/pdf']
        );
    }
}
