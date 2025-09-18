<?php

namespace App\Http\Controllers;

use App\Models\ProfesionalPuesto;
use App\Models\ProfesionalVigencia;
use App\Models\VigenciaMotivo;
use Illuminate\Http\Request;

class CatalogosController extends Controller
{
    /*
    *
    *
    * CATALOGO DE VIGENCIAS
    *
    *
    */
    public function vigenciasIndex()
    {
        // Consultamos todos los motivos y ordenamos por tipo de vigencia
        $vigencias = VigenciaMotivo::orderBy('id_vigencia','asc')->get();

        // Regresamos la vista con la variable
        return view('settings.vigencia.index', compact('vigencias'));
    }

    public function vigenciasCreate()
    {
        return view('settings.vigencia.create');
    }

    public function vigenciasStore(Request $request)
    {
        $request->validate([
            'vigencia'=>'required',
            'motivo'=>'required',
        ],[
            'vigencia.required' => 'Debe seleccionar una vigencia.',
            'motivo.required'   => 'El campo motivo es obligatorio.',
        ]);

        if($request->vigencia == 1)
        {
            $label_vigencia = "ACTIVO";
        }
        elseif($request->vigencia == 2)
        {
            $label_vigencia = "BAJA TEMPORAL";
        }
        elseif($request->vigencia == 3)
        {
            $label_vigencia = "BAJA DEFINITIVA";
        }
        else
        {
            $label_vigencia = "ERROR - TIPO DE MOTIVO DE VIGENCIA";
        }

        $vigencia = new VigenciaMotivo();

        $vigencia->id_vigencia = $request->vigencia;
        $vigencia->label_vigencia = $label_vigencia;
        $vigencia->motivo = $request->motivo;

        $vigencia->save();

        return redirect()->route('vigenciasIndex')->with('success', 'Registro realizado correctamente');

    }

    public function vigenciasEdit($id)
    {
        // Consultamos los datos
        $vigencia = VigenciaMotivo::findOrFail($id);

        // Regresamos la vista con el objeto
        return view('settings.vigencia.edit', compact('vigencia'));
    }

    public function vigenciasUpdate(Request $request, $id)
    {
        $request->validate([
            'vigencia'=>'required',
            'motivo'=>'required',
        ],[
            'vigencia.required' => 'Debe seleccionar una vigencia.',
            'motivo.required'   => 'El campo motivo es obligatorio.',
        ]);

        $labels = [
        1 => 'ACTIVO',
        2 => 'BAJA TEMPORAL',
        3 => 'BAJA DEFINITIVA',
        ];
        $label_vigencia = $labels[$request->vigencia] ?? 'ERROR - TIPO DE MOTIVO DE VIGENCIA';


        // Actualizamos la tabla de cat_vigencia_motivo

        $vigencia = VigenciaMotivo::findOrFail($id);

         // Guardamos el valor antiguo del motivo
        $motivo_antiguo = $vigencia->motivo;

        $vigencia->id_vigencia = $request->vigencia;
        $vigencia->label_vigencia = $label_vigencia;
        $vigencia->motivo = $request->motivo;

        $vigencia->save();

        // Actualizamos el motivo en todos los registros

        ProfesionalVigencia::where('vigencia_motivo', $motivo_antiguo)
                ->update([
                    'vigencia'        => $label_vigencia,
                    'vigencia_motivo' => $request->motivo,
                ]);

        // Actualizamos el modulo de puesto

        ProfesionalPuesto::where('vigencia_motivo', $motivo_antiguo)
                ->update([
                    'vigencia'        => $label_vigencia,
                    'vigencia_motivo' => $request->motivo,
                ]);

        return redirect()->route('vigenciasIndex')->with('update', 'Registro realizado correctamente');
    }

    public function vigenciasDestroy($id)
    {
        $vigencia = vigenciaMotivo::findOrFail($id);

        $vigencia->delete();

        return redirect()->route('vigenciasIndex')->with('delete', 'Registro eliminado correctamente');
    } 

}
