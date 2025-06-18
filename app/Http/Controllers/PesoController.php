<?php

namespace App\Http\Controllers;

use App\Models\Peso;
use Illuminate\Http\Request;

class PesoController extends Controller
{
    public function mostrarPesos(Request $request){
        $idUsuario = $request->session()->get('id');
        $pesos = Peso::where('id_usuario', $idUsuario)->get();

        return view('antecedentes.peso', ['pesos' => $pesos]);
    }

    public function agregarPeso(Request $request){
        $validacion = $request->validate([
            'peso' => 'required'
        ],[
            'peso.required' => 'El campo peso es obligatorio.'
        ]);

        $idUsuario = $request->session()->get('id');
        $fechita = now()->toDateTimeString();

        if($validacion){
            $peso = new Peso();
            $peso->id_usuario = $idUsuario;
            $peso->peso = $request->peso;
            $peso->fecha_hora = $fechita;
            $agregarPeso = $peso->save();
    
            if($agregarPeso){
                return redirect()->route('ver-pesos')->with('agregarPeso', 'true');
            }else{
                return redirect()->route('ver-pesos')->with('agregarPeso', 'false');
            }
        }
    }

    public function eliminarPeso($id_peso){
        $peso = Peso::find($id_peso);
        $eliminarPeso = $peso->delete();

        if($eliminarPeso){
            return redirect()->route('ver-pesos')->with('eliminarPeso', 'true');
        }else{
            return redirect()->route('ver-pesos')->with('eliminarPeso', 'false');
        }
    }
}
