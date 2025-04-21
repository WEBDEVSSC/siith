<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfesionalCambioDeUnidad extends Model
{
    //

    protected $table = 'profesionales_cambios_de_unidad';

    protected $fillable = [
        'id_profesional',
        'tipo_movimiento_id',
        'tipo_movimiento',
        'documento_respaldo',
        'fecha_inicio',
        'fecha_final',
        'unidad_origen_clues',
        'unidad_origen_nombre',
        'unidad_origen_jurisdiccion',
        'unidad_destino_clues',
        'unidad_destino_nombre',
        'unidad_destino_jurisdiccion',
    ];

    // Relación inversa: muchos cambios pertenecen a un profesional
    public function profesional()
    {
        return $this->belongsTo(Profesional::class, 'id_profesional');
    }
}
