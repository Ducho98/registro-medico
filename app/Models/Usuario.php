<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $table = 'usuarios';

    public function especialidades(){
        return $this->hasMany(Especialidad::class, 'id_usuario');
    }

    public function pesos(){
        return $this->hasMany(Peso::class, 'id_usuario');
    }

    public function antecedenteSintomas(){
        return $this->hasMany(AntecedenteSintoma::class, 'id_usuario');
    }
}
