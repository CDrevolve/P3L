<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BahanBaku extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_bahan_baku',
        'satuan_bahan_baku',
        'stok_bahan_baku'
    ];


    protected $casts = [
        'stok_bahan_baku' => 'double'
    ];
}
