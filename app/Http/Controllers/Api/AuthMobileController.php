<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Customer;
use Laravel\Sanctum\HasApiTokens;

class AuthMobileController extends Controller
{
    public function login(Request $request)
    {
        $loginData = $request->validate([
            'email' => 'required|email:rfc,dns',
            'password' => 'required',
        ]);

        // Attempt to authenticate the user
        if (!Auth::attempt($loginData)) {
            return response()->json(['message' => 'Email atau Password salah'], 401);
        }

        $user = Auth::user();
        $token = $user->createToken('Authentication Token')->plainTextToken;

        $data = [
            'id' => $user->id,
            'username' => $user->username,
            'email' => $user->email,
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
