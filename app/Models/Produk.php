<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produks';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'id_jenis',
        'id_penitip',
        'nama',
        'stok',
        'harga',
        'kuota_harian',
        'foto',
    ];
    public function updateStokAndKuota($jumlah, $tanggal)
    {
        $today = Carbon::now()->format('Y-m-d');
        $selectedDate = Carbon::parse($tanggal)->format('Y-m-d');

        if ($today == $selectedDate) {
            $this->stok -= $jumlah;
        }

        $this->kuota_harian -= $jumlah;
        $this->save();
    }

    public function resetKuota()
    {
        $this->kuota_harian = $this->kuota_harian_default; // asumsikan Anda memiliki default kuota harian yang disimpan
        $this->save();
    }

    public function jenis()
    {
        return $this->belongsTo(Jenis::class, 'id_jenis');
    }
    public function penitip()
    {
        return $this->belongsTo(DataPenitip::class, 'id_penitip');
    }
}
