<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPenitip extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_penitip',
        'alamat_penitip',
        'notelp_penitip',
    ];
}
