@extends('menu')

@section('content')
<div class="col-lg-3 mb-3 mx-auto p-5">
    <form action="{{ route('agregar-especialidad') }}" method="POST">
        @csrf
        <h1 class="my-3 text-center">Especialidad</h1>
        @if (session('exito'))
            <h6 class="alert alert-success">{{ session('exito')}}</h6>
        @endif
        @if (session('error'))
            <h6 class="alert alert-danger">{{ session('error')}}</h6>
        @endif
        <div class="form-floating mt-4">
            <input type="text" class="form-control" name="doctor" id="doctor" placeholder="doctor" value="{{ old('doctor') }}">
            <label for="doctor">Doctor</label>
        </div>
        @error('doctor')
            <span class="text-danger">{{ $message }}</span>
        @enderror
        <div class="form-floating mt-4">
            <input type="text" class="form-control" name="especialidad" id="especialidad" placeholder="especialidad" value="{{ old('especialidad') }}">
            <label for="especialidad">Especialidad</label>
        </div>
        @error('especialidad')
            <span class="text-danger">{{ $message }}</span>
        @enderror
        <div class="form-floating mt-4">
            <textarea type="text" style="height: 150px" class="form-control" name="descripcion" id="descripcion" placeholder="descripcion">{{ old('descripcion') }}</textarea>
            <label for="descripcion">Descripción</label>
        </div>
        @error('descripcion')
            <span class="text-danger">{{ $message }}</span>
        @enderror
        <div class="form-floating mt-4 text-center">
            <button type="submit" class="btn btn-primary">Guardar especialidad</button>
        </div>
    </form>
</div>
@endsection