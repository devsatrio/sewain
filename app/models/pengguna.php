<?php

namespace App\models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class pengguna extends Authenticatable
{
    use Notifiable;

    public $timestamps = false;
    protected $table = "pengguna";
    protected $fillable = [
        'name', 'email', 'password','username'
    ];
    protected $hidden = [
        'password',
    ];
}
