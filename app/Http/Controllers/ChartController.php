<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chart;
use App\Models\Customer;
use App\Models\Alamat;
use App\Models\Produk;
use Illuminate\Support\Facades\Auth;

class ChartController extends Controller
{
    public function index()
{
    $customer = Customer::findOrFail(Auth::id());
    $alamats = Alamat::where('id_customer',$customer->id)->get();

    // Mengambil data chart (keranjang belanja) berdasarkan ID customer
    $chart = Chart::where('id_customer', $customer->id)->get();

    return view('customer.chart', compact('chart','customer','alamats'));
}

    public function addToChart(Request $request, $id)
    {
        $produk = Produk::find($id);

        if (!$produk) {
            return redirect()->back()->with('error', 'Produk tidak ditemukan');
        }

        // Membuat entri baru di chart
        $chart = new Chart();
        $chart->id_customer = Auth::id();
        $chart->id_produk = $produk->id;
        $chart->jumlah = $request->jumlah; // Anda mungkin ingin menyesuaikan dengan input jumlah yang diberikan oleh pengguna
        $chart->save();

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang');
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
