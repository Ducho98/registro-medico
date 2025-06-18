<?php

namespace App\Http\Controllers;

use App\Models\Consulta;
use App\Models\Especialidad;
use App\Models\Usuario;
use Illuminate\Http\Request;

class EspecialidadController extends Controller
{
    public function agregarEspecialidad(Request $request){
        $validacion = $request->validate([
            'doctor' => 'required',
            'especialidad' => 'required',
            'descripcion' => 'required'
        ],[
            'doctor.required' => 'El campo doctor es obligatorio.',
            'especialidad.required' => 'El campo especialidad es obligatorio.',
            'descripcion.required' => 'El campo descripción es obligatorio.'
        ]);

        if($validacion){
            $especialidad = new Especialidad();
            $idUsuario = $request->session()->get('id');
            $especialidad->id_usuario = $idUsuario;
            $especialidad->doctor = $request->doctor;
            $especialidad->especialidad = $request->especialidad;
            $especialidad->descripcion = $request->descripcion;
            $agregarEspecialidad = $especialidad->save();

            if($agregarEspecialidad){
                return redirect()->route('agregar-especialidad')->with('exito', 'Especialidad agregada correctamente');
            }else{
                return redirect()->route('agregar-especialidad')->with('error', 'No se pudo agregar la especialidad');
            }
        }
    }

    public function mostrarEspecialidades(Request $request){
        $idUsuario = $request->session()->get('id');
        $especialidades = Especialidad::where('id_usuario', $idUsuario)->get();

        /*$espes = Especialidad::find(8);
        $holi = $espes->consultas()->where('id_especialidad', 8)->get();
        dd($holi->count());*/

        return view('especialidades.index', ['especialidades' => $especialidades]);
    }

    public function eliminarEspecialidad($id){
        $especialidad = Especialidad::find($id);
        $eliminarEspecialidad = $especialidad->delete();
        if($eliminarEspecialidad){
            return redirect()->route('ver-especialidades')->with('eliminarEspecialidad', 'true');
        }else{
            return redirect()->route('ver-especialidades')->with('eliminarEspecialidad', 'false');
        }
    }

    public function actualizarEspecialidad(Request $request, $id){
        $validacion = $request->validate([
            'doctor' => 'required',
            'especialidad' => 'required',
            'descripcion' => 'required'
        ],[
            'doctor.required' => 'El campo doctor es obligatorio.',
            'especialidad.required' => 'El campo especialidad es obligatorio.',
            'descripcion.required' => 'El campo descripción es obligatorio.'
        ]);

        if($validacion){
            $especialidad = Especialidad::find($id);
            $especialidad->doctor = $request->doctor;
            $especialidad->especialidad = $request->especialidad;
            $especialidad->descripcion = $request->descripcion;
            $actualizarEspecialidad = $especialidad->save();

            if($actualizarEspecialidad){
                return redirect()->route('editar-especialidad', [$id])->with('exito', 'Especialidad actualizada');
            }else{
                return redirect()->route('editar-especialidad', [$id])->with('error', 'No se pudo actualizar la especialidad');
            }
        }
    }

    public function editarEspecialidad($id){
        $especialidad = Especialidad::find($id);
        return view('especialidades.editar_especialidad', ['especialidad' => $especialidad]);
    }
}
