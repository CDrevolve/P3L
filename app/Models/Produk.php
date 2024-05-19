<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produks';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'id_jenis',
        'id_penitip',
        'nama',
        'stok',
        'harga',
        'kuota_harian',
        'foto',
    ];

    public function jenis()
    {
        return $this->belongsTo(Jenis::class, 'id_jenis');
    }
    public function penitip()
    {
        return $this->belongsTo(DataPenitip::class, 'id_penitip');
    }
}
