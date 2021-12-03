@extends('layouts.app') 

@section('content')
<h1>Recetas</h1>

<label for="">Comidas</label>
@foreach ($recetas as $receta)

    <div class="alert alert-info">
        {{ $receta }}
    </div>

    <br>
@endforeach 
<label for="">Categorías</label>
<br>
    @foreach ($categorias as $categoria)
    
      &ndash;   {{ $categoria }} <br>
    
    @endforeach 

@endsection