<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pemesanan;
use App\Models\Customer;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\file\UploadedFile;

class ProfileController extends Controller
{
    public function show()
    {
        $user = auth()->user();
        $customer = Customer::where('id_user', $user->id)->first();
        return view('profile.show', compact('user', 'customer'));
    }

    public function edit()
    {
        $user = auth()->user();
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        $customer = Customer::where('id_user', $user->id)->first();

        $image = $request->file('foto');
        $imageName = $image->getClientOriginalName();
        $destinationPath = public_path('images/ppUser/');
        $image->move($destinationPath, $imageName);
        $destinationPath = 'images/ppUser/' . $imageName;

        if ($customer) {
            if ($image == null) {
                $customer->update([
                    'nama' => $request->nama,
                    'tanggal_lahir' => $request->tanggal_lahir,
                    'no_telp' => $request->no_telp,
                ]);
            } else {
                $customer->update([
                    'nama' => $request->nama,
                    'tanggal_lahir' => $request->tanggal_lahir,
                    'no_telp' => $request->no_telp,
                    'foto' => $destinationPath,
                ]);
            }
            $customer->update([
                'nama' => $request->nama,
                'tanggal_lahir' => $request->tanggal_lahir,
                'no_telp' => $request->no_telp,
            ]);
            return redirect()->route('profile.show')->with('success', 'Profil berhasil diperbarui.');
        }
        // Handle the case where there is no authenticated user.
    }

    public function orderHistory()
    {
        $user = auth()->user();

        $customer = Customer::where('id_user', $user->id)->first();

        $orders = Pemesanan::where('id_customer', $customer->id)->get();

        // Ambil semua pesanan berdasarkan id_customer
        return view('profile.history', compact('user', 'orders', 'customer'));
    }
    public function completeOrder($id)
    {
        $order = Pemesanan::find($id);
        if ($order) {
            $order->status = 'Selesai';
            $order->save();
            return redirect()->back()->with('success', 'Pesanan telah diselesaikan.');
        }
        return redirect()->back()->with('error', 'Pesanan tidak ditemukan.');
    }
}
