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

    public function createClues()
    {
        return view('settings.clues.create');
    }

    public function storeClues(Request $request)
    {
        // Validamos los valores
        $request->validate([
            'clues' => 'required',
            'municipio' => 'required',
            'localidad' => 'required',
            'jurisdiccion'=> 'required',
            'nombre'=> 'required',
            'clave_establecimiento'=> 'required',
        ],[
            'clues.required' => 'El campo CLUES es obligatorio.',
            'municipio.required' => 'Debes seleccionar un municipio.',
            'localidad.required' => 'La localidad es obligatoria.',
            'jurisdiccion.required' => 'La jurisdicción es obligatoria.',
            'nombre.required' => 'El nombre de la unidad es obligatorio.',
            'clave_establecimiento.required' => 'La clave del establecimiento es obligatoria.',
        ]);

        // Jurisdicción label
        $labels = [
            1=>"PIEDRAS NEGRAS", 2=>"ACUÑA", 3=>"SABINAS",
            4=>"MONCLOVA", 5=>"CUATRO CIENEGAS", 6=>"TORREON",
            7=>"FRANCISCO I. MADERO", 8=>"SALTILLO", 9=>"SALTILLO"
        ];

        $jurisdiccionLabel = $labels[$request->jurisdiccion] ?? "ERROR - SIN VALOR";

        // Buscamos registro
        $clue = new Clue();

        // Asignamos los valores nuevos
        $clue->clues = $request->clues;
        $clue->municipio = $request->municipio;
        $clue->clave_municipio = 0;
        $clue->localidad = $request->localidad;
        $clue->clave_localidad = 0;
        $clue->jurisdiccion = $jurisdiccionLabel;
        $clue->clave_jurisdiccion = $request->jurisdiccion;
        $clue->nombre = $request->nombre;
        $clue->clave_establecimiento = $request->clave_establecimiento;
        $clue->tipologia = "000";

        $clue->save();

        return redirect()->route('indexClues')
            ->with('success', 'CLUES registrada correctamente.');
    }

    public function showClues($id)
    {
        // Buscamos la clues con el ID
        $clue = Clue::findOrFail($id);

        // Refresamos a la vista con el objeto
        return view('settings.clues.show', compact('clue'));
    }

    public function editClues($id)
    {
        // Buscamos la clues con el ID
        $clue = Clue::findOrFail($id);

        // Refresamos a la vista con el objeto
        return view('settings.clues.edit', compact('clue'));
    }

    public function updateClues(Request $request, $id)
    {
        // Validamos los valores
        $request->validate([
            'clues' => 'required',
            'municipio' => 'required',
            'localidad' => 'required',
            'jurisdiccion'=> 'required',
            'nombre'=> 'required',
            'clave_establecimiento'=> 'required',
        ],[
            'clues.required' => 'El campo CLUES es obligatorio.',
            'municipio.required' => 'Debes seleccionar un municipio.',
            'localidad.required' => 'La localidad es obligatoria.',
            'jurisdiccion.required' => 'La jurisdicción es obligatoria.',
            'nombre.required' => 'El nombre de la unidad es obligatorio.',
            'clave_establecimiento.required' => 'La clave del establecimiento es obligatoria.',
        ]);

        // Jurisdicción label
        $labels = [
            1=>"PIEDRAS NEGRAS", 2=>"ACUÑA", 3=>"SABINAS",
            4=>"MONCLOVA", 5=>"CUATRO CIENEGAS", 6=>"TORREON",
            7=>"FRANCISCO I. MADERO", 8=>"SALTILLO", 9=>"SALTILLO"
        ];

        $jurisdiccionLabel = $labels[$request->jurisdiccion] ?? "ERROR - SIN VALOR";

        // Buscamos registro
        $clue = Clue::findOrFail($id);

        // Guardar valor anterior
        $oldClues = $clue->clues;

        // Asignamos los valores nuevos
        $clue->clues = $request->clues;
        $clue->municipio = $request->municipio;
        $clue->localidad = $request->localidad;
        $clue->jurisdiccion = $jurisdiccionLabel;
        $clue->clave_jurisdiccion = $request->jurisdiccion;
        $clue->nombre = $request->nombre;
        $clue->clave_establecimiento = $request->clave_establecimiento;
        $clue->save();

        // Actualizar Puesto CLUES NOMINA — usando OLD
        ProfesionalPuesto::where('clues_nomina', $oldClues)
            ->update([
                'clues_nomina' => $request->clues,
                'clues_nomina_nombre' => $request->nombre,
                'clues_nomina_municipio' => $request->municipio,
                'clues_nomina_jurisdiccion' => $request->jurisdiccion,
            ]);

        // Actualizar Puesto CLUES ADSCRIPCIÓN — usando OLD
        ProfesionalPuesto::where('clues_adscripcion', $oldClues)
            ->update([
                'clues_adscripcion' => $request->clues,
                'clues_adscripcion_nombre' => $request->nombre,
                'clues_adscripcion_municipio' => $request->municipio,
                'clues_adscripcion_jurisdiccion' => $request->jurisdiccion,
                'clues_adscripcion_tipo' => $request->clave_establecimiento,
            ]);

        return redirect()->route('indexClues')
            ->with('delete', 'CLUES actualizada correctamente.');
    }


    public function deleteClues($id)
    {
        // Buscamos el registro con el id
        $clue = Clue::findOrFail($id);

        // Eliminamos el registro
        $clue->delete();

        return redirect()->route('indexClues')->with('delete', 'CLUES eliminada correctamente.');
    }
}
