<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Karyawan;

class KaryawanMobile extends Controller
{
    public function index()
    {
            $karyawan = Karyawan::all();
    
        return response()->json([
            'messege' => 'sukses',
            'karyawan' => $karyawan
        ], 200);
    }
    

    public function create()
    {
        return view('admin.create_karyawan');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_karyawan' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'alamat_karyawan' => 'required|string',
            'notelp_karyawan' => 'required|string|max:20',
            'gaji' => 'required|numeric|min:0',
        ]);
    
        // Menyimpan data karyawan
        $karyawan = Karyawan::create([
            'nama_karyawan' => $request->input('nama_karyawan'),
            'tanggal_lahir' => $request->input('tanggal_lahir'),
            'alamat_karyawan' => $request->input('alamat_karyawan'),
            'notelp_karyawan' => $request->input('notelp_karyawan'),
            'gaji' => $request->input('gaji'),
        ]);
    
        return redirect()->route('karyawan.index')->with('success', 'Data karyawan berhasil ditambahkan.');
    }
    

    public function show($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        return view('admin.detail_karyawan', compact('karyawan'));
    }    

    public function edit($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        return view('admin.edit_karyawan', compact('karyawan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_karyawan' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'alamat_karyawan' => 'required|string',
            'notelp_karyawan' => 'required|string|max:20',
            'gaji' => 'required|numeric|min:0',
        ]);

        $karyawan = Karyawan::findOrFail($id);
        $karyawan->update($request->all());

        return redirect()->route('karyawan.index')->with('success', 'Data karyawan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        $karyawan->delete();

        return redirect()->route('karyawan.index')->with('success', 'Data karyawan berhasil dihapus.');
    }

}
