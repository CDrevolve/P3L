<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resep extends Model
{
    protected $table = 'resep';
    protected $primaryKey = 'id_resep'; 

    protected $fillable = [
        'nama_resep',
    ];

    public $timestamps = false;

    public function detailProduks()
    {
        return $this->hasMany(DetailProduk::class, 'id_resep');
    }
}
