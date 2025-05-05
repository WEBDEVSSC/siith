<?php

namespace App\Http\Controllers;

use App\Models\CatOcupacionCetsLesp;
use App\Models\ProfesionalOcupacionCetsLesp;
use Illuminate\Http\Request;

class CatalogoOcupacionCetsLespController extends Controller
{
    //
    public function ocupacionCetsLespIndex()
    {
        // Cargamos todos los registros de la tabla
        $ocupaciones = CatOcupacionCetsLesp::orderBy('id')->get();

        // Retornamos la vista con el arreglo
        return view('settings.ocupacion.cets-lesp.cets-lesp-index', compact('ocupaciones'));
    }

    public function ocupacionCetsLespCreate()
    {
        // Cargamos la vista del formulario
        return view('settings.ocupacion.cets-lesp.cets-lesp-create');
    }

    public function ocupacionCetsLespStore(Request $request)
    {
        // Validamos los datos
        $request->validate([
            'area' => 'required|string',
            'subarea' => 'required|string',
            'jefatura_programa' => 'required|string',
            'componente' => 'required|string',
            'ocupacion' => 'required|string',
            'orden' => 'required|string',
        ],[            
            'area.required' => 'El campo área es obligatorio.',
            'area.string' => 'El campo área debe ser una cadena de texto.',
            
            'subarea.required' => 'El campo subárea es obligatorio.',
            'subarea.string' => 'El campo subárea debe ser una cadena de texto.',
            
            'jefatura_programa.required' => 'El campo jefatura programa es obligatorio.',
            'jefatura_programa.string' => 'El campo jefatura programa debe ser una cadena de texto.',

            'componente.required' => 'El campo componentees obligatorio.',
            'componente.string' => 'El campo componente debe ser una cadena de texto.',

            'ocupacion.required' => 'El campo ocupacion es obligatorio.',
            'ocupacion.string' => 'El campo ocupacion debe ser una cadena de texto.',

            'orden.required' => 'El campo orden es obligatorio.',
            'orden.string' => 'El campo orden debe ser una cadena de texto.',
        ]);

        // Creamos el objeto
        $ocupacion = new CatOcupacionCetsLesp();

        // Asignamos los valores
        $ocupacion->area = $request->area;
        $ocupacion->subarea = $request->subarea;
        $ocupacion->jefatura_programa = $request->jefatura_programa;
        $ocupacion->componente = $request->componente;
        $ocupacion->ocupacion = $request->ocupacion;
        $ocupacion->orden = $request->orden;

        // Guardamos los valores
        $ocupacion->save();

        // Retornamos a la vista
        return redirect()->route('ocupacionCetsLespIndex')->with('success', 'Registro realizado correctamente');
    }

    public function ocupacionCetsLespEdit($id)
    {
        // Consultamos los datos del registro
        $ocupacion = CatOcupacionCetsLesp::findOrFail($id);

        // Regresamos a la vista con el arreglo
        return view('settings.ocupacion.cets-lesp.cets-lesp-edit', compact('ocupacion'));
    }

    public function ocupacionCetsLespUpdate(Request $request, $id)
    {
        // Validamos los datos
        $request->validate([
            'area' => 'required|string',
            'subarea' => 'required|string',
            'jefatura_programa' => 'required|string',
            'componente' => 'required|string',
            'ocupacion' => 'required|string',
            'orden' => 'required|string',
        ],[            
            'area.required' => 'El campo área es obligatorio.',
            'area.string' => 'El campo área debe ser una cadena de texto.',
            
            'subarea.required' => 'El campo subárea es obligatorio.',
            'subarea.string' => 'El campo subárea debe ser una cadena de texto.',
            
            'jefatura_programa.required' => 'El campo jefatura programa es obligatorio.',
            'jefatura_programa.string' => 'El campo jefatura programa debe ser una cadena de texto.',

            'componente.required' => 'El campo componentees obligatorio.',
            'componente.string' => 'El campo componente debe ser una cadena de texto.',

            'ocupacion.required' => 'El campo ocupacion es obligatorio.',
            'ocupacion.string' => 'El campo ocupacion debe ser una cadena de texto.',

            'orden.required' => 'El campo orden es obligatorio.',
            'orden.string' => 'El campo orden debe ser una cadena de texto.',
        ]);

        // Buscamos el registro
        $ocupacion = CatOcupacionCetsLesp::findOrFail($id);

        // Asignamos los valores
        $ocupacion->area = $request->area;
        $ocupacion->subarea = $request->subarea;
        $ocupacion->jefatura_programa = $request->jefatura_programa;
        $ocupacion->componente = $request->componente;
        $ocupacion->ocupacion = $request->ocupacion;
        $ocupacion->orden = $request->orden;

        // Guardamos los cambios
        $ocupacion->save();

        ProfesionalOcupacionCetsLesp::where('id_catalogo_uno', $id)
                                        ->update([
                                            'area_uno' => $request->area,
                                            'subarea_uno' => $request->subarea,
                                            'jefatura_programa_uno' => $request->jefatura_programa,
                                            'componente_uno' => $request->componente,
                                            'ocupacion_uno' => $request->ocupacion,
                                        ]);

        ProfesionalOcupacionCetsLesp::where('id_catalogo_dos', $id)
                                        ->update([
                                            'area_dos' => $request->area,
                                            'subarea_dos' => $request->subarea,
                                            'jefatura_programa_dos' => $request->jefatura_programa,
                                            'componente_dos' => $request->componente,
                                            'ocupacion_dos' => $request->ocupacion,
                                        ]);

        // Redirigimos con un mensaje de éxito
        return redirect()->route('ocupacionCetsLespIndex')->with('update', 'Ocupación actualizada correctamente.');
    }

    public function ocupacionCetsLespDestroy($id)
    {
        // Buscamos el registro
        $ocupacion = CatOcupacionCetsLesp::findOrFail($id);

        // Eliminamos el regisrtro
        $ocupacion->delete();

        // Limpiamos los registros
        ProfesionalOcupacionCetsLesp::where('id_catalogo_uno', $id)
                                        ->update([
                                            'area_uno' => NULL,
                                            'subarea_uno' => NULL,
                                            'jefatura_programa_uno' => NULL,
                                            'componente_uno' => NULL,
                                            'ocupacion_uno' => NULL,
                                        ]);
        
        ProfesionalOcupacionCetsLesp::where('id_catalogo_dos', $id)
                                        ->update([
                                            'area_dos' => NULL,
                                            'subarea_dos' => NULL,
                                            'jefatura_programa_dos' => NULL,
                                            'componente_dos' => NULL,
                                            'ocupacion_dos' => NULL,
                                        ]);

        return redirect()->route('ocupacionCetsLespIndex')->with('delete', 'Ocupación eliminada correctamente.');
    }
}
