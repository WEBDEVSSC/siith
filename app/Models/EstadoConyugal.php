<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstadoConyugal extends Model
{
    // Definimos la tabla que utilizará este modelo
    protected $table = 'cat_estados_conyugales';

    // Definimos los campos que pueden ser asignados masivamente
    protected $fillable = [
        'estado',  // Campo para el estado civil
    ];
}
