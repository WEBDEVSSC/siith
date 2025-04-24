<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatOcupacionCors extends Model
{
    protected $table = 'cat_ocupaciones_cors';

    protected $fillable = [
        'unidad',
        'area',
        'subarea_servicio',
        'componente',
        'ocupacion',
        'orden',
    ];
}
