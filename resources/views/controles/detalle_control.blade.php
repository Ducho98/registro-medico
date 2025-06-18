@extends('menu')

@section('content')
<p class="h2 text-center my-4">Detalle Control {{ $control->control }}</p>
<p class="h5 text-center">Descripción: {{ $control->descripcion }}</p>
<p class="h5 text-center mb-4">Fecha: {{ date('d-m-Y', strtotime($control->fecha)) }}</p>
<div class="container">
    <div class="row">
        <div class="col-sm-6 my-3">
            <div class="card">
                <div class="card-header h5">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        Síntomas
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#agregarSintoma"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
                        </svg></button>
                    </div>
                </div>
                <div class="card-body">
                    <p class="card-text">
                        @if ($control->sintomas->count() > 0)
                            @php $i = 1; @endphp
                            @foreach ($control->sintomas as $sintoma)
                                <div class="my-2 p-3" style="border-radius: 20px; border: 1px solid grey; display: flex; justify-content: space-between; align-items: center;">
                                    <div style="justify-content: center; width: 80%;">
                                        {{$i++}}. {{$sintoma->sintoma}}
                                    </div>
                                    <div style="align-items: center; justify-content: center; display: flex;">
                                        <div class="m-1">
                                            <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#editarSintoma{{ $sintoma->id }}"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                                <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                            </svg></button>
                                        </div>
                                        <div class="m-1">
                                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#eliminarSintoma{{ $sintoma->id }}"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                            <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                            </svg></button>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal Editar Sintoma-->
                                <div class="modal fade" id="editarSintoma{{ $sintoma->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Editar Síntoma</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('actualizar-sintoma', [$sintoma->control->consulta->especialidad->id, $sintoma->control->consulta->id, $sintoma->control->id, $sintoma->id]) }}" method="POST" class="needs-validation" novalidate>
                                                @method('PATCH')
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="message-text" class="col-form-label">Síntoma:</label>
                                                        <textarea class="form-control" style="height: 150px" id="message-text" name="sintoma" required>{{ $sintoma->sintoma }}</textarea>
                                                        <div class="invalid-feedback">El campo síntoma es obligatorio.</div>
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
                                <!-- Modal Eliminar Sintoma-->
                                <div class="modal fade" id="eliminarSintoma{{ $sintoma->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Eliminar Síntoma</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>¿Está seguro que desea eliminar el <strong>síntoma {{ $sintoma->sintoma }}</strong>?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                <form action="{{ route('eliminar-sintoma', [$sintoma->control->consulta->especialidad->id, $sintoma->control->consulta->id, $sintoma->control->id, $sintoma->id]) }}" method="POST">
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
                    </p>
                </div>
            </div>
        </div>
        <div class="col-sm-6 my-3">
            <div class="card">
                <div class="card-header h5">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        Diagnóstico
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#agregarDiagnostico"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
                        </svg></button>
                    </div>
                </div>
                <div class="card-body">
                    <p class="card-text">
                        @if ($control->diagnosticos->count() > 0)
                            @php $i = 1; @endphp
                            @foreach ($control->diagnosticos as $diagnostico)
                                <div class="my-2 p-3" style="border-radius: 20px; border: 1px solid grey; display: flex; justify-content: space-between; align-items: center;">
                                    <div style="justify-content: center; width: 80%;">
                                        {{$i++}}. {{$diagnostico->diagnostico}}
                                    </div>
                                    <div style="align-items: center; justify-content: center; display: flex;">
                                        <div class="m-1">
                                            <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#editarDiagnostico{{ $diagnostico->id }}"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                                <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                            </svg></button>
                                        </div>
                                        <div class="m-1">
                                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#eliminarDiagnostico{{ $diagnostico->id }}"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                            <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                            </svg></button>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal Editar Diagnostico-->
                                <div class="modal fade" id="editarDiagnostico{{ $diagnostico->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Editar Diagnóstico</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('actualizar-diagnostico', [$diagnostico->control->consulta->especialidad->id, $diagnostico->control->consulta->id, $diagnostico->control->id, $diagnostico->id]) }}" method="POST" class="needs-validation" novalidate>
                                                @method('PATCH')
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="message-text" class="col-form-label">Diagnóstico:</label>
                                                        <textarea class="form-control" style="height: 150px" id="message-text" name="diagnostico" required>{{ $diagnostico->diagnostico }}</textarea>
                                                        <div class="invalid-feedback">El campo diagnóstico es obligatorio.</div>
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
                                <!-- Modal Eliminar Diagnostico-->
                                <div class="modal fade" id="eliminarDiagnostico{{ $diagnostico->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Eliminar Diagnóstico</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>¿Está seguro que desea eliminar el <strong>diagnóstico {{ $diagnostico->diagnostico }}</strong>?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                <form action="{{ route('eliminar-diagnostico', [$diagnostico->control->consulta->especialidad->id, $diagnostico->control->consulta->id, $diagnostico->control->id, $diagnostico->id]) }}" method="POST">
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
                            <p class="h6 text-center"><strong>Aún no se ha agregado diagnósticos.</strong></p>
                        @endif
                    </p>
                </div>
            </div>
        </div>
        <div class="col-sm-6 my-3">
            <div class="card">
                <div class="card-header h5">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        Análisis
                        <div>
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#agregarAnalisisAmbos"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
                            </svg></button>
                            <!--<button style="border-radius: 8px; border: 2px solid black;" class="btn btn-light"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-image-fill" viewBox="0 0 16 16">
                                <path d="M.002 3a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-12a2 2 0 0 1-2-2V3zm1 9v1a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V9.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12zm5-6.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0z"/>
                            </svg></button>-->
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <p class="card-text">
                        @if ($control->analisis->count() > 0)
                            @php $i = 1; @endphp
                            @foreach ($control->analisis as $unAnalisis)
                                <div class="card my-3">
                                    <div class="card-body">
                                        <h6 class="card-title">{{$i++}}. {{ $unAnalisis->analisis != null ? $unAnalisis->analisis : '----------' }}<br></h6>
                                        <p class="card-text">
                                            @if ($unAnalisis->archivo != null)
                                                <div class="text-center my-3">
                                                    <a data-fancybox="image" href="{{ asset('storage') . '/' . $unAnalisis->archivo }}" class="btn btn-light" style="border-radius: 8px; border: 2px solid black;">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-image-fill" viewBox="0 0 16 16">
                                                            <path d="M.002 3a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-12a2 2 0 0 1-2-2V3zm1 9v1a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V9.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12zm5-6.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0z"/>
                                                        </svg>
                                                    </a>
                                                </div>
                                            @else
                                                <p class="h6 text-center"><strong>No contiene imagen.</strong></p>
                                            @endif
                                            <div class="text-center">
                                                Toma de muestra: {{ $unAnalisis->toma_muestra != null ? date('d-m-Y', strtotime($unAnalisis->toma_muestra)) : '----------' }}<br>
                                                Fecha de entrega: {{ $unAnalisis->entrega != null ? date('d-m-Y', strtotime($unAnalisis->entrega)) : '----------' }}
                                            </div>
                                        </p>
                                    </div>
                                    <div class="card-footer">
                                        <div class="text-center">
                                            <button data-bs-toggle="modal" data-bs-target="#editarAnalisis{{ $unAnalisis->id }}" class="btn btn-primary">Editar</button>
                                            <button data-bs-toggle="modal" data-bs-target="#eliminarAnalisis{{ $unAnalisis->id }}" class="btn btn-danger">Eliminar</button>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal Editar Analisis Texto e Imagen-->
                                <div class="modal fade" id="editarAnalisis{{ $unAnalisis->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Datos de Análisis</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('actualizar-analisis', [$unAnalisis->control->consulta->especialidad->id, $unAnalisis->control->consulta->id, $unAnalisis->control->id, $unAnalisis->id]) }}" method="POST" {{--class="needs-validation" novalidate novalidate--}} enctype="multipart/form-data">
                                                @method('PATCH')
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <div class="mb-3">
                                                            <label for="message-text" class="col-form-label">Análisis:</label>
                                                            <textarea class="form-control" style="height: 150px" id="message-text" name="analisis">{{ $unAnalisis->analisis }}</textarea>
                                                            <!--<div class="invalid-feedback">El campo análisis es obligatorio.</div>-->
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="recipient-name" class="col-form-label">Toma de muestra:</label>
                                                            <input type="date" class="form-control" id="recipient-name" name="tomaMuestra" value="{{ $unAnalisis->toma_muestra }}">
                                                            <!--<div class="invalid-feedback">El campo toma de muestra es obligatorio.</div>-->
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="recipient-name" class="col-form-label">Entrega:</label>
                                                            <input type="date" class="form-control" id="recipient-name" name="entrega" value="{{ $unAnalisis->entrega }}">
                                                            <!--<div class="invalid-feedback">El campo entrega es obligatorio.</div>-->
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="formFile" class="form-label">Archivo:</label>
                                                            <input class="form-control" type="file" id="formFile" name="archivo">
                                                            <!--<div class="invalid-feedback">El campo archivo es obligatorio.</div>-->
                                                        </div>
                                                        @if ($unAnalisis->archivo != null)
                                                            <div class="text-center">
                                                                Imagen Actual:
                                                                <img src="{{ asset('storage') . '/' . $unAnalisis->archivo }}" width="50%" height="50%" alt="imagen"/>
                                                                {{--<a data-fancybox="image" href="{{ asset('storage') . '/' . $unAnalisis->archivo }}" class="btn btn-light" style="border-radius: 8px; border: 2px solid black;">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-image-fill" viewBox="0 0 16 16">
                                                                        <path d="M.002 3a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-12a2 2 0 0 1-2-2V3zm1 9v1a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V9.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12zm5-6.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0z"/>
                                                                    </svg>
                                                                </a>--}}
                                                            </div>
                                                        @else
                                                            <p class="h6 text-center"><strong>No contiene una imagen.</strong></p>
                                                        @endif
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
                                <!-- Modal Eliminar Analisis-->
                                <div class="modal fade" id="eliminarAnalisis{{ $unAnalisis->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Eliminar Análisis</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>¿Está seguro que desea eliminar el <strong>análisis {{ $unAnalisis->analisis }}</strong>?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                <form action="{{ route('eliminar-analisis', [$unAnalisis->control->consulta->especialidad->id, $unAnalisis->control->consulta->id, $unAnalisis->control->id, $unAnalisis->id]) }}" method="POST">
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
                            <p class="h6 text-center"><strong>Aún no se ha agregado análisis.</strong></p>
                        @endif
                        
                    </p>
                </div>
            </div>
        </div>
        <div class="col-sm-6 my-3">
            <div class="card">
                <div class="card-header h5">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        Receta
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#agregarReceta"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
                        </svg></button>
                    </div>
                </div>
                <div class="card-body">
                    <p class="card-text">
                        @if ($control->recetas->count() > 0)               
                            @php $i = 1; @endphp
                            @foreach ($control->recetas as $receta)
                                <div class="card my-3">
                                    <div class="card-body">
                                        <h6 class="card-title">{{$i++}}. {{ $receta->receta != null ? $receta->receta : '----------' }}<br></h6>
                                        <p class="card-text">
                                            @if ($receta->archivo != null)
                                                <div class="text-center my-3">
                                                    <a data-fancybox="image" href="{{ asset('storage') . '/' . $receta->archivo }}" class="btn btn-light" style="border-radius: 8px; border: 2px solid black;">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-image-fill" viewBox="0 0 16 16">
                                                            <path d="M.002 3a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-12a2 2 0 0 1-2-2V3zm1 9v1a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V9.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12zm5-6.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0z"/>
                                                        </svg>
                                                    </a>
                                                </div>
                                            @else
                                                <p class="h6 text-center"><strong>No contiene imagen.</strong></p>
                                            @endif
                                        </p>
                                    </div>
                                    <div class="card-footer">
                                        <div class="text-center">
                                            <button data-bs-toggle="modal" data-bs-target="#editarReceta{{ $receta->id }}" class="btn btn-primary">Editar</button>
                                            <button data-bs-toggle="modal" data-bs-target="#eliminarReceta{{ $receta->id }}" class="btn btn-danger">Eliminar</button>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal Editar Receta-->
                                <div class="modal fade" id="editarReceta{{ $receta->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Datos de Receta</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('actualizar-receta', [$receta->control->consulta->especialidad->id, $receta->control->consulta->id, $receta->control->id, $receta->id]) }}" method="POST" enctype="multipart/form-data" {{--class="needs-validation" novalidate--}}>
                                                @method('PATCH')
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="message-text" class="col-form-label">Receta:</label>
                                                        <textarea class="form-control" style="height: 150px" id="message-text" name="receta">{{ $receta->receta }}</textarea>
                                                        <!--<div class="invalid-feedback">El campo receta es obligatorio.</div>-->
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="formFile" class="form-label">Archivo:</label>
                                                        <input class="form-control" type="file" id="formFile" name="archivo">
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
                                <!-- Modal Eliminar Receta-->
                                <div class="modal fade" id="eliminarReceta{{ $receta->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Eliminar Receta</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>¿Está seguro que desea eliminar la <strong>receta {{ $receta->receta }}</strong>?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                <form action="{{ route('eliminar-receta', [$receta->control->consulta->especialidad->id, $receta->control->consulta->id, $receta->control->id, $receta->id]) }}" method="POST">
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
                            <p class="h6 text-center"><strong>Aún no se ha agregado recetas.</strong></p>
                        @endif
                    </p>
                </div>
            </div>
        </div>
        <div class="col-sm-6 my-3">
            <div class="card">
                <div class="card-header h5">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        Tratamiento
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#agregarTratamiento"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
                        </svg></button>
                    </div>
                </div>
                <div class="card-body">
                    <p class="card-text">
                        @if ($control->tratamientos->count() > 0)
                            @php $i = 1; @endphp
                            @foreach ($control->tratamientos as $tratamiento)
                                <div class="card my-3">
                                    <div class="card-body">
                                        <h6 class="card-title">{{$i++}}. {{ $tratamiento->tratamiento != null ? $tratamiento->tratamiento : '----------' }}<br></h6>
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
                                    <div class="card-footer">
                                        <div class="text-center">
                                            <button data-bs-toggle="modal" data-bs-target="#editarTratamiento{{ $tratamiento->id }}" class="btn btn-primary">Editar</button>
                                            <button data-bs-toggle="modal" data-bs-target="#eliminarTratamiento{{ $tratamiento->id }}" class="btn btn-danger">Eliminar</button>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal Editar Tratamiento-->
                                <div class="modal fade" id="editarTratamiento{{ $tratamiento->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Editar Tratamiento</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('actualizar-tratamiento', [$tratamiento->control->consulta->especialidad->id, $tratamiento->control->consulta->id, $tratamiento->control->id, $tratamiento->id]) }}" method="POST" class="needs-validation" novalidate>
                                                @method('PATCH')
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="message-text" class="col-form-label">Tratamiento:</label>
                                                        <textarea class="form-control" style="height: 150px" id="message-text" name="tratamiento" required>{{ $tratamiento->tratamiento }}</textarea>
                                                        <div class="invalid-feedback">El campo tratamiento es obligatorio.</div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="recipient-name" class="col-form-label">Fecha inicio:</label>
                                                        <input type="date" class="form-control" id="recipient-name" name="fechaInicio" value="{{ $tratamiento->fecha_inicio }}" required>
                                                        <div class="invalid-feedback">El campo fecha inicio es obligatorio.</div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="recipient-name" class="col-form-label">Fecha fin:</label>
                                                        <input type="date" class="form-control" id="recipient-name" name="fechaFin" value="{{ $tratamiento->fecha_fin }}" required>
                                                        <div class="invalid-feedback">El campo fecha fin es obligatorio.</div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="message-text" class="col-form-label">Datos de interés:</label>
                                                        <textarea class="form-control" style="height: 150px" id="message-text" name="datosInteres" required>{{ $tratamiento->dato_interes }}</textarea>
                                                        <div class="invalid-feedback">El campo datos de interés es obligatorio.</div>
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
                                <!-- Modal Eliminar Tratamiento-->
                                <div class="modal fade" id="eliminarTratamiento{{ $tratamiento->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Eliminar Tratamiento</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>¿Está seguro que desea eliminar el <strong>tratamiento {{ $tratamiento->tratamiento }}</strong>?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                <form action="{{ route('eliminar-tratamiento', [$tratamiento->control->consulta->especialidad->id, $tratamiento->control->consulta->id, $tratamiento->control->id, $tratamiento->id]) }}" method="POST">
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
                            <p class="h6 text-center"><strong>Aún no se ha agregado tratamientos.</strong></p>
                        @endif
                    </p>
                </div>
            </div>
        </div>
        <div class="col-sm-6 my-3">
            <div class="card">
                <div class="card-header h5">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        Datos Relevantes
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#agregarDatoRelevante"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
                        </svg></button>
                    </div>
                </div>
                <div class="card-body">
                    <p class="card-text">
                        @if ($control->datosRelevantes->count() > 0)
                            @php $i = 1; @endphp
                            @foreach ($control->datosRelevantes as $datoRelevante)
                                <div class="my-2 p-3" style="border-radius: 20px; border: 1px solid grey; display: flex; justify-content: space-between; align-items: center;">
                                    <div style="justify-content: center; width: 80%;">
                                        {{$i++}}. {{$datoRelevante->dato_relevante}}
                                    </div>
                                    <div style="align-items: center; justify-content: center; display: flex;">
                                        <div class="m-1">
                                            <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#editarDatoRelevante{{ $datoRelevante->id }}"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                                <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                            </svg></button>
                                        </div>
                                        <div class="m-1">
                                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#eliminarDatoRelevante{{ $datoRelevante->id }}"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                            </svg></button>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal Editar Dato Relevante-->
                                <div class="modal fade" id="editarDatoRelevante{{ $datoRelevante->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Editar Dato Relevante</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('actualizar-dato-relevante', [$datoRelevante->control->consulta->especialidad->id, $datoRelevante->control->consulta->id, $datoRelevante->control->id, $datoRelevante->id]) }}" method="POST" class="needs-validation" novalidate>
                                                @method('PATCH')
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="message-text" class="col-form-label">Dato Relevante:</label>
                                                        <textarea class="form-control" style="height: 150px" id="message-text" name="datoRelevante" required>{{ $datoRelevante->dato_relevante }}</textarea>
                                                        <div class="invalid-feedback">El campo dato relevante es obligatorio.</div>
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
                                <!-- Modal Eliminar Dato Relevado-->
                                <div class="modal fade" id="eliminarDatoRelevante{{ $datoRelevante->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Eliminar Dato Relevante</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>¿Está seguro que desea eliminar el <strong>dato relevante {{ $datoRelevante->dato_relevante }}</strong>?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                <form action="{{ route('eliminar-dato-relevante', [$datoRelevante->control->consulta->especialidad->id, $datoRelevante->control->consulta->id, $datoRelevante->control->id, $datoRelevante->id]) }}" method="POST">
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
                            <p class="h6 text-center"><strong>Aún no se ha agregado datos relevantes.</strong></p>
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Agregar Sintoma-->
<div class="modal fade" id="agregarSintoma" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Datos de Síntoma</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('agregar-sintoma', [$control->consulta->especialidad->id, $control->consulta->id, $control->id]) }}" method="POST" class="needs-validation" novalidate>
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">Síntoma:</label>
                        <textarea class="form-control" style="height: 150px" id="message-text" name="sintoma" required></textarea>
                        <div class="invalid-feedback">El campo síntoma es obligatorio.</div>
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
<!-- Modal Agregar Diagnostico-->
<div class="modal fade" id="agregarDiagnostico" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Datos de Diagnóstico</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('agregar-diagnostico', [$control->consulta->especialidad->id, $control->consulta->id, $control->id]) }}" method="POST" class="needs-validation" novalidate>
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">Diagnóstico:</label>
                        <textarea class="form-control" style="height: 150px" id="message-text" name="diagnostico" required></textarea>
                        <div class="invalid-feedback">El campo diagnóstico es obligatorio.</div>
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
<!-- Modal Agregar Analisis-->
<div class="modal fade" id="agregarAnalisis" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Datos de Análisis</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Elija la opción de información que desea ingresar.
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" data-bs-target="#agregarAnalisisTexto" data-bs-toggle="modal">Texto</button>
                <button class="btn btn-primary" data-bs-target="#agregarAnalisisImagen" data-bs-toggle="modal">Imagen</button>
                <button class="btn btn-primary" data-bs-target="#agregarAnalisisAmbos" data-bs-toggle="modal">Ambos</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Agregar Receta-->
<div class="modal fade" id="agregarReceta" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Datos de Receta</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('agregar-receta', [$control->consulta->especialidad->id, $control->consulta->id, $control->id]) }}" method="POST" enctype="multipart/form-data" {{--class="needs-validation" novalidate--}}>
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">Receta:</label>
                        <textarea class="form-control" style="height: 150px" id="message-text" name="receta"></textarea>
                        <!--<div class="invalid-feedback">El campo receta es obligatorio.</div>-->
                    </div>
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Archivo:</label>
                        <input class="form-control" type="file" id="formFile" name="archivo">
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
<!-- Modal Agregar Tratamiento-->
<div class="modal fade" id="agregarTratamiento" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Datos de Tratamiento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('agregar-tratamiento', [$control->consulta->especialidad->id, $control->consulta->id, $control->id]) }}" method="POST" class="needs-validation" novalidate>
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">Tratamiento:</label>
                        <textarea class="form-control" style="height: 150px" id="message-text" name="tratamiento" required></textarea>
                        <div class="invalid-feedback">El campo tratamiento es obligatorio.</div>
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Fecha inicio:</label>
                        <input type="date" class="form-control" id="recipient-name" name="fechaInicio" required>
                        <div class="invalid-feedback">El campo fecha inicio es obligatorio.</div>
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Fecha fin:</label>
                        <input type="date" class="form-control" id="recipient-name" name="fechaFin" required>
                        <div class="invalid-feedback">El campo fecha fin es obligatorio.</div>
                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">Datos de interés:</label>
                        <textarea class="form-control" style="height: 150px" id="message-text" name="datosInteres" required></textarea>
                        <div class="invalid-feedback">El campo datos de interés es obligatorio.</div>
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
<!-- Modal Agregar Dato Relevante-->
<div class="modal fade" id="agregarDatoRelevante" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Datos de dato relevante</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('agregar-dato-relevante', [$control->consulta->especialidad->id, $control->consulta->id, $control->id]) }}" method="POST" class="needs-validation" novalidate>
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">Dato Relevante:</label>
                        <textarea class="form-control" style="height: 150px" id="message-text" name="datoRelevante" required></textarea>
                        <div class="invalid-feedback">El campo dato relevante es obligatorio.</div>
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
<!-- Modal Agregar Analisis Texto-->
{{--<div class="modal fade" id="agregarAnalisisTexto" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Datos de Análisis</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('agregar-analisis', [$control->consulta->especialidad->id, $control->consulta->id, $control->id]) }}" method="POST" class="needs-validation" novalidate>
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">Análisis:</label>
                        <textarea class="form-control" style="height: 150px;" id="message-text" name="analisis" required></textarea>
                        <div class="invalid-feedback">El campo análisis es obligatorio.</div>
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
<!-- Modal Agregar Analisis Imagen-->
<div class="modal fade" id="agregarAnalisisImagen" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Datos de Análisis</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('agregar-analisis', [$control->consulta->especialidad->id, $control->consulta->id, $control->id]) }}" method="POST" class="needs-validation" novalidate enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Toma de muestra:</label>
                            <input type="date" class="form-control" id="recipient-name" name="tomaMuestra" required>
                            <div class="invalid-feedback">El campo toma de muestra es obligatorio.</div>
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Entrega:</label>
                            <input type="date" class="form-control" id="recipient-name" name="entrega" required>
                            <div class="invalid-feedback">El campo entrega es obligatorio.</div>
                        </div>
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Archivo:</label>
                            <input class="form-control" type="file" id="formFile" name="archivo" required>
                            <div class="invalid-feedback">El campo archivo es obligatorio.</div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Agregar</button>
                </div>
            </form>
        </div>
    </div>
</div>--}}
<!-- Modal Agregar Analisis Texto e Imagen-->
<div class="modal fade" id="agregarAnalisisAmbos" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Datos de Análisis</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('agregar-analisis', [$control->consulta->especialidad->id, $control->consulta->id, $control->id]) }}" method="POST" {{--class="needs-validation" novalidate novalidate--}} enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Análisis:</label>
                            <textarea class="form-control" style="height: 150px" id="message-text" name="analisis"></textarea>
                            <!--<div class="invalid-feedback">El campo análisis es obligatorio.</div>-->
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Toma de muestra:</label>
                            <input type="date" class="form-control" id="recipient-name" name="tomaMuestra">
                            <!--<div class="invalid-feedback">El campo toma de muestra es obligatorio.</div>-->
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Entrega:</label>
                            <input type="date" class="form-control" id="recipient-name" name="entrega">
                            <!--<div class="invalid-feedback">El campo entrega es obligatorio.</div>-->
                        </div>
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Archivo:</label>
                            <input class="form-control" type="file" id="formFile" name="archivo">
                            <!--<div class="invalid-feedback">El campo archivo es obligatorio.</div>-->
                        </div>
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
@if (session('agregarSintoma') == 'true')
<script>
    Swal.fire(
        '¡Agregado!',
        'El síntoma se ha agregado correctamente.',
        'success'
    )
</script>
@endif
@if (session('agregarSintoma') == 'false')
<script>
    Swal.fire(
        '¡Error!',
        'No se ha podido agregar el síntoma correctamente.',
        'error'
    )
</script>
@endif
<!--SweetAlert2 Mensaje Actualizar Sintoma-->
@if (session('actualizarSintoma') == 'true')
<script>
    Swal.fire(
        '¡Actualizado!',
        'El síntoma se ha actualizado correctamente.',
        'success'
    )
</script>
@endif
@if (session('actualizarSintoma') == 'false')
<script>
    Swal.fire(
        '¡Error!',
        'No se ha podido actualizar el síntoma correctamente.',
        'error'
    )
</script>
@endif
<!--SweetAlert2 Mensaje Eliminar Sintoma-->
@if (session('eliminarSintoma') == 'true')
<script>
    Swal.fire(
        '¡Eliminado!',
        'El síntoma se ha eliminado correctamente.',
        'success'
    )
</script>
@endif
@if (session('eliminarSintoma') == 'false')
<script>
    Swal.fire(
        '¡Error!',
        'No se ha podido eliminar el síntoma correctamente.',
        'error'
    )
</script>
@endif
<!--SweetAlert2 Mensaje Agregar Diagnostico-->
@if (session('agregarDiagnostico') == 'true')
<script>
    Swal.fire(
        '¡Agregado!',
        'El diagnóstico se ha agregado correctamente.',
        'success'
    )
</script>
@endif
@if (session('agregarDiagnostico') == 'false')
<script>
    Swal.fire(
        '¡Error!',
        'No se ha podido agregar el diagnóstico correctamente.',
        'error'
    )
</script>
@endif
<!--SweetAlert2 Mensaje Eliminar Diagnostico-->
@if (session('eliminarDiagnostico') == 'true')
<script>
    Swal.fire(
        '¡Eliminado!',
        'El diagnóstico se ha eliminado correctamente.',
        'success'
    )
</script>
@endif
@if (session('eliminarDiagnostico') == 'false')
<script>
    Swal.fire(
        '¡Error!',
        'No se ha podido eliminar el diagnóstico correctamente.',
        'error'
    )
</script>
@endif
<!--SweetAlert2 Mensaje Actualizar Diagnostico-->
@if (session('actualizarDiagnostico') == 'true')
<script>
    Swal.fire(
        '¡Actualizado!',
        'El diagnóstico se ha actualizado correctamente.',
        'success'
    )
</script>
@endif
@if (session('actualizarDiagnostico') == 'false')
<script>
    Swal.fire(
        '¡Error!',
        'No se ha podido actualizar el diagnóstico correctamente.',
        'error'
    )
</script>
@endif
<!--SweetAlert2 Mensaje Agregar Analisis-->
@if (session('agregarAnalisis') == 'true')
<script>
    Swal.fire(
        '¡Agregado!',
        'El análisis se ha agregado correctamente.',
        'success'
    )
</script>
@endif
@if (session('agregarAnalisis') == 'false')
<script>
    Swal.fire(
        '¡Error!',
        'No se ha podido agregar el análisis correctamente.',
        'error'
    )
</script>
@endif
<!--SweetAlert2 Mensaje Eliminar Analisis-->
@if (session('eliminarAnalisis') == 'true')
<script>
    Swal.fire(
        '¡Eliminado!',
        'El análisis se ha eliminado correctamente.',
        'success'
    )
</script>
@endif
@if (session('eliminarAnalisis') == 'false')
<script>
    Swal.fire(
        '¡Error!',
        'No se ha podido eliminar el análisis correctamente.',
        'error'
    )
</script>
@endif
<!--SweetAlert2 Mensaje Actualizar Analisis-->
@if (session('actualizarAnalisis') == 'true')
<script>
    Swal.fire(
        '¡Actualizado!',
        'El análisis se ha actualizado correctamente.',
        'success'
    )
</script>
@endif
@if (session('actualizarAnalisis') == 'false')
<script>
    Swal.fire(
        '¡Error!',
        'No se ha podido actualizar el análisis correctamente.',
        'error'
    )
</script>
@endif
<!--SweetAlert2 Mensaje Agregar Receta-->
@if (session('agregarReceta') == 'true')
<script>
    Swal.fire(
        '¡Agregado!',
        'La receta se ha agregado correctamente.',
        'success'
    )
</script>
@endif
@if (session('agregarReceta') == 'false')
<script>
    Swal.fire(
        '¡Error!',
        'No se ha podido agregar la receta correctamente.',
        'error'
    )
</script>
@endif
<!--SweetAlert2 Mensaje Actualizar Receta-->
@if (session('actualizarReceta') == 'true')
<script>
    Swal.fire(
        '¡Actualizado!',
        'La receta se ha actualizado correctamente.',
        'success'
    )
</script>
@endif
@if (session('actualizarReceta') == 'false')
<script>
    Swal.fire(
        '¡Error!',
        'No se ha podido actualizar la receta correctamente.',
        'error'
    )
</script>
@endif
<!--SweetAlert2 Mensaje Eliminar Receta-->
@if (session('eliminarReceta') == 'true')
<script>
    Swal.fire(
        '¡Eliminado!',
        'La receta se ha eliminado correctamente.',
        'success'
    )
</script>
@endif
@if (session('eliminarReceta') == 'false')
<script>
    Swal.fire(
        '¡Error!',
        'No se ha podido eliminar la receta correctamente.',
        'error'
    )
</script>
@endif
<!--SweetAlert2 Mensaje Agregar Tratamiento-->
@if (session('agregarTratamiento') == 'true')
<script>
    Swal.fire(
        '¡Agregado!',
        'El tratamiento se ha agregado correctamente.',
        'success'
    )
</script>
@endif
@if (session('agregarTratamiento') == 'false')
<script>
    Swal.fire(
        '¡Error!',
        'No se ha podido agregar el tratamiento correctamente.',
        'error'
    )
</script>
@endif
<!--SweetAlert2 Mensaje Actualizar Receta-->
@if (session('actualizarTratamiento') == 'true')
<script>
    Swal.fire(
        '¡Actualizado!',
        'El tratamiento se ha actualizado correctamente.',
        'success'
    )
</script>
@endif
@if (session('actualizarTratamiento') == 'false')
<script>
    Swal.fire(
        '¡Error!',
        'No se ha podido actualizar el tratamiento correctamente.',
        'error'
    )
</script>
@endif
<!--SweetAlert2 Mensaje Eliminar Tratamiento-->
@if (session('eliminarTratamiento') == 'true')
<script>
    Swal.fire(
        '¡Eliminado!',
        'El tratamiento se ha eliminado correctamente.',
        'success'
    )
</script>
@endif
@if (session('eliminarTratamiento') == 'false')
<script>
    Swal.fire(
        '¡Error!',
        'No se ha podido eliminar el tratamiento correctamente.',
        'error'
    )
</script>
@endif
<!--SweetAlert2 Mensaje Agregar Dato Relevante-->
@if (session('agregarDatoRelevante') == 'true')
<script>
    Swal.fire(
        '¡Agregado!',
        'El dato relevante se ha agregado correctamente.',
        'success'
    )
</script>
@endif
@if (session('agregarDatoRelevante') == 'false')
<script>
    Swal.fire(
        '¡Error!',
        'No se ha podido agregar el dato relevante correctamente.',
        'error'
    )
</script>
@endif
<!--SweetAlert2 Mensaje Actualizar Dato Relevante-->
@if (session('actualizarDatoRelevante') == 'true')
<script>
    Swal.fire(
        '¡Actualizado!',
        'El dato relevante se ha actualizado correctamente.',
        'success'
    )
</script>
@endif
@if (session('actualizarDatoRelevante') == 'false')
<script>
    Swal.fire(
        '¡Error!',
        'No se ha podido actualizar el dato relevante correctamente.',
        'error'
    )
</script>
@endif
<!--SweetAlert2 Mensaje Eliminar Dato Relevante-->
@if (session('eliminarDatoRelevante') == 'true')
<script>
    Swal.fire(
        '¡Eliminado!',
        'El dato relevante se ha eliminado correctamente.',
        'success'
    )
</script>
@endif
@if (session('eliminarDatoRelevante') == 'false')
<script>
    Swal.fire(
        '¡Error!',
        'No se ha podido eliminar el dato relevante correctamente.',
        'error'
    )
</script>
@endif
{{--PROBANDO--}}
{{--<script>
    document.getElementById('agregarAnalisisAmbos').addEventListener('submit', function() {
        alert("yes!");
    });
</script>--}}
@endsection