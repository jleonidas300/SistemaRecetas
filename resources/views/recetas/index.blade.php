@extends('layouts.app')

@section('botones')
<a href="{{ route('recetas.create') }}" class="btn btn-info text-white" >Crear Receta</a>
@endsection

@section('content')

<h1 class="text-center mb-5">Recetas</h1>

<div class="col-md-12 mx-auto bg-secondary p-3">

    <table class="table">
        <thead class="bg-success text-light">
            <TR>
                <th>Título</th>
                <th>Categoría</th>
                <th>Acciones</th>
                </TR>
        </thead>
    <tbody>

        @foreach ($recetas as $receta)
            <tr>
                <td> {{ $receta->titulo }} </td>
                <td> {{ $receta->categoria->nombre }} </td>
                <td>
                    <a class="btn btn-success mr-1" type="">Ver</a>
                    <a class="btn btn-dark mr-1" type="button">Edit</a>
                    <a class="btn btn-danger mr-1" type="button">X</a>
                </td>
            </tr>
        @endforeach

    </tbody>
    </table>

</div>

@endsection