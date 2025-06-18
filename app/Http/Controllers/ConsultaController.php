<?php

namespace App\Http\Controllers;

use App\Models\Consulta;
use App\Models\Especialidad;
use Illuminate\Http\Request;

class ConsultaController extends Controller
{
    public function mostrarConsultas($id){
        $especialidad = Especialidad::find($id);
        $consultas = Consulta::where('id_especialidad', $id)->get();
        return view('consultas.index', ['especialidad' => $especialidad, 'consultas' => $consultas]);
    }

    public function agregarConsulta(Request $request, $id){
        $validacion = $request->validate([
            'consulta' => 'required',
            'descripcion' => 'required',
            'fecha' => 'required'
        ],[
            'consulta.required' => 'El campo consulta es obligatorio.',
            'descripcion.required' => 'El campo descripción es obligatorio.',
            'fecha.required' => 'El campo fecha es obligatorio.'
        ]);

        if($validacion){
            $consulta = new Consulta();
            $consulta->id_especialidad = $id;
            $consulta->consulta = $request->consulta;
            $consulta->descripcion = $request->descripcion;
            $consulta->fecha = $request->fecha;
            $agregarConsulta = $consulta->save();

            if($agregarConsulta){
                return redirect()->route('ver-consultas', [$id])->with('agregarConsulta', 'true');
            }else{
                return redirect()->route('ver-consultas', [$id])->with('agregarConsulta', 'false');
            }
        }
    }

    public function eliminarConsulta($id, $id_consulta){
        $consulta = Consulta::find($id_consulta);
        $eliminarConsulta = $consulta->delete();
        if($eliminarConsulta){
            return redirect()->route('ver-consultas', [$id])->with('eliminarConsulta', 'true');
        }else{
            return redirect()->route('ver-consultas', [$id])->with('eliminarConsulta', 'false');
        }
    }

    public function actualizarConsulta(Request $request, $id, $id_consulta){
        $validacion = $request->validate([
            'consulta' => 'required',
            'descripcion' => 'required',
            'fecha' => 'required'
        ],[
            'consulta.required' => 'El campo consulta es obligatorio.',
            'descripcion.required' => 'El campo descripcion es obligatorio.',
            'fecha.required' => 'El campo fecha es obligatorio.'
        ]);

        if($validacion){
            $consulta = Consulta::find($id_consulta);
            $consulta->id_especialidad = $id;
            $consulta->consulta = $request->consulta;
            $consulta->descripcion = $request->descripcion;
            $consulta->fecha = $request->fecha;
            $actualizarConsulta = $consulta->save();

            if($actualizarConsulta){
                return redirect()->route('ver-consultas', [$id])->with('actualizarConsulta', 'true');
            }else{
                return redirect()->route('ver-consultas', [$id])->with('actualizarConsulta', 'false');
            }
        }
    }
}
