@extends('menu')

@section('content')
<div class="col-lg-11 my-3 mx-auto p-3">
    <div class="text-center my-3">
        <h2>Consultas</h2>
        <h5>{{ $especialidad->especialidad }} - Dr. {{ $especialidad->doctor }}</h5>
        <pre><button type="button" class="btn btn-primary mt-4" data-bs-toggle="modal" data-bs-target="#agregarConsulta"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
        </svg>  Agregar Consulta</button></pre>
    </div>
    <div class="row row-cols-1 row-cols-md-3 g-4 mt-3">
        @if ($especialidad->consultas->count() > 0)
            @foreach ($consultas as $consulta)
                <div class="col">
                    <div class="card">
                        <h3 class="mt-4 mx-3">{{ $consulta->consulta }}</h3>
                        <h5 class="text-center mx-3 mt-3"><strong>Fecha: {{ date('d-m-Y', strtotime($consulta->fecha)) }}</strong></h5>
                        <div class="card-body">
                            <p class="card-text">{{ $consulta->descripcion }}</p>
                            <div>
                                <pre><button type="submit" class="btn btn-primary btn-sm" style="display: inline-block;" data-bs-toggle="modal" data-bs-target="#agregarControl{{ $consulta->id }}">Agregar Control  <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
                                </svg></button></pre>
                            </div>
                            @if ($consulta->controles->count() > 0)
                                @php $i = 1; @endphp
                                @foreach ($consulta->controles as $control)
                                    <div class="my-2 p-3" style="border-radius: 20px; border: 1px solid grey; display: flex; justify-content: space-between; align-items: center;">
                                        <div class="w-50" style="justify-content: center;">
                                            {{ $i++; }}. {{$control->control}}
                                        </div>
                                        <div style="align-items: center;">
                                            <a href="{{ route('detalle-control', [$control->consulta->especialidad->id, $control->consulta->id, $control->id]) }}">
                                                <button class="btn btn-primary btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                                    <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                                                </svg></button>
                                            </a>
                                            <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#editarControl{{ $control->id }}"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                                <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                            </svg></button>
                                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#eliminarControl{{ $control->id }}"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                            </svg></button>
                                        </div>
                                    </div>
                                    <!-- Modal Editar Control-->
                                    <div class="modal fade" id="editarControl{{ $control->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">Editar Control</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('actualizar-control', [$control->consulta->especialidad->id, $control->consulta->id, $control->id]) }}" method="POST" class="needs-validation" novalidate>
                                                    @method('PATCH')
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="recipient-name" class="col-form-label">Control:</label>
                                                            <input type="text" class="form-control" id="recipient-name" name="control" value="{{ $control->control }}" required>
                                                            <div class="invalid-feedback">El campo control es obligatorio.</div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="message-text" class="col-form-label">Descripción:</label>
                                                            <textarea class="form-control" id="message-text" name="descripcion" required>{{ $control->descripcion }}</textarea>
                                                            <div class="invalid-feedback">El campo descripción es obligatorio.</div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="recipient-name" class="col-form-label">Fecha:</label>
                                                            <input type="date" class="form-control" id="recipient-name" name="fecha" value="{{ $control->fecha }}" required>
                                                            <div class="invalid-feedback">El campo fecha es obligatorio.</div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                        <button type="submit" class="btn btn-primary">Actualizar</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Modal Eliminar Control-->
                                    <div class="modal fade" id="eliminarControl{{ $control->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">Eliminar Control</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>¿Está seguro que desea eliminar el <strong>control {{ $control->control }}</strong>?</p>
                                                    <p style="font-size: 13px"><strong><em>Se eliminarán los datos asociados a este control.</em></strong></p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                    <form action="{{ route('eliminar-control', [$control->consulta->especialidad->id, $control->consulta->id, $control->id]) }}" method="POST">
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
                                <p class="h6 text-center"><strong>Aún no se ha agregado controles.</strong></p>
                            @endif
                        </div>
                        <div class="card-footer text-center">
                            <button type="button" class="btn btn-primary my-1" data-bs-toggle="modal" data-bs-target="#editarConsulta{{ $consulta->id }}">Editar</button>
                            <button type="button" class="btn btn-danger my-1" data-bs-toggle="modal" data-bs-target="#eliminarConsulta{{ $consulta->id }}">Eliminar</button>
                        </div>
                    </div>
                </div>
                <!-- Modal Eliminar Consulta-->
                <div class="modal fade" id="eliminarConsulta{{ $consulta->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Eliminar Consulta</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>¿Está seguro que desea eliminar la <strong>consulta {{ $consulta->consulta }}</strong>?</p>
                                <p style="font-size: 13px"><strong><em>Tambien se eliminaran los controles asociados a esta consulta.</em></strong></p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <form action="{{ route('eliminar-consulta', [$consulta->especialidad->id, $consulta->id]) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal Editar Consulta-->
                <div class="modal fade" id="editarConsulta{{ $consulta->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Editar Consulta</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{ route('actualizar-consulta', [$consulta->especialidad->id, $consulta->id]) }}" method="POST" class="needs-validation" novalidate>
                                @method('PATCH')
                                @csrf
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="recipient-name" class="col-form-label">Consulta:</label>
                                        <input type="text" class="form-control" id="recipient-name" name="consulta" value="{{ $consulta->consulta }}" required>
                                        <div class="invalid-feedback">El campo consulta es obligatorio.</div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="message-text" class="col-form-label">Descripción:</label>
                                        <textarea class="form-control" id="message-text" name="descripcion" required>{{ $consulta->descripcion }}</textarea>
                                        <div class="invalid-feedback">El campo descripción es obligatorio.</div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="recipient-name" class="col-form-label">Fecha:</label>
                                        <input type="date" class="form-control" id="recipient-name" name="fecha" value="{{ $consulta->fecha }}" required>
                                        <div class="invalid-feedback">El campo fecha es obligatorio.</div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-primary">Actualizar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Modal Agregar Control-->
                <div class="modal fade" id="agregarControl{{ $consulta->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Datos del Control</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{ route('agregar-control', [$consulta->especialidad->id, $consulta->id]) }}" method="POST" class="needs-validation" novalidate>
                                @csrf
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="recipient-name" class="col-form-label">Control:</label>
                                        <input type="text" class="form-control" id="recipient-name" name="control" required>
                                        <div class="invalid-feedback">El campo control es obligatorio.</div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="message-text" class="col-form-label">Descripción:</label>
                                        <textarea class="form-control" id="message-text" name="descripcion" required></textarea>
                                        <div class="invalid-feedback">El campo descripción es obligatorio.</div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="recipient-name" class="col-form-label">Fecha:</label>
                                        <input type="date" class="form-control" id="recipient-name" name="fecha" required>
                                        <div class="invalid-feedback">El campo fecha es obligatorio.</div>
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
            @endforeach
        @else
    </div>
            <p class="h5 text-center my-5"><strong>Aún no se ha agregado consultas.</strong></p>
        @endif
</div>
<!-- Modal Agregar Consulta-->
<div class="modal fade" id="agregarConsulta" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Datos de Consulta</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('agregar-consulta', [$especialidad->id]) }}" method="POST" class="needs-validation" novalidate>
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Consulta:</label>
                        <input type="text" class="form-control" id="recipient-name" name="consulta" required>
                        <div class="invalid-feedback">El campo consulta es obligatorio.</div>
                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">Descripción:</label>
                        <textarea class="form-control" id="message-text" name="descripcion" required></textarea>
                        <div class="invalid-feedback">El campo descripción es obligatorio.</div>
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Fecha:</label>
                        <input type="date" class="form-control" id="recipient-name" name="fecha" required>
                        <div class="invalid-feedback">El campo fecha es obligatorio.</div>
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
<!--SweetAlert2 Mensaje Agregar Consulta-->
@if (session('agregarConsulta') == 'true')
<script>
    Swal.fire(
        '¡Agregado!',
        'La consulta se ha agregado correctamente.',
        'success'
    )
</script>
@endif
@if (session('agregarConsulta') == 'false')
<script>
    Swal.fire(
        '¡Error!',
        'No se ha podido agregar la consulta correctamente.',
        'error'
    )
</script>
@endif
<!--SweetAlert2 Mensaje Eliminar Consulta-->
@if (session('eliminarConsulta') == 'true')
<script>
    Swal.fire(
        '¡Eliminado!',
        'La consulta se ha eliminado correctamente.',
        'success'
    )
</script>
@endif
@if (session('eliminarConsulta') == 'false')
<script>
    Swal.fire(
        '¡Error!',
        'No se ha podido eliminar la consulta correctamente.',
        'error'
    )
</script>
@endif
<!--SweetAlert2 Mensaje Actualizar Consulta-->
@if (session('actualizarConsulta') == 'true')
<script>
    Swal.fire(
        '¡Actualizado!',
        'La consulta se ha actualizado correctamente.',
        'success'
    )
</script>
@endif
@if (session('actualizarConsulta') == 'false')
<script>
    Swal.fire(
        '¡Error!',
        'No se ha podido actualizar la consulta correctamente.',
        'error'
    )
</script>
@endif
<!--SweetAlert2 Mensaje Agregar Control-->
@if (session('agregarControl') == 'true')
<script>
    Swal.fire(
        '¡Agregado!',
        'El control se ha agregado correctamente.',
        'success'
    )
</script>
@endif
@if (session('agregarControl') == 'false')
<script>
    Swal.fire(
        '¡Error!',
        'No se ha podido agregar el control correctamente.',
        'error'
    )
</script>
@endif
<!--SweetAlert2 Mensaje Eliminar Control-->
@if (session('eliminarControl') == 'true')
<script>
    Swal.fire(
        '¡Eliminado!',
        'El control se ha eliminado correctamente.',
        'success'
    )
</script>
@endif
@if (session('eliminarControl') == 'false')
<script>
    Swal.fire(
        '¡Error!',
        'No se ha podido eliminar el control correctamente.',
        'error'
    )
</script>
@endif
<!--SweetAlert2 Mensaje Actualizar Control-->
@if (session('actualizarControl') == 'true')
<script>
    Swal.fire(
        '¡Actualizado!',
        'El control se ha actualizado correctamente.',
        'success'
    )
</script>
@endif
@if (session('actualizarControl') == 'false')
<script>
    Swal.fire(
        '¡Error!',
        'No se ha podido actualizar el control correctamente.',
        'error'
    )
</script>
@endif
@endsection