<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customers';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'id_user',
        'nama',
        'tanggal_lahir',
        'no_telp',
        'saldo',
        'poin',
        'foto',
    ];

    protected $dates = ['tanggal_lahir']; // Casting tanggal_lahir to Carbon

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
