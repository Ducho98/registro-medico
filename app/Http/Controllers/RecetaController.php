<?php

namespace App\Http\Controllers;

use App\Models\Receta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RecetaController extends Controller
{
    public function agregarReceta(Request $request, $id, $id_consulta, $id_control){
        /*$validacion = $request->validate([
            'receta' => 'required',
            'archivo' => 'required'
        ],[
            'receta.required' => 'El campo receta es obligatorio.',
            'archivo.required' => 'El campo archivo es obligatorio.'
        ]);*/
        $receta = new Receta();
        $receta->id_control = $id_control;
        $receta->receta = $request->receta;
        if($request->hasFile('archivo')){
            $receta->archivo = $request->file('archivo')->store('uploads/recetas', 'public');
        }
        $agregarReceta = $receta->save();

        if($agregarReceta){
            return redirect()->route('detalle-control', [$id, $id_consulta, $id_control])->with('agregarReceta', 'true');
        }else{
            return redirect()->route('detalle-control', [$id, $id_consulta, $id_control])->with('agregarReceta', 'false');
        }
    }

    public function actualizarReceta(Request $request, $id, $id_consulta, $id_control, $id_receta){
        /*$validacion = $request->validate([
            'receta' => 'required',
            'archivo' => 'required'
        ],[
            'receta.required' => 'El campo receta es obligatorio.',
            'archivo.required' => 'El campo archivo es obligatorio.'
        ]);*/
        $receta = Receta::find($id_receta);
        $receta->id_control = $id_control;
        $receta->receta = $request->receta;
        if($request->hasFile('archivo')){
            Storage::delete('public/' . $receta->archivo);
            $receta->archivo = $request->file('archivo')->store('uploads/recetas', 'public');
        }
        $agregarReceta = $receta->save();

        if($agregarReceta){
            return redirect()->route('detalle-control', [$id, $id_consulta, $id_control])->with('actualizarReceta', 'true');
        }else{
            return redirect()->route('detalle-control', [$id, $id_consulta, $id_control])->with('actualizarReceta', 'false');
        }
    }

    public function eliminarReceta($id, $id_consulta, $id_control, $id_receta){
        $receta = Receta::find($id_receta);
        if($receta->archivo != null){
            Storage::delete('public/' . $receta->archivo);
        }
        $eliminarReceta = $receta->delete();

        if($eliminarReceta){
            return redirect()->route('detalle-control', [$id, $id_consulta, $id_control])->with('eliminarReceta', 'true');
        }else{
            return redirect()->route('detalle-control', [$id, $id_consulta, $id_control])->with('eliminarReceta', 'false');
        }
    }
}
