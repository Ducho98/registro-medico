@extends('menu')

@section('content')
<p class="h2 text-center my-4">Análisis</p>
<div class="container">
    @if ($analisis->count() > 0)
        @php $i = 1; @endphp
        @foreach ($analisis as $analisis)
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <h4><strong>{{ $i++ }}. Analisis</strong></h4>
                            <h6 class="card-title">{{ $analisis->analisis }}</h6>
                            <p class="card-text">
                                @if ($analisis->archivo != null)
                                    <div class="text-center my-3">
                                        <a data-fancybox="image" href="{{ asset('storage') . '/' . $analisis->archivo }}" class="btn btn-light" style="border-radius: 8px; border: 2px solid black;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-image-fill" viewBox="0 0 16 16">
                                                <path d="M.002 3a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-12a2 2 0 0 1-2-2V3zm1 9v1a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V9.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12zm5-6.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0z"/>
                                            </svg>
                                        </a>
                                    </div>
                                @else
                                    <p class="h6 text-center my-4"><strong>No contiene imagen.</strong></p>
                                @endif
                                <div class="text-center">
                                    Toma de muestra: {{ $analisis->toma_muestra != null ? date('d-m-Y', strtotime($analisis->toma_muestra)) : '----------' }}<br>
                                    Fecha de entrega: {{ $analisis->entrega != null ? date('d-m-Y', strtotime($analisis->entrega)) : '----------' }}
                                </div>
                            </p>
                        </div>
                    </div>
                </div>
        @endforeach
    @else
        <p class="h6 text-center my-5"><strong>No hay ningún análisis agregado.</strong></p>
    @endif
            </div>
</div>
@endsection