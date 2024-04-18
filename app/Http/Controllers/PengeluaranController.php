<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use Illuminate\Http\Request;

class PengeluaranController extends Controller
{
    /**
     * Menampilkan daftar pengeluaran.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pengeluarans = Pengeluaran::all();
        return view('pengeluaran.index', compact('pengeluarans'));
    }

    /**
     * Menampilkan formulir untuk membuat pengeluaran baru.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pengeluaran.create');
    }

    /**
     * Menyimpan pengeluaran yang baru dibuat.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'jumlah' => 'required|numeric',
            'harga' => 'required|numeric',
        ]);

        Pengeluaran::create($request->all());

        return redirect()->route('pengeluaran.index')
                         ->with('success','Pengeluaran berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail dari pengeluaran tertentu.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pengeluaran = Pengeluaran::find($id);
        return view('pengeluaran.show', compact('pengeluaran'));
    }

    /**
     * Menampilkan formulir untuk mengedit pengeluaran tertentu.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pengeluaran = Pengeluaran::find($id);
        return view('pengeluaran.edit', compact('pengeluaran'));
    }

    /**
     * Memperbarui pengeluaran tertentu.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string',
            'jumlah' => 'required|numeric',
            'harga' => 'required|numeric',
        ]);

        Pengeluaran::find($id)->update($request->all());

        return redirect()->route('pengeluaran.index')
                         ->with('success','Pengeluaran berhasil diperbarui.');
    }

    /**
     * Menghapus pengeluaran tertentu dari penyimpanan.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Pengeluaran::destroy($id);

        return redirect()->route('pengeluaran.index')
                         ->with('success','Pengeluaran berhasil dihapus.');
    }
}
