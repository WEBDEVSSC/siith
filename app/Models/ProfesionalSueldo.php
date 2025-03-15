<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfesionalSueldo extends Model
{
    protected $table = 'profesionales_sueldos';

    protected $fillable = [
        'id_profesional',
        'sueldo_mensual',
        'compensaciones',
        'prestaciones_mandato_ley',
        'prestaciones_cgt',
        'estimulos',
        'total',
        'mdl_sueldo',
    ];
}
