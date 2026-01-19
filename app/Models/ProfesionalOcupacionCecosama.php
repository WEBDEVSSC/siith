<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfesionalOcupacionCecosama extends Model
{
    //
    protected $table = 'profesionales_ocupaciones_cecosama';

    protected $fillable = [
        'id_profesional',
        'id_catalogo',
        'unidad',
        'area',
        'subarea',
        'ocupacion',
        'mdl_status',
    ];
}
