<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    use HasFactory;

    protected $table = 'consultas';

    public function especialidad(){
        return $this->belongsTo(Especialidad::class, 'id_especialidad');
    }

    public function controles(){
        return $this->hasMany(Control::class, 'id_consulta');
    }
}
