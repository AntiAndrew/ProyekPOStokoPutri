<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    // Nama tabel di database Anda
    protected $table = 'barang'; 
    
    // Kunci utama (Primary Key) tabel
    protected $primaryKey = 'id_barang'; 
    
    // Karena ID Barang berupa kode/string, kita nonaktifkan auto-increment
    public $incrementing = false;
    
    // Tipe data kunci utama
    protected $keyType = 'string';

    // Kolom-kolom yang boleh diisi secara massal (SESUAI DENGAN NAMA DI DATABASE)
    protected $fillable = [
        'id_barang',
        'nama_barang',
        'kategori',
        'harga_barang', // HARGA BARU
        'jumlah_barang' // JUMLAH BARU
    ];
}