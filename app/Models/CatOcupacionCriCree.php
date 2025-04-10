<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatOcupacionCriCree extends Model
{
    //
    protected $table = 'cat_ocupaciones_cri_cree';

    protected $fillable = [
        'unidad',
        'area',
        'subarea',
        'ocupacion',
        'orden',
    ];
}
