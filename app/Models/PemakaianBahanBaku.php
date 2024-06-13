<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemakaianBahanBaku extends Model
{
    use HasFactory;

    protected $table = 'pemakaian_bahanbakus';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'bahan_baku_id',
        'jumlah',
    ];

    // Relasi dengan model BahanBaku
    public function bahan_baku()
    {
        return $this->belongsTo(BahanBaku::class);
    }
}