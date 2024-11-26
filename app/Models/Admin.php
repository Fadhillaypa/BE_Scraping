<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $table = 'admins'; // Nama tabel jika berbeda dari konvensi

    protected $fillable = [
        'email', 'password',
    ];

    protected $hidden = [
        'password', 
    ];

    // Jika Anda memiliki atribut tambahan yang ingin di-hash atau manipulasi, tambahkan di sini
}

