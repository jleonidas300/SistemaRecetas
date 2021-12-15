@extends('layouts.app')
@section('botones')
<a href="{{ route('recetas.index') }}" title="Inicio" class="btn btn-info text-white" ><i class="fas fa-home"></i></a>
@endsection
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
            {{ $receta->autor->name }} || Fecha: @php $fecha = $receta->created_at @endphp
            <fecha-receta fecha = "{{ $fecha }}"></fecha-receta>
        </p>
        
    </div>

    <div class="p-4 text-justify">
    <h1 class="text-primary my-4">Ingredientes</h1>
        {{-- para no imprimir los html--}}
        
        {!! $receta->ingredientes !!}
    </div>

    <div class="p-4 text-justify">
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