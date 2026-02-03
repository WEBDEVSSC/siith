<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfesionalesDireccion extends Model
{
    //
    protected $table = 'profesionales_direcciones';

    protected $fillable = [
        'id_profesional',
        'calle',
        'numero_exterior',
        'numero_interior',
        'codigo_postal',
        'colonia',
        'municipio',
        'estado'
    ];

    /**
     * Relación con ProfesionalDatosGenerales
     */
    public function profesional()
    {
        return $this->belongsTo(Profesional::class, 'id_profesional');
    }
}
