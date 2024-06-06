<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemesanan;
use App\Models\Customer;
use App\Models\Alamat;

class PesananMobileController extends Controller
{
    public function index()
    {
        $pengirimanPesanans = Pemesanan::where('id_customer', auth()->user()->id)->where('status', ['sedang dikirim', 'sudah di-pickup'])->get();

        return response()->json([
            'messege' => 'sukses',
            'pemesanan' => $pengirimanPesanans
        ], 200);
    }

    public function updateStatus(Request $request, $id)
    {

        $pesanan = Pemesanan::findOrFail($id);
        $pesanan->status = 'Selesai';
        $pesanan->save();

        return redirect()->route('pesananPengiriman.index')->with('success', 'Pesanan telah selesai, Selamat menikmati.');
    }
}
