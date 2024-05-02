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
        'id_resep',
        'nama',
        'stok',
        'harga',
        'kuota_harian',
    ];

    public function jenis()
    {
        return $this->belongsTo(Jenis::class, 'id_jenis');
    }
    public function resep()
    {
        return $this->belongsTo(Resep::class, 'id_resep');
    }
}
