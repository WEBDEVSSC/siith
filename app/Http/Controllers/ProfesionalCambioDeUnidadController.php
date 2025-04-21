<?php

namespace App\Http\Controllers;

use App\Models\Clue;
use App\Models\Profesional;
use App\Models\ProfesionalCambioDeUnidad;
use App\Models\ProfesionalOcupacionHospital;
use App\Models\ProfesionalPuesto;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfesionalCambioDeUnidadController extends Controller
{
    //

    public function findProfesional()
    {
        // Mostramos el formulario de busqueda por CURP
        return view('cambio-unidad.buscar-profesional');
    }

    public function showProfesional(Request $request)
    {
        //Validamos el registro
        $request->validate([
            'curp' => 'required|regex:/^[A-Z]{4}[0-9]{6}[A-Z]{6}[0-9]{2}$/',
        ], [
            'curp.required' => 'El campo CURP es obligatorio.',
            'curp.regex' => 'El formato del CURP no es válido. Asegúrate de que esté correctamente escrito (18 caracteres: letras y números en mayúsculas).',
        ]);
        
        // Buscamos el registro con la CURP
        $profesional = Profesional::where('curp', $request->curp)->first();

        // Si no se encontró el profesional, regresamos con un mensaje de error
        if (!$profesional) {
            return redirect()->back()->with('error', 'No se encontró ningún profesional con esa CURP.');
        }

        // Cargamos los datos del MODULO CREDENCIALIZACION
        $credencializacion = $profesional?->credencializacion;
        $fotografia = $credencializacion ? $credencializacion->fotografia : null;

        // Generamos la URL de la fotografía
        $fotoUrl = $fotografia ? url('/foto/' . basename($fotografia)) : null;

        // Regresamos la vista con el objeto
        return view('cambio-unidad.mostrar-profesional', compact('profesional', 'fotoUrl'));
    }

    public function createCambioDeUnidad($id)
    {
        // Asignamos el valor id a la variable profeisonal
        $profesional = Profesional::findOrFail($id);
        
        // Cargamos el usuario en sesion
        $user = Auth::user();

        // Cargamos los datos de la clues del usuario
        $clues = Clue::findOrFail($user->id_unidad);
        
        return view('cambio-unidad.cambioUnidad-create', compact('profesional', 'clues'));
    }

    public function storeCambioDeUnidad(Request $request)
    {
        // Primero validamos
        $request->validate([
            'id_profesional' => 'required',
            'clues_adscripcion' => 'required',
            'clues_adscripcion_nombre' => 'required',
            'clues_adscripcion_municipio' => 'required',
            'clues_adscripcion_jurisdiccion' => 'required',
            'clues_adscripcion_tipo' => 'required',
            'tipo_movimiento' => 'required',
            'documento_respaldo' => 'required|mimes:pdf|max:5120',
            'fecha_inicio' => 'required|date',
            'fecha_termino' => 'required|date|after:fecha_inicio',
        ], [
            'tipo_movimiento.required' => 'El tipo de movimiento es obligatorio.',
            'documento_respaldo.required' => 'El documento de respaldo es obligatorio.',
            'documento_respaldo.mimes' => 'El documento de respaldo debe ser un archivo PDF.',
            'documento_respaldo.max' => 'El documento de respaldo no debe ser mayor a 5 MB.',
            'documento_resplado.uploaded' => 'No se pudo subir el archivo :attribute. Asegúrate de que no supere el tamaño permitido (5 MB) y que el formato sea correcto.',
            'fecha_inicio.required' => 'La fecha de inicio es obligatoria.',
            'fecha_inicio.date' => 'La fecha de inicio debe ser una fecha válida.',
            'fecha_termino.required' => 'La fecha de término es obligatoria.',
            'fecha_termino.date' => 'La fecha de término debe ser una fecha válida.',
            'fecha_termino.after' => 'La fecha de término debe ser posterior a la fecha de inicio.',
        ]);

        // Consultamos la curp del profesional
        $profesional = Profesional::findOrFail($request->id_profesional);

        // Obtener la fecha y hora actual en el formato deseado
        $timestamp = now()->format('Ymd_His');

        // Regresa a su unidad de origen
        if($request->tipo_movimiento == 1)
        {
            // Asignamos el tipo de movimiento
            $tipoMovimiento = "REGRESA A UNIDAD DE ORIGEN";
            
            // Crear el nombre del archivo con la fecha y hora
            $archivoNombre = $profesional->curp . '_RUO_' . $timestamp . '.' . $request->documento_respaldo->extension();
        }
        // Comisionado a otra unidad
        elseif($request->tipo_movimiento == 2)
        {
            // Asignamos el tipo de movimiento
            $tipoMovimiento = "COMISIONADO A OTRA UNIDAD";
            
            // Crear el nombre del archivo con la fecha y hora
            $archivoNombre = $profesional->curp . '_COU_' . $timestamp . '.' . $request->documento_respaldo->extension();
        }
        // Movimiento Escalafonario
        elseif($request->tipo_movimiento == 3)
        {
            // Asignamos el tipo de movimiento
            $tipoMovimiento = "MOVIMIENTO ESCALAFONARIO";
            
            // Crear el nombre del archivo con la fecha y hora
            $archivoNombre = $profesional->curp . '_ME_' . $timestamp . '.' . $request->documento_respaldo->extension();
        }
        else
        {

        }

        // Almacenar el archivo en la carpeta 'documents' en el almacenamiento local
        $archivoPath = $request->documento_respaldo->storeAs('cambio-unidad', $archivoNombre, 'local');

        $cambioDeUnidad = new ProfesionalCambioDeUnidad();

        $cambioDeUnidad->id_profesional = $request->id_profesional;
        $cambioDeUnidad->tipo_movimiento_id = $request->tipo_movimiento;
        $cambioDeUnidad->tipo_movimiento = $tipoMovimiento;
        $cambioDeUnidad->documento_respaldo = $archivoPath;
        $cambioDeUnidad->fecha_inicio = $request->fecha_inicio;
        $cambioDeUnidad->fecha_final = $request->fecha_termino;
        $cambioDeUnidad->unidad_origen_clues = $profesional->puesto->clues_adscripcion;
        $cambioDeUnidad->unidad_origen_nombre = $profesional->puesto->clues_adscripcion_nombre;
        $cambioDeUnidad->unidad_origen_jurisdiccion = $profesional->puesto->clues_adscripcion_jurisdiccion;
        $cambioDeUnidad->unidad_destino_clues = $request->clues_adscripcion;
        $cambioDeUnidad->unidad_destino_nombre = $request->clues_adscripcion_nombre;
        $cambioDeUnidad->unidad_destino_jurisdiccion = $request->clues_adscripcion_jurisdiccion;
        

        $cambioDeUnidad->save();

        // Buscar el registro del puesto actual de ese profesional
        $puesto = ProfesionalPuesto::where('id_profesional', $request->id_profesional)->first();

        if ($puesto) 
        {
            $puesto->clues_adscripcion = $request->clues_adscripcion;
            $puesto->clues_adscripcion_nombre = $request->clues_adscripcion_nombre;
            $puesto->clues_adscripcion_municipio = $request->clues_adscripcion_municipio;
            $puesto->clues_adscripcion_jurisdiccion = $request->clues_adscripcion_jurisdiccion;
            $puesto->clues_adscripcion_tipo = $request->clues_adscripcion_tipo;

            $puesto->save();
        }

        // Eliminar registros de las OCUPACIONES

        // Catalogo 1 - HOSPITALES
        //$buscarOcupacionHospital = ProfesionalOcupacionHospital::where('id_profesional',$request->id_profesional)->first()?->delete();

        // Catalogo 2 - HOSPITALES
        //$buscarOcupacionHospital = ProfesionalOcupacionHospital::where('id_profesional',$request->id_profesional)->first()?->delete();

        return redirect()->route('profesionalShow',$profesional->id)->with('successCambioDeUnidad', 'Cambio de unidad registrada correctamente');


    }
}