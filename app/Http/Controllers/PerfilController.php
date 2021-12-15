<?php

namespace App\Http\Controllers;

use App\Perfil;
use App\Receta;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     /**
     * Display the specified resource.
     *
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function show(Perfil $perfil)
    {
        //return $perfil; recetas con paginacion
        $recetas = Receta::where('user_id', $perfil->user_id)->paginate(3);

        return view('perfiles.show', compact('perfil', 'recetas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function edit(Perfil $perfil)
    {
        $this->authorize('view', $perfil);//bloquea el usuario no logueado de acuerdo al policy
        
        return view('perfiles.edit', compact('perfil'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Perfil $perfil)
    {
        $this->authorize('update', $perfil);
        //return "Actualizando perfil...";
        //validar

           $data = request()->validate([
               'nombre' => 'required',
               'biografia' => 'required'
           ]);
           //dd($data);
        //si el usuario sube una imagen
        if( $request['imagen'])
        {
            //se captura la ruta de la imagen
        $RutaImagen = $request['imagen']->store('Perfiles', 'public');

        //risize de la imagen
        $img = Image::make( public_path("storage/{$RutaImagen}"))->fit(600,600);
        $img->save(); 

        //array de imagen para unirlo con $dat
        $array_imagen = ['imagen' => $RutaImagen];

        }
       
        //asignar nombre y url si tiene en la tabla users
        //return auth()->user();
        auth()->user()->name = $data['nombre'];
        auth()->user()->save();

        //elimino de $data el nombre 
       unset($data['nombre']);
       //return $data;
       //guardar la informacion en la tabla perfiles y une con array_merge la imagen y $data
        auth()->user()->perfil()->update( array_merge(
            $data,
            $array_imagen ?? [] //si no se sube una imagen se pasa un array vacio para que pueda guardar
        ));
        
        //redireccionar
        return redirect()->action('RecetaController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function destroy(Perfil $perfil)
    {
        //
    }
}
