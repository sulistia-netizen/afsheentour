<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ulasan extends Model
{
    protected $guarded = ['id'];
    public function user(){
        return $this->belongsTo(User::class,'id_user');
    }
    public function paket(){
        return $this->belongsTo(Paket::class,'id_paket');
    }

}
