<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $guarded = ['id'];
    public function booking(){
        return $this->hasOne(Booking::class,'id','id_booking');
    }
}
