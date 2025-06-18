@extends('app')

@section('content')
<div class="row">
    <div class="col-lg-3 mb-3 mx-auto p-4">
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <h1 class="my-3 text-center">Login</h1>
            @if (session('sesion'))
                <h6 class="alert alert-danger">{{ session('sesion')}}</h6>
            @endif
            @if (session('error'))
                <h6 class="alert alert-danger">{{ session('error')}}</h6>
            @endif
            <div class="form-floating mt-4">
                <input type="text" class="form-control" name="usuario" id="usuario" placeholder="usuario">
                <label for="usuario">Usuario</label>
            </div>
            @error('usuario')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <div class="form-floating mt-4">
                <input type="password" class="form-control" name="clave" id="clave" placeholder="clave">
                <label for="clave">Contraseña</label>
            </div>
            @error('clave')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <div class="form-floating mt-4 text-center">
                <button type="submit" class="btn btn-primary">Ingresar</button>
            </div>
        </form>
    </div>
</div>
@endsection