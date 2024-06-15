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

        

        // foreach ($detailPemesanan as $dpn) {

        //     $resep = Resep::where('id_produk', $dpn->id_produk)->first();

        //     $detailProduk = DetailProduk::where('id_resep', $resep->id)->get();

        //     foreach ($detailProduk as $dp) {
        //         $bahanBaku = BahanBaku::findOrFail($dp->id_bahan_baku);

        //         $bahanBaku->stok -= $dp->jumlah;

        //         $bahanBaku->save();
        //     }
        // }

        $pesanan->status = 'Diterima';
        $pesanan->save();

        $customer = Customer::findOrFail($pesanan->id_customer);
        $poin = 0;
        $jumlah = $pesanan->harga;

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

        $orderDateObj = Carbon::parse($pesanan->tanggal);
        $birthdayObj = Carbon::parse($customer->tanggal_lahir);


        $rangeStart = $birthdayObj->copy()->subYears(1)->subDays(3);
        $rangeEnd = $birthdayObj->copy()->addYears(1)->addDays(3);


        if ($orderDateObj->between($rangeStart, $rangeEnd)) {
            $poin *= 2;
        }

        $customer->poin += $poin;
        $customer->save();

        if (!empty($insufficientStockItems)) {
            
            return redirect()->route('confirmMo.index')
                ->with('error', $insufficientStockItems);
        }

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
