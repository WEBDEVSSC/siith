<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfesionalComisionHistorico extends Model
{
    //
    // Definir la tabla correspondiente
    protected $table = 'profesionales_comision_historico';

    // Definir los campos que pueden ser llenados (asignación masiva)
    protected $fillable = [
        'id_profesional',
        'documento'
    ];

    public function profesional()
    {
        return $this->belongsTo(Profesional::class, 'id');
    }

}
