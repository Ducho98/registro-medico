@extends('menu')

@section('content')
<div class="col-lg-11 my-3 mx-auto p-4">
    <h1 class="text-center">Especialidades</h1>
    <div class="row row-cols-1 row-cols-md-3 g-4 mt-3">
        @if ($especialidades->count() > 0)
            @foreach ($especialidades as $especialidad)
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="mt-2">Especialidad: {{ $especialidad->especialidad }}</h3>
                        </div>
                        <h3 class="text-center mx-3 mt-3"><strong>Doctor {{ $especialidad->doctor }}</strong></h3>
                        <h5 class="mt-3 mx-3">Cantidad de Consultas: {{ $especialidad->consultas->count() }}</h5>
                        <div class="card-body">
                            <p class="card-text">{{ $especialidad->descripcion }}</p>
                        </div>
                        <div class="card-footer text-center">
                            <a href="{{ route('ver-consultas', [$especialidad->id]) }}" class="btn btn-primary my-1">Ver consultas</a>
                            <a href="{{ route('editar-especialidad', [$especialidad->id]) }}" class="btn btn-info my-1">Editar</a>
                            <button type="button" class="btn btn-danger my-1" data-bs-toggle="modal" data-bs-target="#eliminarEspecialidad{{ $especialidad->id }}">Eliminar</button>
                        </div>
                    </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="eliminarEspecialidad{{ $especialidad->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Especialidad {{ $especialidad->especialidad }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>¿Está seguro que desea eliminar la <strong>especialidad de {{ $especialidad->especialidad }}</strong>?</p>
                                <p style="font-size: 13px"><strong><em>Tambien se eliminaran las consultas asociadas a esta especialidad.</em></strong></p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <form action="{{ route('eliminar-especialidad', [$especialidad->id]) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
    </div>
            <p class="h5 text-center my-5"><strong>Aún no se ha agregado especialidades.</strong></p>
        @endif
</div>
@if (session('eliminarEspecialidad') == 'true')
<script>
    Swal.fire(
        '¡Eliminado!',
        'La especialidad se ha eliminado correctamente.',
        'success'
    )
</script>
@endif
@if (session('eliminarEspecialidad') == 'false')
<script>
    Swal.fire(
        '¡Error!',
        'No se ha podido eliminar la especialidad correctamente.',
        'error'
    )
</script>
@endif
@endsection