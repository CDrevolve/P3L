<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chart;
use App\Models\Customer;
use App\Models\Produk;
use App\Models\Pemesanan;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CheckoutController extends Controller
{
    public function checkout()
    {
        $customer = Customer::findOrFail(Auth::id());

        // Mengambil data chart (keranjang belanja) berdasarkan ID customer
        $charts = Chart::where('id_customer', $customer->id)->get();

        // Initialize total price and product names
        $totalPrice = 0;
        $productNames = [];

        foreach ($charts as $chart) {
            $produk = Produk::findOrFail($chart->id_produk);

            // Sum up the total price
            $totalPrice += $produk->harga * $chart->jumlah;

            // Append product names to the list
            $productNames[] = $produk->nama;

            // Hapus entri di chart karena sudah di-checkout
            $chart->delete();
        }

        // Create a single order
        $pemesanan = new Pemesanan();
        $pemesanan->id_customer = $customer->id;
        $pemesanan->id_karyawan = 1; // This can be dynamically set as needed
        $pemesanan->nama = $customer->nama;
        $pemesanan->isi = implode(', ', $productNames); // Concatenate product names
        $pemesanan->harga = $totalPrice; // Total price
        $pemesanan->pickup = null;
        $pemesanan->status = 'Belum Bayar';
        $pemesanan->tanggal = now();
        $pemesanan->save();

        return redirect()->route('checkout.success')->with('success', 'Pesanan berhasil diajukan');
    }

    public function success()
    {
        return redirect()->route('home');
    }

    public function updateStatus($id, $status)
    {
        $pemesanan = Pemesanan::findOrFail($id);
        $pemesanan->status = $status;
        $pemesanan->save();

        if ($status == 'Selesai') {
            $this->addPoints($pemesanan);
        }

        return redirect()->back()->with('success', 'Status berhasil diperbarui');
    }

    private function addPoints(Pemesanan $pemesanan)
    {
        $customer = Customer::findOrFail($pemesanan->id_customer);
        $totalPrice = $pemesanan->harga;

        // Calculate points
        $poin = 0;

        if ($totalPrice >= 1000000) {
            $poin = 200 * floor($totalPrice / 1000000);
        } elseif ($totalPrice >= 500000) {
            $poin = 75 * floor($totalPrice / 500000);
        } elseif ($totalPrice >= 100000) {
            $poin = 15 * floor($totalPrice / 100000);
        } elseif ($totalPrice >= 10000) {
            $poin = floor($totalPrice / 10000);
        }

        // Ensure the order date and customer's birthday are Carbon instances
        $orderDate = Carbon::parse($pemesanan->tanggal)->format('m-d');
        $birthday = Carbon::parse($customer->tanggal_lahir)->format('m-d');

        if ($orderDate == $birthday) {
            $poin *= 2; // Double the points if it's the customer's birthday
        }

        // Update customer points
        $customer->poin += $poin;
        $customer->save();
    }
}
