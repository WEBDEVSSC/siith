<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfesionalOcupacionEnsenanza extends Model
{
    //
    // Nombre de la tabla (opcional si sigue convención)
    protected $table = 'profesionales_ocupaciones_ensenanza';

    // Campos asignables masivamente
    protected $fillable = [
        'id_profesional',
        'id_catalogo',
        'unidad',
        'area',
        'subarea',
        'ocupacion',
        'mdl_status',
    ];

    /**
     * Relación con el modelo ProfesionalDatosGenerales
     */
    public function profesional()
    {
        return $this->belongsTo(Profesional::class, 'id');
    }
}
