<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    //evento que se ejecuta cuando un usuario es creado
    protected static function boot(){
        parent::boot();
        
        //asignar perfil cuando se crea un suuario nuevo
        static::created(function ($user)
        {
           $user->perfil()->create(); 
        });

    }

    //relacion 1:n de User -> recetas

    public function recetas(){
        
        return $this->hasMany(Receta::class);
    }

    //relacion 1 a 1 hacia la tabla perfils
    public function perfil()
    {
        return $this->hasOne(Perfil::class);
    }

    //recetas que el user le ha dado me gusta
    public function meGusta(){
        return $this->belongsToMany(Receta::class, 'likes_receta');
    }
}
