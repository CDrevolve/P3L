<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Customer;
use App\Models\Alamat;
use App\Mail\MailSend;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if (Auth::check()) {
            return redirect('dashboard');
        } else {
            return view('loginview');
        }
    }

    public function actionLogin(Request $request)
    {
        $data = $request->only('email', 'password');

        // Temukan user berdasarkan email
        $user = User::where('email', $data['email'])->first();

        // Periksa apakah user ditemukan
        if (!$user) {
            Session::flash('Error', 'Email atau password Salah!');
            return redirect('login');
        }

        // Periksa apakah password cocok
        if ($user->password !== $data['password']) {
            Session::flash('Error', 'Email atau password Salah!');
            return redirect('login');
        }
        // Periksa apakah password cocok
        if ($user->password !== $data['password']) {
            Session::flash('Error', 'Email atau password Salah!');
            return redirect('login');
        }

        // Periksa apakah user aktif
        if (!$user->active) {
            Session::flash('Error', 'Akun anda belum diverifikasi. Silahkan cek email Anda!');
            return redirect('login');
        }
        // Periksa apakah user aktif
        if (!$user->active) {
            Session::flash('Error', 'Akun anda belum diverifikasi. Silahkan cek email Anda!');
            return redirect('login');
        }

        // Lakukan login jika berhasil
        Auth::login($user);
        // Lakukan login jika berhasil
        Auth::login($user);

        // Periksa role pengguna dan arahkan sesuai dengan rolenya
        switch ($user->id_role) {
            case 1:
                return redirect('owner');
            case 2:
                return redirect('admin');
            case 3:
                return redirect('manager');
            case 4:
                return redirect('karyawan');
            case 5:
                return redirect('profile');
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
            'alamat' => 'required',
            'tanggal_lahir' => 'required',
            'no_telp' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()], 400);
        }

        // Buat random string untuk verifikasi
        $str = Str::random(100);

        // Simpan user dengan password terhash dan key verifikasi
        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password,
            'id_role' => 5,
            'verify_key' => $str,
            'active' => 0,
        ]);

        // Buat data customer
        $image = $request->file('foto');
        $imageName = $image->getClientOriginalName();
        $destinationPath = ('images/ppUser');
        $image->move($destinationPath, $imageName);
        $destinationPath = 'images/ppUser' . $imageName;

        $customer = Customer::create([
            'id_user' => $user->id, // Ambil id pengguna yang baru dibuat
            'nama' => $user->username,
            'tanggal_lahir' => $request->tanggal_lahir,
            'no_telp' => $request->no_telp,
            'saldo' => '0',
            'poin' => '0',
            'foto' => $destinationPath,
            // Gunakan nama pengguna sebagai nama customer
            // Masukkan nilai default untuk kolom lain jika diperlukan
        ]);

        $alamat = Alamat::create([
            'id_customer' => $customer->id,
            'nama' => $request->alamat,
        ]);

        // Kirim email verifikasi
        $details = [
            'username' => $request->username,
            'website' => 'Atma Kitchen',
            'datetime' => now(),
            'url' => request()->getHttpHost() . '/register/verify/' . $str
        ];
        Mail::to($request->email)->send(new MailSend($details));

        // Kembalikan respons berhasil
        // return response()->json([
        //     'message' => 'Register Berhasil',
        //     'user' => $user,
        // ], 200);

        return redirect('login');
    }

    public function verify($verify_key)
    {
        $keyCheck = User::where('verify_key', $verify_key)->exists();

        if ($keyCheck) {
            $user = User::where('verify_key', $verify_key)
                ->update([
                    'active' => 1,
                ]);

            return "Verifikasi berhasil. Akun anda sudah aktif.";
        } else {
            return "Keys tidak valid.";
        }
    }
}
