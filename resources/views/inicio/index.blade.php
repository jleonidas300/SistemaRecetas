@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('hero')
<div class="hero-categorias">
    <form class="container h-100 align-items-center"
        method="get" action="{{ route('buscar.show') }}">

    <div class="col-md-4 texto-buscar">
        <p class="font-weight-bold font-italic text-primary">Encuentra una receta para tu próxima comida</p>
        <input class="form-control" type="search" name="buscar" placeholder="Buscar Receta">
    </div>
        
    </form>

</div>
@endsection

@section('botones')
<!--<a href="{{ route('recetas.create') }}" class="btn btn-info text-white" >Crear Receta</a>-->


@endsection
@section('content')
    
    <div class="nuevas-recetas container">
        <h2 class="titulo-categoria mt-3 mb-4">Últimas Recetas</h2>

        <div class="owl-carousel owl-theme">
            @foreach($nuevas as $nueva)
            
                <div class="card">
                    <img src="/storage/{{ $nueva->imagen }}" class="card-img-top" alt="Imagenes de las recetas">
                

                    <div class="card-body">
                        <h3>{{ $nueva->titulo}}</h3>

                        <p>{{ Str::words(strip_tags ($nueva->preparacion), 20) }}</p>   
                        
                        <a href="{{ route('recetas.show', ['receta' => $nueva->id ]) }}" class="btn btn-primary d-block font-weight-bold">Ver Receta <i class="far fa-eye"></i></a>
                    </div>
                </div>
            
            @endforeach

        </div>
    </div>
    
    <div class="container">
            <h2 class="titulo-categoria mt-4 mb-3 text-uppercase">Recetas más Votadas</h2>

            <div class="row">
                @foreach($votadas as $receta )
                    @include('ui.receta')
                @endforeach

            </div>

    </div>
    
    <!--categorias de recetas-->

    @foreach($recetas as $key => $grupo)
        <div class="container">
            <h2 class="titulo-categoria mt-4 mb-3 text-uppercase">{{ str_replace('-', ' ', $key) }}</h2>

            <div class="row">
                @foreach($grupo as $recetas )
                    @foreach($recetas as $receta)
                        @include('ui.receta')
                    @endforeach
                @endforeach

            </div>

        </div>
    @endforeach

@endsection