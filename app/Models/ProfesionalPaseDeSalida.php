<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfesionalPaseDeSalida extends Model
{
    //
    protected $table = 'profesionales_pases_de_salida';

    protected $fillable = [
        'id_profesional',
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'nomina',
        'id_autoriza',
        'nombre_autoriza',
        'tipo',
        'fecha',
        'tiempo_autorizado',
        'hora_inicio',
        'hora_final',
        'status',
        'folio',
    ];

    protected $casts = [
        'fecha' => 'date',
        'hora_inicio' => 'datetime:H:i:s',
        'hora_final' => 'datetime:H:i:s',
        'status' => 'boolean',
    ];

    /**
     * Relación con el modelo ProfesionalDatosGenerales
     */
    public function profesional()
    {
        return $this->belongsTo(Profesional::class, 'id_profesional');
    }
}
