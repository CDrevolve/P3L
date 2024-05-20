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
        $bahanbakus = BahanBaku::all();
        return view('mo.create_pembelian', compact('bahanbakus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_bahanbaku' => 'required|numeric',
            'nama' => 'required|string|max:255',
            'jumlah' => 'required|numeric',
            'harga' => 'required|numeric',
            'tanggal' => 'required|date',
        ]);

        // Simpan pembelian
        $pembelian = Pembelian::create($request->all());

        $bahanBaku = BahanBaku::findOrFail($request->input('id_bahanbaku'));
        $bahanBaku->stok += $request->input('jumlah');
        $bahanBaku->save();

        return redirect()->route('pembelian.index')->with('success', 'Data pembelian berhasil ditambahkan');
    }

    public function edit($id_pengeluaran)
    {
        $bahanbakus = BahanBaku::all();
        $pembelian = Pembelian::findOrFail($id_pengeluaran);
        return view('mo.edit_pembelian', compact('pembelian','bahanbakus'));
    }

    public function update(Request $request, $id_pengeluaran)
{
    $request->validate([
        'id_bahanbaku' => 'required|numeric',
        'nama' => 'required|string|max:255',
        'jumlah' => 'required|numeric',
        'harga' => 'required|numeric',
        'tanggal' => 'required|date',
    ]);

    // Temukan pembelian
    $pembelian = Pembelian::findOrFail($id_pengeluaran);
    // Simpan jumlah pembelian sebelum diubah
    $jumlahSebelumnya = $pembelian->jumlah;
    
    // Hitung perbedaan jumlah
    $perbedaan = $request->input('jumlah') - $jumlahSebelumnya;

    // Update pembelian
    $pembelian->update($request->all());

    // Update stok bahan baku yang terkait
    $bahanBaku = BahanBaku::findOrFail($request->input('id_bahanbaku'));
    // Jika ada penambahan, tambahkan perbedaan tersebut ke stok
    if ($perbedaan > 0) {
        $bahanBaku->stok += $perbedaan;
    }
    // Jika ada pengurangan, kurangkan perbedaan tersebut dari stok
    elseif ($perbedaan < 0) {
        $bahanBaku->stok -= abs($perbedaan);
    }
    $bahanBaku->save();

    return redirect()->route('pembelian.index')->with('success', 'Data pembelian berhasil diperbarui');
}


    public function destroy($id_pembelian)
    {
        try {
            // Temukan pembelian yang akan dihapus
            $pembelian = Pembelian::findOrFail($id_pembelian);
            
            // Simpan jumlah pembelian sebelum dihapus
            $jumlahSebelumnya = $pembelian->jumlah;
    
            // Hapus pembelian
            $pembelian->delete();
    
            // Temukan bahan baku yang terkait
            $bahanBaku = BahanBaku::findOrFail($pembelian->id_bahanbaku);
    
            // Kurangi stok bahan baku dengan jumlah pembelian sebelumnya
            $bahanBaku->stok -= $jumlahSebelumnya;
            $bahanBaku->save();
    
            return redirect()->route('pembelian.index')->with('success', 'Data pembelian berhasil dihapus');
        } catch (\Exception $e) {
            // Tangani kesalahan jika pembelian tidak ditemukan
            return redirect()->route('pembelian.index')->with('error', 'Gagal menghapus pembelian. ' . $e->getMessage());
        }
    }
    
}
