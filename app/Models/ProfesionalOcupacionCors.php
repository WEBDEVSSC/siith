<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfesionalOcupacionCors extends Model
{
    //
    protected $table = 'profesionales_ocupaciones_cors';

    protected $fillable = [
        'id_profesional',
        'id_catalogo_uno',
        'unidad_uno',
        'area_uno',
        'subarea_servicio_uno',
        'componente_uno',
        'ocupacion_uno',
        'id_catalogo_dos',
        'unidad_dos',
        'area_dos',
        'subarea_servicio_dos',
        'componente_dos',
        'ocupacion_dos',
        'mdl_status',
    ];
}
