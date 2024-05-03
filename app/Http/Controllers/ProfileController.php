<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pemesanan;
use App\Models\Customer;

class ProfileController extends Controller
{
    public function show()
    {
        $user = auth()->user();
        return view('profile.show', compact('user'));
    }

    public function edit()
    {
        $user = auth()->user();
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        if ($user) {
            $user->update($request->all()); // gatau ini kok error, tapi masih bisa jalan
            return redirect()->route('profile.show')->with('success', 'Profil berhasil diperbarui.');
        }
        // Handle the case where there is no authenticated user.
    }

    public function orderHistory()
    {
        $user = auth()->user();
        $customer = Customer::where('id_user', $user->id)->first();
        $orders = Pemesanan::where('id_customer', $customer->id_customer)->get();
        // Ambil semua pesanan berdasarkan id_customer
        return view('profile.history', compact('user', 'orders', 'customer'));
    }
}
