<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatOcupacionIssreei extends Model
{
    // Nombre de la tabla 
    protected $table = 'cat_ocupaciones_issreei';

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'unidad',
        'area',
        'subarea',
        'ocupacion',
    ];
}
