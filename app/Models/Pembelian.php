<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    use HasFactory;

    protected $table = 'pengeluaran';

    protected $primaryKey = 'id_pengeluaran';
    public $timestamps = false;

    protected $fillable = [
        'id_bahanbaku',
        'nama',
        'jenis',
        'tanggal',
        'harga',
        'jumlah'
    ];
}
