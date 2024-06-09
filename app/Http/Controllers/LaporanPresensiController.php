<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LaporanPresensi;
use App\Models\Presensi;
use App\Models\Karyawan;
use Carbon\Carbon;

class LaporanPresensiController extends Controller
{
    //
    public function index()
    {
        return view('owner.laporanPresensiKaryawan');
    }

    public function store(Request $request)
    {
        $karyawan = Karyawan::all();

        foreach ($karyawan as $karyawan) {

            $totalhadir = 0;
            $totalbolos = 0;
            $presensi = Presensi::where('id_karyawan', $karyawan->id)->where('tanggal', 'like', '%' . $request->tanggal . '/' . $request->bulan)->get();

            $checkLaporan = LaporanPresensi::where('id_karyawan', $karyawan->id)->where('bulan', $request->bulan)->where('tahun', $request->tahun)->get();
            foreach ($checkLaporan as $checkLaporan) {
                $checkLaporan->delete();
            }

            $laporanPresensi = new LaporanPresensi;
            $laporanPresensi->nama = $karyawan->nama;
            $laporanPresensi->bulan = $request->bulan;
            $laporanPresensi->tahun = $request->tahun;

            foreach ($presensi as $presensi) {
                if ($presensi->status == 'hadir') {
                    $totalhadir++;
                } else if ($presensi->status == 'bolos') {
                    $totalbolos++;
                }
            }

            $laporanPresensi->jumlah_hadir = $totalhadir;
            $laporanPresensi->jumlah_bolos = $totalbolos;
            $laporanPresensi->honor_harian = $karyawan->gaji * $totalhadir;

            if ($laporanPresensi->jumlah_bolos <= 4) {
                $laporanPresensi->bonus_rajin = $laporanPresensi->honor_harian * 0.1;
            } else {
                $laporanPresensi->bonus_rajin = 0;
            }

            $laporanPresensi->total = $laporanPresensi->honor_harian + $laporanPresensi->bonus_rajin;
        }
        return redirect()->route('laporanPresensi.index');
    }

    public function show($id)
    {
        $laporanPresensi = LaporanPresensi::find($id);
        return view('owner.detailLaporanPresensi', compact('laporanPresensi'));
    }
}
