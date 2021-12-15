<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receta extends Model
{
    //campos que se agregaran
    protected $fillable = [
        'titulo', 'preparacion', 'ingredientes', 'imagen', 'categoria_id',
    ];

    //obtiene la categoria de la receta
    public function categoria()
    {
        return $this->belongsTo(CategoriaReceta::class);
    }

    //se obtiene el auto mediante la relacion con la tabla users
    public function autor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    //likes de una receta
    public function likes(){
        return $this->belongsToMany(User::class, 'likes_receta');
    }
}
