<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if (Auth::check()) {
            return redirect('home');
        } else {
            return view('loginview');
        }
    }

    public function actionLogin(Request $request)
    {
        $data = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];

        // Temukan user berdasarkan email
        $user = User::where('email', $data['email'])->first();

        // Periksa apakah user ditemukan
        if (!$user) {
            return response(['message' => 'Invalid Credentials'], 401);
        }

        // Periksa apakah password cocok
        if ($user->password !== $data['password']) {
            return response(['message' => 'Invalid Credentials'], 401);
        }

        // Lakukan login jika berhasil
        Auth::login($user);

        // Periksa role pengguna dan arahkan sesuai dengan rolenya
        switch ($user->id_role) {
            case 1:
                return redirect('owner');
            case 2:
                return redirect('admin/produk');
            case 3:
                return redirect('manager');
            case 4:
                return redirect('karyawan');
            case 5:
                return redirect('dashboard');
            default:
                return redirect('default');
        }
    }

    public function actionLogout()
    {
        Auth::logout();
        return redirect('login');
    }

    public function register()
    {
        return view('registerview');
    }

    public function actionRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()], 400);
        }
    
        // Simpan password tanpa hashing
        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password,
            'id_role' => 5,
        ]);
    
        return response()->json([
            'message' => 'Register Berhasil',
            'user' => $user,
        ], 200);
    }
}
