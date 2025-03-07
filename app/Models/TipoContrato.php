<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoContrato extends Model
{
    //
    protected $table = 'cat_tipos_contrato'; // Nombre de la tabla

    protected $fillable = ['tipo_contrato']; // Campos permitidos para asignación masiva

    public $timestamps = true; // Habilita created_at y updated_at
}
