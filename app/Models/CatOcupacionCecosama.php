<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatOcupacionCecosama extends Model
{
    //
    protected $table = 'cat_ocupaciones_cecosama';

    protected $fillable = [
        'unidad',
        'area',
        'subarea',
        'ocupacion',
        's_area_trabajo',
        's_ocupacion',
        'orden',
    ];
}
