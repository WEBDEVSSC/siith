<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatOcupacionEnsenanza extends Model
{
    // Nombre de la tabla
    protected $table = 'cat_ocupaciones_ensenanza';

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'unidad',
        'area',
        'subarea',
        'ocupacion',
    ];
}
