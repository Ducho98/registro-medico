@extends('app')

@section('content')
<div class="row mt-5 mx-3">
    <div class="col-lg-3 mb-3 mx-auto p-4" style="border-style: solid; border-radius: 10px; border-bottom-left-radius: 50px; border-top-right-radius: 50px">
        <form action="{{ route('registro') }}" method="POST">
            @csrf
            <h1 class="my-3 text-center">Crear Cuenta</h1>
            @if (session('exito'))
                <h6 class="alert alert-success">{{ session('exito')}}</h6>
            @endif
            @if (session('error'))
                <h6 class="alert alert-danger">{{ session('error')}}</h6>
            @endif
            <div class="form-floating mt-4">
                <input type="text" class="form-control" name="nombres" id="nombres" placeholder="nombres" value="{{ old('nombres') }}">
                <label for="nombres">Nombres</label>
            </div>
            @error('nombres')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <div class="form-floating mt-4">
                <input type="text" class="form-control" name="apellidos" id="apellidos" placeholder="apellidos" value="{{ old('apellidos') }}">
                <label for="apellidos">Apellidos</label>
            </div>
            @error('apellidos')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <div class="form-floating mt-4">
                <input type="text" class="form-control" name="usuario" id="usuario" placeholder="usuario" value="{{ old('usuario') }}">
                <label for="usuario">Usuario</label>
            </div>
            @error('usuario')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <div class="form-floating mt-4">
                <select class="form-select" aria-label="Default select example" name="sexo">
                    <option value="" disabled selected>Seleccione su sexo...</option>
                    <option value="masculino" {{ old('sexo') == 'masculino' ? 'selected' : '' }}>Masculino</option>
                    <option value="femenino" {{ old('sexo') == 'femenino' ? 'selected' : '' }}>Femenino</option>
                </select>
                <label for="message-text" class="col-form-label">Sexo:</label>
            </div>
            @error('sexo')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <div class="form-floating mt-4">
                <input type="date" class="form-control" name="fechaNacimiento" id="fechaNacimiento" placeholder="fechaNacimiento" value="{{ old('fechaNacimiento') }}">
                <label for="fechaNacimiento">Fecha de Nacimiento</label>
            </div>
            @error('fechaNacimiento')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <div class="form-floating mt-4">
                <input type="password" class="form-control" name="clave" id="clave" placeholder="clave" value="{{ old('clave') }}">
                <label for="clave">Contraseña</label>
            </div>
            @error('clave')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <div class="form-floating mt-4">
                <input type="password" class="form-control" name="repetirClave" id="repetirClave" placeholder="repetirClave">
                <label for="repetirClave">Repetir Contraseña</label>
            </div>
            @error('repetirClave')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <div class="form-floating mt-4 text-center">
                <button type="submit" class="btn btn-primary">Crear</button>
            </div>
            <div class="text-center py-4">
                <div class="small"><a href="{{ url('/') }}">¿Ya tienes una cuenta? Ingresa aquí</a></div>
            </div>
        </form>
    </div>
</div>
@endsection