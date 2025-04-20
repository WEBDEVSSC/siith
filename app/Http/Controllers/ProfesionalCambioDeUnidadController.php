<?php

namespace App\Http\Controllers;

use App\Models\Profesional;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class ProfesionalCambioDeUnidadController extends Controller
{
    //

    public function findProfesional()
    {
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

       // return redirect()->route('showProfesional', ['profesional' => $profesional, 'fotoUrl' => $fotoUrl]);

    }

    public function storeCambioDeUnidad(Request $request)
    {
        $request->validate([
            'id_profesional'=>'required',
            'tipo_movimiento'=>'required',
            'documento_respaldo' => 'required|mimes:pdf|max:5120',
            'fecha_inicio' => 'required|date',
            'fecha_termino' => 'required|date|after:fecha_inicio',
        ], [
            'id_profesional.required' => 'El campo profesional es obligatorio.',
            'tipo_movimiento.required' => 'El tipo de movimiento es obligatorio.',
            'documento_respaldo.required' => 'El documento de respaldo es obligatorio.',
            'documento_respaldo.mimes' => 'El documento de respaldo debe ser un archivo PDF.',
            'documento_respaldo.max' => 'El documento de respaldo no debe ser mayor a 5 MB.',
            'fecha_inicio.required' => 'La fecha de inicio es obligatoria.',
            'fecha_inicio.date' => 'La fecha de inicio debe ser una fecha válida.',
            'fecha_termino.required' => 'La fecha de término es obligatoria.',
            'fecha_termino.date' => 'La fecha de término debe ser una fecha válida.',
            'fecha_termino.after' => 'La fecha de término debe ser posterior a la fecha de inicio.',
        ]);

        
    }
}
