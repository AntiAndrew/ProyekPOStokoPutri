<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiItem extends Model
{
    use HasFactory;

    protected $table = 'transaksi_items'; // Pastikan sesuai nama tabel di database
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'transaksi_id',
        'id_barang',
        'nama_barang',
        'jumlah',
        'harga_satuan',
        'diskon_persen', // opsional jika tabel punya kolom ini
        'subtotal',
    ];

    /**
     * Relasi ke Transaksi (many-to-one)
     * Setiap item dimiliki oleh satu transaksi.
     */
    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'transaksi_id', 'id');
    }

    /**
     * Relasi ke Barang (many-to-one)
     * Menghubungkan item dengan data barang.
     */
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang', 'id_barang');
    }

    /**
     * Hitung subtotal otomatis (harga * jumlah - diskon)
     */
    public function hitungSubtotal()
    {
        $diskon = $this->diskon_persen ?? 0;
        $hargaSetelahDiskon = $this->harga_satuan * (1 - ($diskon / 100));
        return $hargaSetelahDiskon * $this->jumlah;
    }
}
