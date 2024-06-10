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


class AuthMobileController extends Controller
{
    public function login(Request $request)
    {
        $loginData = $request->all();

        $validate = Validator::make($loginData, [
            "email" => "required|email:rfc,dns",
            "password" => "required",
        ]);

        if ($validate->fails()) {
            return response()->json([
                'message' => $validate->errors(),
            ], 400);
        }

        $user = User::where('email', $loginData['email'])->first();

        if (!$user || !Hash::check($loginData['password'], $user->password)) {
            return response()->json([
                'message' => 'Email atau Password salah',
            ], 401);
        }

        $token = $user->createToken('Authentication Token')->plainTextToken;
        $data = [
            'id' => $user->id,
            'username' => $user->username,
            'email' => $user->email,
            'password' => $user->password,
            'id_role' => $user->id_role,
            'verify_key' => $user->verify_key,
            'active' => $user->active,
            'token' => $token,
        ];
        return response()->json([
            'message' => 'Authenticated',
            'data' => $data,

        ]);
    }

    public function showCustomer()
    {
        $customer = Customer::where('id_user', Auth::user()->id)->first();

        return response()->json([
            'status' => 'success',
            'data' => $customer,
        ], 200);
    }
}
