<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembelian;
use App\Models\BahanBaku;

class PembelianBBController extends Controller
{
    public function index()
    {
        // Mengambil data pembelian yang memiliki id_bahanbaku
        $pembelian = Pembelian::whereNotNull('id_bahanbaku')->get();
        return view('mo.pembelian', compact('pembelian'));
    }

    public function create()
    {
        return view('mo.create_pembelian');
    }

    public function store(Request $request)
{
    $request->validate([
        'id_bahanbaku' => 'required|numeric',
        'nama' => 'required|string|max:255',
        'jenis' => 'required|string|max:255',
        'tanggal'=> 'required|date',
        'harga' => 'required|numeric',
        'jumlah' => 'required|numeric',
    ]);

    // Simpan pembelian
    $pembelian = Pembelian::create($request->all());

    // Kurangi stok bahan baku yang terkait
    $bahanBaku = BahanBaku::findOrFail($request->input('id_bahanbaku'));
    $bahanBaku->stok -= $request->input('jumlah');
    $bahanBaku->save();

    return redirect()->route('mo.create_pembelian')->with('success', 'Data pembelian berhasil ditambahkan');
}

    public function edit($id_pengeluaran)
    {
        $pembelian = Pembelian::findOrFail($id_pengeluaran);
        return view('mo.edit_pembelian', compact('pembelian'));
    }

    public function update(Request $request, $id_pengeluaran)
{
    $request->validate([
        'id_bahanbaku' => 'required|numeric',
        'nama' => 'required|string|max:255',
        'jenis' => 'required|string|max:255', 
        'tanggal' => 'required|date',
        'harga' => 'required|numeric',
        'jumlah' => 'required|numeric',
    ]);

    // Temukan pembelian
    $pembelian = Pembelian::findOrFail($id_pengeluaran);
    // Simpan jumlah pembelian sebelum diubah
    $jumlahSebelumnya = $pembelian->jumlah;
    // Update pembelian
    $pembelian->update($request->all());

    // Update stok bahan baku yang terkait
    $bahanBaku = BahanBaku::findOrFail($request->input('id_bahanbaku'));
    // Kembalikan stok sebelumnya
    $bahanBaku->stok += $jumlahSebelumnya;
    // Kurangi stok baru
    $bahanBaku->stok -= $request->input('jumlah');
    $bahanBaku->save();

    return redirect()->route('pembelian.index')->with('success', 'Data pembelian berhasil diperbarui');
}

    public function destroy($id_pembelian)
    {
        $pembelian = Pembelian::findOrFail($id_pembelian);
        $pembelian->delete();

        return redirect()->route('pembelian.index')->with('success', 'Data pembelian berhasil dihapus');
    }

}
