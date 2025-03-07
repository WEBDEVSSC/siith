<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoPlaza extends Model
{
    protected $table = 'cat_tipos_plaza'; // Nombre exacto de la tabla

    protected $fillable = ['tipo_plaza']; // Permite asignación masiva

    public $timestamps = true; // Usa created_at y updated_at
}
