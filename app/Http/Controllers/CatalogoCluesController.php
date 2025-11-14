<?php

namespace App\Http\Controllers;

use App\Models\Clue;
use App\Models\Profesional;
use App\Models\ProfesionalPuesto;
use Illuminate\Http\Request;

class CatalogoCluesController extends Controller
{
    //
    public function indexClues()
    {
        $clues = Clue::all();

        $datos = $clues->map(function ($clue) {

            // Contar profesionales cuya relación "puesto" tenga el clues_adscripcion igual al clues de esta unidad
            $total = Profesional::whereHas('puesto', function ($q) use ($clue) {
            $q->where('clues_adscripcion', $clue->clues)
              ->where('vigencia', 'ACTIVO');   // ← FILTRO AGREGADO
            })->count();

            return [
                'id' => $clue->id,
                'clues' => $clue->clues,
                'nombre' => $clue->nombre,
                'localidad' => $clue->localidad,
                'jurisdiccion' => $clue->clave_jurisdiccion,
                'total_profesionales' => $total,
            ];
        });

        return view('settings.clues.index', compact('datos'));
    }
}
