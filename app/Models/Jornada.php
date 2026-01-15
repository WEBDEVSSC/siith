<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jornada extends Model
{
    //
    protected $table = 'cat_jornadas';

    protected $fillable = [
        'jornada',
        'jornada_mexico',
        'orden',
    ];

    /***
     * 
     * 
     * ARREGLO INVERSO PARA MMOSTRAR LA CLAVE DE LA ENTIDAD
     * 
     * 
     */

    public function profesionalesHorarios()
    {
        return $this->hasMany(ProfesionalHorario::class, 'id_jornada', 'id');
    }
}
