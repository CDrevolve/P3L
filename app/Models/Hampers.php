<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hampers extends Model
{
    use HasFactory;

    protected $table = 'hampers';
    protected $primary ='id';
    public $timestamps = false;

    protected $fillable = [
        'nama',
        'harga',
    ];

    public function detailHampers()
    {
        return $this->hasMany(DetailHampers::class, 'id_hampers');
    }
}
