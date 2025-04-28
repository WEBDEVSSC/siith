<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatOcupacionCetsLesp extends Model
{
    //
    protected $table = 'cat_ocupaciones_cets_lesp';

    protected $fillable = [
        'area',
        'subarea',
        'jefatura_programa',
        'componente',
        'ocupacion',
        'orden',
    ];
}
