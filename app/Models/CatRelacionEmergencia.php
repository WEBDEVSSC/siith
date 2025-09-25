<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatRelacionEmergencia extends Model
{
    //
    protected $table = 'cat_relacion_emergencia';

    protected $fillable = [
        'relacion',
    ];
}
