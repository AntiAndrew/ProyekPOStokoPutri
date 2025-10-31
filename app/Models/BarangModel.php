<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangModel extends Model
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

    // Kolom-kolom yang boleh diisi secara massal (mass assignable)
    protected $fillable = [
        'id_barang',
        'nama_barang',
        'kategori',
        'harga',
        'jumlah' // Asumsi: ini adalah kolom stok/jumlah
    ];
}