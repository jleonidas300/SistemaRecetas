@extends('layouts.app')

@section('botones')
<a href="{{ route('recetas.index') }}" title="Inicio" class="btn btn-info text-white" ><i class="fas fa-home"></i></a>
@endsection

@section('content')

<h1 class="text-center mb-5">Crear Nueva Receta</h1>
    <div class="card">
        <div class="card-body">
            <div class="card-header text-center">
                <h1>Recetas</h1>
            </div>

            <form action="{{ route('recetas.store') }}" method="POST">
                @csrf
                <div class="form-group py-4">
                    <label for="ttulo">Título de la receta</label>
                    <input type="text" class="form-control" id="titulo" name="titulo">
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Agregar Receta">
                </div>

            </form>
        </div>
    </div>

@endsection