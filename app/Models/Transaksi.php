<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';
    
    // Menggunakan 'id_transaksi' sebagai Primary Key
    protected $primaryKey = 'id_transaksi'; 
    public $incrementing = false; // ID transaksi biasanya string, bukan auto-increment
    protected $keyType = 'string'; // Tipe PK string

    public $timestamps = false; // Tidak ada created_at/updated_at

    protected $fillable = [
        'id_transaksi',
        'tanggal',
        'id_barang',
        'nama_barang',
        'harga_barang',
        'jumlah_barang',
        'total_harga',
        'id_pegawai',
    ];

    /**
     * Relasi ke pengguna (pegawai yang input transaksi)
     */
    public function pegawai()
    {
        return $this->belongsTo(User::class, 'id_pegawai', 'id');
    }

    /**
     * Scope untuk mencari transaksi berdasarkan ID
     */
    public function scopeById($query, $id)
    {
        return $query->where('id_transaksi', $id);
    }

    /**
     * Method helper untuk menghitung total_harga
     */
    public function hitungTotal()
    {
        return $this->harga_barang * $this->jumlah_barang;
    }
}
