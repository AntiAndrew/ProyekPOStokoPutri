<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'no_transaksi',
        'tanggal',
        'pelanggan',     // Nama pelanggan (string)
        'user_id',       // ID kasir / pengguna
        'subtotal',
        'diskon',
        'total',
        'status',
    ];

    /**
     * Relasi ke detail barang (TransaksiItem)
     * Setiap transaksi memiliki banyak item.
     */
    public function items()
    {
        return $this->hasMany(TransaksiItem::class, 'transaksi_id', 'id');
    }

    /**
     * Relasi ke pengguna (User)
     * Setiap transaksi dilakukan oleh satu user (kasir/admin).
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Relasi opsional ke pelanggan (jika nanti dibuat model Pelanggan)
     * Jika belum ada tabel pelanggan, relasi ini bisa diabaikan.
     */
    // public function pelanggan()
    // {
    //     return $this->belongsTo(Pelanggan::class, 'pelanggan_id', 'id');
    // }
}
