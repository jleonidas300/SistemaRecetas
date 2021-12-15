<?php

namespace App\Http\Controllers;

use auth;
use App\Receta;
use Illuminate\Http\Request;

class LikesController extends Controller
{
   
    public function update(Request $request, Receta $receta)
    {
        // almacena los like de un usuario auna receta
        return auth()->user()->meGusta()->toggle($receta);
    }
}
