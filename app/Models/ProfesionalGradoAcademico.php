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

        'cve_grado_tres',
        'grado_academico_tres',
        'titulo_tres_id',
        'titulo_tres',
        'institucion_educativa_tres',
        'institucion_educativa_tres_id',
        'cedula_tres',
        'numero_cedula_tres',
        'reg_nac_prof_tres',

        'cve_grado_cuatro',
        'grado_academico_cuatro',
        'titulo_cuatro_id',
        'titulo_cuatro',
        'institucion_educativa_cuatro',
        'institucion_educativa_cuatro_id',
        'cedula_cuatro',
        'numero_cedula_cuatro',
        'reg_nac_prof_cuatro',

        'mdl_grado_academico',
    ];
}
