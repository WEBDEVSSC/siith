<?php

namespace App\Http\Controllers;

use App\Models\CatAlergia;
use App\Models\CatRelacionEmergencia;
use App\Models\CatTipoDeSangre;
use App\Models\Municipio;
use App\Models\Profesional;
use App\Models\ProfesionalBitacora;
use App\Models\ProfesionalEmergencia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfesionalEmergenciaController extends Controller
{
    //

    public function storeDatosGeneralesEmergencia(Request $request)
    {
        $request->validate([
            'id_profesional'=>'required',
            'telefono_celular'=>'required|digits:10',
            'correo_electronico'=>'required|email|max:100',
        ],[
            'telefono_celular.required' => 'El número de teléfono es obligatorio.',
            'telefono_celular.digits'   => 'El número de teléfono debe tener exactamente 10 dígitos.',
            'correo_electronico.required' => 'El correo electrónico es obligatorio.',
            'correo_electronico.email'    => 'Debe ser un correo electrónico válido.',
            'correo_electronico.max'      => 'El correo electrónico no debe exceder los 100 caracteres.',
        ]);

        dd($request->id_profesional);


    }

    public function createEmergencia($id)
    {
        // Consultamos los datos del profesional
        $profesional = Profesional::findOrFail($id);

        // Llenamos el select de ocupaciones
        $tiposDeSangre = CatTipoDeSangre::all();

        // Llenamos el select de tipos de alergias
        $tiposDeAlergia = CatAlergia::all();

        // Llenamos el select de municipios de Coahuila
        $municipios = Municipio::where('relacion',7)->get();

        // Llenamos el select de Contactos de Emergencia
        $relacionesDeEmergencia = CatRelacionEmergencia::all();

        // Retornamos la vista con todos los objetos
        return view('emergencia.create', compact('profesional','tiposDeSangre','tiposDeAlergia','municipios','relacionesDeEmergencia'));
        
    }

    public function storeEmergencia(Request $request)
    {        
        // Validación
    $request->validate([
        'id_profesional' => 'required',

        'telefono_celular'   => 'required|digits:10',
        'correo_electronico' => 'required|email|max:100',

        'tipo_sangre' => 'nullable',
        'tipo_alergia_id' => 'required|integer|in:1,2,3,4,5,6',
        'alergia_descripcion' => 'nullable|string|max:255|required_if:tipo_alergia_id,1,2,3,4,5',

        'enfermedad'    => 'nullable|string',
        'medicamentos'  => 'nullable|string',
        'tratamiento'   => 'nullable|string',
        'medico_nombre' => 'nullable|string',
        'medico_telefono' => 'nullable|string',

        // Emergencias UNO, DOS, TRES
        'emergencia_nombre_uno' => 'nullable|string',
        'emergencia_relacion_uno' => 'nullable|string',
        'emergencia_telefono_uno_uno' => 'nullable|string',
        'emergencia_telefono_dos_uno' => 'nullable|string',
        'emergencia_email_uno' => 'nullable|string',
        'emergencia_calle_uno' => 'nullable|string',
        'emergencia_numero_uno' => 'nullable|string',
        'emergencia_colonia_uno' => 'nullable|string',
        'emergencia_municipio_uno' => 'nullable|integer',

        'emergencia_nombre_dos' => 'nullable|string',
        'emergencia_relacion_dos' => 'nullable|string',
        'emergencia_telefono_uno_dos' => 'nullable|string',
        'emergencia_telefono_dos_dos' => 'nullable|string',
        'emergencia_email_dos' => 'nullable|string',
        'emergencia_calle_dos' => 'nullable|string',
        'emergencia_numero_dos' => 'nullable|string',
        'emergencia_colonia_dos' => 'nullable|string',
        'emergencia_municipio_dos' => 'nullable|integer',

        'emergencia_nombre_tres' => 'nullable|string',
        'emergencia_relacion_tres' => 'nullable|string',
        'emergencia_telefono_uno_tres' => 'nullable|string',
        'emergencia_telefono_dos_tres' => 'nullable|string',
        'emergencia_email_tres' => 'nullable|string',
        'emergencia_calle_tres' => 'nullable|string',
        'emergencia_numero_tres' => 'nullable|string',
        'emergencia_colonia_tres' => 'nullable|string',
        'emergencia_municipio_tres' => 'nullable|integer',
    ]);

    // Tipo de alergia
    $tipoAlergia = null;
    if (!is_null($request->tipo_alergia_id) && $request->tipo_alergia_id != 6) {
        $tipoAlergia = CatAlergia::find($request->tipo_alergia_id);
    }

    // Municipios
    $municipio_uno = $request->emergencia_municipio_uno ? Municipio::find($request->emergencia_municipio_uno) : null;
    $municipio_dos = $request->emergencia_municipio_dos ? Municipio::find($request->emergencia_municipio_dos) : null;
    $municipio_tres = $request->emergencia_municipio_tres ? Municipio::find($request->emergencia_municipio_tres) : null;

    // Guardamos Emergencia
    $emergencia = new ProfesionalEmergencia();

    $emergencia->id_profesional = $request->id_profesional;
    $emergencia->telefono = $request->telefono_celular;
    $emergencia->correo_electronico = $request->correo_electronico;
    $emergencia->tipo_sangre = $request->tipo_sangre;
    $emergencia->tipo_alergia_id = $request->tipo_alergia_id;
    $emergencia->alergia_descripcion = $tipoAlergia ? $tipoAlergia->tipo_alergia : $request->alergia_descripcion;

    $emergencia->enfermedad = $request->enfermedad;
    $emergencia->medicamentos = $request->medicamentos;
    $emergencia->tratamiento = $request->tratamiento;
    $emergencia->medico_nombre = $request->medico_nombre;
    $emergencia->medico_telefono = $request->medico_telefono;

    // Emergencia UNO
    $emergencia->emergencia_nombre_uno = $request->emergencia_nombre_uno;
    $emergencia->emergencia_relacion_uno = $request->emergencia_relacion_uno;
    $emergencia->emergencia_telefono_uno_uno = $request->emergencia_telefono_uno_uno;
    $emergencia->emergencia_telefono_dos_uno = $request->emergencia_telefono_dos_uno;
    $emergencia->emergencia_email_uno = $request->emergencia_email_uno;
    $emergencia->emergencia_calle_uno = $request->emergencia_calle_uno;
    $emergencia->emergencia_numero_uno = $request->emergencia_numero_uno;
    $emergencia->emergencia_colonia_uno = $request->emergencia_colonia_uno;
    $emergencia->emergencia_municipio_id_uno = $request->emergencia_municipio_uno;
    $emergencia->emergencia_municipio_label_uno = $municipio_uno?->nombre;

    // Emergencia DOS
    $emergencia->emergencia_nombre_dos = $request->emergencia_nombre_dos;
    $emergencia->emergencia_relacion_dos = $request->emergencia_relacion_dos;
    $emergencia->emergencia_telefono_uno_dos = $request->emergencia_telefono_uno_dos;
    $emergencia->emergencia_telefono_dos_dos = $request->emergencia_telefono_dos_dos;
    $emergencia->emergencia_email_dos = $request->emergencia_email_dos;
    $emergencia->emergencia_calle_dos = $request->emergencia_calle_dos;
    $emergencia->emergencia_numero_dos = $request->emergencia_numero_dos;
    $emergencia->emergencia_colonia_dos = $request->emergencia_colonia_dos;
    $emergencia->emergencia_municipio_id_dos = $request->emergencia_municipio_dos;
    $emergencia->emergencia_municipio_label_dos = $municipio_dos?->nombre;

    // Emergencia TRES
    $emergencia->emergencia_nombre_tres = $request->emergencia_nombre_tres;
    $emergencia->emergencia_relacion_tres = $request->emergencia_relacion_tres;
    $emergencia->emergencia_telefono_uno_tres = $request->emergencia_telefono_uno_tres;
    $emergencia->emergencia_telefono_dos_tres = $request->emergencia_telefono_dos_tres;
    $emergencia->emergencia_email_tres = $request->emergencia_email_tres;
    $emergencia->emergencia_calle_tres = $request->emergencia_calle_tres;
    $emergencia->emergencia_numero_tres = $request->emergencia_numero_tres;
    $emergencia->emergencia_colonia_tres = $request->emergencia_colonia_tres;
    $emergencia->emergencia_municipio_id_tres = $request->emergencia_municipio_tres;
    $emergencia->emergencia_municipio_label_tres = $municipio_tres?->nombre;

    $emergencia->mdl_emergencia = 1;
    $emergencia->save();

    // Bitácora
    $usuario = Auth::user();

    ProfesionalBitacora::create([
        'id_capturista' => $usuario->id,
        'capturista_label' => $usuario->responsable,
        'accion' => "NUEVO REGISTRO EN MODULO EMERGENCIA",
        'id_profesional' => $request->id_profesional,
    ]);

    // Actualizamos Datos Generales
    $datosGenerales = Profesional::findOrFail($request->id_profesional);
    $datosGenerales->celular = $request->telefono_celular;
    $datosGenerales->email = $request->correo_electronico;
    $datosGenerales->save();

    return redirect()->route('profesionalShow', $request->id_profesional)
        ->with('success', 'Registro realizado correctamente.');
        
    }
}
