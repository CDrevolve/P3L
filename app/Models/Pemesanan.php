<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'tanggal',
        'status',
    ];

    // Relasi dengan model User untuk menghubungkan id_customer dengan id_user di tabel users
    public function customer()
    {
        return $this->belongsTo(User::class, 'id_customer');
    }

    // Relasi dengan model User untuk menghubungkan id_karyawan dengan id_user di tabel users
    public function karyawan()
    {
        return $this->belongsTo(User::class, 'id_karyawan');
    }
}
