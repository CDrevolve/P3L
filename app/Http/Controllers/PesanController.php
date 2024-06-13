<?php

namespace App\Http\Controllers;

use App\Models\DetailTanggal;
use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Tanggal;
use App\Models\Hampers;
use App\Models\DetailHampers;
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
        $tanggal = Tanggal::where('tanggal',session('selected_date'))->first();
        $detailtanggal = DetailTanggal::where('id_tanggal',$tanggal->id)->where('id_produk',$produk->id)->first();
        // Cek jika produk tidak ditemukan
        if (!$produk) {
            return redirect()->route('produk.index')->with('error', 'Produk tidak ditemukan');
        }

        // Mengirim data produk ke view
        return view('customer.productPage', compact('produk','detailtanggal'));
    }

    public function showHampers($id)
    {
        $hampers = Hampers::findOrFail($id);
        $detailhampers = DetailHampers::where('id_hampers', $id)->get();
        
        return view ('customer.hampersPage', compact('detailhampers','hampers'));
    }
}

