<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfesionalOcupacionCeam extends Model
{
    //
    // Nombre de la tabla (opcional si sigue convención)
    protected $table = 'profesionales_ocupaciones_ceam';

    // Campos asignables masivamente
    protected $fillable = [
        'id_profesional',
        'id_catalogo_uno',
        'unidad_uno',
        'area_uno',
        'subarea_servicio_uno',
        'componente_uno',
        'ocupacion_uno',
        'id_catalogo_dos',
        'unidad_dos',
        'area_dos',
        'subarea_servicio_dos',
        'componente_dos',
        'ocupacion_dos',
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
