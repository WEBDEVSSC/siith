<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    // Definimos la tabla que utilizará este modelo
    protected $table = 'cat_municipios';

    // Definimos los campos que pueden ser asignados masivamente
    protected $fillable = [
        'nombre', 
        'relacion',
    ];
}
