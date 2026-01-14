<?php

namespace App\Models;

use App\Casts\Uppercase;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profesional extends Model
{
    use SoftDeletes;    

    // Definir la tabla correspondiente
    protected $table = 'profesionales_datos_generales';

    // Definir los campos que pueden ser llenados (asignación masiva)
    protected $fillable = [
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

    // Uppercase para mutar los textos
    protected $casts = [
        'fecha_nacimiento' => 'date',
        'homoclave' => Uppercase::class,
        'nombre' => Uppercase::class,
        'apellido_paterno' => Uppercase::class,
        'apellido_materno' => Uppercase::class,
        'email' => Uppercase::class,
    ];

    /****************************************************************************************** */

    public function user()
    {
        return $this->hasOne(User::class, 'id_profesional');
    }

    /****************************************************************************************** */

    /*public function puesto()
    {
        return $this->hasOne(ProfesionalPuesto::class, 'id_profesional');
    }*/

    public function puesto()
    {
        return $this->hasOne(ProfesionalPuesto::class, 'id_profesional', 'id');
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

    public function ocupacionIssreei()
    {
        return $this->hasOne(ProfesionalOcupacionIssreei::class,'id_profesional');
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

    public function ocupacionEnsenanza()
    {
        return $this->hasOne(ProfesionalOcupacionEnsenanza::class,'id_profesional');
    }

    /** PASES DE SALIDA */
    public function pasesDeSalida()
    {
        return $this->hasMany(ProfesionalPaseDeSalida::class, 'id_profesional')
                    ->orderBy('created_at', 'desc');
    }

    public function comisionesHistorico()
    {
        return $this->hasMany(ProfesionalComisionHistorico::class, 'id_profesional')
                    ->orderBy('id', 'desc');;
    }

    /***
     * 
     * 
     * ARREGLO PARA RELACIONAR LA CLAVE DE LA ENTIDAD DE NACIMIENTO
     * 
     */

    public function entidadNacimiento()
    {
        return $this->belongsTo(
            Entidad::class,
            'entidad_nacimiento', // campo LOCAL
            'nombre'              // campo en cat_entidades
        );
    }

    public function datosGenerales()
    {
        return $this->hasOne(
            Profesional::class,
            'id'
        );
    }

}
