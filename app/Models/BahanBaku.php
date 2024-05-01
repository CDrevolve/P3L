<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BahanBaku extends Model
{
    protected $table = 'bahan_baku';
    protected $primaryKey = 'id_bahan_baku'; 
    public $timestamps = false;

    protected $fillable = [
        'nama_bahan_baku',
        'satuan_bahan_baku',
        'stok_bahan_baku'
    ];

    public function detailProduks()
    {
        return $this->hasMany(DetailProduk::class, 'id_bahan_baku');
    }
}
