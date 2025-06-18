@extends('menu')

@section('content')
<div class="col-lg-3 my-3 mx-auto p-4">
    <h1 class="text-center">Antecedentes</h1>
    <div class="d-grid gap-2 mt-3 p-3">
        <a href="{{ route('ver-pesos') }}" class="btn btn-primary btn-lg my-2" type="button">PESO</a>
        <a href="{{ route('ver-antecedente-sintomas') }}" class="btn btn-primary btn-lg my-2" type="button">SÍNTOMAS</a>
        <a href="{{ route('ver-analisis') }}" class="btn btn-primary btn-lg my-2" type="button">ANÁLISIS</a>
        <a href="{{ route('ver-tratamientos') }}" class="btn btn-primary btn-lg my-2" type="button">TRATAMIENTOS</a>
        <a href="" class="btn btn-primary btn-lg my-2" type="button">RECETAS</a>
    </div>
</div>
@endsection