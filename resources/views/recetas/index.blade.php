@extends('layouts.app')

@section('botones')
<a href="{{ route('recetas.create') }}" class="btn btn-info text-white" >Crear Receta</a>
<a href="{{ route('perfiles.show', ['perfil' => Auth::user()->id ]) }}" class="btn btn-info text-white" >Ver Perfil</a>
<a href="{{ route('perfiles.edit', ['perfil' => Auth::user()->id ]) }}" class="btn btn-info text-white" >Editar Perfil</a>
@endsection

@section('content')

<h1 class="text-center mb-5">Recetas</h1>

<div class="col-md-12 mx-auto bg-light p-3">

    <table class="table table-striped">
        <thead class="bg-success text-light">
            <TR>
                <th>Título</th>
                <th>Categoría</th>
                <th>Imagen</th>
                <th class="text-center col-sm-3">Acciones</th>
            </TR>
        </thead>
    <tbody>

        @foreach ($recetas as $receta)
            <tr>
                <td> {{ $receta->titulo }} </td>
                <td> {{ $receta->categoria->nombre }} </td>
                <td> <img src="/storage/{{ $receta->imagen }}" style="width: 7em" class="rounded"></td>
                <td>
                    <div class="row">
                        <div class="col">
                            <!--Otra forma de pasar el Id por la URL-->
                            <!--<a href="{{ route('recetas.show', $receta) }}" class="btn btn-success mr-1" type="">Ver</a>-->
                            <a href="{{ route('recetas.show', ['receta' => $receta->id]) }}" class="btn btn-success" type=""><i class="fas fa-eye"></i></a>
                        </div>

                        <div class="col">
                            <a href="{{ route('recetas.edit', $receta) }}" class="btn btn-dark" type="button"><i class="fas fa-edit"></i></a>
                        </div>

                        <div class="col">
                            <eliminar-receta receta-id={{ $receta->id }}></eliminar-receta>

                            <!--
                            <form method="post" action="{{ route('recetas.show', ['receta' => $receta->id ]) }}">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" value="X" class="btn btn-danger" id="">
                            </form>-->
                        </div>

                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
    </table>
    <div class="col-12 text-center d-flex">
    {{ $recetas->links() }}
    </div>

        <h2 class=""text-center my-5>Recetas que te gustan</h2>
        <div class="mx-auto bg-white p-3 col-md-10">
            @if( count($usuario->meGusta) > 0)
            <ul class="list-group">
                @foreach($usuario->meGusta as $receta)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <p>{{ $receta->titulo }}</p>
                    <a href="{{ route('recetas.show', ['receta' => $receta->id ]) }}" title="ver receta"class="btn btn-outline-success">
                    <i class="fas fa-eye"></i>
                    </a>
                </li>
                @endforeach

            </ul>
            @else
                <p>No tienes recetas que te gustan</p>
            @endif
        </div>
</div>

@endsection