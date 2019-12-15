<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class m_semuaproduk extends Model
{
    public $timestamps = false;
    protected $table = 'absensi';
    protected $guarded = ['id'];
}
