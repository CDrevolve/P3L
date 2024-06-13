<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pemesanan;
use Illuminate\Support\Facades\Auth;

class PesanannMobileController extends Controller
{

    public function index()
    {
        try {
            $pengirimanPesanans = Pemesanan::where('id_customer', Auth::id())
                                            ->whereIn('status', ['sedang dikirim', 'sudah dipick-up'])
                                            ->get();

            return response()->json([
                'message' => 'sukses',
                'pemesanan' => $pengirimanPesanans
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'error',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function updateStatus(Request $request, $id)
    {
        try {
            $pesanan = Pemesanan::findOrFail($id);
            $pesanan->status = 'Selesai';
            $pesanan->save();

            return response()->json([
                'message' => 'Pesanan telah selesai.',
                'pemesanan' => $pesanan
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'error',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
