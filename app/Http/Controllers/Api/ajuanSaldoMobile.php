<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\AjuanSaldo;

class AjuanSaldoMobile extends Controller
{
    public function index()
    {
        $customer = Customer::where('id_user', Auth::user()->id)->first();
        $ajuanSaldo = AjuanSaldo::where('id_customer', $customer->id)->get();

        return response()->json([
            'status' => 'success',
            'data' => $ajuanSaldo
        ]);
    }

    public function store(Request $request)
    {
        $customer = Customer::where('id_user', Auth::user()->id)->first();

        $ajuan = AjuanSaldo::create([
            'id_customer' => $customer->id,
            'saldo' => $customer->saldo,
            'bank' => $request->bank,
            'no_rekening' => $request->no_rekening,
            'status' => 'Menunggu Konfirmasi',
        ]);

        $customer->saldo = 0;
        $customer->save();

        return response()->json([
            'status' => 'success',
            'data' => $ajuan
        ], 200);
    }
}
