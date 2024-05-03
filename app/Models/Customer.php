<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customers';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'id_user',
        'nama',
        'saldo',
        'tanggal_lahir',
        'notelp',
        'poin'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
