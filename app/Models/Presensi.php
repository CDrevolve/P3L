<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    use HasFactory;

    protected $table = 'presensi'; 

    protected $primaryKey = 'id'; 

    protected $fillable = [
        'id_karyawan',
        'status',
        'tanggal',
    ];

    public function karyawan()
    {
        return $this->belongsTo(User::class, 'id_karyawan');
    }
}
