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

    public function puesto()
    {
        return $this->hasOne(ProfesionalPuesto::class, 'id_profesional');
    }

    public function credencializacion()
    {
        return $this->hasOne(ProfesionalCredencializacion::class, 'id_profesional');
    }

    public function horario()
    {
        return $this->hasOne(ProfesionalHorario::class, 'id_profesional');
    }

    public function sueldo()
    {
        return $this->hasOne(ProfesionalSueldo::class,'id_profesional');
    }

    public function gradoAcademico()
    {
        return $this->hasOne(ProfesionalGradoAcademico::class,'id_profesional');
    }

    public function areaMedica()
    {
        return $this->hasOne(ProfesionalAreaMedica::class,'id_profesional');
    }

    public function certificacion()
    {
        return $this->hasOne(ProfesionalCertificacion::class,'id_profesional');
    }

    // MODELOS PARA ASIGANCIONES DE OCUPACION

    public function ocupacionCentroSalud()
    {
        return $this->hasOne(ProfesionalOcupacionCentroSalud::class,'id_profesional');
    }

    public function ocupacionHospital()
    {
        return $this->hasOne(ProfesionalOcupacionHospital::class,'id_profesional');
    }

    public function ocupacionOfJurisidccion()
    {
        return $this->hasOne(ProfesionalOcupacionOfJurisdiccional::class,'id_profesional');
    }
}
