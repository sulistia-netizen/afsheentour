<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kunjungan extends Model
{
    protected $table = 'kunjungans'; // sesuaikan dengan nama tabel di database
    protected $fillable = ['ip_address']; // sesuaikan dengan kolom yang dipakai
}

