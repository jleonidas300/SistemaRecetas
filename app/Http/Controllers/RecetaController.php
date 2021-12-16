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
        $this->middleware('auth', ['except' => ['show', 'search']]);
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

        //$recetas = auth()->user()->recetas;
        $usuario = auth()->user();
        //para la paginacion 
        $recetas = Receta::where('user_id', $usuario->id)->paginate(2);

        return view('recetas.index', compact('recetas', 'usuario'));
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
        //obtener si el usuario dio like a la receta
        $like = (auth()->user()) ? auth()->user()->meGusta->contains($receta->id) : false;

        //buscando la cantidad de likes
        $likes = $receta->likes->count();

        return view('recetas.show', compact('receta', 'like', 'likes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function edit(Receta $receta)
    {
         //revisa las policy
         $this->authorize('view', $receta);
        $categorias = CategoriaReceta::all(['id', 'nombre']);//datos con modelo

        return view('recetas.edit', compact('categorias', 'receta'));
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
        //revisa las policy
        $this->authorize('update', $receta);

        //validaciones
        $data = request()->validate([
            'titulo' => 'required|min:6',
            'categorias' => 'required',
            'preparacion' => 'required',
            'ingredientes' => 'required'
        ]);

        //asignando valores
        $receta->titulo = $data['titulo'];
        $receta->categoria_id = $data['categorias'];
        $receta->preparacion = $data['preparacion'];
        $receta->ingredientes = $data['ingredientes'];

        //si el user sube nueva imagen

        if(request('imagen'))
        {
            //se captura la ruta de la imagen
            $RutaImagen = $request['imagen']->store('ImagenesRecetas', 'public');

            //risize de la imagen
            $img = Image::make( public_path("storage/{$RutaImagen}"))->fit(1000, 550);
            $img->save();

            //se asigna al objeto
            $receta->imagen = $RutaImagen;
        }

        $receta->save();

        //redireccionamos
        return redirect()->action('RecetaController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Receta $receta)
    {
        //eturn "Eliminando";
        //revisa las policy
        $this->authorize('delete', $receta);

        //elimina receta
        $receta->delete();
          //redireccionamos
        return redirect()->action('RecetaController@index');
    }

    //funcion para buscar
    public function search(Request $request){
        //$busqueda = $request['buscar'];

        $busqueda = $request->get('buscar');

        $recetas = Receta::where('titulo', 'like', '%' .$busqueda. '%')->paginate(3);
        $recetas->appends(['buscar' => $busqueda ]);

        return view('busquedas.show', compact('recetas', 'busqueda'));
    }
}
