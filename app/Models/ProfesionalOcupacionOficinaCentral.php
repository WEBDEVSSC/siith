<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfesionalOcupacionOficinaCentral extends Model
{
    //
    protected $table = 'profesionales_ocupaciones_oficina_central';

    protected $fillable = [
        'id_profesional',
        'id_catalogo_uno',
        'area_uno',
        'subarea_uno',
        'programa_uno',
        'componente_uno',
        'ocupacion_uno',
        'id_catalogo_dos',
        'area_dos',
        'subarea_dos',
        'programa_dos',
        'componente_dos',
        'ocupacion_dos',
    ];
}
