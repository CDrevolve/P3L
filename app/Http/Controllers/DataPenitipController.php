<?php

namespace App\Http\Controllers;

use App\Models\DataPenitip;
use Illuminate\Http\Request;

class DataPenitipController extends Controller
{
    /**
     * Menampilkan daftar data penitip.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataPenitips = DataPenitip::all();
        return view('data_penitip.index', compact('dataPenitips'));
    }

    /**
     * Menampilkan formulir untuk membuat data penitip baru.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('data_penitip.create');
    }

    /**
     * Menyimpan data penitip yang baru dibuat.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_penitip' => 'required|string',
            'alamat_penitip' => 'required|string',
            'notelp_penitip' => 'required|string',
        ]);

        DataPenitip::create($request->all());

        return redirect()->route('data-penitip.index')
            ->with('success', 'Data penitip berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail dari data penitip tertentu.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dataPenitip = DataPenitip::find($id);
        return view('data_penitip.show', compact('dataPenitip'));
    }

    /**
     * Menampilkan formulir untuk mengedit data penitip tertentu.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dataPenitip = DataPenitip::find($id);
        return view('data_penitip.edit', compact('dataPenitip'));
    }

    /**
     * Memperbarui data penitip tertentu.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_penitip' => 'required|string',
            'alamat_penitip' => 'required|string',
            'notelp_penitip' => 'required|string',
        ]);

        DataPenitip::find($id)->update($request->all());

        return redirect()->route('data-penitip.index')
            ->with('success', 'Data penitip berhasil diperbarui.');
    }

    /**
     * Menghapus data penitip tertentu dari penyimpanan.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DataPenitip::destroy($id);

        return redirect()->route('data-penitip.index')
            ->with('success', 'Data penitip berhasil dihapus.');
    }
}
