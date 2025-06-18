<?php

namespace App\Http\Controllers;

use App\Models\Sintoma;
use Illuminate\Http\Request;

class SintomaController extends Controller
{
    public function agregarSintoma(Request $request, $id, $id_consulta, $id_control){
        $validacion = $request->validate([
            'sintoma' => 'required'
        ],[
            'sintoma.required' => 'El campo síntoma es obligatorio.'
        ]);

        if($validacion){
            $sintoma = new Sintoma();
            $sintoma->id_control = $id_control;
            $sintoma->sintoma = $request->sintoma;
            $agregarSintoma = $sintoma->save();

            if($agregarSintoma){
                return redirect()->route('detalle-control', [$id, $id_consulta, $id_control])->with('agregarSintoma', 'true');
            }else{
                return redirect()->route('detalle-control', [$id, $id_consulta, $id_control])->with('agregarSintoma', 'false');
            }
        }
    }

    public function eliminarSintoma($id, $id_consulta, $id_control, $id_sintoma){
        $sintoma = Sintoma::find($id_sintoma);
        $eliminarSintoma = $sintoma->delete();

        if($eliminarSintoma){
            return redirect()->route('detalle-control', [$id, $id_consulta, $id_control])->with('eliminarSintoma', 'true');
        }else{
            return redirect()->route('detalle-control', [$id, $id_consulta, $id_control])->with('eliminarSintoma', 'false');
        }
    }

    public function actualizarSintoma(Request $request, $id, $id_consulta, $id_control, $id_sintoma){
        $validacion = $request->validate([
            'sintoma' => 'required'
        ],[
            'sintoma.required' => 'El campo sintoma es obligatorio.'
        ]);

        if($validacion){
            $sintoma = Sintoma::find($id_sintoma);
            $sintoma->id_control = $id_control;
            $sintoma->sintoma = $request->sintoma;
            $actualizarSintoma = $sintoma->save();

            if($actualizarSintoma){
                return redirect()->route('detalle-control', [$id, $id_consulta, $id_control])->with('actualizarSintoma', 'true');
            }else{
                return redirect()->route('detalle-control', [$id, $id_consulta, $id_control])->with('actualizarSintoma', 'false');
            }
        }
    }
}