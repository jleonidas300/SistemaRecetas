<?php

namespace App\Http\Controllers;

use App\Receta;
use App\CategoriaReceta;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class InicioController extends Controller
{
    public function index()
    {
        //obtener las recetas más votadas
        //$votadas = Receta::has('likes', '>', 1)->get();

        $votadas = Receta::withCount('likes')->orderBy('likes_count', 'DESC')->take(3)->get();
        //return $votadas;

        //obtener las recetas más nuevas
        $nuevas = Receta::latest('created_at')->take(3)->get();
        //recetas por categoria - obtenerlas todas

        $categorias = CategoriaReceta::all();

        //return $categorias;
        //agrupar las categorias

        $recetas = [];

        foreach($categorias as $categoria){
            $recetas[ Str::slug($categoria->nombre) ] [] = Receta::where('categoria_id', $categoria->id)->take(3)->get();
        }

        //return $recetas;

        return view('inicio.index', compact('nuevas', 'recetas', 'votadas'));
    }
}
