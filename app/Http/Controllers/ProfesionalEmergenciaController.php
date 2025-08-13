<?php

namespace App\Http\Controllers;

use App\Models\CatAlergia;
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

        // Retornamos la vista con todos los objetos
        return view('emergencia.create', compact('profesional','tiposDeSangre','tiposDeAlergia','municipios'));
        
    }

    public function storeEmergencia(Request $request)
    {        
        //dd($request->tipo_alergia_id);
        
        $request->validate([
            'id_profesional'                    =>'required',
            'tipo_sangre'                       =>'nullable',

            //'tipo_alergia_id'=> 'required|integer',
            //'alergia_descripcion'=> 'nullable|string',

            'tipo_alergia_id' => 'required|integer|in:1,2,3,4,5,6',
            'alergia_descripcion' => 'nullable|string|max:255|required_if:tipo_alergia_id,1,2,3,4,5',

            'enfermedad'                        =>'nullable|string',
            'medicamentos'                      =>'nullable|string',
            'tratamiento'                       =>'nullable|string',
            'medico_nombre'                     =>'nullable|string',
            'medico_telefono'                   =>'nullable|string',
            
            'emergencia_nombre'                 =>'required|string',
            'emergencia_relacion'               =>'required|string',
            'emergencia_telefono_uno'           =>'required|string',
            'emergencia_telefono_dos'           =>'required|string',
            'emergencia_email'                  =>'required|string',
            'emergencia_calle'                  =>'required|string',
            'emergencia_numero'                 =>'required|string',
            'emergencia_colonia'                =>'required|string',
            'emergencia_municipio'              =>'required|string',
        ],[
            'id_profesional.required'           => 'El campo profesional es obligatorio.',
            
            'tipo_alergia_id.required'          => 'El campo es obligatorio',
            'tipo_alergia_id.in'                => 'El tipo de alergia seleccionado no es válido.',
            'alergia_descripcion.required_if'   => 'La descripción de la alergia es obligatoria',
            'alergia_descripcion.string'        => 'La descripción de la alergia debe ser texto.',
            'alergia_descripcion.max'           => 'La descripción de la alergia no debe exceder los 255 caracteres.',
            
            'enfermedad.string'                 => 'La enfermedad debe ser texto.',
            'medicamentos.string'               => 'Los medicamentos deben ser texto.',
            'tratamiento.string'                => 'El tratamiento debe ser texto.',
            'medico_nombre.string'              => 'El nombre del médico debe ser texto.',
            'medico_telefono.string'            => 'El teléfono del médico debe ser texto.',
            
            'emergencia_nombre.required'       => 'Este campo es obligatorio.',
            'emergencia_nombre.string'         => 'El nombre de contacto de emergencia debe ser un texto.',
            
            'emergencia_relacion.required'     => 'Este campo es obligatorio.',
            'emergencia_relacion.string'       => 'La relación debe ser un texto.',

            'emergencia_telefono_uno.required' => 'Este campo es obligatorio.',
            'emergencia_telefono_uno.string'   => 'El teléfono principal debe ser un texto.',

            'emergencia_telefono_dos.required' => 'Este campo es obligatorio.',
            'emergencia_telefono_dos.string'   => 'El teléfono secundario debe ser un texto.',

            'emergencia_email.required'        => 'Este campo es obligatorio.',
            'emergencia_email.string'          => 'El correo electrónico debe ser un texto.',

            'emergencia_calle.required'        => 'Este campo es obligatorio.',
            'emergencia_calle.string'          => 'La calle debe ser un texto.',

            'emergencia_numero.required'       => 'Este campo es obligatorio.',
            'emergencia_numero.string'         => 'El número debe ser un texto.',

            'emergencia_colonia.required'      => 'Este campo es obligatorio.',
            'emergencia_colonia.string'        => 'La colonia debe ser un texto.',

            'emergencia_municipio.required'    => 'Este campo es obligatorio.',
            'emergencia_municipio.string'      => 'El municipio debe ser un texto.',
        ]);

        // Consultamos el tipo de alergia
        $tipoAlergia = null;

        if (!is_null($request->tipo_alergia_id) && $request->tipo_alergia_id != 6) 
        {
            $tipoAlergia = CatAlergia::findOrFail($request->tipo_alergia_id);
        }

        // Consultamos el nombre del municipio
        $municipio = Municipio::findOrFail($request->emergencia_municipio);

        // Creamos el objeto para asignar los valores

        $emergencia = new ProfesionalEmergencia();

        $emergencia->id_profesional = $request->id_profesional;
        $emergencia->tipo_sangre = $request->tipo_sangre;
        $emergencia->tipo_alergia_id = $request->tipo_alergia_id;
        $emergencia->alergia_descripcion = $tipoAlergia->tipo_alergia;

        $emergencia->alergia_descripcion = $tipoAlergia ? $request->alergia_descripcion : null;
        
        $emergencia->enfermedad = $request->enfermedad;
        $emergencia->medicamentos = $request->medicamentos;
        $emergencia->tratamiento = $request->tratamiento;
        $emergencia->medico_nombre = $request->medico_nombre;
        $emergencia->medico_telefono = $request->medico_telefono;
        $emergencia->emergencia_nombre = $request->emergencia_nombre;
        $emergencia->emergencia_relacion = $request->emergencia_relacion;
        $emergencia->emergencia_telefono_uno = $request->emergencia_telefono_uno;
        $emergencia->emergencia_telefono_dos = $request->emergencia_telefono_dos;
        $emergencia->emergencia_email = $request->emergencia_email;
        $emergencia->emergencia_calle = $request->emergencia_calle;
        $emergencia->emergencia_numero = $request->emergencia_numero;
        $emergencia->emergencia_colonia = $request->emergencia_colonia;
        $emergencia->emergencia_municipio_id = $request->emergencia_municipio;
        $emergencia->emergencia_municipio_label = $municipio->nombre;
        $emergencia->mdl_emergencia = 1;

        $emergencia -> save();

        $usuario = Auth::user();

        // Guaradmos la bitacora
        $bitacora = new ProfesionalBitacora();

        $bitacora->id_capturista = $usuario->id;
        $bitacora->capturista_label = $usuario->responsable;
        $bitacora->accion = "NUEVO REGISTRO EN MODULO EMERGENCIA";
        $bitacora->id_profesional = $request->id_profesional;

        $bitacora->save();

        // Redireccionar con un mensaje de éxito
        return redirect()->route('profesionalShow',$emergencia->id_profesional)->with('success', 'Registro realizado correctamente.');
        
    }
}
