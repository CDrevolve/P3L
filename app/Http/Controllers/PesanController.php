<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Pemesanan;
use Illuminate\Support\Facades\Auth;

class PesanController extends Controller
{
    public function index()
    {
        $produk = Produk::all();
        return view('customer.productPage', compact('produk'));
    }

    public function show($id)
    {
        // Mengambil produk berdasarkan ID
        $produk = Produk::find($id);

        // Cek jika produk tidak ditemukan
        if (!$produk) {
            return redirect()->route('produk.index')->with('error', 'Produk tidak ditemukan');
        }

        // Mengirim data produk ke view
        return view('customer.productPage', compact('produk'));
    }
}

