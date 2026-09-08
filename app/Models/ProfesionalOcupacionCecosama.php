<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfesionalOcupacionCecosama extends Model
{
    //
    protected $table = 'profesionales_ocupaciones_cecosama';

    protected $fillable = [
        'id_profesional',
        'id_catalogo',
        'unidad',
        'area',
        'subarea',
        'ocupacion',
        's_area_trabajo',
        's_ocupacion',
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
