<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'barang'; 
    
    // Kunci utama (Primary Key)
    protected $primaryKey = 'id_barang'; 
    
    // Karena ID Barang berupa kode/string, nonaktifkan auto-increment
    public $incrementing = false;
    
    // Tipe data kunci utama
    protected $keyType = 'string';

    // ⛔ Nonaktifkan otomatis kolom created_at dan updated_at
    public $timestamps = false;

    // Kolom yang boleh diisi secara massal
    protected $fillable = [
        'id_barang',
        'nama_barang',
        'kategori',
        'harga_barang',
        'jumlah_barang'
    ];
}
