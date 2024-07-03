<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTanggal extends Model
{
    
    use HasFactory;

    use HasFactory;

    protected $table = 'detail_tanggal';
    protected $primary ='id';
    protected $fillable = [
        'kuota_terpakai',
        'id_tanggal',
        'id_produk',
    ];

    public function tanggal()
    {
        return $this->belongsTo(Tanggal::class, 'id_tanggal');
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk');
    }
}
