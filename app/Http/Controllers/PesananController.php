<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use App\Models\Pemesanan;
use App\Models\DetailPemesanan;
use App\Models\Customer;
use App\Models\Alamat;
use Carbon\Carbon;

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

        return redirect()->back()->with('success', 'Pembayaran telah berhasil dikonfirmasi.');
    }

    public function prosesIndex()
    {
        $today = Carbon::today();
    
        // Using eager loading to load the relationships
        $pemesanans = Pemesanan::whereDate('tanggal', $today)
                                ->where('status', 'diterima')
                                ->with(['detailpemesanans.produk'])
                                ->get();
                                
        return view('mo.pemesanans', compact('pemesanans'));
    }
    
    public function prosesPesanan($id)
    {
        $detailPemesanan = DetailPemesanan::find($id);
        if ($detailPemesanan) {
            $detailPemesanan->pemesanan->status = 'diproses'; // Contoh update status
            $detailPemesanan->pemesanan->save();
        }

        return redirect()->route('pesanan.prosesIndex')->with('success', 'Pesanan berhasil diproses.');
    }
}

