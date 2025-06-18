@extends('menu')

@section('content')
<p class="h2 text-center my-4">Tratamientos</p>
<div class="container">
    @if ($tratamientos->count() > 0)
        @php $i = 1; @endphp
        @foreach ($tratamientos as $tratamiento)
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <h4><strong>{{ $i++ }}. Tratamiento</strong></h4>
                            <h6 class="card-title">{{ $tratamiento->tratamiento }}</h6>
                            <p class="card-text">
                                <div class="text-center">
                                    Toma de muestra: {{ $tratamiento->fecha_inicio != null ? date('d-m-Y', strtotime($tratamiento->fecha_inicio)) : '----------' }}<br>
                                    Fecha de entrega: {{ $tratamiento->fecha_fin != null ? date('d-m-Y', strtotime($tratamiento->fecha_fin)) : '----------' }}
                                </div>
                                <div class="text-center mt-3">
                                    <strong>Datos de interés:</strong> {{ $tratamiento->dato_interes }}.
                                </div>
                            </p>
                        </div>
                    </div>
                </div>
        @endforeach
    @else
        <p class="h6 text-center my-5"><strong>No hay ningún tratamiento agregado.</strong></p>
    @endif
            </div>
</div>
@endsection