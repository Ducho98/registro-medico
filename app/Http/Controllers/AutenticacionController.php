<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class AutenticacionController extends Controller
{
    public function registro(Request $request){
        $validacion = $request->validate([
            'nombres' => 'required',
            'apellidos' => 'required',
            'usuario' => 'required|min:5|unique:usuarios,usuario',
            'sexo' => 'required',
            'fechaNacimiento' => 'required',
            'clave' => 'required|min:5',
            'repetirClave' => 'required|min:5|same:clave'
        ],[
            'nombres.required' => 'El campo nombres es obligatorio.',
            'apellidos.required' => 'El campo apellidos es obligatorio.',
            'usuario.required' => 'El campo usuario es obligatorio',
            'usuario.min' => 'El campo usuario debe tener mínimo 5 caracteres.',
            'usuario.unique' => 'El campo usuario debe ser único.',
            'sexo.required' => 'El campo sexo es obligatorio.',
            'fechaNacimiento.required' => 'El campo fecha de nacimiento es obligatorio.',
            'clave.required' => 'El campo contraseña es obligatorio',
            'clave.min' => 'El campo contraseña debe tener mínimo 5 caracteres.',
            'repetirClave.required' => 'El campo repetir contraseña es obligatorio.',
            'repetirClave.min' => 'El campo repetir contraseña debe tener mínimo 5 caracteres.',
            'repetirClave.same' => 'El campo contraseña y repetir contraseña deben ser iguales.'
        ]);

        if($validacion){
            $usuarios = new Usuario();
            $usuarios->nombres = $request->nombres;
            $usuarios->apellidos = $request->apellidos;
            $usuarios->usuario = $request->usuario;
            $usuarios->sexo = $request->sexo;
            $usuarios->fecha_nacimiento = $request->fechaNacimiento;
            $usuarios->clave = $request->clave;
            $agregarUsuario = $usuarios->save();

            if($agregarUsuario){
                return redirect()->route('registro')->with('exito', 'Usuario creado correctamente');
            }else{
                return redirect()->route('registro')->with('error', 'No se pudo crear el usuario');
            }
        }
    }

    //TODO: FALTA MEJORAR (INVALIDATE, REGENERATE)
    public function login(Request $request){
        $validacion = $request->validate([
            'usuario' => 'required',
            'clave' => 'required'
        ],[
            'usuario.required' => 'El campo usuario es obligatorio.',
            'clave.required' => 'El campo contraseña es obligatorio.'
        ]);

        $usuario = $request->usuario;
        $clave = $request->clave;

        if($validacion){
            $usuarioLogin = Usuario::where('usuario', $usuario)->where('clave', $clave)->first();

            if($usuarioLogin){
                $request->session()->regenerate();
                $request->session()->put('id', $usuarioLogin['id']);
                $request->session()->put('usuario', $usuario);

                return redirect()->route('ver-especialidades');
                //return $request->session()->all();
                //return $request->session()->getId();
            }else{
                return redirect()->route('login')->with('error', 'Su usuario y/o contraseña son incorrectos.');
            }
        }
        
    }

    public function cerrarSesion(Request $request){
        $request->session()->flush();
        //$request->session()->invalidate();
        return redirect('/');
    }
}
