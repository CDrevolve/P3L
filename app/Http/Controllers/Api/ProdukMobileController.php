<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukMobileController extends Controller
{
    // Method untuk menampilkan semua produk
    public function index()
    {
        // Mengambil semua produk dari database
        $produk = Produk::all();

        // Mengembalikan data dalam format JSON
        return response()->json([
            'success' => true,
            'message' => 'Data produk berhasil diambil',
            'data' => $produk
        ]);
    }

    // Method untuk menampilkan detail sebuah produk berdasarkan ID
    public function show($id)
    {
        // Mencari produk berdasarkan ID
        $produk = Produk::find($id);

        // Jika produk tidak ditemukan
        if (!$produk) {
            return response()->json([
                'success' => false,
                'message' => 'Produk tidak ditemukan',
                'data' => null
            ], 404); // Kode status 404 untuk produk tidak ditemukan
        }

        // Jika produk ditemukan, kembalikan detail produk dalam format JSON
        return response()->json([
            'success' => true,
            'message' => 'Detail produk berhasil diambil',
            'data' => $produk
        ]);
    }
}
