<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfesionalIne extends Model
{
    // Indicamos explícitamente el nombre de la tabla renombrada
    protected $table = 'profesionales_ine';

    // Campos permitidos para asignación masiva
    protected $fillable = [
        'sid_profesional',
        'clave_elector',
        'seccion',
        'vigencia',
        'dl',
        'df',
    ];

    /**
     * Relación: Un INE pertenece a un registro en profesionales_datos_generales.
     */
    public function profesional()
    {
        return $this->belongsTo(Profesional::class, 'id_profesional', 'id');
    }

    /**
     * Obtiene el Profesional asociado a través de la CURP.
     */
    public function ine()
    {
        return $this->belongsTo(Profesional::class, 'curp', 'curp');
    }
}
