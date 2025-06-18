<?php

namespace App\Http\Controllers;

use App\Models\Analisis;
use App\Models\Consulta;
use App\Models\Especialidad;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use function PHPUnit\Framework\isNull;

class AnalisisController extends Controller
{
    public function agregarAnalisis(Request $request, $id, $id_consulta, $id_control){
        /*$validacion = $request->validate([
            'analisis' => 'required',
            'tomaMuestra' => 'required',
            'entrega' => 'required',
            'archivo' => 'required'
        ],[
            'analisis.required' => 'El campo análisis es obligatorio.',
            'tomaMuestra.required' => 'El campo toma muestra es obligatorio.',
            'entrega.required' => 'El campo entrega es obligatorio.',
            'archivo.required' => 'El campo archivo es obligatorio.'
        ]);*/
        $analisis = new Analisis();
        $analisis->id_control = $id_control;
        $analisis->analisis = $request->analisis;
        $analisis->toma_muestra = $request->tomaMuestra;
        $analisis->entrega = $request->entrega;
        if($request->hasFile('archivo')){
            $analisis->archivo = $request->file('archivo')->store('uploads/analisis', 'public');
        }
        $agregarAnalisis = $analisis->save();

        if($agregarAnalisis){
            return redirect()->route('detalle-control', [$id, $id_consulta, $id_control])->with('agregarAnalisis', 'true');
        }else{
            return redirect()->route('detalle-control', [$id, $id_consulta, $id_control])->with('agregarAnalisis', 'false');
        }
    }

    public function eliminarAnalisis($id, $id_consulta, $id_control, $id_analisis){
        $analisis = Analisis::find($id_analisis);
        if($analisis->archivo != null){
            Storage::delete('public/' . $analisis->archivo);
        }
        $eliminarAnalisis = $analisis->delete();

        if($eliminarAnalisis){
            return redirect()->route('detalle-control', [$id, $id_consulta, $id_control])->with('eliminarAnalisis', 'true');
        }else{
            return redirect()->route('detalle-control', [$id, $id_consulta, $id_control])->with('eliminarAnalisis', 'false');
        }
    }

    public function actualizarAnalisis(Request $request, $id, $id_consulta, $id_control, $id_analisis){
        /*$validacion = $request->validate([
            'analisis' => 'required',
            'tomaMuestra' => 'required',
            'entrega' => 'required',
            'archivo' => 'required'
        ],[
            'analisis.required' => 'El campo análisis es obligatorio.',
            'tomaMuestra.required' => 'El campo toma muestra es obligatorio.',
            'entrega.required' => 'El campo entrega es obligatorio.',
            'archivo.required' => 'El campo archivo es obligatorio.'
        ]);*/
        $analisis = Analisis::find($id_analisis);
        $analisis->id_control = $id_control;
        $analisis->analisis = $request->analisis;
        $analisis->toma_muestra = $request->tomaMuestra;
        $analisis->entrega = $request->entrega;
        if($request->hasFile('archivo')){
            Storage::delete('public/' . $analisis->archivo);
            $analisis->archivo = $request->file('archivo')->store('uploads/analisis', 'public');
        }
        $actualizarAnalisis = $analisis->save();

        if($actualizarAnalisis){
            return redirect()->route('detalle-control', [$id, $id_consulta, $id_control])->with('actualizarAnalisis', 'true');
        }else{
            return redirect()->route('detalle-control', [$id, $id_consulta, $id_control])->with('actualizarAnalisis', 'false');
        }
    }

    public function mostrarAnalisis(Request $request){
        $idUsuario = $request->session()->get('id');
        $analisis = Usuario::join('especialidades', 'especialidades.id_usuario', '=', 'usuarios.id')
                            ->join('consultas', 'consultas.id_especialidad', '=', 'especialidades.id')
                            ->join('controles', 'controles.id_consulta', '=', 'consultas.id')
                            ->join('analisis', 'analisis.id_control', '=', 'controles.id')
                            ->where('usuarios.id', '=', $idUsuario)
                            ->select('analisis.*')
                            ->get();

        return view('antecedentes.analisis', ['analisis' => $analisis]);
    }
}
