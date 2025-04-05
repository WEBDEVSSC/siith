<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatOcupacionOfJurisdiccional extends Model
{
    //
    protected $table = 'cat_ocupaciones_jurisdicciones';

    protected $fillable = [
        'unidad', 
        'area', 
        'subarea', 
        'servicio',
        'ocupacion'
    ];
}
