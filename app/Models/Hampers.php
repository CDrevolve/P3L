<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hampers extends Model
{
    use HasFactory;
    protected  $table = 'hampers';
    protected $primaryKey = "id";

    protected $fillable = [
        "nama",
        "harga",
        "isi",
    ];
    public function Detailhampers()
    {
        return $this->belongsTo(DetailHampers::class, 'id_hampers');
    }
}
