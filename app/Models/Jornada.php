<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jornada extends Model
{
    //
    protected $table = 'cat_jornadas';

    protected $primaryKey = 'id';

    protected $fillable = [
        'jornada',
        'jornada_mexico',
        'orden',
    ];

}
