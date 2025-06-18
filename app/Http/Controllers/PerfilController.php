<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class PerfilController extends Controller
{
    public function visualizarPerfil(Request $request){
        $idUsuario = $request->session()->get('id');
        $datosUsuario = Usuario::find($idUsuario);

        return view('perfil', ['datosUsuario' => $datosUsuario]);
    }

    public function actualizarPerfil(Request $request){
        $idUsuario = $request->session()->get('id');
        $datosUsuario = Usuario::find($idUsuario);
        $datosUsuario->nombres = $request->nombres;
        $datosUsuario->apellidos = $request->apellidos;
        $datosUsuario->usuario = $request->usuario;
        $datosUsuario->sexo = $request->sexo;
        $datosUsuario->fecha_nacimiento = $request->fechaNacimiento;
        $actualizarPerfil = $datosUsuario->save();

        if($actualizarPerfil){
            return redirect()->route('ver-perfil')->with('actualizarPerfil', 'true');
        }else{
            return redirect()->route('ver-perfil')->with('actualizarPerfil', 'false');
        }
    }
}
