<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chart;
use App\Models\Customer;
use App\Models\Alamat;
use App\Models\Produk;
use App\Models\Hampers; // Add Hampers model
use Illuminate\Support\Facades\Auth;

class ChartController extends Controller
{
    public function index()
    {
        $customer = Customer::findOrFail(Auth::id());
        $alamats = Alamat::where('id_customer',$customer->id)->get();

        // Mengambil data chart (keranjang belanja) berdasarkan ID customer
        $chart = Chart::where('id_customer', $customer->id)->get();
        $totalPrice = 0;
        foreach($chart as $charts){
            $produk = Produk::findOrFail($charts->id_produk);
            $totalPrice += $produk->harga * $charts->jumlah;
        }
        $poin = 0;

        while ($totalPrice >= 10000) {
            if ($totalPrice >= 1000000) {
                $poin += 200;
                $totalPrice -= 1000000;
            } else if ($totalPrice >= 500000) {
                $poin += 75;
                $totalPrice -= 500000;
            } else if ($totalPrice >= 100000) {
                $poin += 15;
                $totalPrice -= 100000;
            } else if ($totalPrice >= 10000) {
                $poin += 1;
                $totalPrice -= 10000;
            }
        }
        return view('customer.chart', compact('chart','customer','alamats','poin'));
    }
    public function addToChart(Request $request, $id)
    {
        $produk = Produk::find($id);
    
        if (!$produk) {
            return redirect()->back()->with('error', 'Produk tidak ditemukan');
        }
    
        // Cek apakah kuota harian produk tidak sama dengan 0
        if ($produk->kuota_harian !== 0) {
            // Membuat entri baru di chart untuk produk
            $chart = new Chart();
            $chart->id_customer = Auth::id();
            $chart->id_produk = $produk->id;
            $chart->jumlah = $request->jumlah; // Anda mungkin ingin menyesuaikan dengan input jumlah yang diberikan oleh pengguna
            $chart->save();
    
            return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang');
        } else {
            return redirect()->back()->with('error', 'Kuota harian produk sudah habis');
        }
        
    }
    

    public function removeFromChart($id)
    {
        $chart = Chart::find($id);

        if (!$chart) {
            return redirect()->back()->with('error', 'Item tidak ditemukan di keranjang');
        }

        $chart->delete();

        return redirect()->back()->with('success', 'Item berhasil dihapus dari keranjang');
    }
}
