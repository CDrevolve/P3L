<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use App\Models\Pemesanan;
use App\Models\BahanBaku;
use App\Models\DetailPemesanan;
use App\Models\PemakaianBahanBaku;
use App\Models\DetailProduk;
use App\Models\Resep;
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
        $pesanan->status = 'Belum Bayar';
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
                        ->where(function ($query) {
                            $query->where('status', 'diterima')
                                  ->orWhere('status', 'diproses');
                        })
                        ->with(['detailpemesanans.produk'])
                        ->get();
                                
        return view('mo.pemesanans', compact('pemesanans'));
    }
    
    public function prosesPesanan($id)
    {
        $detailPemesanan = DetailPemesanan::find($id);
    
        if (!$detailPemesanan) {
            return redirect()->route('pesanan.prosesIndex')->with('error', 'Pesanan tidak ditemukan.');
        }
    
        $produk = $detailPemesanan->produk;
        $resep = Resep::where('id_produk', $produk->id)->first();
        $detailProduk = DetailProduk::where('id_resep', $resep->id)->get();
    
        // Check if stock is sufficient
        foreach ($detailProduk as $dp) {
            $bahanBaku = BahanBaku::findOrFail($dp->id_bahan_baku);
            if ($bahanBaku->stok < $dp->jumlah) {
                return redirect()->route('pesanan.prosesIndex')->with('error', 'Bahan baku tidak cukup untuk memproses pesanan.');
            }
        }
    
        // Update stock levels if sufficient
        foreach ($detailProduk as $dp) {
            $bahanBaku = BahanBaku::findOrFail($dp->id_bahan_baku);
            $bahanBaku->stok -= $dp->jumlah;
            $bahanBaku->save();
    
            // Catat pemakaian bahan baku
            $pemakaian = new PemakaianBahanBaku();
            $pemakaian->bahan_baku_id = $bahanBaku->id;
            $pemakaian->jumlah = $dp->jumlah;
            $pemakaian->save();
        }
    
        // Update the order status
        $detailPemesanan->pemesanan->status = ' sedang diproses';
        $detailPemesanan->pemesanan->save();
    
        return redirect()->route('pesanan.prosesIndex')->with('success', 'Pesanan berhasil diproses.');
    }
    
    public function prosesSemua()
{
    // Mengambil semua pesanan yang belum diproses
    $pemesanans = Pemesanan::where('status', '!=', 'diproses')->get();

    // Flag untuk menandai apakah semua pesanan bisa diproses
    $semuaBahanCukup = true;

    // Memeriksa stok bahan baku untuk setiap pesanan
    foreach ($pemesanans as $pemesanan) {
        $detailPemesanans = $pemesanan->detailpemesanans;

        foreach ($detailPemesanans as $detailPemesanan) {
            $produk = $detailPemesanan->produk;
            $resep = Resep::where('id_produk', $produk->id)->first();
            $detailProduk = DetailProduk::where('id_resep', $resep->id)->get();

            // Memeriksa apakah stok bahan baku cukup untuk setiap detail pemesanan
            foreach ($detailProduk as $dp) {
                $bahanBaku = BahanBaku::findOrFail($dp->id_bahan_baku);
                if ($bahanBaku->stok < $dp->jumlah) {
                    $semuaBahanCukup = false;
                    break 3; // Mengakhiri semua loop jika ada bahan baku yang tidak cukup
                }
            }
        }
    }

    // Jika semua bahan cukup, proses semua pesanan
    if ($semuaBahanCukup) {
        foreach ($pemesanans as $pemesanan) {
            $pemesanan->status = 'sedang diproses';
            $pemesanan->save();

            foreach ($pemesanan->detailpemesanans as $detailPemesanan) {
                $produk = $detailPemesanan->produk;
                $resep = Resep::where('id_produk', $produk->id)->first();
                $detailProduk = DetailProduk::where('id_resep', $resep->id)->get();

                // Mengurangi stok bahan baku
                foreach ($detailProduk as $dp) {
                    $bahanBaku = BahanBaku::findOrFail($dp->id_bahan_baku);
                    $bahanBaku->stok -= $dp->jumlah;
                    $bahanBaku->save();

                    // Catat pemakaian bahan baku
                    $pemakaian = new PemakaianBahanBaku();
                    $pemakaian->bahan_baku_id = $bahanBaku->id;
                    $pemakaian->jumlah = $dp->jumlah;
                    $pemakaian->save();
                }
            }
        }

        return redirect()->back()->with('success', 'Semua pesanan berhasil diproses.');
    } else {
        return redirect()->back()->with('error', 'Tidak bisa memproses semua pesanan karena stok bahan baku tidak cukup.');
    }
}

 public function riwayatIndex()
    {
        $riwayatPemakaian = PemakaianBahanBaku::all();
        return view('mo.pemakaianbb', compact('riwayatPemakaian'));
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

    public function pesananTelatBayar()
    {
        $now = Carbon::now();
        $pesanans = Pemesanan::where('status', 'belum bayar')
            ->where('created_at', '<', $now->subDay())
            ->get();

        return view('admin.pesanan_telat_bayar', compact('pesanans'));
    }

    public function batalkanPesanan($id)
{
    $pesanan = Pemesanan::findOrFail($id);

    $detailPemesanan = DetailPemesanan::where('id_pemesanan', $pesanan->id)->get();

    foreach ($detailPemesanan as $dp) {
        $produk = Produk::findOrFail($dp->id_produk);
        $produk->kuota_harian_terpakai -= $dp->jumlah;
        $produk->save(); 
    }

    $pesanan->status = 'dibatalkan';
    $pesanan->save(); 

    return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui menjadi dibatalkan.');


}
}