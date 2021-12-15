@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection
@section('botones')
<a href="{{ route('recetas.create') }}" class="btn btn-info text-white" >Crear Receta</a>


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
    <!--categorias de recetas-->

    @foreach($recetas as $key => $grupo)
        <div class="container">
            <h2 class="titulo-categoria mt-4 mb-3 text-uppercase">{{ str_replace('-', ' ', $key) }}</h2>

            <div class="row">
                @foreach($grupo as $recetas )
                    @foreach($recetas as $receta)
                        <div class="col-md-4 mt-4">
                            <div class="card shadow">
                                <img src="/storage/{{ $receta->imagen }}" class="card-img-top" alt="Receta imagen">
                                <div class="card-body">
                                    <h3 class="card-title">{{ $receta->titulo}}</h3>
                                    <div class="meta-receta d-flex justify-content-between">
                                        <p class="font-weight-bold text-primary">
                                            
                                            @php $fecha = $receta->created_at @endphp
                                            <fecha-receta fecha = "{{ $fecha }}"></fecha-receta>
                                        </p>
                                        <p class="font-weight-bold">
                                           {{ count($receta->likes ) }} Les gustó
                                        </p>
                                    </div>
                                    <p class="text-justify">
                                            {{ Str::words(strip_tags ($nueva->preparacion), 20, '...') }}
                                            <a href="{{ route('recetas.show', ['receta' => $receta->id ]) }}" class="btn btn-info">Ver más</a>
                                    </p>
                                </div>

                            </div>

                        </div>
                    @endforeach
                @endforeach

            </div>

        </div>
    @endforeach

@endsection