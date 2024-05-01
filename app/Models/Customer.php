<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    
    protected $table = 'customer';

    protected $primaryKey = 'id_customer';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'nama_customer',
        'saldo_customer',
        'tanggal_lahir_customer',
        'notelp_customer',
        'poin'
    ];

    public function customer()
    {
        return $this->hasMany(User::class, 'id');
    }
}
