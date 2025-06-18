<?php

use App\Http\Controllers\AnalisisController;
use App\Http\Controllers\AntecedenteSintomaController;
use App\Http\Controllers\AutenticacionController;
use App\Http\Controllers\ConsultaController;
use App\Http\Controllers\ControlController;
use App\Http\Controllers\DatosRelevantesController;
use App\Http\Controllers\DiagnosticoController;
use App\Http\Controllers\EspecialidadController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\PesoController;
use App\Http\Controllers\RecetaController;
use App\Http\Controllers\SintomaController;
use App\Http\Controllers\TratamientoController;
use App\Models\Tratamiento;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', function () {
    return view('index');
});
Route::post('/', [AutenticacionController::class, 'login'])->name('login');

Route::get('/registro', function () {
    return view('registro');
});
Route::post('/registro', [AutenticacionController::class, 'registro'])->name('registro');

Route::group(['middleware' => ['protegerSesion']], function(){
    Route::get('/cerrarSesion', [AutenticacionController::class, 'cerrarSesion'])->name('cerrarSesion');

    Route::get('/agregar_especialidad', function () {
        return view('especialidades.agregar_especialidad');
    });
    Route::post('/agregar_especialidad', [EspecialidadController::class, 'agregarEspecialidad'])->name('agregar-especialidad');
    
    Route::get('/especialidades', [EspecialidadController::class, 'mostrarEspecialidades'])->name('ver-especialidades');

    Route::delete('/especialidades/{id}', [EspecialidadController::class, 'eliminarEspecialidad'])->name('eliminar-especialidad');
    Route::patch('/especialidades/{id}', [EspecialidadController::class, 'actualizarEspecialidad'])->name('actualizar-especialidad');
    Route::get('/editar_especialidad/{id}', [EspecialidadController::class, 'editarEspecialidad'])->name('editar-especialidad');

    Route::get('/especialidad/{id}/consultas', [ConsultaController::class, 'mostrarConsultas'])->name('ver-consultas');
    Route::post('/especialidad/{id}/consultas', [ConsultaController::class, 'agregarConsulta'])->name('agregar-consulta');
    Route::delete('/especialidad/{id}/consulta/{id_consulta}', [ConsultaController::class, 'eliminarConsulta'])->name('eliminar-consulta');

    Route::post('/especialidad/{id}/consulta/{id_consulta}', [ControlController::class, 'agregarControl'])->name('agregar-control');
    Route::delete('/especialidad/{id}/consulta/{id_consulta}/control/{id_control}', [ControlController::class, 'eliminarControl'])->name('eliminar-control');

    Route::get('/especialidad/{id}/consulta/{id_consulta}/detalle_control/{id_control}', [ControlController::class, 'detalleControl'])->name('detalle-control');

    Route::post('/especialidad/{id}/consulta/{id_consulta}/detalle_control/{id_control}/sintoma', [SintomaController::class, 'agregarSintoma'])->name('agregar-sintoma');

    Route::delete('/especialidad/{id}/consulta/{id_consulta}/control/{id_control}/sintoma/{id_sintoma}', [SintomaController::class, 'eliminarSintoma'])->name('eliminar-sintoma');
    
    Route::patch('/especialidad/{id}/consulta/{id_consulta}', [ConsultaController::class, 'actualizarConsulta'])->name('actualizar-consulta');

    Route::patch('/especialidad/{id}/consulta/{id_consulta}/control/{id_control}', [ControlController::class, 'actualizarControl'])->name('actualizar-control');
    
    Route::patch('/especialidad/{id}/consulta/{id_consulta}/control/{id_control}/sintoma/{id_sintoma}', [SintomaController::class, 'actualizarSintoma'])->name('actualizar-sintoma');
    
    Route::post('/especialidad/{id}/consulta/{id_consulta}/detalle_control/{id_control}/diagnostico', [DiagnosticoController::class, 'agregarDiagnostico'])->name('agregar-diagnostico');
    
    Route::delete('/especialidad/{id}/consulta/{id_consulta}/control/{id_control}/diagnostico/{id_diagnostico}', [DiagnosticoController::class, 'eliminarDiagnostico'])->name('eliminar-diagnostico');
    
    Route::patch('/especialidad/{id}/consulta/{id_consulta}/control/{id_control}/diagnostico/{id_diagnostico}', [DiagnosticoController::class, 'actualizarDiagnostico'])->name('actualizar-diagnostico');
    
    Route::post('/especialidad/{id}/consulta/{id_consulta}/detalle_control/{id_control}/analisis', [AnalisisController::class, 'agregarAnalisis'])->name('agregar-analisis');
    
    Route::delete('/especialidad/{id}/consulta/{id_consulta}/control/{id_control}/analisis/{id_analisis}', [AnalisisController::class, 'eliminarAnalisis'])->name('eliminar-analisis');
    
    Route::patch('/especialidad/{id}/consulta/{id_consulta}/control/{id_control}/analisis/{id_analisis}', [AnalisisController::class, 'actualizarAnalisis'])->name('actualizar-analisis');
    
    Route::post('/especialidad/{id}/consulta/{id_consulta}/detalle_control/{id_control}/receta', [RecetaController::class, 'agregarReceta'])->name('agregar-receta');
    
    Route::patch('/especialidad/{id}/consulta/{id_consulta}/control/{id_control}/receta/{id_receta}', [RecetaController::class, 'actualizarReceta'])->name('actualizar-receta');
    
    Route::delete('/especialidad/{id}/consulta/{id_consulta}/control/{id_control}/receta/{id_receta}', [RecetaController::class, 'eliminarReceta'])->name('eliminar-receta');
    
    Route::post('/especialidad/{id}/consulta/{id_consulta}/detalle_control/{id_control}/tratamiento', [TratamientoController::class, 'agregarTratamiento'])->name('agregar-tratamiento');
    
    Route::patch('/especialidad/{id}/consulta/{id_consulta}/control/{id_control}/tratamiento/{id_tratamiento}', [TratamientoController::class, 'actualizarTratamiento'])->name('actualizar-tratamiento');
    
    Route::delete('/especialidad/{id}/consulta/{id_consulta}/control/{id_control}/tratamiento/{id_tratamiento}', [TratamientoController::class, 'eliminarTratamiento'])->name('eliminar-tratamiento');
    
    Route::post('/especialidad/{id}/consulta/{id_consulta}/detalle_control/{id_control}/dato_relevante', [DatosRelevantesController::class, 'agregarDatoRelevante'])->name('agregar-dato-relevante');
    
    Route::patch('/especialidad/{id}/consulta/{id_consulta}/control/{id_control}/dato_relevante/{id_dato_relevante}', [DatosRelevantesController::class, 'actualizarDatoRelevante'])->name('actualizar-dato-relevante');
    
    Route::delete('/especialidad/{id}/consulta/{id_consulta}/control/{id_control}/dato_relevante/{id_dato_relevante}', [DatosRelevantesController::class, 'eliminarDatoRelevante'])->name('eliminar-dato-relevante');
    
    Route::get('/actualizar_perfil', [PerfilController::class, 'visualizarPerfil'])->name('ver-perfil');
    
    Route::patch('/actualizar_perfil', [PerfilController::class, 'actualizarPerfil'])->name('actualizar-perfil');
    
    Route::get('/antecedentes', function () {
        return view('antecedentes.index');
    });
    
    Route::get('/pesos', [PesoController::class, 'mostrarPesos'])->name('ver-pesos');
    
    Route::post('/agregar_peso', [PesoController::class, 'agregarPeso'])->name('agregar-peso');
    
    Route::delete('/peso/{id_peso}', [PesoController::class, 'eliminarPeso'])->name('eliminar-peso');
    
    Route::get('/analisis', [AnalisisController::class, 'mostrarAnalisis'])->name('ver-analisis');
    
    Route::get('/tratamientos', [TratamientoController::class, 'mostrarTratamientos'])->name('ver-tratamientos');
    
    Route::get('/antecedente_sintomas', [AntecedenteSintomaController::class, 'mostrarAntecedenteSintomas'])->name('ver-antecedente-sintomas');
    
    Route::post('/agregar_antecedente_sintoma', [AntecedenteSintomaController::class, 'agregarAntecedenteSintoma'])->name('agregar-antecedente-sintoma');
    
    Route::delete('/antecedente_sintoma/{id_antecedente_sintoma}', [AntecedenteSintomaController::class, 'eliminarAntecedenteSintoma'])->name('eliminar-antecedente-sintoma');
    
    //PROBANDO ESTO
    

});