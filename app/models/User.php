<?php

namespace App\models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    public $timestamps = false;
    protected $fillable = [
        'name', 'email', 'password','username','level'
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];
}
