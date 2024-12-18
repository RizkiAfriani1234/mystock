<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * Atribut yang dapat diisi secara massal.
     */
    protected $fillable = [
        'username',
        'nama_pemilik',
        'name',
        'email',
        'password',
    ];

    /**
     * Menyembunyikan atribut ini saat model dikembalikan sebagai array/json.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
}
