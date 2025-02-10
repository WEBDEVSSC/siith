<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{
    protected $table = 'cat_actividades'; // Especifica la tabla en la base de datos

    protected $fillable = ['actividad']; // Campos que pueden ser asignados masivamente
}
