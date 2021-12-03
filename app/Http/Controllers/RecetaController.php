<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RecetaController extends Controller
{
    public function receta(Request $request)
    {

        $recetas =['Pollo', 'Cerdo'];
        $categorias = ['C. Mexicana', 'C. China'];
        //formas de pasar los datos a la vista
        //return view('recetas.index')
                //->with('recetas', $recetas)
                //->with('categorias', $categorias);

        return view('recetas.index', compact('recetas', 'categorias')); //segunda forma de pasar los datos
        
    }
}
