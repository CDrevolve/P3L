<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemesanan;
use App\Models\BahanBaku;
use App\Models\DetailProduk;
use App\Models\Produk;
use App\Models\Resep;
use App\Models\Customer;
use App\Models\DetailPemesanan;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class MoKonfirPesanan extends Controller
{
    //
    public function index()
    {
        $pesanans = Pemesanan::where('status', 'pembayaran valid')->get();
        return view('mo.confirmPesanan', compact('pesanans'));
    }

    public function terima($id)
    {

        $pesanan = Pemesanan::findOrFail($id);


        $detailPemesanan = DetailPemesanan::where('id_pemesanan', $pesanan->id)->get();

        // $resep = Resep::where('id_produk', $detailPemesanan->id_produk)->get();
        // $detailProduk = DetailProduk::where('id_resep', $resep->id)->get();
        $insufficientStockItems = [];

        foreach ($detailPemesanan as $dpn) {

            $resep = Resep::where('id_produk', $dpn->id_produk)->first();

            $detailProduk = DetailProduk::where('id_resep', $resep->id)->get();

            foreach ($detailProduk as $dp) {
                $bahanBaku = BahanBaku::findOrFail($dp->id_bahan_baku);

                $bahanBaku->stok -= $dp->jumlah;

                if ($bahanBaku->stok < 0) {
                    $insufficientStockItems[] = 'Stok Bahan Baku ' . $bahanBaku->nama . ' tidak mencukupi.' . 'kurang' . $dp->jumlah - $bahanBaku->stok . ' ' . $bahanBaku->satuan;
                }
            }
        }

        if (!empty($insufficientStockItems)) {
            return redirect()->route('confirmMo.index')
                ->with('error', $insufficientStockItems);
        }

        foreach ($detailPemesanan as $dpn) {

            $resep = Resep::where('id_produk', $dpn->id_produk)->first();

            $detailProduk = DetailProduk::where('id_resep', $resep->id)->get();

            foreach ($detailProduk as $dp) {
                $bahanBaku = BahanBaku::findOrFail($dp->id_bahan_baku);

                $bahanBaku->stok -= $dp->jumlah;

                $bahanBaku->save();
            }
        }

        $pesanan->status = 'Diterima';
        $pesanan->save();

        $customer = Customer::findOrFail($pesanan->id_customer);
        $poin = 0;

        if ($pesanan->harga >= 1000000) {
            $poin = 200 * floor($pesanan->harga / 1000000);
        } elseif ($pesanan->harga >= 500000) {
            $poin = 75 * floor($pesanan->harga / 500000);
        } elseif ($pesanan->harga >= 100000) {
            $poin = 15 * floor($pesanan->harga / 100000);
        } elseif ($pesanan->harga >= 10000) {
            $poin = floor($pesanan->harga / 10000);
        }

        $orderDate = Carbon::parse($pesanan->tanggal)->format('m-d');
        $birthday = Carbon::parse($customer->tanggal_lahir)->format('m-d');

        if ($orderDate == $birthday) {
            $poin *= 2;
        }

        $customer->poin += $poin;
        $customer->save();

        return redirect()->route('confirmMo.index')->with('success', 'Berhasil di terima.');
    }


    public function tolak($id)
    {

        $pesanan = Pemesanan::findOrFail($id);


        $detailPemesanan = DetailPemesanan::where('id_pemesanan', $pesanan->id)->get();

        foreach ($detailPemesanan as $dp) {
            $produk = Produk::findOrFail($dp->id_produk);
            // $produk->stok += $dp->jumlah;
            $produk->kuota_harian_terpakai -= $dp->jumlah;
            $produk->save();
        }

        $pesanan->status = 'Ditolak';
        $pesanan->save();

        $customer = Customer::findOrFail($pesanan->id_customer);
        $customer->saldo += $pesanan->jumlah_pembayaran;
        $customer->save();

        return redirect()->route('confirmMo.index')->with('success', 'Pesanan berhasil ditolak.');
    }
}