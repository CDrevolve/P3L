<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailProduk;
use App\Models\Resep;
use App\Models\BahanBaku;

class AdminDetailProduk extends Controller
{
    //
    public function index($id)
    {
        $resep = Resep::findOrFail($id);
        $detailProduks = DetailProduk::where('id_resep', $resep->id)->get();
        $bahanBakus = BahanBaku::all();
        return view('admin.detail_produk', compact('detailProduks', 'resep', 'bahanBakus'));
    }

    public function store(Request $request, $id)
    {
        DetailProduk::create([
            'id_resep' => $id,
            'id_bahan_baku' => $request->input('id_bahan_baku'),
            'jumlah' => $request->input('jumlah'),
        ]);

        return redirect()->route('detail.resep', $id)->with('success', 'Detail Produk berhasil ditambahkan');
    }

    public function update(Request $request, $id, $id_resep)
    {
        $detailProduk = DetailProduk::findOrFail($id);
        $detailProduk->update([
            'id_bahan_baku' => $request->input('id_bahan_baku'),
            'jumlah' => $request->input('jumlah'),
        ]);

        return redirect()->route('detail.resep', $id_resep)->with('success', 'Detail Produk berhasil diubah');
    }

    public function destroy($id, $id_resep)
    {
        $detailProduk = DetailProduk::findOrFail($id);
        $detailProduk->delete();
        return redirect()->route('detail.resep', $id_resep)->with('success', 'Detail Produk berhasil dihapus');
    }
}
