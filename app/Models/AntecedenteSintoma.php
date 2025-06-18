<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AntecedenteSintoma extends Model
{
    use HasFactory;

    protected $table = 'antecedente_sintomas';

    public function usuario(){
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }
}
