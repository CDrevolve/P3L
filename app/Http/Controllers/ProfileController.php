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
            return redirect()->route('profile.show')->with('success', 'Profil berhasil diperbarui.');
        }
        // Handle the case where there is no authenticated user.
    }

    public function orderHistory(Request $request)
    {
        $user = auth()->user();
        $customer = Customer::where('id_user', $user->id)->first();

        $keyword = $request->input('keyword');

        if ($keyword) {
            $orders = Pemesanan::where('id_customer', $customer->id)
                                ->where('isi', 'like', '%' . $keyword . '%')
                                ->get();
        } else {
            $orders = Pemesanan::where('id_customer', $customer->id)->get();
        }
    
        return view('profile.history', compact('user', 'orders', 'customer'));
    }
    
    
}
