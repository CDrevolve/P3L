<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Presensi;
use App\Models\LaporanPresensi;
use Carbon\Carbon;

class LaporanPresensiController extends Controller
{

    public function index()
    {
        return view('MO.laporan.laporanPresensi');
    }

    public function laporan(Request $request)
    {
        $bulan = date('m', strtotime($request->dates));
        $tahun = date('Y', strtotime($request->dates));

        $presensi = Presensi::whereYear('tanggal', $tahun)
            ->whereMonth('tanggal', $bulan)
            ->get();

        if ($presensi->isEmpty()) {
            return redirect()->route('laporanPresensi.index')->with('error', 'Data tidak ditemukan');
        }

        $absen = [];

        foreach ($presensi as $p) {
            if (!isset($absen[$p->id_karyawan])) {
                if ($p->status == 'masuk') {
                    $absen[$p->id_karyawan] = [
                        'nama' => $p->karyawan->nama,
                        'masuk' => 1,
                        'bolos' => 0,
                        'honor_harian' => $p->karyawan->gaji,
                        'bonus_rajin' => 0,
                        'total' => $p->karyawan->gaji
                    ];
                } else {
                    $absen[$p->id_karyawan] = [
                        'nama' => $p->karyawan->nama,
                        'masuk' => 0,
                        'bolos' => 1,
                        'honor_harian' => 0,
                        'bonus_rajin' => 0,
                        'total' => 0
                    ];
                }
            } else {
                if ($p->status == 'masuk') {
                    $absen[$p->id_karyawan]['masuk']++;
                    $absen[$p->id_karyawan]['honor_harian'] += $p->karyawan->gaji;
                    $absen[$p->id_karyawan]['total'] = $absen[$p->id_karyawan]['honor_harian'] + $absen[$p->id_karyawan]['bonus_rajin'];
                } else {
                    $absen[$p->id_karyawan]['bolos']++;
                }
            }
        }
        $total = 0;
        foreach ($absen as &$a) {
            if ($a['bolos'] <= 4) {
                $a['bonus_rajin'] = $a['honor_harian'] * 0.2;
                $a['total'] = $a['honor_harian'] + $a['bonus_rajin'];
            }
            $total += $a['total'];
        }
        unset($a);
        // dd($absen);

        $bulan = Carbon::parse($request->tanggal)->format('F');

        return view('MO.laporan.laporanPresensi', compact('absen', 'bulan', 'tahun', 'total'));
    }


}
