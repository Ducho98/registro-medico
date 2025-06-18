<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sintoma extends Model
{
    use HasFactory;

    protected $table = 'sintomas';

    public function control(){
        return $this->belongsTo(Control::class, 'id_control');
    }
}
