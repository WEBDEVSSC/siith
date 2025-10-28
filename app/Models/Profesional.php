<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profesional extends Model
{
    // Definir la tabla correspondiente
    protected $table = 'profesionales_datos_generales';

    // Definir los campos que pueden ser llenados (asignación masiva)
    protected $fillable = [
        'id',
        'curp',
        'rfc',
        'homoclave',
        'sexo',
        'nombre',
        'apellido_paterno',
        'apellido_materno',        
        'fecha_nacimiento',
        'entidad_nacimiento',
        'municipio_nacimiento',
        'pais_nacimiento',
        'nacionalidad',
        'estado_conyugal',
        'telefono_casa',
        'celular',
        'email',
        'padre_madre_familia',
        'capturado_id',
        'capturado_label',
        'mdl_datos_generales',
    ];

    // Opcional: Definir los campos que deben ser tratados como fechas (Laravel los convierte en objetos Carbon)
    protected $dates = [
        'fecha_nacimiento',
    ];

    // Mutadores para guardar datos

    public function setHomoclaveAttribute($value)
    {
        $this->attributes['homoclave'] = strtoupper($value);
    }

    public function setNombreAttribute($value)
    {
        $this->attributes['nombre'] = strtoupper($value);
    }

    public function setApellidoPaternoAttribute($value)
    {
        $this->attributes['apellido_paterno'] = strtoupper($value);
    }

    public function setApellidoMaternoAttribute($value)
    {
        $this->attributes['apellido_materno'] = strtoupper($value);
    }

    public function setCorreoElectronicoAttribute($value)
    {
        $this->attributes['email'] = strtoupper($value);
    }

    /****************************************************************************************** */

    public function user()
    {
        return $this->hasOne(User::class, 'id_profesional');
    }

    /****************************************************************************************** */

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

    public function emergencia()
    {
        return $this->hasOne(ProfesionalEmergencia::class,'id_profesional');
    }

    public function cambiosDeUnidad()
    {
        return $this->hasMany(ProfesionalCambioDeUnidad::class, 'id_profesional');
    }

    public function bitacoras()
    {
        return $this->hasMany(ProfesionalBitacora::class, 'id_profesional');
    }

    public function vigencias()
    {
        return $this->hasMany(ProfesionalVigencia::class, 'id_profesional', 'id');
    }

    public function cambioTipoNomina()
    {
        return $this->hasMany(ProfesionalCambioTipoNomina::class, 'id_profesional', 'id');
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

    public function ocupacionCriCree()
    {
        return $this->hasOne(ProfesionalOcupacionCriCree::class,'id_profesional');
    }

    public function ocupacionSamuCrum()
    {
        return $this->hasOne(ProfesionalOcupacionSamuCrum::class,'id_profesional');
    }

    public function ocupacionOficinaCentral()
    {
        return $this->hasOne(ProfesionalOcupacionOficinaCentral::class,'id_profesional');
    }

    public function ocupacionAlmacen()
    {
        return $this->hasOne(ProfesionalOcupacionAlmacen::class,'id_profesional');
    }

    public function ocupacionCetsLesp()
    {
        return $this->hasOne(ProfesionalOcupacionCetsLesp::class,'id_profesional');
    }

    public function ocupacionCors()
    {
        return $this->hasOne(ProfesionalOcupacionCors::class,'id_profesional');
    }

    public function ocupacionCesame()
    {
        return $this->hasOne(ProfesionalOcupacionCesame::class,'id_profesional');
    }

    public function ocupacionPsiParras()
    {
        return $this->hasOne(ProfesionalOcupacionPsiParras::class,'id_profesional');
    }

    public function ocupacionCeam()
    {
        return $this->hasOne(ProfesionalOcupacionCeam::class,'id_profesional');
    }

    public function ocupacionHospitalNino()
    {
        return $this->hasOne(ProfesionalOcupacionHospitalNino::class,'id_profesional');
    }

    public function ocupacionIssreei()
    {
        return $this->hasOne(ProfesionalOcupacionIssreei::class,'id_profesional');
    }

    public function ocupacionEnsenanza()
    {
        return $this->hasOne(ProfesionalOcupacionEnsenanza::class,'id_profesional');
    }

    /** PASES DE SALIDA */
    public function pasesDeSalida()
    {
        return $this->hasMany(ProfesionalPaseDeSalida::class, 'id_profesional')
                    ->orderBy('created_at', 'desc');;
    }

}
