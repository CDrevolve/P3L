<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resep extends Model
{
    protected $table = 'reseps';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nama',
        'id_produk',
    ];

    public function detailProduks()
    {
        return $this->hasMany(DetailProduk::class, 'id_resep');
    }
}
