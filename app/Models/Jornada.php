<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jornada extends Model
{
    //
    protected $table = 'cat_jornadas';

    protected $fillable = [
        'jornada',
        'orden',
    ];
}
