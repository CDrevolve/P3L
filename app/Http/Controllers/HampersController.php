<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreHampersRequest;
use App\Models\Hampers;
use App\Models\DetailHampers;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HampersController extends Controller
{
    // Menampilkan daftar hampers
    public function index()
    {
        $hampers = Hampers::with('detailHampers.produk')->get();
        return view('admin.hampers.index', compact('hampers'));
    }

    // Menampilkan form untuk membuat hampers baru
    public function create()
    {
        $produks = Produk::all();
        return view('admin.hampers.create', compact('produks'));
    }

    // Menyimpan hampers baru
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'produk_id' => 'required|array|min:3', // Minimal harus memilih 3 produk
            'produk_id.*' => 'required|exists:produks,id', // Pastikan semua produk yang dipilih ada dalam database
        ]);
    
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()], 400);
        }
    
        $hampers = Hampers::create([
            'nama' => $request->get('nama'),
            'harga' => $request->get('harga'),
        ]);
    
        foreach ($request->get('produk_id') as $produk_id) {
            DetailHampers::create([
                'id_hampers' => $hampers->id,
                'id_produk' => $produk_id,
            ]);
        }
    
        return redirect()->route('hampers.index')->with('success', 'Hampers berhasil ditambahkan.');
    }
    
   
    // Menampilkan form untuk mengedit hampers
    public function edit($id)
    {
        $hampers = Hampers::with('detailHampers')->findOrFail($id);
        $produks = Produk::all();
        $selectedProduks = $hampers->detailHampers->pluck('id_produk')->toArray();
        return view('admin.hampers.edit', compact('hampers', 'produks', 'selectedProduks'));
    }

    // Mengupdate hampers yang ada
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'produk_id' => 'required|array|min:3', // Minimal harus memilih 3 produk
            'produk_id.*' => 'required|exists:produks,id', // Pastikan semua produk yang dipilih ada dalam database
        ]);
    
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()], 400);
        }
    
        $hampers = Hampers::findOrFail($id);
        $hampers->update([
            'nama' => $request->get('nama'),
            'harga' => $request->get('harga'),
        ]);
    
        // Hapus detail hampers yang lama
        DetailHampers::where('id_hampers', $hampers->id)->delete();
    
        // Tambahkan detail hampers yang baru
        foreach ($request->get('produk_id') as $produk_id) {
            DetailHampers::create([
                'id_hampers' => $hampers->id,
                'id_produk' => $produk_id,
            ]);
        }
    
        return redirect()->route('hampers.index')->with('success', 'Hampers berhasil diupdate.');
    }
    
    // Menghapus hampers
    public function destroy($id)
    {
        $hampers = Hampers::findOrFail($id);
        $hampers->delete();

        return redirect()->route('hampers.index')->with('success', 'Hampers berhasil dihapus.');
    }
    public function show($id)
    {
        $hampers = Hampers::with('detailHampers.produk')->findOrFail($id);
        return view('admin.hampers.show', compact('hampers'));
    }
    public function showCustomer($id)
    {
        $hampers = Hampers::with('detailHampers.produk')->findOrFail($id);
        return view('customer.productPage', compact('hampers'));
    }
}
