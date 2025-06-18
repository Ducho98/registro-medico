<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Especialidad extends Model
{
    use HasFactory;

    protected $table = 'especialidades';

    public function usuario(){
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }

    public function consultas(){
        return $this->hasMany(Consulta::class, 'id_especialidad');
    }
}
