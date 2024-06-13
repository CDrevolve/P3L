<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanPemasukandanPengeluaran extends Model
{
    use HasFactory;

    protected $table = 'laporan_pemasukan_pengeluarans';

    protected $fillable = [
        'tanggal',
        'keterangan',
        'pemasukan',
        'pengeluaran',
        'total',
    ];
}
