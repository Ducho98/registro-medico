<?php

namespace App\Http\Controllers;

use App\Models\Control;
use Illuminate\Http\Request;

class ControlController extends Controller
{
    public function agregarControl(Request $request, $id, $id_consulta){
        $validacion = $request->validate([
            'control' => 'required',
            'descripcion' => 'required',
            'fecha' => 'required'
        ],[
            'control.required' => 'El campo control es obligatorio.',
            'descripcion.required' => 'El campo descripción es obligatorio.',
            'fecha.required' => 'El campo fecha es obligatorio.'
        ]);

        if($validacion){
            $control = new Control();
            $control->id_consulta = $id_consulta;
            $control->control = $request->control;
            $control->descripcion = $request->descripcion;
            $control->fecha = $request->fecha;
            $agregarControl = $control->save();

            if($agregarControl){
                return redirect()->route('ver-consultas', [$id])->with('agregarControl', 'true');
            }else{
                return redirect()->route('ver-consultas', [$id])->with('agregarControl', 'false');
            }
        }
    }

    public function eliminarControl($id, $id_consulta, $id_control){
        $control = Control::find($id_control);
        $eliminarControl = $control->delete();

        if($eliminarControl){
            return redirect()->route('ver-consultas', [$id])->with('eliminarControl', 'true');
        }else{
            return redirect()->route('ver-consultas', [$id])->with('eliminarControl', 'false');
        }
    }

    public function detalleControl($id, $id_consulta, $id_control){
        $control = Control::find($id_control);
        return view('controles.detalle_control', ['control' => $control]);
    }

    //HACIENDO
    public function actualizarControl(Request $request, $id, $id_consulta, $id_control){
        $validacion = $request->validate([
            'control' => 'required',
            'descripcion' => 'required',
            'fecha' => 'required'
        ],[
            'control.required' => 'El campo control es obligatorio.',
            'descripcion.required' => 'El campo descripcion es obligatorio.',
            'fecha.required' => 'El campo fecha es obligatorio.'
        ]);

        if($validacion){
            $control = Control::find($id_control);
            $control->id_consulta = $id_consulta;
            $control->control = $request->control;
            $control->descripcion = $request->descripcion;
            $control->fecha = $request->fecha;
            $actualizarControl = $control->save();

            if($actualizarControl){
                return redirect()->route('ver-consultas', [$id])->with('actualizarControl', 'true');
            }else{
                return redirect()->route('ver-consultas', [$id])->with('actualizarControl', 'false');
            }
        }
    }
}
