<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfesionalOcupacionHospital extends Model
{
    //
    protected $table = 'profesionales_ocupaciones_hospitales';

    protected $fillable = [
        'id_profesional',
        'id_catalogo_uno',
        'unidad_uno',
        'area_uno',
        'subarea_uno',
        'puesto_uno',
        'id_catalogo_dos',
        'unidad_dos',
        'area_dos',
        'subarea_dos',
        'puesto_dos',
        'mdl_status',
    ];
}
