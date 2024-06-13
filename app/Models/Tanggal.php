<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tanggal extends Model
{
    use HasFactory;

    protected $table = 'tanggals';
    protected $primary ='id';
    protected $fillable = [
        'tanggal',
    ];


    public function detailTanggals()
    {
        return $this->hasMany(DetailTanggal::class, 'id_tanggal');
    }
}
