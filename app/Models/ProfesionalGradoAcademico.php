<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfesionalGradoAcademico extends Model
{
    protected $table = 'profesionales_grados_academicos';

    protected $fillable = [
        'id_profesional',
        'grado_academico_uno',
        'titulo_uno',
        'institucion_educativa_uno',
        'cedula_uno',
        'numero_cedula_uno',
        'grado_academico_dos',
        'titulo_dos',
        'institucion_educativa_dos',
        'cedula_dos',
        'numero_cedula_dos',
    ];
}
