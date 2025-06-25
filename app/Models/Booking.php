<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
      protected $guarded = ['id'];

    public function user() {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function paket() {
        return $this->belongsTo(Paket::class, 'id_paket');
        
    //protected $guarded = ['id'];
    //public function user(){
       // return $this->hasOne(User::class,'id','id_user');
    //}
    // public function paket(){
       // return $this->hasOne(Paket::class,'id','id_paket');
    }
}
