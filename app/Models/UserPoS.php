<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';
    protected $fillable = [
        'name',
        'email',
        'password',
        'role' // tambahkan jika kamu punya role (admin / pegawai)
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
