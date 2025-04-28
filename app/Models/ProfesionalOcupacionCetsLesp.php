<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfesionalOcupacionCetsLesp extends Model
{
    //
    protected $table = 'profesionales_ocupaciones_cets_lesp';

    protected $fillable = [
        'id_profesional',
        'id_catalogo_uno',
        'area_uno',
        'subarea_uno',
        'jefatura_programa_uno',
        'componente_uno',
        'ocupacion_uno',
        'id_catalogo_dos',
        'area_dos',
        'subarea_dos',
        'jefatura_programa_dos',
        'componente_dos',
        'ocupacion_dos',
        'mdl_status',
    ];

     // Relación con la tabla profesionales_datos_generales
     public function profesional()
     {
         return $this->belongsTo(Profesional::class, 'id');
     }
}
