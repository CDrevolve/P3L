<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPenitip extends Model
{
    use HasFactory;

    protected $table = 'data_penitips';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama',
        'alamat',
        'notelp',
    ];
}
