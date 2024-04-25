<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailProduk extends Model
{
    protected $table = 'detail_produk';
    protected $primaryKey = 'id_detail_produk';

    protected $fillable = [
        'id_resep',
        'id_bahan_baku',
        'jumlah',
    ];

    public $timestamps = false;

    public function resep()
    {
        return $this->belongsTo(Resep::class, 'id_resep');
    }

    public function bahanBaku()
    {
        return $this->belongsTo(BahanBaku::class, 'id_bahan_baku');
    }

}
