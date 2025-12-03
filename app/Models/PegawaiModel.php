<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PegawaiModel extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'pegawai';

    // Primary key tabel
    protected $primaryKey = 'idPegawai';

    // Primary key berupa string, bukan auto increment
    public $incrementing = false;
    protected $keyType = 'string';

    // Fields yang bisa diisi mass-assignment
    protected $fillable = [
    'idPegawai',
    'namaPegawai',
    'email',
    'password',
    'jenisKelamin',
    'umur'
];
}
