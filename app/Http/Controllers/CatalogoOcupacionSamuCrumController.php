<?php

namespace App\Http\Controllers;

use App\Models\CatOcupacionSamuCrum;
use App\Models\ProfesionalOcupacionSamuCrum;
use Illuminate\Http\Request;

class CatalogoOcupacionSamuCrumController extends Controller
{
    //
    public function ocupacionSamuCrumIndex()
    {
        // Cargamos todos los registros de la tabla
        $ocupaciones = CatOcupacionSamuCrum::orderBy('id')->get();

        // Retornamos la vista con el arreglo
        return view('settings.ocupacion.samu-crum.samuCrum-index', compact('ocupaciones'));
    }

    public function ocupacionSamuCrumCreate()
    {
        // Cargamos la vista del formulario
        return view('settings.ocupacion.samu-crum.samuCrum-create');
    }

    public function ocupacionSamuCrumStore(Request $request)
    {
        // Validamos los datos
        $request->validate([
            'unidad' => 'required|string',
            'area' => 'required|string',
            'subarea' => 'required|string',
            'componente' => 'required|string',
            'ocupacion' => 'required|string',
            'orden' => 'required|string',
        ],[
            'unidad.required' => 'El campo unidad es obligatorio.',
            'unidad.string' => 'El campo unidad debe ser una cadena de texto.',
            
            'area.required' => 'El campo área es obligatorio.',
            'area.string' => 'El campo área debe ser una cadena de texto.',
            
            'subarea.required' => 'El campo subárea es obligatorio.',
            'subarea.string' => 'El campo subárea debe ser una cadena de texto.',
            
            'componente.required' => 'El campo componente es obligatorio.',
            'componente.string' => 'El campo componente debe ser una cadena de texto.',

            'ocupacion.required' => 'El campo ocupacion es obligatorio.',
            'ocupacion.string' => 'El campo ocupacion debe ser una cadena de texto.',

            'orden.required' => 'El campo orden es obligatorio.',
            'orden.string' => 'El campo orden debe ser una cadena de texto.',
        ]);

        // Creamos el objeto
        $ocupacion = new CatOcupacionSamuCrum();

        // Asignamos los valores
        $ocupacion->unidad = $request->unidad;
        $ocupacion->area = $request->area;
        $ocupacion->subarea = $request->subarea;
        $ocupacion->componente = $request->componente;
        $ocupacion->ocupacion = $request->ocupacion;
        $ocupacion->orden = $request->orden;

        // Guardamos los valores
        $ocupacion->save();

        // Retornamos a la vista
        return redirect()->route('ocupacionSamuCrumIndex')->with('success', 'Registro realizado correctamente');
    }

    public function ocupacionSamuCrumEdit($id)
    {
        // Consultamos los datos del registro
        $ocupacion = CatOcupacionSamuCrum::findOrFail($id);

        // Regresamos a la vista con el arreglo
        return view('settings.ocupacion.samu-crum.samuCrum-edit', compact('ocupacion'));
    }

    public function ocupacionSamuCrumUpdate(Request $request, $id)
    {
        // Validamos los datos
        $request->validate([
            'unidad' => 'required|string',
            'area' => 'required|string',
            'subarea' => 'required|string',
            'componente' => 'required|string',
            'ocupacion' => 'required|string',
            'orden' => 'required|string',
        ],[
            'unidad.required' => 'El campo unidad es obligatorio.',
            'unidad.string' => 'El campo unidad debe ser una cadena de texto.',
            
            'area.required' => 'El campo área es obligatorio.',
            'area.string' => 'El campo área debe ser una cadena de texto.',
            
            'subarea.required' => 'El campo subárea es obligatorio.',
            'subarea.string' => 'El campo subárea debe ser una cadena de texto.',
            
            'componente.required' => 'El campo componente es obligatorio.',
            'componente.string' => 'El campo componente debe ser una cadena de texto.',

            'ocupacion.required' => 'El campo ocupacion es obligatorio.',
            'ocupacion.string' => 'El campo ocupacion debe ser una cadena de texto.',

            'orden.required' => 'El campo orden es obligatorio.',
            'orden.string' => 'El campo orden debe ser una cadena de texto.',
        ]);

        // Buscamos el registro
        $ocupacion = CatOcupacionSamuCrum::findOrFail($id);

        // Asignamos los valores
        $ocupacion->unidad = $request->unidad;
        $ocupacion->area = $request->area;
        $ocupacion->subarea = $request->subarea;
        $ocupacion->componente = $request->componente;
        $ocupacion->ocupacion = $request->ocupacion;
        $ocupacion->orden = $request->orden;

        // Guardamos los cambios
        $ocupacion->save();

        ProfesionalOcupacionSamuCrum::where('id_catalogo_uno', $id)
                                        ->update([
                                            'unidad_uno' => $request->unidad,
                                            'area_uno' => $request->area,
                                            'subarea_uno' => $request->subarea,
                                            'componente_uno' => $request->componente,
                                            'ocupacion_uno' => $request->ocupacion,
                                        ]);

        ProfesionalOcupacionSamuCrum::where('id_catalogo_dos', $id)
                                        ->update([
                                            'unidad_dos' => $request->unidad,
                                            'area_dos' => $request->area,
                                            'subarea_dos' => $request->subarea,
                                            'componente_dos' => $request->componente,
                                            'ocupacion_dos' => $request->ocupacion,
                                        ]);

        // Redirigimos con un mensaje de éxito
        return redirect()->route('ocupacionSamuCrumIndex')->with('update', 'Ocupación actualizada correctamente.');
    }

    public function ocupacionSamuCrumDestroy($id)
    {
        // Buscamos el registro
        $ocupacion = CatOcupacionSamuCrum::findOrFail($id);

        // Eliminamos el regisrtro
        $ocupacion->delete();

        // Limpiamos los registros
        ProfesionalOcupacionSamuCrum::where('id_catalogo_uno', $id)
                                        ->update([
                                            'unidad_uno' => NULL,
                                            'area_uno' => NULL,
                                            'subarea_uno' => NULL,
                                            'componente_uno' => NULL,
                                            'ocupacion_uno' => NULL,
                                        ]);
        
        ProfesionalOcupacionSamuCrum::where('id_catalogo_dos', $id)
                                        ->update([
                                            'unidad_dos' => NULL,
                                            'area_dos' => NULL,
                                            'subarea_dos' => NULL,
                                            'componente_dos' => NULL,
                                            'ocupacion_dos' => NULL,
                                        ]);

        return redirect()->route('ocupacionSamuCrumIndex')->with('delete', 'Ocupación eliminada correctamente.');
    }
}
