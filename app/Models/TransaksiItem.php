<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiItem extends Model
{
    use HasFactory;

    protected $table = 'transaksi_items'; // pastikan sesuai tabel di DB

    protected $fillable = [
        'transaksi_id',
        'id_barang',
        'nama_barang',
        'jumlah',
        'harga_satuan',
        'diskon_persen', // tambah jika ingin simpan diskon tiap item
        'subtotal',
    ];

    // Relasi ke Transaksi
    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'transaksi_id');
    }

    // Relasi ke Barang
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang', 'id_barang');
    }

    // Helper: Hitung subtotal otomatis (harga * jumlah - diskon)
    public function hitungSubtotal()
    {
        $diskon = $this->diskon_persen ?? 0;
        return ($this->harga_satuan * $this->jumlah) * (1 - ($diskon/100));
    }
}
