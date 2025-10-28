<?php

namespace App\Http\Controllers;

use App\Models\CatOcupacionEnsenanza;
use App\Models\ProfesionalOcupacionEnsenanza;
use Illuminate\Http\Request;

class CatalogoOcupacionEnsenanzaController extends Controller
{
    //
    public function ocupacionEnsenanzaIndex()
    {
        // Cargamos todos los registros de la tabla
        $ocupaciones = CatOcupacionEnsenanza::all();

        // Retornamos la vista con el arreglo
        return view('settings.ocupacion.ensenanza.ensenanza-index', compact('ocupaciones'));
    }

    public function ocupacionEnsenanzaCreate()
    {
        // Cargamos la vista del formulario
        return view('settings.ocupacion.ensenanza.ensenanza-create');
    }

    public function ocupacionEnsenanzaStore(Request $request)
    {
        // Validamos los datos
        $request->validate([
            'unidad' => 'required|string',
            'area' => 'required|string',
            'subarea' => 'required|string',
            'ocupacion' => 'required|string',
        ],[            
            'unidad.required' => 'El campo unidad es obligatorio.',
            'unidad.string' => 'El campo unidad debe ser una cadena de texto.',

            'area.required' => 'El campo área es obligatorio.',
            'area.string' => 'El campo área debe ser una cadena de texto.',
            
            'subarea.required' => 'El campo subárea es obligatorio.',
            'subarea.string' => 'El campo subárea debe ser una cadena de texto.',
            
            'ocupacion.required' => 'El campo ocupación es obligatorio.',
            'ocupacion.string' => 'El campo ocupación debe ser una cadena de texto.',
        ]);

        // Creamos el objeto
        $ocupacion = new CatOcupacionEnsenanza();

        // Asignamos los valores
        $ocupacion->unidad = $request->unidad;
        $ocupacion->area = $request->area;
        $ocupacion->subarea = $request->subarea;
        $ocupacion->ocupacion = $request->ocupacion;

        // Guardamos los valores
        $ocupacion->save();

        // Retornamos a la vista
        return redirect()->route('ocupacionEnsenanzaIndex')->with('success', 'Ocupacion registrada correctamente');
    }

    public function ocupacionEnsenanzaEdit($id)
    {
        // Consultamos los datos del registro
        $ocupacion = CatOcupacionEnsenanza::findOrFail($id);

        // Regresamos a la vista con el arreglo
        return view('settings.ocupacion.ensenanza.ensenanza-edit', compact('ocupacion'));
    }

    public function ocupacionEnsenanzaUpdate(Request $request, $id)
    {
        // Validamos los datos
        $request->validate([
            'unidad' => 'required|string',
            'area' => 'required|string',
            'subarea' => 'required|string',
            'ocupacion' => 'required|string',
        ],[            
            'unidad.required' => 'El campo unidad es obligatorio.',
            'unidad.string' => 'El campo unidad debe ser una cadena de texto.',

            'area.required' => 'El campo área es obligatorio.',
            'area.string' => 'El campo área debe ser una cadena de texto.',
            
            'subarea.required' => 'El campo subárea es obligatorio.',
            'subarea.string' => 'El campo subárea debe ser una cadena de texto.',
            
            'ocupacion.required' => 'El campo ocupación es obligatorio.',
            'ocupacion.string' => 'El campo ocupación debe ser una cadena de texto.',
        ]);


        // Buscamos el registro
        $ocupacion = CatOcupacionEnsenanza::findOrFail($id);

        // Asignamos los valores del formulario al modelo
        $ocupacion->unidad = $request->unidad;
        $ocupacion->area = $request->area;
        $ocupacion->subarea = $request->subarea;
        $ocupacion->ocupacion = $request->ocupacion;

        // Guardamos los cambios
        $ocupacion->save();

        ProfesionalOcupacionEnsenanza::where('id_catalogo', $id)
                                        ->update([
                                            'unidad' => $request->unidad,
                                            'area' => $request->area,
                                            'subarea' => $request->subarea,
                                            'ocupacion' => $request->ocupacion,
                                        ]);

        // Redirigimos con un mensaje de éxito
        return redirect()->route('ocupacionEnsenanzaIndex')->with('update', 'Ocupación actualizada correctamente.');
    }

    public function ocupacionEnsenanzaDestroy($id)
    {
        // Buscamos el registro
        $ocupacion = CatOcupacionEnsenanza::findOrFail($id);

        // Eliminamos el regisrtro
        $ocupacion->delete();

        // Limpiamos los registros
        ProfesionalOcupacionEnsenanza::where('id_catalogo', $id)
                                        ->update([
                                            'unidad' => NULL,
                                            'area' => NULL,
                                            'subarea' => NULL,
                                            'ocupacion' => NULL,
                                        ]);

        return redirect()->route('ocupacionEnsenanzaIndex')->with('delete', 'Ocupación eliminada correctamente.');
    }
}
