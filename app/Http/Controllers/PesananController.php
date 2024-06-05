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
        $pesanan->updateHarga();
        $pesanan->save();

        return redirect()->route('pesanan.index')->with('success', 'Jarak dan harga berhasil diperbarui.');
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
        $pesanan->calculateTips();
        $pesanan->status = 'pembayaran valid';
        $pesanan->save();

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Pembayaran telah berhasil dikonfirmasi.');
    }

    public function pesananSedangDiproses()
    {
        $pesanans = Pemesanan::where('status', 'sedang diproses')->get();
        return view('admin.pesanan_sedang_diproses', compact('pesanans'));
    }

    public function updateStatus($id)
    {
        $pesanan = Pemesanan::findOrFail($id);
        
        if ($pesanan->pickup == 1) {
            $pesanan->status = 'siap dipick-up';
        } else {
            $pesanan->status = 'sedang dikirim';
        }

        $pesanan->save();

        return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui.');
    }

    public function pesananSudahDipickup()
    {
        $pesanans = Pemesanan::where('status', 'siap dipick-up')->get();
        return view('admin.pesanan_sudah_dipickup', compact('pesanans'));
    }

    public function updatePickupStatus(Request $request, $id)
    {
        $pesanan = Pemesanan::findOrFail($id);

        if ($request->input('pickup_option') == 'pihak_ketiga') {
            $pesanan->status = 'sudah di-pickup';
        } else {
            $pesanan->status = 'selesai';
        }

        $pesanan->save();

        return redirect()->route('pesanan.sudahDipickup')->with('success', 'Status pesanan berhasil diperbarui.');
    }
}

