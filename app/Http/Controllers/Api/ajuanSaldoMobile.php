<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AjuanSaldo;

class ajuanSaldoMobile extends Controller
{
    //
    public function index()
    {
        $ajuanSaldo = AjuanSaldo::where('status', 'Menunggu Konfirmasi')->get;

        return response()->json([
            'status' => 'success',
            'data' => $ajuanSaldo
        ]);
    }

    public function store(Request $request)
    {
        AjuanSaldo::create($request->all());
        return response()->json([
            'status' => 'success',
            'message' => 'Ajuan saldo berhasil diajukan'
        ]);
    }

    
}
