<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfesionalOcupacionCriCree extends Model
{
    //
    protected $table = 'profesionales_ocupaciones_cri_cree';

    protected $fillable = [
        'id_profesional',
        'id_catalogo_uno',
        'unidad_uno',
        'area_uno',
        'subarea_uno',
        'ocupacion_uno',
        'id_catalogo_dos',
        'unidad_dos',
        'area_dos',
        'subarea_dos',
        'ocupacion_dos',
    ];
}
