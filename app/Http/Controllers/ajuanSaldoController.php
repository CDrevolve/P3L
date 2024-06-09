<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AjuanSaldo;

class ajuanSaldoController extends Controller
{
    //
    public function index()
    {
        $ajuanSaldo = AjuanSaldo::where('status', 'Menunggu Konfirmasi')->get;

        return view('admin.ajuanSaldo', compact('ajuanSaldo'));
    }

    public function store(Request $request)
    {
        AjuanSaldo::create($request->all());
        return redirect()->route('ajuanSaldo.index');
    }

    public function konfirmasi($id)
    {
        $ajuanSaldo = AjuanSaldo::find($id);
        $ajuanSaldo->status = 'Dikonfirmasi';
        $ajuanSaldo->save();

        return redirect()->route('ajuanSaldo.index');
    }
}
