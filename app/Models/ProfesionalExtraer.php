<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfesionalExtraer extends Model
{
    //
    protected $table = 'profesionales_extraer';

    /**
     * Los atributos que se pueden asignar de forma masiva.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'archivo',
        'tipo',
        'curp',
        'seccion',
        'vigencia',
    ];
}
