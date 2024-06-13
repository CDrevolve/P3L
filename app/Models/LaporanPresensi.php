<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanPresensi extends Model
{
    use HasFactory;

    protected $table = 'laporan_presensis';

    protected $fillable = [
        'id_karyawan',
        'bulan',
        'tahun',
        'nama',
        'jumlah_hadir',
        'honor_harian',
        'bonus_rajin',
        'total',
    ];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'id_karyawan');
    }
}
