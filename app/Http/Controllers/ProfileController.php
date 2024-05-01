<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pemesanan; // Import model Pemesanan

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
        $user->update($request->all());
        return redirect()->route('profile.show')->with('success', 'Profil berhasil diperbarui.');
    }

    public function orderHistory()
    {
        $user = auth()->user();
        $orders = Pemesanan::where('id_customer', $user->id)->get(); // Ambil semua pesanan berdasarkan id_customer
        return view('profile.history', compact('user', 'orders'));
    }
}