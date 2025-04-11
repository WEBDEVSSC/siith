<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatOcupacionOficinaCentral extends Model
{
    //
    protected $table = 'cat_ocupaciones_oficina_central';

    protected $fillable = [
        'area',
        'subarea',
        'programa',
        'componente',
        'ocupacion',
        'orden',
    ];
}
