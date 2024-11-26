<?php

// app/Models/User.php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    // Menggunakan id_user sebagai primary key
    protected $primaryKey = 'id_user';

    protected $fillable = [
        'id_user', // Menambahkan id_user ke fillable
        'name', 
        'email', 
        'password', 
        'alamat', 
        'no_tlfn', 
        'foto', 
        'role', 
        'document',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
