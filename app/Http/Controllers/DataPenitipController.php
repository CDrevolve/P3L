<?php

namespace App\Http\Controllers;

use App\Models\DataPenitip;
use Illuminate\Http\Request;

class DataPenitipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $dataPenitips = DataPenitip::all();
        return view('admin.dataPenitipview', compact('dataPenitips'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        DataPenitip::create($request->all());
        return redirect()->route('datapenitip.index');
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $dataPenitip = DataPenitip::findOrFail($id);
        $dataPenitip->update($request->all());
        return redirect()->route('datapenitip.index');
    }

    /**
     * Remove the specified resource from storage.
     */


    public function destroy($id)
    {
        //
        $dataPenitip = DataPenitip::findOrFail($id);
        $dataPenitip->delete();
        return redirect()->route('datapenitip.index');
    }

    public function fetchAll()
    {
        $dataPenitips = DataPenitip::all();
        return response()->json($dataPenitips);
    }
}
