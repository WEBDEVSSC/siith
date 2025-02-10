<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profesional extends Model
{
    // Definir la tabla correspondiente
    protected $table = 'profesionales_datos_generales';

    // Definir los campos que pueden ser llenados (asignación masiva)
    protected $fillable = [
        'curp',
        'rfc',
        'homoclave',
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'sexo',
        'fecha_nacimiento',
        'entidad_nacimiento',
        'municipio_nacimiento',
        'pais_nacimiento',
        'nacionalidad',
        'estado_conyugal',
        'telefono_casa',
        'celular',
        'email',
    ];

    // Opcional: Definir los campos que deben ser tratados como fechas (Laravel los convierte en objetos Carbon)
    protected $dates = [
        'fecha_nacimiento',
    ];

    public function puestos()
    {
        return $this->hasMany(ProfesionalPuesto::class, 'id_profesional');
    }

    public function credencializaciones()
    {
        return $this->hasMany(ProfesionalCredencializacion::class, 'id_profesional');
    }
}
