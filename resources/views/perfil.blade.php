@extends('menu')

@section('content')
<div class="row">
    <div class="col-lg-3 mb-3 mx-auto p-4">
        <h1 class="my-3 text-center">Mi Perfil</h1>
        <form action="{{ route('actualizar-perfil') }}" method="POST" class="needs-validation" novalidate>
            @method('PATCH')
            @csrf
            <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Nombres:</label>
                <input type="text" class="form-control" id="recipient-name" name="nombres" value="{{ $datosUsuario->nombres }}" required>
                <div class="invalid-feedback">El campo nombres es obligatorio.</div>
            </div>
            <div class="mb-3">
                <label for="message-text" class="col-form-label">Apellidos:</label>
                <input type="text" class="form-control" id="message-text" name="apellidos" value="{{ $datosUsuario->apellidos }}" required>
                <div class="invalid-feedback">El campo apellidos es obligatorio.</div>
            </div>
            <div class="mb-3">
                <label for="message-text" class="col-form-label">Usuario:</label>
                <input type="text" class="form-control" id="message-text" name="usuario" value="{{ $datosUsuario->usuario }}" required>
                <div class="invalid-feedback">El campo usuario es obligatorio.</div>
            </div>
            <div class="mb-3">
                <label for="message-text" class="col-form-label">Sexo:</label>
                <select class="form-select" aria-label="Default select example" name="sexo" required>
                    <option value="" disabled selected>Seleccione su sexo...</option>
                    <option value="masculino" {{ $datosUsuario->sexo == 'masculino' ? 'selected' : '' }}>Masculino</option>
                    <option value="femenino" {{ $datosUsuario->sexo == 'femenino' ? 'selected' : '' }}>Femenino</option>
                </select>
                <div class="invalid-feedback">El campo sexo es obligatorio.</div>
            </div>
            <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Fecha de Nacimiento:</label>
                <input type="date" class="form-control" id="recipient-name" name="fechaNacimiento" value="{{ $datosUsuario->fecha_nacimiento }}" required>
                <div class="invalid-feedback">El campo fecha de nacimiento es obligatorio.</div>
            </div>
            <div class="mt-4 text-center">
                <button type="submit" class="btn btn-primary">Actualizar</button>
            </div>
        </form>
    </div>
</div>
<!--SweetAlert2 Mensaje Actualizar Consulta-->
@if (session('actualizarPerfil') == 'true')
<script>
    Swal.fire(
        '¡Actualizado!',
        'Perfil actualizado correctamente.',
        'success'
    )
</script>
@endif
@if (session('actualizarPerfil') == 'false')
<script>
    Swal.fire(
        '¡Error!',
        'No se pudo actualizar el perfil correctamente.',
        'error'
    )
</script>
@endif
@endsection