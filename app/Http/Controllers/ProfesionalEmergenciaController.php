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
        'emergencia_nombre_uno' => 'nullable|string|max:128',
        'emergencia_relacion_uno' => 'nullable|string',
        'emergencia_telefono_uno_uno' => 'nullable|string|digits:10',
        'emergencia_telefono_dos_uno' => 'nullable|string|digits:10',
        'emergencia_email_uno' => 'nullable|string|email|max:100',
        'emergencia_calle_uno' => 'nullable|string|max:128',
        'emergencia_numero_uno' => 'nullable|string|max:128',
        'emergencia_colonia_uno' => 'nullable|string|max:128',
        'emergencia_codigo_postal_uno' => 'nullable|string|max:5',
        'emergencia_municipio_uno' => 'nullable|integer',

        'emergencia_nombre_dos' => 'nullable|string|max:128',
        'emergencia_relacion_dos' => 'nullable|string',
        'emergencia_telefono_uno_dos' => 'nullable|string|digits:10',
        'emergencia_telefono_dos_dos' => 'nullable|string|digits:10',
        'emergencia_email_dos' => 'nullable|string|email|max:100',
        'emergencia_calle_dos' => 'nullable|string|max:128',
        'emergencia_numero_dos' => 'nullable|string|max:128',
        'emergencia_colonia_dos' => 'nullable|string|max:128',
        'emergencia_codigo_postal_dos' => 'nullable|string|max:5',
        'emergencia_municipio_dos' => 'nullable|integer',

        'emergencia_nombre_tres' => 'nullable|string|max:128',
        'emergencia_relacion_tres' => 'nullable|string',
        'emergencia_telefono_uno_tres' => 'nullable|string|digits:10',
        'emergencia_telefono_dos_tres' => 'nullable|string|digits:10',
        'emergencia_email_tres' => 'nullable|string|email|max:100',
        'emergencia_calle_tres' => 'nullable|string|max:128',
        'emergencia_numero_tres' => 'nullable|string|max:128',
        'emergencia_colonia_tres' => 'nullable|string|max:128',
        'emergencia_codigo_postal_tres' => 'nullable|string|max:5',
        'emergencia_municipio_tres' => 'nullable|integer',
    ],[
        // --- Mensajes personalizados ---
        'id_profesional.required' => 'El campo profesional es obligatorio.',

        'telefono_celular.required' => 'El teléfono celular es obligatorio.',
        'telefono_celular.digits'   => 'El teléfono celular debe tener exactamente 10 dígitos.',

        'correo_electronico.required' => 'El correo electrónico es obligatorio.',
        'correo_electronico.email'    => 'Debe ingresar un correo electrónico válido.',
        'correo_electronico.max'      => 'El correo electrónico no debe superar los 100 caracteres.',

        'tipo_alergia_id.required' => 'Debe seleccionar un tipo de alergia.',
        'tipo_alergia_id.in'       => 'El tipo de alergia seleccionado no es válido.',

        'alergia_descripcion.required_if' => 'Debe especificar la alergia cuando se selecciona un tipo de alergia.',
        'alergia_descripcion.max'         => 'La descripción de la alergia no debe superar los 255 caracteres.',

        // Emergencias
        'emergencia_telefono_uno_uno.digits' => 'El teléfono de emergencia (1.1) debe tener 10 dígitos.',
        'emergencia_telefono_dos_uno.digits' => 'El teléfono de emergencia (1.2) debe tener 10 dígitos.',
        'emergencia_email_uno.email'         => 'El correo de emergencia (1) debe ser válido.',
        'emergencia_email_uno.max'           => 'El correo de emergencia (1) no debe superar los 100 caracteres.',

        'emergencia_telefono_uno_dos.digits' => 'El teléfono de emergencia (2.1) debe tener 10 dígitos.',
        'emergencia_telefono_dos_dos.digits' => 'El teléfono de emergencia (2.2) debe tener 10 dígitos.',
        'emergencia_email_dos.email'         => 'El correo de emergencia (2) debe ser válido.',
        'emergencia_email_dos.max'           => 'El correo de emergencia (2) no debe superar los 100 caracteres.',

        'emergencia_telefono_uno_tres.digits' => 'El teléfono de emergencia (3.1) debe tener 10 dígitos.',
        'emergencia_telefono_dos_tres.digits' => 'El teléfono de emergencia (3.2) debe tener 10 dígitos.',
        'emergencia_email_tres.email'         => 'El correo de emergencia (3) debe ser válido.',
        'emergencia_email_tres.max'           => 'El correo de emergencia (3) no debe superar los 100 caracteres.',
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

    // Parentesco
    $emergencia_relacion_uno = $request->emergencia_relacion_uno ? CatRelacionEmergencia::find($request->emergencia_relacion_uno) : null;
    $emergencia_relacion_dos = $request->emergencia_relacion_dos ? CatRelacionEmergencia::find($request->emergencia_relacion_dos) : null;
    $emergencia_relacion_tres = $request->emergencia_relacion_tres ? CatRelacionEmergencia::find($request->emergencia_relacion_tres) : null;

    // Guardamos Emergencia
    $emergencia = new ProfesionalEmergencia();

    $emergencia->id_profesional = $request->id_profesional;
    $emergencia->telefono = $request->telefono_celular;
    $emergencia->correo_electronico = $request->correo_electronico;
    $emergencia->tipo_sangre = $request->tipo_sangre;
    $emergencia->tipo_alergia_id = $request->tipo_alergia_id;
    $emergencia->tipo_alergia = $tipoAlergia ? $tipoAlergia->tipo_alergia : $request->tipo_alergia_id;
    $emergencia->alergia_descripcion = $tipoAlergia ? $tipoAlergia->tipo_alergia : $request->alergia_descripcion;

    $emergencia->enfermedad = $request->enfermedad;
    $emergencia->medicamentos = $request->medicamentos;
    $emergencia->tratamiento = $request->tratamiento;
    $emergencia->medico_nombre = $request->medico_nombre;
    $emergencia->medico_telefono = $request->medico_telefono;

    // Emergencia UNO
    $emergencia->emergencia_nombre_uno = $request->emergencia_nombre_uno;
    $emergencia->emergencia_relacion_uno_id = $request->emergencia_relacion_uno;
    $emergencia->emergencia_relacion_uno = $emergencia_relacion_uno->relacion;
    $emergencia->emergencia_telefono_uno_uno = $request->emergencia_telefono_uno_uno;
    $emergencia->emergencia_telefono_dos_uno = $request->emergencia_telefono_dos_uno;
    $emergencia->emergencia_email_uno = $request->emergencia_email_uno;
    $emergencia->emergencia_calle_uno = $request->emergencia_calle_uno;
    $emergencia->emergencia_numero_uno = $request->emergencia_numero_uno;
    $emergencia->emergencia_colonia_uno = $request->emergencia_colonia_uno;
    $emergencia->emergencia_codigo_postal_uno = $request->emergencia_codigo_postal_uno;
    $emergencia->emergencia_municipio_id_uno = $request->emergencia_municipio_uno;
    $emergencia->emergencia_municipio_label_uno = $municipio_uno?->nombre;

    // Emergencia DOS
    $emergencia->emergencia_nombre_dos = $request->emergencia_nombre_dos;
    $emergencia->emergencia_relacion_dos_id = $request->emergencia_relacion_dos;
    $emergencia->emergencia_relacion_dos = $emergencia_relacion_dos->relacion;
    $emergencia->emergencia_telefono_uno_dos = $request->emergencia_telefono_uno_dos;
    $emergencia->emergencia_telefono_dos_dos = $request->emergencia_telefono_dos_dos;
    $emergencia->emergencia_email_dos = $request->emergencia_email_dos;
    $emergencia->emergencia_calle_dos = $request->emergencia_calle_dos;
    $emergencia->emergencia_numero_dos = $request->emergencia_numero_dos;
    $emergencia->emergencia_colonia_dos = $request->emergencia_colonia_dos;
    $emergencia->emergencia_codigo_postal_dos = $request->emergencia_codigo_postal_dos;
    $emergencia->emergencia_municipio_id_dos = $request->emergencia_municipio_dos;
    $emergencia->emergencia_municipio_label_dos = $municipio_dos?->nombre;

    // Emergencia TRES
    $emergencia->emergencia_nombre_tres = $request->emergencia_nombre_tres;
    $emergencia->emergencia_relacion_tres_id = $request->emergencia_relacion_tres;
    $emergencia->emergencia_relacion_tres = $emergencia_relacion_tres->relacion;
    $emergencia->emergencia_telefono_uno_tres = $request->emergencia_telefono_uno_tres;
    $emergencia->emergencia_telefono_dos_tres = $request->emergencia_telefono_dos_tres;
    $emergencia->emergencia_email_tres = $request->emergencia_email_tres;
    $emergencia->emergencia_calle_tres = $request->emergencia_calle_tres;
    $emergencia->emergencia_numero_tres = $request->emergencia_numero_tres;
    $emergencia->emergencia_colonia_tres = $request->emergencia_colonia_tres;
    $emergencia->emergencia_codigo_postal_tres = $request->emergencia_codigo_postal_tres;
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

    public function editEmergencia($id)
    {   
        // Consultamos el registro por el id profesional     
        $emergencia = ProfesionalEmergencia::where('id_profesional',$id)->firstOrFail();

        // Buscamos el profesional
        $profesional = Profesional::where('id',$emergencia->id_profesional)->firstOrFail();

        $credencializacion = $profesional->credencializacion;
        $fotografia = $credencializacion ? $credencializacion->fotografia : null;

        // Generamos la URL de la fotografía desde storage
        $fotoUrl = $fotografia 
            ? asset('storage/credencializacion/thumbs/' . $fotografia) 
            : null;


        // Llenamos el select de ocupaciones
        $tiposDeSangre = CatTipoDeSangre::all();

        // Llenamos el select de tipos de alergias
        $tiposDeAlergia = CatAlergia::all();

        // Llenamos el select de municipios de Coahuila
        $municipios = Municipio::where('relacion',7)->get();

        // Llenamos el select de Contactos de Emergencia
        $relacionesDeEmergencia = CatRelacionEmergencia::all();

        // Retornamos la vista con todos los objetos
        return view('emergencia.edit', compact('profesional','fotoUrl','emergencia','tiposDeSangre','tiposDeAlergia','municipios','relacionesDeEmergencia'));
    }
}
