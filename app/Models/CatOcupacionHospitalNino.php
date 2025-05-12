<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatOcupacionHospitalNino extends Model
{
    //
    protected $table = 'cat_ocupaciones_hospital_nino';

    protected $fillable = [
        'unidad',
        'area',
        'subarea',
        'ocupacion',
        'orden',
    ];
}
