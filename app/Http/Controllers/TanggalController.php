<?php

namespace App\Http\Controllers;

use App\Models\Hampers;
use Illuminate\Http\Request;
use App\Models\Tanggal;
use App\Models\Produk;

class TanggalController extends Controller
{
    public function selectTanggal(Request $request)
    {
        // Validasi input
        $request->validate([
            'tanggal' => 'required|date',
        ]);

        // Ambil tanggal dari request
        $tanggal = $request->input('tanggal');
        $request->session()->put('selected_date', $tanggal);
        $tanggalModel = Tanggal::whereDate('tanggal', $tanggal)->first();

        // Jika tanggal belum ada, buat baru
        if (!$tanggalModel) {
            $tanggalModel = new Tanggal();
            $tanggalModel->tanggal = $tanggal; // Atur kouta harian ke nilai default
            $tanggalModel->save();
        }

    
        $produk = Produk::all(); 
        $hampers = Hampers::all(); 

        return view('dashboard.landingPage')->with('tanggal', $tanggal)->with('produk', $produk)->with('hampers', $hampers);
    }

}