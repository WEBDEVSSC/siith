<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfesionalFirmaNomina extends Model
{
    //
    protected $table = 'profesionales_firmas_nominas';

    protected $fillable = [
        'curp',
        'cantidad',
        'quincena_numero',
        'concepto',
        'anio',
        'firma',
        'token',
        'status',
    ];

    /**
     * Relación con el modelo ProfesionalDatosGenerales.
     */
    public function profesional()
    {
        return $this->belongsTo(Profesional::class, 'curp', 'curp');
    }
}
