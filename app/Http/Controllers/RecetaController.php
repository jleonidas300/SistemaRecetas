<?php

namespace App\Http\Controllers;

use App\CategoriaReceta;
use App\Receta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class RecetaController extends Controller
{
    //proteger el acceso a los metodos
    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //cargo las recetas
        //Auth::user()->recetas->dd(); otra forma de traer los datos
        //auth()->user()->recetas->dd();

        $recetas = auth()->user()->recetas;

        return view('recetas.index', compact('recetas'));
        //return view('recetas.index')->with('recetas', $recetas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       //DB::table('categorias_receta')->get()->pluck('nombre', 'id')->dd();

        //$categorias = DB::table('categoria_recetas')->get()->pluck('nombre', 'id');//retorna datos sin modelo

        $categorias = CategoriaReceta::all(['id', 'nombre']);//datos con modelo
        
        return view('recetas.create', compact ('categorias'));//retornamos a la vista y enviamos el dato para el combo
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd( $request['imagen']->store('ImagenesRecetas', 'public'));
        //validaciones
        $data = request()->validate([
            'titulo' => 'required|min:6',
            'categorias' => 'required',
            'preparacion' => 'required',
            'ingredientes' => 'required',
            'imagen' => 'required|image'
        ]);

        //se captura la ruta de la imagen
        $RutaImagen = $request['imagen']->store('ImagenesRecetas', 'public');

        //risize de la imagen
        $img = Image::make( public_path("storage/{$RutaImagen}"))->fit(1000, 550);
        $img->save(); 

        //insersion de datos
        /*DB::table('recetas')->insert([
            'titulo' => $data['titulo'],
            'preparacion' => $data['preparacion'],
            'ingredientes' => $data['ingredientes'],
            'imagen' => $RutaImagen,
            'user_id' => Auth::user()->id,
            'categoria_id' => $data['categorias'],

        ]);*/

        //insertando datos con modelo
        auth()->user()->recetas()->create([
            'titulo' => $data['titulo'],
            'preparacion' => $data['preparacion'],
            'ingredientes' => $data['ingredientes'],
            'imagen' => $RutaImagen,
            'categoria_id' => $data['categorias']
        ]);

        return redirect()->action('RecetaController@index');
        //dd ($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function show(Receta $receta)
    {
        return view('recetas.show', compact('receta'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function edit(Receta $receta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Receta $receta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Receta $receta)
    {
        //
    }
}
