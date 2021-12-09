@extends('layouts.app')

@section('content')


<article class="card">

    <h1 class="text-center mb-4">{{ $receta->titulo }}</h1>

    <div>
        <img src="/storage/{{ $receta->imagen }}" class="w-25">
    </div>

    <div>
        <p>
        <span class="font-weight-bold text-primary">Escrito en: </span>
            {{ $receta->categoria->nombre }}
        </p>

        <p>
        <span class="font-weight-bold text-primary">Autor: </span>
            {{ $receta->user_id}} || Fecha: {{ $receta->created_at }}
        </p>
    </div>

    <div>
    <h1 class="text-primary my-4">Ingredientes</h1>
        {{-- para no imprimir los html--}}
        
        {!! $receta->ingredientes !!}
    </div>

    <div>
        <h1 class="text-primary my-4">preparacion</h1>
        {!! $receta->preparacion !!}
    </div>

</article>


@endsection