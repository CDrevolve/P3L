<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BahanBaku;

class BahanBakuController extends Controller
{
    public function index()
    {
        $bahanBakus = BahanBaku::all();
        return view('admin.bahanBakuView', compact('bahanBakus'));
    }


    public function store(Request $request)
    {
        BahanBaku::create($request->all());
        return redirect()->route('bahanbaku.index');
    }

    public function update(Request $request, $id)
    {
        $bahanBaku = BahanBaku::findOrFail($id);
        $bahanBaku->update($request->all());
        return redirect()->route('bahanbaku.index');
    }

    public function destroy($id)
    {
        $bahanBaku = BahanBaku::findOrFail($id);
        $bahanBaku->delete();
        return redirect()->route('bahanbaku.index');
    }

    public function fetchAll()
    {
        $bahanBakus = BahanBaku::all();
        return response()->json($bahanBakus);
    }
}
