<?php

namespace App\Http\Controllers;

use App\Models\Actividad;
use App\Models\Adicional;
use App\Models\AreaTrabajo;
use App\Models\Clue;
use App\Models\CodigoPuesto;
use App\Models\NominaPago;
use App\Models\Ocupacion;
use App\Models\Profesional;
use App\Models\ProfesionalPuesto;
use App\Models\TipoPersonal;
use Illuminate\Http\Request;

class ProfesionalPuestoController extends Controller
{
    //
    public function createPuesto($id)
    {
        // Consultar los datos del profesional
        $profesional = Profesional::findOrFail($id);

        // Llenamos el select de ACTIVIDAD
        $actividades = Actividad::all();

        // Llenamos el select de ADICIONAL
        $adicionales = Adicional::all();

        // Llenamos el select TIPO DE PERSONAL
        $tiposPersonal = TipoPersonal::all();

        // Llenamos el select de CODIGO DE PUESTO
        $codigosPuesto = CodigoPuesto::orderBy('codigo_puesto', 'asc')->get();

        // Llenamos el select de CLUES Nomina y Adscripcion
        $clues = Clue::orderBy('clave_jurisdiccion', 'asc') 
             ->orderBy('nombre', 'asc')
             ->get();

        // Llenamos el select de AREA DE TRABAJO
        $areasTrabajo = AreaTrabajo::orderBy('area_trabajo','asc')->get();

        // Llenamos el select de ocupacion
        $ocupaciones = Ocupacion::orderBy('ocupacion', 'asc')->get();

        // Llenamos el select de nominas de pago
        $nominasPago = NominaPago::orderBy('nomina','asc')->get();

        // Regresamos al form con el objeto
        return view('puesto.puesto', compact(
            'profesional',
            'id',
            'actividades',
            'adicionales',
            'tiposPersonal',
            'codigosPuesto',
            'clues',
            'areasTrabajo',
            'ocupaciones',
            'nominasPago'
        ));
    }

    public function storePuesto(Request $request)
    {
        // Validamos los datos
        $validated = $request->validate([
            'id_profesional' => 'required',
            'fiel' => 'required',
            'fiel_vigencia' => 'required_if:fiel,SI',
        ],[
            'id_profesional.required' => 'El ID del profesional es obligatorio',
            'fiel.required' => 'El campo FIEL es obligatorio.',
            'fiel_vigencia.required_if' => 'El campo FIEL Vigencia es obligatorio cuando FIEL está seleccionado.',
        ]);

        // Activamos el modulo
        $mdl_puesto = 1;

        // Creamos el objeto
        $puesto = new ProfesionalPuesto();

        // Asignamos los valores
        $puesto->id_profesional = $request->id_profesional;
        $puesto->fiel = $request->fiel;
        $puesto->fiel_vigencia = $request->fiel_vigencia;
        $puesto->mdl_puesto = $mdl_puesto;

        // Almacenamos los valores
        // Guardar el nuevo profesional
        $puesto->save();

        // Retornar o redirigir a donde lo necesites, por ejemplo:
        return redirect()->route('profesionalIndex')->with('success', 'Registro realizado correctamente.');
    }
}
