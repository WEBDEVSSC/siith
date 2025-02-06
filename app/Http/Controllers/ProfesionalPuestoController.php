<?php

namespace App\Http\Controllers;

use App\Models\Profesional;
use App\Models\ProfesionalPuesto;
use Illuminate\Http\Request;

class ProfesionalPuestoController extends Controller
{
    //
    public function createPuesto($id)
    {
        // Consultar los datos del profesional
        $profesional = Profesional::findOrFail($id);

        // Regresamos al form con el objeto
        return view('puesto.puesto', compact('profesional','id'));
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
