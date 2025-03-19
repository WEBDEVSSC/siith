<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carrera extends Model
{
    //
    protected $table = 'cat_carreras';

    protected $fillable = [
        'carrera',
    ];
}
