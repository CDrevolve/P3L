<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemesanan;
use Illuminate\Support\Facades\Auth;

class PesananMobileController extends Controller
{
    public function index()
    {
        $pengirimanPesanans = Pemesanan::where('id_customer', auth()->user()->id)
            ->whereIn('status', ['sedang dikirim', 'sudah di-pickup'])
            ->get();

        return response()->json([
            'message' => 'sukses',
            'pemesanan' => $pengirimanPesanans
        ], 200);
    }

    public function updateStatus(Request $request, $id)
    {
        $pesanan = Pemesanan::findOrFail($id);
        $pesanan->status = 'Selesai';
        $pesanan->save();

        return response()->json([
            'message' => 'Pesanan telah selesai, Selamat menikmati.'
        ], 200);
    }
}

