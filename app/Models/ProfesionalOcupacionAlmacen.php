<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfesionalOcupacionAlmacen extends Model
{
    //
    protected $table = 'profesionales_ocupaciones_almacen';

    protected $fillable = [
        'id_profesional',
        'id_catalogo_uno',
        'area_uno',
        'subarea_uno',
        'jefatura_uno',
        'departamento_uno',
        'ocupacion_uno',
        'id_catalogo_dos',
        'area_dos',
        'subarea_dos',
        'jefatura_dos',
        'departamento_dos',
        'ocupacion_dos',
        'mdl_status',
    ];
}
