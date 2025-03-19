<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfesionalGradoAcademico extends Model
{
    protected $table = 'profesionales_grados_academicos';

    protected $fillable = [
        'id_profesional',
        'cve_grado_uno',
        'grado_academico_uno',
        'titulo_uno_id',
        'titulo_uno',
        'institucion_educativa_uno',
        'institucion_educativa_uno_id',
        'cedula_uno',
        'numero_cedula_uno',
        'reg_nac_prof_uno',
        'cve_grado_dos',
        'grado_academico_dos',
        'titulo_dos_id',
        'titulo_dos',
        'institucion_educativa_dos',
        'institucion_educativa_dos_id',
        'cedula_dos',
        'numero_cedula_dos',
        'reg_nac_prof_dos',
        'mdl_grado_academico',
    ];
}
