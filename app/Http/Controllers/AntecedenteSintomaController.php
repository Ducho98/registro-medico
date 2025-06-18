<?php

namespace App\Http\Controllers;

use App\Models\AntecedenteSintoma;
use Illuminate\Http\Request;

class AntecedenteSintomaController extends Controller
{
    public function mostrarAntecedenteSintomas(Request $request){
        $idUsuario = $request->session()->get('id');
        $antecedenteSintomas = AntecedenteSintoma::where('id_usuario', $idUsuario)->get();

        return view('antecedentes.sintomas', ['antecedenteSintomas' => $antecedenteSintomas]);
    }

    public function agregarAntecedenteSintoma(Request $request){
        $validacion = $request->validate([
            'descripcion' => 'required'
        ],[
            'descripcion.required' => 'El campo descripcion es obligatorio.'
        ]);

        $idUsuario = $request->session()->get('id');
        $fechita = now()->toDateTimeString();

        if($validacion){
            $antecedenteSintoma = new AntecedenteSintoma();
            $antecedenteSintoma->id_usuario = $idUsuario;
            $antecedenteSintoma->descripcion = $request->descripcion;
            $antecedenteSintoma->fecha_hora = $fechita;
            $agregarAntecedenteSintoma = $antecedenteSintoma->save();
    
            if($agregarAntecedenteSintoma){
                return redirect()->route('ver-antecedente-sintomas')->with('agregarAntecedenteSintoma', 'true');
            }else{
                return redirect()->route('ver-antecedente-sintomas')->with('agregarAntecedenteSintoma', 'false');
            }
        }
    }

    public function eliminarAntecedenteSintoma($id_antecedente_sintoma){
        $antecedenteSintoma = AntecedenteSintoma::find($id_antecedente_sintoma);
        $eliminarAntecedenteSintoma = $antecedenteSintoma->delete();

        if($eliminarAntecedenteSintoma){
            return redirect()->route('ver-antecedente-sintomas')->with('eliminarAntecedenteSintoma', 'true');
        }else{
            return redirect()->route('ver-antecedente-sintomas')->with('eliminarAntecedenteSintoma', 'false');
        }
    }
}
