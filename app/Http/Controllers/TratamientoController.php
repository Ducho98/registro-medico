<?php

namespace App\Http\Controllers;

use App\Models\Tratamiento;
use App\Models\Usuario;
use Illuminate\Http\Request;

class TratamientoController extends Controller
{
    public function agregarTratamiento(Request $request, $id, $id_consulta, $id_control){
        $validacion = $request->validate([
            'tratamiento' => 'required',
            'fechaInicio' => 'required',
            'fechaFin' => 'required',
            'datosInteres' => 'required'
        ],[
            'tratamiento.required' => 'El campo tratamiento es obligatorio.',
            'fechaInicio.required' => 'El campo fecha inicio es obligatorio.',
            'fechaFin.required' => 'El campo fecha fin es obligatorio.',
            'datosInteres.required' => 'El campo datos de interés es obligatorio.'
        ]);

        if($validacion){
            $tratamiento = new Tratamiento();
            $tratamiento->id_control = $id_control;
            $tratamiento->tratamiento = $request->tratamiento;
            $tratamiento->fecha_inicio = $request->fechaInicio;
            $tratamiento->fecha_fin = $request->fechaFin;
            $tratamiento->dato_interes = $request->datosInteres;
            $agregarTratamiento = $tratamiento->save();

            if($agregarTratamiento){
                return redirect()->route('detalle-control', [$id, $id_consulta, $id_control])->with('agregarTratamiento', 'true');
            }else{
                return redirect()->route('detalle-control', [$id, $id_consulta, $id_control])->with('agregarTratamiento', 'false');
            }
        }
    }

    public function actualizarTratamiento(Request $request, $id, $id_consulta, $id_control, $id_tratamiento){
        $validacion = $request->validate([
            'tratamiento' => 'required',
            'fechaInicio' => 'required',
            'fechaFin' => 'required',
            'datosInteres' => 'required'
        ],[
            'tratamiento.required' => 'El campo tratamiento es obligatorio.',
            'fechaInicio.required' => 'El campo fecha inicio es obligatorio.',
            'fechaFin.required' => 'El campo fecha fin es obligatorio.',
            'datosInteres.required' => 'El campo datos de interés es obligatorio.'
        ]);

        if($validacion){
            $tratamiento = Tratamiento::find($id_tratamiento);
            $tratamiento->id_control = $id_control;
            $tratamiento->tratamiento = $request->tratamiento;
            $tratamiento->fecha_inicio = $request->fechaInicio;
            $tratamiento->fecha_fin = $request->fechaFin;
            $tratamiento->dato_interes = $request->datosInteres;
            $actualizarTratamiento = $tratamiento->save();

            if($actualizarTratamiento){
                return redirect()->route('detalle-control', [$id, $id_consulta, $id_control])->with('actualizarTratamiento', 'true');
            }else{
                return redirect()->route('detalle-control', [$id, $id_consulta, $id_control])->with('actualizarTratamiento', 'false');
            }
        }
    }

    public function eliminarTratamiento($id, $id_consulta, $id_control, $id_tratamiento){
        $tratamiento = Tratamiento::find($id_tratamiento);
        $eliminarTratamiento = $tratamiento->delete();

        if($eliminarTratamiento){
            return redirect()->route('detalle-control', [$id, $id_consulta, $id_control])->with('eliminarTratamiento', 'true');
        }else{
            return redirect()->route('detalle-control', [$id, $id_consulta, $id_control])->with('eliminarTratamiento', 'false');
        }
    }

    public function mostrarTratamientos(Request $request){
        $idUsuario = $request->session()->get('id');
        $tratamientos = Usuario::join('especialidades', 'especialidades.id_usuario', '=', 'usuarios.id')
                            ->join('consultas', 'consultas.id_especialidad', '=', 'especialidades.id')
                            ->join('controles', 'controles.id_consulta', '=', 'consultas.id')
                            ->join('tratamientos', 'tratamientos.id_control', '=', 'controles.id')
                            ->where('usuarios.id', '=', $idUsuario)
                            ->select('tratamientos.*')
                            ->get();

        return view('antecedentes.tratamientos', ['tratamientos' => $tratamientos]);
    }
}
