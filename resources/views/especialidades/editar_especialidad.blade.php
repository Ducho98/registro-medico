@extends('menu')

@section('content')
<div class="row">
    <div class="col-lg-3 mb-3 mx-auto p-4">
        <form action="{{ route('actualizar-especialidad', ['id' => $especialidad->id]) }}" method="POST">
            @method('PATCH')
            @csrf
            <h1 class="my-3 text-center">Editar Especialidad</h1>
            @if (session('exito'))
                <h6 class="alert alert-success">{{ session('exito')}}</h6>
            @endif
            @if (session('error'))
                <h6 class="alert alert-danger">{{ session('error')}}</h6>
            @endif
            <div class="form-floating mt-4">
                <input type="text" class="form-control" name="doctor" id="doctor" placeholder="doctor" value="{{ $especialidad->doctor }}">
                <label for="doctor">Doctor</label>
            </div>
            @error('doctor')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <div class="form-floating mt-4">
                <input type="text" class="form-control" name="especialidad" id="especialidad" placeholder="especialidad" value="{{ $especialidad->especialidad }}">
                <label for="especialidad">Especialidad</label>
            </div>
            @error('especialidad')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <div class="form-floating mt-4">
                <textarea type="text" style="height: 150px" class="form-control" name="descripcion" id="descripcion" placeholder="descripcion">{{ $especialidad->descripcion }}</textarea>
                <label for="descripcion">Descripción</label>
            </div>
            @error('descripcion')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <div class="d-flex justify-content-center mt-3">
                <div class="row d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary m-1">Actualizar especialidad</button>
                    <a class="btn btn-secondary m-1 mt-2" href="{{ route('ver-especialidades') }}" role="button">Regresar</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection