<?php

namespace App\Http\Controllers;

use App\Models\PengeluaranLain;
use Illuminate\Http\Request;

class PengeluaranLainController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $pengeluaranLains = PengeluaranLain::all();
        return view('MO.pengeluaranLainView', compact('pengeluaranLains'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        PengeluaranLain::create($request->all());
        return redirect()->route('pengeluaranlain.index');
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $pengeluaranLain = PengeluaranLain::findOrFail($id);
        $pengeluaranLain->update($request->all());
        return redirect()->route('pengeluaranlain.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $pengeluaranLain = PengeluaranLain::findOrFail($id);
        $pengeluaranLain->delete();
        return redirect()->route('pengeluaranlain.index');
    }

    public function fetechAll()
    {
        $pengeluaranLains = PengeluaranLain::all();
        return response()->json($pengeluaranLains);
    }
}
