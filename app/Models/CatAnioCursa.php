<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatAnioCursa extends Model
{
    //
    protected $table = 'cat_anio_cursa';

    protected $fillable = [
        'anio',
    ];
}
