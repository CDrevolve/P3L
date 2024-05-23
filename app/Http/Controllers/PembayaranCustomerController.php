<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemesanan;

class PembayaranCustomerController extends Controller
{
    //
    public function index()
    {

        $pemesanans = Pemesanan::where('id_customer', auth()->user()->id)->where('status', 'belum bayar')->get();
        return view('customer.daftarPesananBayar', compact('pemesanans'));
    }

    public function update(Request $request, $id)
    {
        $pemesanan = Pemesanan::findOrFail($id);


        $image = $request->file('bukti_pembayaran');
        $imageName = $image->getClientOriginalName();
        $destinationPath = public_path('images/buktiBayar/');
        $image->move($destinationPath, $imageName);
        $destinationPath = 'images/buktiBayar/' . $imageName;

        if ($pemesanan->total_harga + $pemesanan->ongkir < $request->total_bayar) {
            $pemesanan->update([
                'status' => 'sudah dibayar',
                'tips'  => $request->total_bayar - $pemesanan->harga - $pemesanan->ongkir,
                'bukti_pembayaran' => $destinationPath,
            ]);
        }

        return redirect()->route('pesananBayar.index');
    }

    public function show($id)
    {
        $pemesanan = Pemesanan::findOrFail($id);
        
        return view('customer.pembayaran', compact('pemesanan'));
    }
}
