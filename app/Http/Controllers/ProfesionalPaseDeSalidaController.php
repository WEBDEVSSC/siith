<?php

namespace App\Http\Controllers;

use App\Mail\PaseDeSalidaSolicitud;
use App\Models\Profesional;
use App\Models\ProfesionalOcupacionOficinaCentral;
use App\Models\ProfesionalPaseDeSalida;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ProfesionalPaseDeSalidaController extends Controller
{
    //
    public function paseDeSalidaIndex()
    {
        return view('pase-salida.index');
    }

    public function paseDeSalidaCreate(Request $request)
    {
        $request->validate([
            'curp' => 'required|exists:profesionales_datos_generales,curp',
        ], [
            'curp.required' => 'El campo CURP es obligatorio.',
            'curp.exists' => 'No se encontró ningún profesional con esa CURP.',
        ]);

        $profesional = Profesional::where('curp',$request->curp)->first();

        // Ocupacion
        if ($profesional->puesto && $profesional->puesto->clues_adscripcion_tipo == 6) {

            $ocupacion = ProfesionalOcupacionOficinaCentral::where('id_profesional', $profesional->id)->first();

            if ($ocupacion) {
                $consultaJefes = ProfesionalOcupacionOficinaCentral::where('programa_uno', $ocupacion->programa_uno)
                    ->whereIn('ocupacion_uno', ['JEFE(A)', 'TITULAR','COORDINADOR(A)'])
                    ->get();
            } else {
                $consultaJefes = collect(); // colección vacía para evitar errores más adelante
            }
        } else {
            $ocupacion = "SIN DATO";
            $consultaJefes = collect(); // por si necesitas usarlo más adelante
        }

        // Si no se encontró, regresar con mensaje de error
        if (!$profesional) 
        {
            return back()
                ->withInput()
                ->with('error', 'No se encontró ningún profesional con ese CURP.');
        }

        $fecha = date('Y-m-d');

        // Consultamos todos los pases que tiene el profesional
        $pasesDeSalida = Profesional::with('pasesDeSalida')->findOrFail($profesional->id);

        // Mandamos al formulario con el curp
        return view('pase-salida.create', compact(
            'profesional',
            'ocupacion',
            'consultaJefes',
            'fecha',
            'pasesDeSalida'
        ));
    }

    public function paseDeSalidaStore(Request $request)
    {
        // Validamos los datos
        $request->validate([
            'id_profesional'=>'required',
            'nomina'=>'required',
            'fecha'=>'required',
            'jefe'=>'required',
            'tipo'=>'required',
            'tiempo_autorizado'=>'required',
            'hora_inicio'=>'required',
            'hora_final'=>'required',
        ],[]);

        // Consultamos los datos del profesional
        $profesional = Profesional::findOrFail($request->id_profesional);
        $nombreCompleto = $profesional->nombre." ".$profesional->apellido_paterno." ".$profesional->apellido_materno;

        // Consultamos los datos del que autoriza
        $autoriza = Profesional::findOrFail($request->jefe);
        $nombreCompletoAutoriza = $autoriza->nombre." ".$autoriza->apellido_paterno." ".$autoriza->apellido_materno;

        // Asignamos el status
        $status = 0;

        // Generamos el folio
        $nextFolio = ProfesionalPaseDeSalida::max('folio') + 1;

        // Generamos el objeto y asignamos propiedades
        $paseDeSalida = new ProfesionalPaseDeSalida();

        $paseDeSalida->id_profesional = $request->id_profesional;
        $paseDeSalida->nombre = $profesional->nombre;
        $paseDeSalida->apellido_paterno = $profesional->apellido_paterno;
        $paseDeSalida->apellido_materno = $profesional->apellido_materno;
        $paseDeSalida->nomina = $request->nomina;
        $paseDeSalida->id_autoriza = $request->jefe;
        $paseDeSalida->nombre_autoriza = $autoriza->nombre." ".$autoriza->apellido_paterno." ".$autoriza->apellido_materno;
        $paseDeSalida->tipo = $request->tipo;
        $paseDeSalida->fecha = $request->fecha;
        $paseDeSalida->tiempo_autorizado = $request->tiempo_autorizado;
        $paseDeSalida->hora_inicio = $request->hora_inicio;
        $paseDeSalida->hora_final = $request->hora_final;
        $paseDeSalida->status = $status;
        $paseDeSalida->folio = $nextFolio;

        $paseDeSalida -> save();

        // Notificamos por email su solicitud
        Mail::to($autoriza->email)->send(new PaseDeSalidaSolicitud($nombreCompleto,$nombreCompletoAutoriza));


        return redirect()->route('paseDeSalidaIndex')->with('success', 'Pase de Salida solicitado correctamente, en espera de autorización');        
    }
}
