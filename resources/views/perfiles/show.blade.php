@extends('layouts.app');
@section('botones')
<a href="{{ route('inicio.index') }}" title="Inicio" class="btn btn-info text-white" ><i class="fas fa-home"></i>Inicio</a>
@endsection
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-5">
            @if($perfil->imagen)
                <img src="/storage/{{ $perfil->imagen }}" style="width: 20em" class="rounded-circle">
            @endif
        </div>
        <div class="col-md-7">
            <h2 class="text-center mb-2 text-primary">{{ $perfil->usuario->name }}</h2>
        </div>

        <div class="biografia">
            <p>Mi biografía</p>
            {!! $perfil->biografia !!}
        </div>

    </div>
</div>

<div class="container">
    <h2 class="text-center mt-4">Recetas creadas por: {{ $perfil->usuario->name }}</h2>
    <div class="row mx-auto bg-white p-3">
        @if(count($recetas) > 0)
            
            @foreach($recetas as $receta)
                
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="/storage/{{ $receta->imagen }}" class="card-img-top">
                    
                        <div class="card-body">
                            <h3>{{  $receta->titulo}}</h3>
                            <a title="Ver receta" class="mt-4" href="{{ route('recetas.show', ['receta' => $receta->id ]) }}"><i class="fas fa-eye fa-2x"></i></a>
                        </div>
                    </div>
                </div>

            @endforeach
        @else
            <label class="primary w-100">Este usuario no tiene recetas</label>
        @endif
        
    </div>
    <div class="mb-4">
         {{$recetas->links()}}
    </div>

    
    
</div>
@endsection