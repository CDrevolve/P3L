<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index()
    {
        $produk = Produk::all();
        return view('admin.daftar_produk', compact('produk'));
    }

    public function show($id_produk)
    {
        $produk = Produk::findOrFail($id_produk);
        return view("admin.isi_produk", compact("produk"));
    }

    public function create()
    {
        return view("admin.create_produk");
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_jenis' => 'required|numeric',
            'id_resep' => 'required|numeric',
            'nama' => 'required|string|max:255',
            'stok' => 'required|numeric',
            'harga' => 'required|numeric',
            'kuota_harian' => 'required|numeric',
        ]);

        Produk::create([
            'id_jenis' => $request->input('id_jenis'),
            'id_resep' => $request->input('id_resep'),
            'nama' => $request->input('nama'),
            'stok' => $request->input('stok'),
            'harga' => $request->input('harga'),
            'kuota_harian' => $request->input('kuota_harian'),
        ]);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan');
    }
    public function edit($id_produk)
    {
        $produk = Produk::findOrFail($id_produk);
        return view('admin.edit_produk', compact('produk'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'stok' => 'required|numeric',
            'harga' => 'required|numeric',
            'kuota_harian' => 'required|numeric',
        ]);

        $produk = Produk::findOrFail($id);
        $produk->update($request->all());

        return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui');
    }

    public function destroy($id_produk)
    {
        $produk = Produk::findOrFail($id_produk);
        $produk->delete();

        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus');
    }
    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        // Lakukan pencarian berdasarkan keyword
        $produk = Produk::where('nama', 'like', '%' . $keyword . '%')->get();

        return view('admin.daftar_produk', compact('produk'));
    }
}
