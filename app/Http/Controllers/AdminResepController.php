<?php

namespace App\Http\Controllers;

use App\Models\Resep;
use App\Models\DetailProduk;
use App\Models\BahanBaku;
use Illuminate\Http\Request;

class AdminResepController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');

        // Jika terdapat keyword pencarian
        if ($keyword) {
            $reseps = Resep::where('nama_resep', 'like', '%' . $keyword . '%')->get();
        } else {
            // Jika tidak ada keyword, tampilkan semua resep
            $reseps = Resep::all();
        }

        return view('admin.daftar_resep', compact('reseps', 'keyword'));
    }

    public function show($id)
    {
        $resep = Resep::findOrFail($id);
        return view('admin.detail_resep', compact('resep'));
    }

    public function create()
    {
        $bahanBaku = BahanBaku::all();
        return view('admin.create_resep', compact('bahanBaku'));
    }

    public function store(Request $request)
    {
        // Validasi data yang dikirimkan
        $request->validate([
            'nama_resep' => 'required|string|max:255',
            'id_bahan_baku' => 'required|string|max:255',
            'jumlah' => 'required|numeric|min:1', // Ubah sesuai kebutuhan validasi
        ]);
    
        // Cari resep berdasarkan nama, jika sudah ada, gunakan yang sudah ada
        $resep = Resep::firstOrCreate(['nama_resep' => $request->nama_resep]);

        $resep->detailProduks()->create([
            'id_bahan_baku' => $request->id_bahan_baku,
            'jumlah' => $request->jumlah,
        ]);
         
        // Redirect ke halaman daftar resep setelah berhasil menambahkan resep
        return redirect()->route('resep.index')->with('success', 'Resep berhasil ditambahkan.');
    }
    
    public function edit($id)
    {
        $resep = Resep::findOrFail($id);
        $bahanBaku = BahanBaku::all();
        // Ambil detail produk yang akan diedit
        $detailProduk = $resep->detailProduks->first();
        return view('admin.edit_resep', compact('resep', 'bahanBaku', 'detailProduk'));
    }

    public function update(Request $request, $id)
{
    // Validasi data yang dikirimkan
    $request->validate([
        'nama_resep' => 'required|string|max:255',
        'id_bahan_baku' => 'required|string|max:255',
        'bahan_baru' => 'required|string|max:255', // Tambahkan validasi untuk bahan baru
        'jumlah' => 'required|numeric|min:1', // Sesuaikan dengan kebutuhan validasi
    ]);

    // Cari resep yang akan diupdate
    $resep = Resep::findOrFail($id);

    // Ambil detail produk yang akan diupdate
    $detailProduk = $resep->detailProduks->where('id_bahan_baku', $request->id_bahan_baku)->first();

    // Perbarui detail produk sesuai dengan input dari pengguna
    if ($detailProduk) {
        $detailProduk->id_bahan_baku = $request->bahan_baru; // Gunakan bahan baru yang dipilih oleh pengguna
        $detailProduk->jumlah = $request->jumlah;
        $detailProduk->save();
    }

    // Update nama resep jika diinginkan
    $resep->nama_resep = $request->nama_resep;
    $resep->save();

    // Redirect ke halaman daftar resep setelah berhasil mengupdate resep
    return redirect()->route('resep.index')->with('success', 'Resep berhasil diperbarui.');
}


    public function destroy($id)
    {
        $resep = Resep::findOrFail($id);
        $resep->delete();

        return redirect()->route('resep.index')->with('success', 'Resep berhasil dihapus.');
    }
}
