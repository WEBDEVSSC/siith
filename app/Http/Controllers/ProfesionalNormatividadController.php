<?php

namespace App\Http\Controllers;

use App\Models\ProfesionalVigencia;
use Illuminate\Http\Request;

class ProfesionalNormatividadController extends Controller
{
    //
    public function indexNormatividad()
    {
        return view('normatividad.index');
    }

    public function showNormatividad(Request $request)
    {
        $request->validate([
            'fecha_inicio' => 'required|date',
            'fecha_termino' => 'required|date|after_or_equal:fecha_inicio'
        ], [
            'fecha_inicio.required' => 'La fecha de inicio es obligatoria.',
            'fecha_termino.required' => 'La fecha de término es obligatoria.',
            'fecha_termino.after_or_equal' => 'La fecha de término debe ser igual o posterior a la de inicio.',
        ]);

        $vigencias = ProfesionalVigencia::where('vigencia', 'BAJA TEMPORAL')
            ->whereBetween('fecha_final', [$request->fecha_inicio, $request->fecha_termino])
            ->orderBy('fecha_final', 'asc')
            ->get();

        return view('normatividad.show', compact('vigencias'))
            ->with('fecha_inicio', $request->fecha_inicio)
            ->with('fecha_termino', $request->fecha_termino);
        
    }
}
