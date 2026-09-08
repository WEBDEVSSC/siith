<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfesionalOcupacionCesame extends Model
{
    //
    protected $table = 'profesionales_ocupaciones_cesame';

    protected $fillable = [
        'id_profesional',
        'id_catalogo_uno',
        'unidad_uno',
        'area_uno',
        'subarea_servicio_uno',
        'componente_uno',
        'ocupacion_uno',
        's_area_trabajo_uno',
        's_ocupacion_uno',
        'id_catalogo_dos',
        'unidad_dos',
        'area_dos',
        'subarea_servicio_dos',
        'componente_dos',
        'ocupacion_dos',
        's_area_trabajo_dos',
        's_ocupacion_dos',
        'mdl_status',
    ];

    // Relación con la tabla profesionales_datos_generales
    public function profesional()
    {
        return $this->belongsTo(Profesional::class, 'id');
    }
}
