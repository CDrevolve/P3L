<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chart;
use App\Models\Customer;
use App\Models\User;
use App\Models\Produk;
use App\Models\Pemesanan;
use App\Models\Alamat;
use App\Models\DetailPemesanan;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CheckoutController extends Controller
{
    public function checkout(Request $request)
    {
        $customer = Customer::findOrFail(Auth::id());
        $charts = Chart::where('id_customer', $customer->id)->get();

        $totalPrice = 0;
        $productNames = [];
        $tanggalPesanan = $request->input('tanggal');
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

            if ($produk->stok >= $chart->jumlah) {
                $produk->stok -= $chart->jumlah;
            } else {
                if ($produk->kuota_harian_terpakai > $produk->kuota_harian) {
                    return redirect()->back()->withErrors(['msg' => 'Stok atau kuota harian tidak mencukupi untuk produk: ' . $produk->nama]);
                }
                $produk->kuota_harian_terpakai += $chart->jumlah;
                $produk->stok = 0;
            }
            $produk->save();
            $chart->delete();
        }

        // Kurangi harga total dengan poin yang digunakan (1 poin = Rp 100)
        $discount = $poinDigunakan * 100;
        if ($discount > $totalPrice) {
            return redirect()->back()->withErrors(['msg' => 'Poin yang digunakan melebihi total harga.']);
        }
        $totalPrice -= $discount;

        // Kurangi poin pelanggan
        if ($poinDigunakan > $customer->poin) {
            return redirect()->back()->withErrors(['msg' => 'Poin yang digunakan melebihi jumlah poin yang dimiliki.']);
        }
        $customer->poin -= $poinDigunakan;
        $customer->save();


        $pemesanan = new Pemesanan();
        $pemesanan->id_customer = $customer->id;
        $pemesanan->id_karyawan = 1;
        $pemesanan->nama = $customer->nama;
        $pemesanan->isi = implode(', ', $productNames);
        $pemesanan->harga = $totalPrice;
        $pemesanan->pickup = $metode === 'pickup' ? 1 : 0;
        $pemesanan->status = 'Checkout';
        $pemesanan->tanggal = $tanggalPesanan;
        $pemesanan->ongkir = 0;
        $pemesanan->id_alamat = $idAlamat;
        $pemesanan->bukti_pembayaran = null;
        $pemesanan->jumlah_pembayaran = $totalPrice;
        $pemesanan->tips = 0;
        $pemesanan->save();

        foreach ($charts as $chart) {
            $detail = new DetailPemesanan();
            $detail->id_pemesanan = $pemesanan->id;
            $detail->id_produk = $chart->id_produk;
            $detail->jumlah = $chart->jumlah;
            $detail->save();
        }
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

        if ($status == 'Checkout') {
            $this->addPoints($pemesanan);
        }

        return redirect()->back()->with('success', 'Status berhasil diperbarui');
    }

    private function addPoints(Pemesanan $pemesanan)
    {
        $customer = Customer::findOrFail($pemesanan->id_customer);
        $totalPrice = $pemesanan->harga;

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

        $orderDate = Carbon::parse($pemesanan->tanggal)->format('m-d');
        $birthday = Carbon::parse($customer->tanggal_lahir)->format('m-d');

        if ($orderDate == $birthday) {
            $poin *= 2;
        }

        $customer->poin += $poin;
        $customer->save();
    }
    public function printReceipt($id)
    {
        $order = Pemesanan::findOrFail($id);
        $customer = Customer::findOrFail($order->id_customer);
        $user = User::findOrFail($customer->id_user);
        $details = DetailPemesanan::where('id_pemesanan',$order->id)->get();
        $produks = [];

        // Iterate over each detail to get the related product
        foreach ($details as $detail) {
            $produks[] = Produk::findOrFail($detail->id_produk);
        }
    
        return view('customer.nota', compact('order','details','produks','user'));
    }

}
