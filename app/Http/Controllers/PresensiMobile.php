<?php

namespace App\Http\Controllers;
use App\Models\Presensi;

use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;

class PresensiMobile extends Controller
{
    // Menampilkan kehadiran berdasarkan tanggal
public function index(Request $request)
{

    $tanggal = $request->tanggal;

    $presensi = Presensi::where('tanggal', 'like', '%' . $tanggal . '%')->get();

    return response()->json([
        'message' => 'Data kehadiran berhasil diambil',
        'presensi' => $presensi
    ], 200);

}

    // Mengupdate kehadiran
 // Di dalam metode update di Laravel
    public function update(Request $request, $id)
{
    // Temukan kehadiran yang akan diupdate
    $presensi = Presensi::findOrFail($id);

    // Perbarui bidang status
    $status = $request->input('status', 'unknown');
    $presensi->status = $status;
    $presensi->save();

    return response()->json($presensi, 200);
}

    
    

    // Menghapus kehadiran
    public function destroy($id)
    {
        $presensi = Presensi::findOrFail($id);
        $presensi->delete();

        return response()->json(null, 204);
    }
}
