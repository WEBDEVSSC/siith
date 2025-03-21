<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfesionalCertificacion extends Model
{
    //
    protected $table = 'profesionales_certificaciones';

    protected $fillable = [
        'id_profesional',
        'colegiacion_id',
        'colegiacion_label',
        'certificacion_id',
        'certificacion_label',
        'idioma_id',
        'idioma_label',
        'nivel_de_dominio',
        'lengua_indigena_id',
        'lengua_indigena_label',
        'mdl_certificacion',
    ];
}
