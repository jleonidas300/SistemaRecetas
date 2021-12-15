@extends('layouts.app');

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css" integrity="sha512-CWdvnJD7uGtuypLLe5rLU3eUAkbzBR3Bm1SFPEaRfvXXI2v2H5Y0057EMTzNuGGRIznt8+128QIDQ8RqmHbAdg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection


@section('botones')
<a href="{{ route('recetas.index') }}" title="Inicio" class="btn btn-info text-white" ><i class="fas fa-home"></i></a>
@endsection

@section('content')
<!--{{-- $perfil --}}-->
<div class="container">
    <h1 class="text-center">Editar Perfil</h1>

    <div class="row justify-content-center mt-5">
        <div class="col-md-10 bg-white p-3">
            
            <form method="POST" action="{{ route('perfiles.update', ['perfil' => $perfil->id ]) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                        <div class="form-group py-4">
                            <label for="nombre">Nombre</label>
                                <input 
                                type="text" 
                                class="form-control @error('nombre') is-invalid @enderror" 
                                id="nombre" 
                                name="nombre"
                                placeholder="Tu nombre" 
                                value="{{ $perfil->usuario->name }}">

                                @error ('nombre') 
                                <p class="bg-info">{{ $message }} </p>
                                @enderror
                        </div>

                        <div class="form-group mt-2">
                            <label for="biografia">Biografía</label>
                                <input 
                                type="hidden" 
                                name="biografia" 
                                id="biografia" 
                                value="{{ $perfil->biografia }}"
                                >

                                <trix-editor input="biografia" 
                                    class="form-control @error('biografia') is-invalid @enderror">
                                </trix-editor>

                                @error ('biografia') 
                                    <p class="bg-info">{{ $message }} </p>
                                @enderror
                        </div>

                        <div class="form-group mt-2">
                                <label for="imagen">Tu imagen</label>

                                <input 
                                type="file" 
                                name="imagen" 
                                id="imagen"
                                class="form-control  @error('imagen') is-invalid @enderror">
                                
                                <!--cargo la imagen actual-->
                                    @if( $perfil->imagen )
                                        <p>Imagen actual</p>
                                        <img src="/storage/{{ $perfil->imagen }}" style="width: 20em" class="rounded">

                                        @error ('imagen') 
                                            <p class="bg-info">{{ $message }} </p>
                                        @enderror
                                    @endif
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Actualizar Perfil">
                        </div>
            </form>

        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js" integrity="sha512-/1nVu72YEESEbcmhE/EvjH/RxTg62EKvYWLG3NdeZibTCuEtW5M4z3aypcvsoZw03FAopi94y04GhuqRU9p+CQ==" crossorigin="anonymous" referrerpolicy="no-referrer" defer></script>
@endsection