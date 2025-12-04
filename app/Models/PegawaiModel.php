<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PegawaiModel extends Model
{
    use HasFactory;

    protected $table = 'pegawai';

    // IMPORTANT: Set primary key to match the database column name (id_pegawai)
    protected $primaryKey = 'idPegawai'; 

    public $incrementing = false;
    protected $keyType = 'string';

    public $timestamps = false;

    // CRITICAL: Must use the same CamelCase names as validation and requests
    protected $fillable = [
        'idPegawai',
        'namaPegawai',
        'email',
        'password',
        'jenisKelamin',
        'umur'
    ];
}