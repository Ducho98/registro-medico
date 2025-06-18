<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Control extends Model
{
    use HasFactory;

    protected $table = 'controles';

    public function consulta(){
        return $this->belongsTo(Consulta::class, 'id_consulta');
    }

    public function sintomas(){
        return $this->hasMany(Sintoma::class, 'id_control');
    }

    public function diagnosticos(){
        return $this->hasMany(Diagnostico::class, 'id_control');
    }

    public function analisis(){
        return $this->hasMany(Analisis::class, 'id_control');
    }

    public function recetas(){
        return $this->hasMany(Receta::class, 'id_control');
    }

    public function tratamientos(){
        return $this->hasMany(Tratamiento::class, 'id_control');
    }

    public function datosRelevantes(){
        return $this->hasMany(DatosRelevantes::class, 'id_control');
    }
}
