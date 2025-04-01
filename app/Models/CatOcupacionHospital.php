<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatOcupacionHospital extends Model
{
    //
    protected $table = 'cat_ocupaciones_hospitales';

    protected $fillable = [
        'unidad', 
        'area', 
        'subarea', 
        'puesto'
    ];
}
