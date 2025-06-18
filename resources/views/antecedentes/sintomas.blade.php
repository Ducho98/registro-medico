@extends('menu')

@section('content')
<div class="col-lg-11 my-4 mx-auto">
    <div class="text-center">
        <h2>Antecedente - Síntomas</h2>
        <pre><button type="button" class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#agregarSintoma"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
        </svg>  Agregar Síntoma</button></pre>
    </div>
</div>
<div class="col-lg-3 mx-auto">
    <ol class="list-group list-group-numbered p-4  m-1">
        @if ($antecedenteSintomas->count() > 0)
            @foreach ($antecedenteSintomas as $antecedenteSintoma)
            <li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <div><strong>Descripción:</strong> {{ $antecedenteSintoma->descripcion }}</div>
                    <strong>Fecha:</strong> {{ date('d-m-Y', strtotime($antecedenteSintoma->fecha_hora)) }}<br>
                    <strong>Hora:</strong> {{ date('H:i:s', strtotime($antecedenteSintoma->fecha_hora)) }}
                </div>
                <button data-bs-toggle="modal" data-bs-target="#eliminarSintoma{{ $antecedenteSintoma->id }}" class="btn position-absolute top-50 start-100 translate-middle badge rounded-pill bg-danger">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                        <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                    </svg>
                </button>
            </li>
            <!-- Modal Eliminar Sintoma-->
            <div class="modal fade" id="eliminarSintoma{{ $antecedenteSintoma->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Eliminar Síntoma</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>¿Está seguro que desea eliminar el <strong>síntoma {{ $antecedenteSintoma->descripcion }}</strong>?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <form action="{{ route('eliminar-antecedente-sintoma', [$antecedenteSintoma->id]) }}" method="POST">
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
            <p class="h6 text-center"><strong>Aún no se ha agregado síntomas.</strong></p>
        @endif
    </ol>
</div>
<!-- Modal Agregar Sintoma-->
<div class="modal fade" id="agregarSintoma" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Datos de Síntoma</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('agregar-antecedente-sintoma') }}" method="POST" class="needs-validation" novalidate>
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">Descripción:</label>
                        <textarea class="form-control" style="height: 150px" id="message-text" name="descripcion" required></textarea>
                        <div class="invalid-feedback">El campo descripción es obligatorio.</div>
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
<!--SweetAlert2 Mensaje Agregar Sintoma-->
@if (session('agregarAntecedenteSintoma') == 'true')
<script>
    Swal.fire(
        '¡Agregado!',
        'El síntoma se ha agregado correctamente.',
        'success'
    )
</script>
@endif
@if (session('agregarAntecedenteSintoma') == 'false')
<script>
    Swal.fire(
        '¡Error!',
        'No se ha podido agregar el síntoma correctamente.',
        'error'
    )
</script>
@endif
<!--SweetAlert2 Mensaje Eliminar Sintoma-->
@if (session('eliminarAntecedenteSintoma') == 'true')
<script>
    Swal.fire(
        '¡Eliminado!',
        'El síntoma se ha eliminado correctamente.',
        'success'
    )
</script>
@endif
@if (session('eliminarAntecedenteSintoma') == 'false')
<script>
    Swal.fire(
        '¡Error!',
        'No se ha podido eliminar el síntoma correctamente.',
        'error'
    )
</script>
@endif
@endsection