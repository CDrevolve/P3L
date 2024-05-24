<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Jenis;
// use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProdukController extends Controller
{
    public function index()
    {
        $produk = Produk::all();
        return view('admin.daftar_produk', compact('produk'));
    }
    public function indexDashboard()
    {
        $produk = Produk::all();
        return view('dashboard.landingpage', compact('produk'));  
    }

    public function show($id_produk)
    {
        $produk = Produk::findOrFail($id_produk);
        return view("admin.isi_produk", compact('produk'));
    }
    

    public function create()
    {
        $jenis = Jenis::all();
        return view("admin.create_produk", compact('jenis'));
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'id_jenis' => 'required|numeric',
            'nama' => 'required|string|max:255',
            'stok' => 'required|numeric',
            'harga' => 'required|numeric',
            'kuota_harian' => 'required|numeric',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()], 400);
        }
        // $request->validate([
        //     'id_jenis' => 'required|numeric',
        //     'nama' => 'required|string|max:255',
        //     'stok' => 'required|numeric',
        //     'harga' => 'required|numeric',
        //     'kuota_harian' => 'required|numeric',
        //     'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        // ]);

        $image = $request->file('foto');
        $imageName = $image->getClientOriginalName();
        $destinationPath = ('images/produk');
        $image->move($destinationPath, $imageName);
        $destinationPath = 'images/produk/' . $imageName;

        Produk::create([
            'id_jenis' => $request->input('id_jenis'),
            'nama' => $request->input('nama'),
            'stok' => $request->input('stok'),
            'harga' => $request->input('harga'),
            'kuota_harian' => $request->input('kuota_harian'),
            'foto' => $destinationPath
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
