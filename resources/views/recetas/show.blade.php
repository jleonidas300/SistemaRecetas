@extends('layouts.app')
@section('botones')
<!--<a href="{{ route('inicio.index') }}" title="Inicio" class="btn btn-info text-white" ><i class="fas fa-home"></i></a>-->
@endsection
@section('content')


<article class="card p-5 shadow">

    <h1 class="text-center mb-4">{{ $receta->titulo }}</h1>

    <div>
        <img src="/storage/{{ $receta->imagen }}" class="w-100 rounded">
    </div>

    <div class="mt-4">
        <p>
        <span class="font-weight-bold text-primary">Escrito en: </span>
        <a href="{{ route('categorias.show', ['categoriaReceta'=> $receta->categoria->id ]) }}">
            {{ $receta->categoria->nombre }}
        </a>
        </p>

        <p>
        <span class="font-weight-bold text-primary">Autor: </span>
           
        <a href="{{ route('perfiles.show', ['perfil'=> $receta->autor->id ]) }}">
            {{ $receta->autor->name }} 
        </a>
            
            || Fecha: @php $fecha = $receta->created_at @endphp
            <fecha-receta fecha = "{{ $fecha }}"></fecha-receta>
        </p>
        
    </div>

    <div class="text-justify">
    <h1 class="text-primary my-4">Ingredientes</h1>
        {{-- para no imprimir los html--}}
        
        {!! $receta->ingredientes !!}
    </div>

    <div class="text-justify">
        <h1 class="text-primary my-4">preparacion</h1>
        {!! $receta->preparacion !!}
    </div>

</article>

<like-button 
receta-id="{{$receta->id}}"
like="{{$like}}"
likes="{{$likes}}"
>
</like-button>

@endsection