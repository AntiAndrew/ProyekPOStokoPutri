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
        'pelanggan', // Catatan: Kolom ini kemungkinan string/nama, bukan foreign key
        'user_id',   // Foreign key ke tabel users (Salesman/Kasir)
        'subtotal',
        'diskon',
        'total',
        'status',
    ];

    /**
     * Relasi ke TransaksiItem (Detail Barang)
     */
    public function items()
    {
        return $this->hasMany(TransaksiItem::class, 'transaksi_id');
    }

    /**
     * Relasi ke User (Salesman/Kasir)
     * Kolom foreign key di tabel 'transaksi' adalah 'user_id'
     */
    public function user()
    {
        // Asumsi Model User berada di App\Models\User
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * OPSI Relasi Pelanggan (Jika menggunakan foreign key)
     * Jika Anda TIDAK menggunakan foreign key dan 'pelanggan' hanya menyimpan nama (string),
     * maka fungsi ini JANGAN DIPAKAI.
     * * public function pelanggan()
     * {
     * // Ganti Pelanggan::class jika nama modelnya berbeda,
     * // dan ganti 'pelanggan_id' jika nama kolomnya berbeda.
     * return $this->belongsTo(Pelanggan::class, 'pelanggan_id'); 
     * }
     */
}