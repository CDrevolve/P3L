<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Karyawan;
use App\Models\Customer;
use Carbon\Carbon;


class ProfileAdminController extends Controller
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

        // Logika untuk mengupdate data karyawan

        return redirect()->route('profile.show')->with('success', 'Profil berhasil diperbarui.');
    }

    public function editPassword()
    {
        return view('admin.profile.edit_password');
    }

    public function updatePassword(Request $request)
{
    // Validasi input
    $request->validate([
        'current_password' => 'required',
        'new_password' => 'required|string|min:6',
        'new_password_confirmation' => 'required',
    ]);

    $user = auth()->user();

    if($request-> current_password != $user->password){
        return back()->withErrors(['current_password' => 'Password saat ini salah.']);
    }

    // Memeriksa apakah password saat ini sesuai dengan yang diberikan
    // if (!Hash::check($request->current_password, $user->password)) {
    //     return back()->withErrors(['current_password' => 'Password saat ini salah.']);
    // }

    // Update password dengan yang baru
    // $user->password = Hash::make($request->new_password);
    $user->password = $request->new_password;
    $user->save();

    return redirect()->route('admin')->with('success', 'Password berhasil diperbarui.');
}

}