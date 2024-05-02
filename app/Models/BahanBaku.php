<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BahanBaku extends Model
{

    protected $table = 'bahan_bakus';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama',
        'stok',
        'satuan',
    ];
  
  public function detailProduks()
    {
        return $this->hasMany(DetailProduk::class, 'id_bahan_baku');
    }
}
