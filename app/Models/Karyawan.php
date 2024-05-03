<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;

    protected $table = 'karyawans';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nama',
        'tanggal_lahir',
        'alamat',
        'notelp',
        'gaji',
    ];

    public $timestamps = false;

}
