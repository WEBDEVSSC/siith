<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InstitucionPuesto extends Model
{
    protected $table = 'cat_instituciones_puesto'; // Nombre exacto de la tabla

    protected $fillable = ['abreviatura', 'nombre']; // Permite asignación masiva

    public $timestamps = true; // Usa created_at y updated_at
}
