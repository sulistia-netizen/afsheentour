<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Pengguna extends Model
{
    use HasRoles;
    
    protected $guard_name = 'web';
    
    protected $guarded = ['id'];

    public function user() {
        return $this->hasOne(User::class, 'id', 'pengguna_id');
    }
}
