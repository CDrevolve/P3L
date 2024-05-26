<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemesanan;
use App\Models\Customer;
use App\Models\Alamat;

class PesananController extends Controller
{
    public function pesananAntar()
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
        $pesanan->updateHarga();
        $pesanan->save();

        return redirect()->route('pesanan.antar')->with('success', 'Jarak dan harga berhasil diperbarui.');
    }

    public function pesananSudahDibayar()
    {
        $pesanans = Pemesanan::where('status', 'sudah dibayar')->get();
        return view('admin.pesanan_sudah_dibayar', compact('pesanans'));
    }

    public function konfirmasiPembayaran(Request $request, $id)
    {
        $pesanan = Pemesanan::findOrFail($id);

        // Validasi input jumlah pembayaran
        $request->validate([
            'jumlah_pembayaran' => 'required|numeric|min:0',
        ]);

        // Update jumlah_pembayaran dan status pada pesanan
        $pesanan->jumlah_pembayaran = $request->jumlah_pembayaran;
        $pesanan->status = 'pembayaran valid';
        $pesanan->save();

        // Tambahkan log atau lakukan tindakan lain sesuai kebutuhan

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Pembayaran telah berhasil dikonfirmasi.');
    }
}

