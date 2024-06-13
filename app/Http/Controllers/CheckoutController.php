<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chart;
use App\Models\Customer;
use App\Models\User;
use App\Models\Produk;
use App\Models\Pemesanan;
use App\Models\Alamat;
use App\Models\Tanggal;
use App\Models\DetailTanggal;
use App\Models\DetailPemesanan;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CheckoutController extends Controller
{
    public function checkout(Request $request)
{
    $customer = Customer::findOrFail(Auth::id());
    $charts = Chart::where('id_customer', $customer->id)->get();

    $tanggal = Tanggal::where('tanggal',$request->date)->first();
    if($tanggal == null){
        $tanggal = new Tanggal();
        $tanggal->tanggal = $request->date;
        $tanggal->save();
        $tanggal = Tanggal::where('tanggal',$request->date)->first();
    }

    $totalPrice = 0;
    $productNames = [];
    $metode = $request->input('metode');
    $alamat = $request->input('alamat');
    $alamatBaru = $request->input('alamat_baru');
    $idAlamat = null;
    $poinDigunakan = (int) $request->input('poin');

    // Handle alamat baru
    if ($metode === 'delivery' && $alamat === 'new') {
        $alamatBaru = new Alamat();
        $alamatBaru->id_customer = $customer->id;
        $alamatBaru->nama = $request->input('alamat_baru');
        $alamatBaru->save();
        $idAlamat = $alamatBaru->id;
    } elseif ($metode === 'delivery') {
        $idAlamat = $alamat;
    }

    foreach ($charts as $chart) {
        $produk = Produk::findOrFail($chart->id_produk);
        $totalPrice += $produk->harga * $chart->jumlah;
        $productNames[] = $produk->nama;

        // Buat detail tanggal dengan id_tanggal yang sesuai
        $detailcheck = DetailTanggal::where('id_produk',$produk->id)->where('id_tanggal',$tanggal->id)->first();
        if($detailcheck == null){
            $detailTanggal = new DetailTanggal();
            $detailTanggal->kuota_terpakai = $chart->jumlah;
            $detailTanggal->id_tanggal = $tanggal->id;
            $detailTanggal->id_produk = $produk->id;
            $detailTanggal->save();
        }else{
            $detailcheck->kuota_terpakai += $chart->jumlah;
            $detailcheck->save();
        }   
    }


    $discount = $poinDigunakan * 100;
    if ($discount > $totalPrice) {
        return redirect()->back()->withErrors(['msg' => 'Poin yang digunakan melebihi total harga.']);
    }
    $totalPrice -= $discount;

    if ($poinDigunakan > $customer->poin) {
        return redirect()->back()->withErrors(['msg' => 'Poin yang digunakan melebihi jumlah poin yang dimiliki.']);
    }
    $customer->poin -= $poinDigunakan;
    $customer->save();

    $pemesanan = new Pemesanan();
    $pemesanan->id_customer = $customer->id;
    $pemesanan->id_karyawan = 1;
    $pemesanan->no_nota = null;
    $pemesanan->nama = $customer->nama;
    $pemesanan->isi = implode(', ', $productNames);
    $pemesanan->harga = $totalPrice;
    $pemesanan->pickup = $metode === 'pickup' ? 1 : 0;
    $pemesanan->status = 'Checkout';
    $pemesanan->tanggal = $tanggal->tanggal;
    $pemesanan->ongkir = 0;
    $pemesanan->id_alamat = $idAlamat;
    $pemesanan->bukti_pembayaran = null;
    $pemesanan->jumlah_pembayaran = $totalPrice;
    $pemesanan->tips = 0;

    $jumlah = $pemesanan->harga;
    $jumlah = $pemesanan->harga;
    $poin = 0;

    while ($jumlah >= 10000) {
        if ($jumlah >= 1000000) {
            $poin += 200;
            $jumlah -= 1000000;
        } else if ($jumlah >= 500000) {
            $poin += 75;
            $jumlah -= 500000;
        } else if ($jumlah >= 100000) {
            $poin += 15;
            $jumlah -= 100000;
        } else if ($jumlah >= 10000) {
            $poin += 1;
            $jumlah -= 10000;
        }
    }
    $pemesanan->poin_diperoleh = $poin;
    $pemesanan->save();


    foreach ($charts as $chart) {
        $detail = new DetailPemesanan();
        $detail->id_pemesanan = $pemesanan->id;
        $detail->id_produk = $chart->id_produk;
        $detail->jumlah = $chart->jumlah;
        $detail->save();
        $chart->delete();
    }

    return redirect()->route('checkout.success')->with('success', 'Pesanan berhasil diajukan'); 
    }
    public function success()
    {
        return redirect()->route('home');
    }

}