<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfesionalBitacoraCartera extends Model
{
    //
    protected $table = 'profesionales_bitacoras_cartera';

    protected $fillable = [
        'id_profesional',
        'ocupacion_anterior',
        'id_capturista',
        'capturista_label'
    ];

    /**
     * Relación con el profesional
     */
    public function profesional()
    {
        return $this->belongsTo(Profesional::class, 'id_profesional');
    }
}
