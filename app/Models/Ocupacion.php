<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ocupacion extends Model
{
    protected $table = 'cat_ocupaciones';

    protected $fillable = [
        'ocupacion',
    ];
}
