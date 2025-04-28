<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatOcupacionCesame extends Model
{
    protected $table = 'cat_ocupaciones_cesame';

    protected $fillable = [
        'unidad',
        'area',
        'subarea_servicio',
        'componente',
        'ocupacion',
        'orden',
    ];
}
