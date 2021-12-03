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
        <tr>
            <td>Pollo</td>
            <td>Comidas</td>
            <td>||</td>
        </tr>
    </tbody>
    </table>

</div>

@endsection