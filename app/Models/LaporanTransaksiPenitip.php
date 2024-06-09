<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanTransaksiPenitip extends Model
{
    use HasFactory;

    protected $table = 'laporan_transaksi_penitips';

    protected $fillable = [
        'id_penitip',
        'bulan',
        'tahun',
        'nama',
        'total_transaksi',

    ];

    public function penitip()
    {
        return $this->belongsTo(DataPenitip::class, 'id_penitip');
    }
}
