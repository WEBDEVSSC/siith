<?php

namespace App\Http\Controllers;

use App\Exports\ProfesionalExport;
use App\Models\Entidad;
use App\Models\EstadoConyugal;
use App\Models\Municipio;
use App\Models\Profesional;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ProfesionalController extends Controller
{
    /**
     * 
     * 
     * FORMULARIO PARA BUSCAR LA CURP
     * 
     * 
     */
    
    public function buscarCurp()
    {
        return view('profesional.buscar-curp');
    }

    /**
     * 
     * 
     * BUSCAMOS LA CURP 
     * 
     * 
     */

    public function mostrarCurp(Request $request)
    {
        // Validación para CURP
        $request->validate([
            'curp' => 'required|regex:/^[A-Z]{4}[0-9]{6}[A-Z]{6}[0-9]{2}$/', // Expresión regular para CURP
        ], [
            'curp.required' => 'La CURP es obligatoria.',
            'curp.regex' => 'La CURP debe tener un formato válido.',
        ]);

        // Buscamos el profesional por CURP
        $profesional = Profesional::where('curp', $request->curp)->first();

        if ($profesional) 
        {
            // Si el registro ya existe, redirigimos con un mensaje de error
            return redirect()->back()->with('error', 'USUARIO REGISTRADO');
        } 
        else 
        {
            // Si no se encuentra el registro, redirigimos al formulario de creación de datos
            return redirect()->route('datosGenerales', [
                'curp' => $request->curp
            ]);
        }
    }

    public function datosGenerales($curp)
    {
        // Extraemos los datos de la CURP
        $rfc = substr($curp, 0, 10);
        $fechaNacimiento = substr($curp, 4, 6);
        $sexo = substr($curp, 10, 1);  
        $entidadNacimiento = substr($curp, 11, 2);

         // Formateamos la fecha
         $fechaFormateada = Carbon::createFromFormat('ymd', $fechaNacimiento)->format('Y-m-d');

         // Consultamos la entidad de nacimiento
         $entidad = Entidad::where('abreviacion',$entidadNacimiento)->first();

         // Estados conyugales
         $estadosConyuales = EstadoConyugal::all();

         // Ajustamos la nacionalidad
         if($entidadNacimiento === 'X')
         {
             $paisNacimiento = 'EXTRANGERO';
             $nacionalidad = 'EXTRANGERA';
         }
         else
         {
             $paisNacimiento = 'MÉXICO';
             $nacionalidad = 'MEXICANA';
         }

         // Lista de municipios
         $municipios = Municipio::where('relacion',$entidad->id)->get();

         return view('profesional.create',compact(
            'curp',
            'rfc',
            'sexo',
            'fechaFormateada',
            'paisNacimiento',
            'entidad',
            'municipios',
            'nacionalidad',
            'estadosConyuales',
        ));
    }

    public function datosGeneralesStore(Request $request)
    {
        // Validamos los datos
        $validated = $request->validate([
            'curp' => 'required',
            'rfc' => 'required',
            'homoclave' => 'required|size:3',
            'sexo' => 'required',
            'nombre' => 'required',
            'apellido_paterno' => 'required',
            'apellido_materno' => 'required',
            'fechaFormateada' => 'required',
            'paisNacimiento' => 'required',
            'entidadNacimiento' => 'required',
            'municipio_nacimiento' => 'required',
            'nacionalidad' => 'required',
            'estado_conyugal' => 'required',
            'telefono_casa' => 'required|size:10',
            'celular' => 'required|size:10',
            'email' => 'required|email',
            
        ], [
            'homoclave.required' => 'La homoclave es obligatoria.',
            'homoclave.size' => 'La homoclave debe ser de 3 caracteres.',            
            'nombre.required' => 'El nombre es obligatorio.',            
            'apellido_paterno.required' => 'El apellido paterno es obligatorio.',            
            'apellido_materno.required' => 'El apellido materno es obligatorio.',            
            'municipio_nacimiento.required' => 'El municipio de nacimiento es obligatorio.',            
            'telefono_casa.required' => 'El teléfono de casa es obligatorio.',
            'telefono_casa.size' => 'El teléfono de casa debe tener más de 10 caracteres.',            
            'celular.required' => 'El celular es obligatorio.',
            'celular.size' => 'El celular debe tener más de 10 caracteres.',            
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico debe ser una dirección válida.',
            'estado_conyugal.required' => 'El estado conyugal es obligatorio.',
        ]);

        // Formateamos el valor de SEXO
        if($request->sexo === "H")
        {
            $sexoNuevo = "M";
        }
        else
        {
            $sexoNuevo = "F";
        }

        // Consultamos el municipio de nacimiento
        $municipio = Municipio::findOrFail($request->municipio_nacimiento);

        // Ahora que los datos están validados, puedes guardarlos en la base de datos
        $profesional = new Profesional();

        $profesional->curp = $request->curp;
        $profesional->rfc = $request->rfc;
        $profesional->homoclave = $request->homoclave;
        $profesional->nombre = $request->nombre;
        $profesional->apellido_paterno = $request->apellido_paterno;
        $profesional->apellido_materno = $request->apellido_materno;
        $profesional->fecha_nacimiento = $request->fechaFormateada; 
        $profesional->sexo = $sexoNuevo;
        $profesional->pais_nacimiento = $request->paisNacimiento;
        $profesional->entidad_nacimiento = $request->entidadNacimiento;
        $profesional->municipio_nacimiento = $municipio->nombre;
        $profesional->nacionalidad = $request->nacionalidad;
        $profesional->estado_conyugal = $request->estado_conyugal;
        $profesional->telefono_casa = $request->telefono_casa;
        $profesional->celular = $request->celular;
        $profesional->email = $request->email;
        $profesional->mdl_datos_generales = 1;

        // Guardar el nuevo profesional
        $profesional->save();

        // Retornar o redirigir a donde lo necesites, por ejemplo:
        return redirect()->route('profesionalIndex')->with('success', 'Registro realizado correctamente.');
    }

    /**
     * 
     * 
     * 
     * 
     */

    public function profesionalIndex()
    {
        // Consultamos todos los profesionales con sus relaciones
        $profesionales = Profesional::with(['puesto', 'credencializacion', 'horario', 'sueldo', 'gradoAcademico'])->get();

        // Creamos un array para almacenar los datos adicionales
        $profesionalesData = $profesionales->map(function ($profesional) {
            return [
                'profesional' => $profesional,
                'cluesAdscripcionNombre' => optional($profesional->puesto)->clues_adscripcion_nombre,
            ];
        });

        // Regresamos la vista con los datos
        return view('profesional.index', compact('profesionalesData'));
    }

    /**
     * 
     * 
     * 
     * 
     * 
     */
    public function profesionalEdit($id)
    {
        // Buscamos el registro por el ID
        $profesional = Profesional::findOrFail($id);

        // Creamos el arreglo para los municipios select

        $municipioRelacion = Municipio::where('nombre',$profesional->municipio_nacimiento)->first();

        $municipios = Municipio::where('relacion',$municipioRelacion->relacion)->get();

        // Creamos el arreglo para los estados conyugales
        $estadosConyuales = EstadoConyugal::all();

        // Regresamos la vista con el arreglo
        return view('profesional.edit', compact('profesional','municipios','estadosConyuales'));
    }

    /**
     * 
     * 
     * 
     * 
     * 
     */
    public function profesionalUpdate(Request $request, $id)
    {
        // Validamos los datos
        $validated = $request->validate([
            'homoclave' => 'required|size:3',
            'nombre' => 'required',
            'apellido_paterno' => 'required',
            'apellido_materno' => 'required',
            'municipio_nacimiento' => 'required',
            'estado_conyugal' => 'required',
            'telefono_casa' => 'required|size:10',
            'celular' => 'required|size:10',
            'email' => 'required|email',
            
        ], [
            'homoclave.required' => 'La homoclave es obligatoria.',
            'homoclave.size' => 'La homoclave debe ser de 3 caracteres.',            
            'nombre.required' => 'El nombre es obligatorio.',            
            'apellido_paterno.required' => 'El apellido paterno es obligatorio.',            
            'apellido_materno.required' => 'El apellido materno es obligatorio.',            
            'municipio_nacimiento.required' => 'El municipio de nacimiento es obligatorio.',            
            'telefono_casa.required' => 'El teléfono de casa es obligatorio.',
            'telefono_casa.size' => 'El teléfono de casa debe tener más de 10 caracteres.',            
            'celular.required' => 'El celular es obligatorio.',
            'celular.size' => 'El celular debe tener más de 10 caracteres.',            
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico debe ser una dirección válida.',
            'estado_conyugal.required' => 'El estado conyugal es obligatorio.',
        ]);

        // Buscamos el registro
        $profesional = Profesional::findOrFail($id);

        // Actualizamos los campos
        $profesional->update([
            'homoclave'=>$request->homoclave,
            'nombre'=>$request->nombre,
            'apellido_paterno'=>$request->apellido_paterno,
            'apellido_materno'=>$request->apellido_materno,
            'municipio_nacimiento' => $request->municipio_nacimiento,
            'estado_conyugal' => $request->estado_conyugal,
            'telefono_casa' => $request->telefono_casa,
            'celular' => $request->celular,
            'email' => $request->email,
        ]);

        // Redireccionar con un mensaje de éxito
        return redirect()->route('profesionalIndex')->with('success', 'Registro actualizado correctamente.');

    }

    /**
     * 
     * 
     * 
     * 
     * 
     */
    public function profesionalShow($id)
    {
        // Buscamos el registro por el ID
        $profesional = Profesional::findOrFail($id);

        // Calculamos la edad
        $edad = Carbon::parse($profesional->fecha_nacimiento)->age;

        // Cargamos los datos del MODULO PUESTO
        $puesto = $profesional->puesto->first();

        $fiel = $puesto ? $puesto->fiel : null;
        $fiel_vigencia = $puesto ? $puesto->fiel_vigencia : null;
        $actividad = $puesto ? $puesto->actividad : null;
        $adicional = $puesto ? $puesto->adicional : null;
        $tipoPersonal = $puesto ? $puesto->tipo_personal : null;
        $codigoPuesto = $puesto ? $puesto->codigo_puesto : null;

        $cluesNomina = $puesto ? $puesto->clues_nomina : null;
        $cluesNominaNombre = $puesto ? $puesto->clues_nomina_nombre : null;
        $cluesNominaMunicipio = $puesto ? $puesto->clues_nomina_municipio : null;
        $cluesNominaJurisdiccion = $puesto ? $puesto->clues_nomina_jurisdiccion : null;

        $cluesAdscripcion = $puesto ? $puesto->clues_adscripcion : null;
        $cluesAdscripcionNombre = $puesto ? $puesto->clues_adscripcion_nombre : null;
        $cluesAdscripcionMunicipio = $puesto ? $puesto->clues_adscripcion_municipio : null;
        $cluesAdscripcionJurisdiccion = $puesto ? $puesto->clues_adscripcion_jurisdiccion : null;

        // Cargamos los datos del MODULO CREDENCIALIZACION
        $credencializacion = $profesional->credencializacion->first();
        $fotografia = $credencializacion ? $credencializacion->fotografia : null;

        // Generamos la URL de la fotografía
        $fotoUrl = $fotografia ? url('/foto/' . basename($fotografia)) : null;

        // Cargamos los datos del MODULO DE HORARIO
        $horario = $profesional->horario->first();
        $jornada = $horario ? $horario->jornada : null;
        
        $entradaLunes = $horario && $horario->entrada_lunes ? Carbon::parse($horario->entrada_lunes)->format('h:i A') : null;
        $salidaLunes = $horario && $horario->salida_lunes ? Carbon::parse($horario->salida_lunes)->format('h:i A') : null;

        $entradaMartes = $horario && $horario->entrada_martes ? Carbon::parse($horario->entrada_martes)->format('h:i A') : null;
        $salidaMartes = $horario && $horario->salida_martes ? Carbon::parse($horario->salida_martes)->format('h:i A') : null;

        $entradaMiercoles = $horario && $horario->entrada_miercoles ? Carbon::parse($horario->entrada_miercoles)->format('h:i A') : null;
        $salidaMiercoles = $horario && $horario->salida_miercoles ? Carbon::parse($horario->salida_miercoles)->format('h:i A') : null;

        $entradaJueves = $horario && $horario->entrada_jueves ? Carbon::parse($horario->entrada_jueves)->format('h:i A') : null;
        $salidaJueves = $horario && $horario->salida_jueves ? Carbon::parse($horario->salida_jueves)->format('h:i A') : null;

        $entradaViernes = $horario && $horario->entrada_viernes ? Carbon::parse($horario->entrada_viernes)->format('h:i A') : null;
        $salidaViernes = $horario && $horario->salida_viernes ? Carbon::parse($horario->salida_viernes)->format('h:i A') : null;

        $entradaSabado = $horario && $horario->entrada_sabado ? Carbon::parse($horario->entrada_sabado)->format('h:i A') : null;
        $salidaSabado = $horario && $horario->salida_sabado ? Carbon::parse($horario->salida_sabado)->format('h:i A') : null;

        $entradaDomingo = $horario && $horario->entrada_domingo ? Carbon::parse($horario->entrada_domingo)->format('h:i A') : null;
        $salidaDomingo = $horario && $horario->salida_domingo ? Carbon::parse($horario->salida_domingo)->format('h:i A') : null;

        $entradaFestivo = $horario && $horario->entrada_festivo ? Carbon::parse($horario->entrada_festivo)->format('h:i A') : null;
        $salidaFestivo = $horario && $horario->salida_festivo ? Carbon::parse($horario->salida_festivo)->format('h:i A') : null;

        // Cargamos los datos del modulo sueldo
        $sueldo = $profesional->sueldo->first();

        $sueldoMensual = $sueldo ? $sueldo->sueldo_mensual : null;
        $compensaciones = $sueldo ? $sueldo->compensaciones : null;
        $prestacionesMandatoLey = $sueldo ? $sueldo->prestaciones_mandato_ley : null;
        $prestacionesCgt = $sueldo ? $sueldo->prestaciones_cgt : null;
        $estimulos = $sueldo ? $sueldo->estimulos : null;
        $totalSueldo = $sueldo ? $sueldo->total : null;

        // Regresamos la vista con el arreglo
        return view('profesional.show', compact(
            'profesional',
            'edad',
            'fiel',
            'fiel_vigencia',
            'actividad',
            'adicional',
            'tipoPersonal',
            'codigoPuesto',
            'cluesNomina',
            'cluesNominaNombre',
            'cluesNominaMunicipio',
            'cluesNominaJurisdiccion',
            'cluesAdscripcion',
            'cluesAdscripcionNombre',
            'cluesAdscripcionMunicipio',
            'cluesAdscripcionJurisdiccion',
            'fotografia',
            'fotoUrl',
            'jornada',
            'entradaLunes',
            'salidaLunes',
            'entradaMartes',
            'salidaMartes',
            'entradaMiercoles',
            'salidaMiercoles',
            'entradaJueves',
            'salidaJueves',
            'entradaViernes',
            'salidaViernes',
            'entradaSabado',
            'salidaSabado',
            'entradaDomingo',
            'salidaDomingo',
            'entradaFestivo',
            'salidaFestivo',
            'sueldoMensual',
            'compensaciones',
            'prestacionesMandatoLey',
            'prestacionesCgt',
            'estimulos',
            'totalSueldo',
        ));
    }


    public function export()
    {
        // Exporta los datos usando la clase CluesExport
        return Excel::download(new ProfesionalExport, 'REPORTE.xlsx');
    }


}