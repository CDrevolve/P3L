<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Karyawan;

class KaryawanController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');

        // Jika terdapat keyword pencarian
        if ($keyword) {
            $karyawan = Karyawan::where('nama', 'like', '%' . $keyword . '%')->get();
        } else {
            // Jika tidak ada keyword, tampilkan semua karyawan
            $karyawan = Karyawan::all();
        }

        return view('admin.daftar_karyawan', compact('karyawan', 'keyword'));
    }


    public function create()
    {
        return view('admin.create_karyawan');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'no_telp' => 'required|string|max:20',
            'gaji' => 'required|numeric|min:0',
        ]);

        // Menyimpan data karyawan
        $karyawan = Karyawan::create([
            'nama' => $request->input('nama'),
            'tanggal_lahir' => $request->input('tanggal_lahir'),
            'alamat' => $request->input('alamat'),
            'no_telp' => $request->input('no_telp'),
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
            'nama' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'no_telp' => 'required|string|max:20',
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