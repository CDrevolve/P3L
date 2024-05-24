<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Pemesanan extends Model
{
    use HasFactory;

    protected $table = 'pemesanans'; // Sesuaikan dengan nama tabel Anda
    protected $primaryKey = 'id'; // Sesuaikan dengan nama primary key tabel Anda
    protected $fillable = [
        'id_customer',
        'id_karyawan',
        'nama',
        'isi',
        'harga',
        'pickup',
        'status',
        'tanggal',
    ];

    protected $dates = ['tanggal']; // Casting tanggal to Carbon

    public function customer()
    {
        return $this->belongsTo(User::class, 'id_customer');
    }

    public function karyawan()
    {
        return $this->belongsTo(User::class, 'id_karyawan');
    }
}

