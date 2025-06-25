<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    protected $guarded = ['id'];

    public function detail_paket(){
        return $this->hasMany(DetailPaket::class,'id_paket','id');
    }

    public function hotel(){
        return $this->hasOne(Hotel::class,"id","id_hotel");
    }

    public function transportasi(){
        return $this->hasOne(Transportasi::class,"id","id_transportasi");
    }
}
