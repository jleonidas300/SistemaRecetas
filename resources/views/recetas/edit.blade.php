@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css" integrity="sha512-CWdvnJD7uGtuypLLe5rLU3eUAkbzBR3Bm1SFPEaRfvXXI2v2H5Y0057EMTzNuGGRIznt8+128QIDQ8RqmHbAdg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection


@section('botones')
<a href="{{ route('recetas.index') }}" title="Inicio" class="btn btn-info text-white" ><i class="fas fa-home"></i>Inicio</a>
@endsection

@section('content')

<h1 class="text-center">Editar Receta: {{ $receta->titulo }} </h1>
    <div class="card">
        <div class="card-body">
            <div class="card-header text-center">
                <h1>Recetas</h1>
            </div>
            
            <form action="{{ route('recetas.update', ['receta' => $receta->id ]) }}" method="POST" enctype="multipart/form-data" novalidate>
                @csrf
                @method('PUT')
                
                <div class="form-group py-4">
                    <label for="titulo">Título de la receta</label>
                    <input type="text" class="form-control @error('titulo') is-invalid @enderror" id="titulo" name="titulo" value="{{ $receta->titulo }}">
                        @error ('titulo') 
                        <p class="bg-info">{{ $message }} </p>
                        @enderror
                </div>

                <div class="form-group">
                <label for="categorias">Categorías</label>
                    <select name="categorias" id="categorias" class="form-control @error('categorias') is-invalid @enderror">

                    <option value="">- Seleccione</option>
                        @foreach ($categorias as $categoria)
                        <option 
                            value="{{ $categoria->id }}" 
                            {{ $receta->categoria_id == $categoria->id ? 'selected' : '' }}
                            >{{ $categoria->nombre }}
                        </option>
                        @endforeach
                    </select>

                    @error ('categorias') 
                        <p class="bg-info">{{ $message }} </p>
                    @enderror
                </div>

                <div class="form-group mt-2">
                    <label for="preparacion">Preparación</label>
                    <input type="hidden" name="preparacion" id="preparacion" value="{{ $receta->preparacion }}">

                    <trix-editor input="preparacion" class="form-control @error('preparacion') is-invalid @enderror"></trix-editor>

                    @error ('preparacion') 
                        <p class="bg-info">{{ $message }} </p>
                    @enderror
                </div>

                <div class="form-group mt-2">
                    <label for="ingredientes">Ingredientes</label>
                    <input type="hidden" name="ingredientes" id="ingredientes"  value="{{ $receta->ingredientes }}">

                    <trix-editor input="ingredientes" class="form-control @error('ingredientes') is-invalid @enderror"></trix-editor>

                    @error ('ingredientes') 
                        <p class="bg-info">{{ $message }} </p>
                    @enderror
                </div>

                <div class="form-group mt-2">
                    <label for="imagen">Agrega una imagen</label>

                    <input 
                    type="file" 
                    name="imagen" 
                    id="imagen"
                    class="form-control  @error('imagen') is-invalid @enderror">
                    
                    <!--cargo la imagen actual-->
                    <p>Imagen actual</p>
                    <img src="/storage/{{ $receta->imagen }}" style="width: 20em" class="rounded">

                    @error ('imagen') 
                        <p class="bg-info">{{ $message }} </p>
                    @enderror
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Agregar Receta">
                </div>

            </form>
        </div>
    </div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js" integrity="sha512-/1nVu72YEESEbcmhE/EvjH/RxTg62EKvYWLG3NdeZibTCuEtW5M4z3aypcvsoZw03FAopi94y04GhuqRU9p+CQ==" crossorigin="anonymous" referrerpolicy="no-referrer" defer></script>
@endsection