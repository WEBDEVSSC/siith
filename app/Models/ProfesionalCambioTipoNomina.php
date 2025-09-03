<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfesionalCambioTipoNomina extends Model
{
    //
     // Nombre de la tabla
    protected $table = 'profesionales_cambios_nomina';

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'id_profesional',
        'nomina_pago',
        'tipo_contrato',
        'tipo_plaza',
        'seguro_salud',
        'codigo_puesto',
        'codigo_puesto_id',
        'codigo_puesto_label',
    ];

    /**
     * Relación con el modelo ProfesionalDatosGenerales
     * Un cambio de nómina pertenece a un profesional
     */
    public function profesional()
    {
        return $this->belongsTo(Profesional::class, 'id');
    }
}
