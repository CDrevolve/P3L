<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chart extends Model
{
    use HasFactory;
    protected $table = 'chart';

    protected $primaryKey = 'id';

    public $timestamps = false;
    protected $fillable = [
        'id_customer',
        'id_produk',
        'jumlah',
    ];
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'id_customer');
    }
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk');
    }
}
