<?php

namespace App\Http\Controllers;

use App\Models\ProfesionalCambioDeUnidad;
use App\Models\ProfesionalVigencia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfesionalNormatividadController extends Controller
{
    //
    public function indexNormatividad()
    {
        return view('normatividad.index');
    }

    public function createBajasTemporales(Request $request)
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

        return view('normatividad.bajas-temporal', compact('vigencias'))
            ->with('fecha_inicio', $request->fecha_inicio)
            ->with('fecha_termino', $request->fecha_termino);
        
    }
    
    public function createBajasComision(Request $request)
    {
        $request->validate([
            'fecha_inicio' => 'required|date',
            'fecha_termino' => 'required|date|after_or_equal:fecha_inicio'
        ],[
            'fecha_inicio.required' => 'La fecha de inicio es obligatoria.',
            'fecha_termino.required' => 'La fecha de término es obligatoria.',
            'fecha_termino.after_or_equal' => 'La fecha de término debe ser igual o posterior a la de inicio.',
        ]);

        $user = Auth::user();

        // CONSULTA PARA OFICINA CENTRAL
        if (in_array($user->role, ['normatividad', 'admin'])) 
        {
            $bajasComision = ProfesionalCambioDeUnidad::whereBetween('fecha_final', [$request->fecha_inicio, $request->fecha_termino])
                ->orderBy('fecha_final', 'asc')
                ->get();
        } 

        // CONSULTA PARA JURISDICCIONES
        elseif ($user->role == 'ofJurisdiccional')
        {            
            $bajasComision = ProfesionalCambioDeUnidad::whereHas('profesional.puesto', function ($query) 
            {
                 $query->whereIn('clues_adscripcion_tipo', [1, 2, 3])
                    ->where('clues_adscripcion_jurisdiccion', $user->jurisdiccion_unidad);
            })
                ->whereBetween('fecha_final', [$request->fecha_inicio, $request->fecha_termino])
                ->orderBy('fecha_final', 'asc')
                ->get();
        }
        // CONSULTA PARA UNIDADES
        else
        {
            $bajasComision = ProfesionalCambioDeUnidad::where('profesional.puesto','clues_adscripcion',$user->clues_unidad)
                ->whereBetween('fecha_final', [$request->fecha_inicio, $request->fecha_termino])
                ->orderBy('fecha_final', 'asc')
                ->get();
        }

        return view('normatividad.bajas-comision', compact('bajasComision'))
            ->with('fecha_inicio', $request->fecha_inicio)
            ->with('fecha_termino', $request->fecha_termino);
    }
}
