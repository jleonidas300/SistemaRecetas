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
                                            {{ Str::words(strip_tags ($receta->preparacion), 20, '...') }}
                                            <a href="{{ route('recetas.show', ['receta' => $receta->id ]) }}" class="btn btn-info">Ver más</a>
                                    </p>
                                </div>

                            </div>

                        </div>
