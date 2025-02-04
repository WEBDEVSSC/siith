<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entidad extends Model
{
    // Definimos la tabla a la que corresponde este modelo
    protected $table = 'cat_entidades';

    // Definimos los campos que pueden ser asignados masivamente
    protected $fillable = [
        'nombre', 
        'abreviacion',
    ];
}
