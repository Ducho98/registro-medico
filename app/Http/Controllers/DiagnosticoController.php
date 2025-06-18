<?php

namespace App\Http\Controllers;

use App\Models\Diagnostico;
use Illuminate\Http\Request;

class DiagnosticoController extends Controller
{
    public function agregarDiagnostico(Request $request, $id, $id_consulta, $id_control){
        $validacion = $request->validate([
            'diagnostico' => 'required'
        ],[
            'diagnostico.required' => 'El campo diagnóstico es obligatorio.'
        ]);

        if($validacion){
            $diagnostico = new Diagnostico();
            $diagnostico->id_control = $id_control;
            $diagnostico->diagnostico = $request->diagnostico;
            $agregarDiagnostico = $diagnostico->save();

            if($agregarDiagnostico){
                return redirect()->route('detalle-control', [$id, $id_consulta, $id_control])->with('agregarDiagnostico', 'true');
            }else{
                return redirect()->route('detalle-control', [$id, $id_consulta, $id_control])->with('agregarDiagnostico', 'false');
            }
        }
    }

    public function eliminarDiagnostico($id, $id_consulta, $id_control, $id_diagnostico){
        $diagnostico = Diagnostico::find($id_diagnostico);
        $eliminarDiagnostico = $diagnostico->delete();

        if($eliminarDiagnostico){
            return redirect()->route('detalle-control', [$id, $id_consulta, $id_control])->with('eliminarDiagnostico', 'true');
        }else{
            return redirect()->route('detalle-control', [$id, $id_consulta, $id_control])->with('eliminarDiagnostico', 'false');
        }
    }

    public function actualizarDiagnostico(Request $request, $id, $id_consulta, $id_control, $id_diagnostico){
        $validacion = $request->validate([
            'diagnostico' => 'required'
        ],[
            'diagnostico.required' => 'El campo diagnostico es obligatorio.'
        ]);

        if($validacion){
            $diagnostico = Diagnostico::find($id_diagnostico);
            $diagnostico->id_control = $id_control;
            $diagnostico->diagnostico = $request->diagnostico;
            $actualizarDiagnostico = $diagnostico->save();

            if($actualizarDiagnostico){
                return redirect()->route('detalle-control', [$id, $id_consulta, $id_control])->with('actualizarDiagnostico', 'true');
            }else{
                return redirect()->route('detalle-control', [$id, $id_consulta, $id_control])->with('actualizarDiagnostico', 'false');
            }
        }
    }
}
