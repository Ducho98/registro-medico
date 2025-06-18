<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peso extends Model
{
    use HasFactory;

    protected $table = 'pesos';

    public function usuario(){
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }
}
