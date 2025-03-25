<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatOcupacionCentroSalud extends Model
{
    //
    protected $table = 'cat_ocupaciones_centros_salud';

    protected $fillable = [
        'unidad',
        'area',
        'subarea',
        'ocupacion',
        'orden',
    ];
}
