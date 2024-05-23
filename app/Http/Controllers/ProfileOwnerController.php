<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Karyawan;
use App\Models\Customer;
use Carbon\Carbon;

class ProfileOwnerController extends Controller
{

    public function editPassword()
    {
        return view('owner.profile.edit_password');
    }

    public function updatePassword(Request $request)
    {
        // Validasi input
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:6',
            'new_password_confirmation' => 'required|same:new_password',
        ]);

        $user = auth()->user();

        // Memeriksa apakah password saat ini sesuai dengan yang diberikan
        if($request->current_password != $user->password){
            return back()->withErrors(['current_password' => 'Password saat ini salah.']);
        }

        // Update password dengan yang baru
        $user->password = $request->new_password;
        $user->save();

        return redirect()->route('owner')->with('success', 'Password berhasil diperbarui.');
    }
}
