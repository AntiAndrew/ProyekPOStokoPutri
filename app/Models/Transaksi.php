<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';

    protected $fillable = [
        'no_transaksi',
        'tanggal',
        'pelanggan',
        'user_id',
        'subtotal',
        'diskon',
        'total',
        'status',
    ];

    public function items()
    {
        return $this->hasMany(TransaksiItem::class, 'transaksi_id');
    }
}
