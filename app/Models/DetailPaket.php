<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPaket extends Model
{
    protected $guarded = ['id'];

    public function paket(){
        return $this->hasOne(Paket::class,'id','id_paket');
    }
    public function destinasi(){
        return $this->hasOne(Destinasi::class,'id','id_destinasi');
    }
    public function transportasi(){
        return $this->hasOne(Transportasi::class,'id','id_transportasi');
    }
}
