<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DatosRelevantes extends Model
{
    use HasFactory;

    protected $table = 'datos_relevantes';

    public function control(){
        return $this->belongsTo(Control::class, 'id_control');
    }
}
