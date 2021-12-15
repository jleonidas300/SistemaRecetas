<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    //relacion 1 a 1 hacia users
    public function usuario(){
        
        return $this->belongsTo(User::class, 'user_id');
    }
}
