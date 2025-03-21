<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfesionalAreaMedica extends Model
{
    //
    protected $table = 'profesionales_areas_medicas';

    protected $fillable = [
        'id_profesional',
        'tipo_formacion',
        'tipo_formacion_id',
        'tipo_formacion_label',
        'carrera_id',
        'carrera_label',
        'institucion_educativa_id',
        'institucion_educativa_label',
        'anio_cursa',
        'duracion_formacion',
    ];
}
