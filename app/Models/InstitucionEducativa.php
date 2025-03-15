<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InstitucionEducativa extends Model
{
    // Define la tabla que se asociará con este modelo
    protected $table = 'cat_instituciones_educativas';

    // Define los campos que son asignables en masa
    protected $fillable = ['institucion'];
}
