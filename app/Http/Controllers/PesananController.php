<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemesanan;
use App\Models\Customer;
use App\Models\Alamat;

class PesananController extends Controller
{
    public function index()
    {
        $pesanans = Pemesanan::where('pickup', 0)->whereNull('jarak')->get();
        return view('admin.pesanan_antar', compact('pesanans'));
    }

    public function updateJarak(Request $request, $id)
    {
        $request->validate([
            'jarak' => 'required|numeric'
        ]);

        $pesanan = Pemesanan::findOrFail($id);
        $pesanan->jarak = $request->input('jarak');
        $pesanan->updateHarga();  // Update harga dengan ongkir
        $pesanan->save();

        return redirect()->route('pesanan.index')->with('success', 'Jarak dan harga berhasil diperbarui.');
    }
}



