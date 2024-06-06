<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Karyawan;

class GajiController extends Controller
{
    public function index()
    {
        $karyawann = Karyawan::all();
        return view('owner.karyawann', compact('karyawann'));
    }

    public function editGaji($id)
    {
        $karyawann = Karyawan::findOrFail($id);
        return view('owner.edit_gaji', compact('karyawann'));
    }

    public function updateGaji(Request $request, $id)
    {

        $request->validate([
            'gaji' => 'required|numeric|min:0',
        ]);

        $karyawann = Karyawan::findOrFail($id);

        $karyawann->update(['gaji' => $request->gaji]);

        return redirect()->route('owner.karyawann')->with('success', 'Gaji karyawan berhasil diperbarui.');
    }
}