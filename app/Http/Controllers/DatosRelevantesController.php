<?php

namespace App\Http\Controllers;

use App\Models\DatosRelevantes;
use Illuminate\Http\Request;

class DatosRelevantesController extends Controller
{
    public function agregarDatoRelevante(Request $request, $id, $id_consulta, $id_control){
        $validacion = $request->validate([
            'datoRelevante' => 'required'
        ],[
            'datoRelevante.required' => 'El campo dato relevante es obligatorio.'
        ]);

        if($validacion){
            $datoRelevante = new DatosRelevantes();
            $datoRelevante->id_control = $id_control;
            $datoRelevante->dato_relevante = $request->datoRelevante;
            $agregarDatoRelevante = $datoRelevante->save();

            if($agregarDatoRelevante){
                return redirect()->route('detalle-control', [$id, $id_consulta, $id_control])->with('agregarDatoRelevante', 'true');
            }else{
                return redirect()->route('detalle-control', [$id, $id_consulta, $id_control])->with('agregarDatoRelevante', 'false');
            }
        }
    }

    public function actualizarDatoRelevante(Request $request, $id, $id_consulta, $id_control, $id_dato_relevante){
        $validacion = $request->validate([
            'datoRelevante' => 'required'
        ],[
            'datoRelevante.required' => 'El campo dato relevante es obligatorio.'
        ]);

        if($validacion){
            $datoRelevante = DatosRelevantes::find($id_dato_relevante);
            $datoRelevante->id_control = $id_control;
            $datoRelevante->dato_relevante = $request->datoRelevante;
            $actualizarDatoRelevante = $datoRelevante->save();

            if($actualizarDatoRelevante){
                return redirect()->route('detalle-control', [$id, $id_consulta, $id_control])->with('actualizarDatoRelevante', 'true');
            }else{
                return redirect()->route('detalle-control', [$id, $id_consulta, $id_control])->with('actualizarDatoRelevante', 'false');
            }
        }
    }

    public function eliminarDatoRelevante($id, $id_consulta, $id_control, $id_dato_relevante){
        $datoRelevante = DatosRelevantes::find($id_dato_relevante);
        $eliminarDatoRelevante = $datoRelevante->delete();

        if($eliminarDatoRelevante){
            return redirect()->route('detalle-control', [$id, $id_consulta, $id_control])->with('eliminarDatoRelevante', 'true');
        }else{
            return redirect()->route('detalle-control', [$id, $id_consulta, $id_control])->with('eliminarDatoRelevante', 'false');
        }
    }
}
