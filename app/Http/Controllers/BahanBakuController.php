<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BahanBaku;

class BahanBakuController extends Controller
{
    /**
     * Menampilkan daftar bahan baku.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bahanBakus = BahanBaku::all();
        return view('bahan_baku.index', compact('bahanBakus'));
    }

    /**
     * Menampilkan formulir untuk membuat bahan baku baru.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('bahan_baku.create');
    }

    /**
     * Menyimpan bahan baku yang baru dibuat.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_bahan_baku' => 'required|string',
            'satuan_bahan_baku' => 'required|string',
            'stok_bahan_baku' => 'required|numeric',
        ]);

        BahanBaku::create($request->all());

        return redirect()->route('bahan-baku.index')
            ->with('success', 'Bahan baku berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail dari bahan baku tertentu.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bahanBaku = BahanBaku::find($id);
        return view('bahan_baku.show', compact('bahanBaku'));
    }

    /**
     * Menampilkan formulir untuk mengedit bahan baku tertentu.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bahanBaku = BahanBaku::find($id);
        return view('bahan_baku.edit', compact('bahanBaku'));
    }

    /**
     * Memperbarui bahan baku tertentu.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_bahan_baku' => 'required|string',
            'satuan_bahan_baku' => 'required|string',
            'stok_bahan_baku' => 'required|numeric',
        ]);

        BahanBaku::find($id)->update($request->all());

        return redirect()->route('bahan-baku.index')
            ->with('success', 'Bahan baku berhasil diperbarui.');
    }

    /**
     * Menghapus bahan baku tertentu dari penyimpanan.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        BahanBaku::destroy($id);

        return redirect()->route('bahan-baku.index')
            ->with('success', 'Bahan baku berhasil dihapus.');
    }
}
