<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BahanBaku;
use Carbon\Carbon;

class laporanpenggunaanbahanbakuController extends Controller
{
    public function laporanPenggunaanBahanBaku(Request $request)
    {
        // Ambil tanggal mulai dan akhir dari request atau gunakan default
        $startDate = $request->input('start_date', Carbon::now()->startOfMonth());
        $endDate = $request->input('end_date', Carbon::now()->endOfMonth());

        // Query untuk mendapatkan data penggunaan bahan baku pada periode tersebut
        $bahanBaku = BahanBaku::with(['detailProduks' => function($query) use ($startDate, $endDate) {
            $query->whereBetween('tanggal_penggunaan', [$startDate, $endDate]);
        }])->get();

        return view('owner.laporan_penggunaan_bahan_baku', compact('bahanBaku', 'startDate', 'endDate'));
    }
}
