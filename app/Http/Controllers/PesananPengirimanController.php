<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemesanan;
use Illuminate\Support\Facades\Auth;

class PesananPengirimanController extends Controller
{
    public function index()
    {
        $pengirimanPesanans = Pemesanan::where('id_customer', auth()->user()->id)->where('status', ['sedang dikirim', 'sudah di-pickup'])->get();
        return view('customer.pesanan_pengiriman', compact('pengirimanPesanans'));
    }

    public function updateStatus(Request $request, $id)
    {

        $pesanan = Pemesanan::findOrFail($id);
        $pesanan->status = 'Selesai';
        $pesanan->save();

        return redirect()->route('pesananPengiriman.index')->with('success', 'Pesanan telah selesai, Selamat menikmati.');
    }
}
