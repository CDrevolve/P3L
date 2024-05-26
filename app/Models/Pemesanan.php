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
        'id_alamat',
        'nama',
        'isi',
        'harga',
        'pickup',
        'status',
        'tanggal',
        'jarak',
        'ongkir',
        'id_alamat',
        'bukti_pembayaran',
        'jumlah_pembayaran',
        'tips',
    ];

    protected $dates = ['tanggal'];

    public function customer()
    {
        return $this->belongsTo(customer::class, 'id_customer');
    }

    public function karyawan()
    {
        return $this->belongsTo(karyawan::class, 'id_karyawan');
    }

    public function alamat()
    {
        return $this->belongsTo(Alamat::class, 'id_alamat');
    }

    public function calculateOngkir()
    {
        if ($this->jarak <= 5) {
            return 10000;
        } elseif ($this->jarak <= 10) {
            return 15000;
        } elseif ($this->jarak <= 15) {
            return 20000;
        } else {
            return 25000;
        }
    }

    public function updateHarga()
    {
        $this->ongkir = $this->calculateOngkir();
        $this->harga += $this->ongkir;
    }
}

