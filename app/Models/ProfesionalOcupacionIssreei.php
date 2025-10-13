<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfesionalOcupacionIssreei extends Model
{
    // Nombre de la tabla
    protected $table = 'profesionales_ocupaciones_issreei';

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'id_profesional',
        'id_catalogo_uno',
        'unidad_uno',
        'area_uno',
        'subarea_uno',
        'ocupacion_uno',
        'mdl_status',
    ];

    // Relación con ProfesionalDatoGeneral
    public function profesional()
    {
        return $this->belongsTo(Profesional::class, 'id_profesional');
    }
}
