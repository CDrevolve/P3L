<?php

namespace App\Http\Controllers;

use App\Models\DetailTanggal;
use App\Models\Hampers;
use Illuminate\Http\Request;
use App\Models\Tanggal;
use App\Models\Produk;

class TanggalController extends Controller
{
    public function selectTanggal(Request $request)
    {
        $produk = Produk::all(); 
        $hampers = Hampers::all(); 
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
            foreach($produk as $produks){
                $details = new DetailTanggal();
                $details->id_tanggal = $tanggalModel->id;
                $details->id_produk = $produks->id;
                $details->kuota_terpakai = 0;
                $details->save();
            }
        }

        foreach($produk as $produks){
            $produkcheck = DetailTanggal::where('id_tanggal',$tanggalModel->id)->where('id_produk', $produks->id)->first();
            if($produkcheck == null){
                $newdetail = new DetailTanggal();
                $newdetail->id_tanggal = $tanggalModel->id;
                $newdetail->id_produk = $produks->id;
                $newdetail->kuota_terpakai = 0;
                $newdetail->save();
            }
        }
        return view('dashboard.landingPage')->with('tanggal', $tanggal)->with('produk', $produk)->with('hampers', $hampers);
    }

}