@extends('menu')

@section('content')
<div class="col-lg-11 my-4 mx-auto">
    <div class="text-center">
        <h2>Peso</h2>
        <pre><button type="button" class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#agregarPeso"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
        </svg>  Agregar Peso</button></pre>
    </div>
</div>
<div class="col-lg-3 mx-auto">
    <ol class="list-group list-group-numbered p-4  m-1">
        @if ($pesos->count() > 0)
            @foreach ($pesos as $peso)
            <li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <div class="fw-bold">Peso: {{ $peso->peso }} kg</div>
                    <strong>Fecha:</strong> {{ date('d-m-Y', strtotime($peso->fecha_hora)) }}<br>
                    <strong>Hora:</strong> {{ date('H:i:s', strtotime($peso->fecha_hora)) }}
                </div>
                <button data-bs-toggle="modal" data-bs-target="#eliminarPeso{{ $peso->id }}" class="btn position-absolute top-50 start-100 translate-middle badge rounded-pill bg-danger">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                        <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                    </svg>
                </button>
            </li>
            <!-- Modal Eliminar Peso-->
            <div class="modal fade" id="eliminarPeso{{ $peso->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Eliminar Peso</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>¿Está seguro que desea eliminar el <strong>peso {{ $peso->peso }} kg</strong>?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <form action="{{ route('eliminar-peso', [$peso->id]) }}" method="POST">
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
            <p class="h6 text-center"><strong>Aún no se ha agregado pesos.</strong></p>
        @endif
    </ol>
</div>
<!-- Modal Agregar Peso-->
<div class="modal fade" id="agregarPeso" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Datos de Peso</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('agregar-peso') }}" method="POST" class="needs-validation" novalidate>
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">Peso:</label>
                        <input type="number" class="form-control" id="message-text" name="peso" step="0.01" required>
                        <div class="invalid-feedback">El campo peso es obligatorio.</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Agregar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--SweetAlert2 Mensaje Agregar Peso-->
@if (session('agregarPeso') == 'true')
<script>
    Swal.fire(
        '¡Agregado!',
        'El peso se ha agregado correctamente.',
        'success'
    )
</script>
@endif
@if (session('agregarPeso') == 'false')
<script>
    Swal.fire(
        '¡Error!',
        'No se ha podido agregar el peso correctamente.',
        'error'
    )
</script>
@endif
<!--SweetAlert2 Mensaje Eliminar Peso-->
@if (session('eliminarPeso') == 'true')
<script>
    Swal.fire(
        '¡Eliminado!',
        'El peso se ha eliminado correctamente.',
        'success'
    )
</script>
@endif
@if (session('eliminarPeso') == 'false')
<script>
    Swal.fire(
        '¡Error!',
        'No se ha podido eliminar el peso correctamente.',
        'error'
    )
</script>
@endif
@endsection