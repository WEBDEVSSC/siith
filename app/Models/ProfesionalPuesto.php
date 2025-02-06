<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfesionalPuesto extends Model
{
    // Seleccionamos la tabla
    protected $table = 'profesionales_puesto';

    protected $fillable = [
        'id_profesional',
        'fiel',
        'fiel_vigencia',
        'mdl_puesto',
    ];

    // Relación con la tabla profesionales_datos_generales
    public function profesional()
    {
        return $this->belongsTo(Profesional::class, 'id_profesional');
    }
}
