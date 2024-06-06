<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AjuanSaldo extends Model
{
    use HasFactory;

    protected $table = 'ajuan_saldos';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_customer',
        'saldo',
        'bank',
        'no_rekening',
        'status',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'id_customer');
    }
}
