<?php

namespace App\Http\Controllers;

use App\Models\CatOcupacionCriCree;
use App\Models\ProfesionalOcupacionCriCree;
use Illuminate\Http\Request;

class CatalogoOcupacionCriCreeController extends Controller
{
    //
    public function ocupacionCriCreeIndex()
    {
        // Cargamos todos los registros de la tabla
        $ocupaciones = CatOcupacionCriCree::orderBy('orden')->get();

        // Retornamos la vista con el arreglo
        return view('settings.ocupacion.criCree.criCree-index', compact('ocupaciones'));
    }

    public function ocupacionCriCreeCreate()
    {
        // Cargamos la vista del formulario
        return view('settings.ocupacion.criCree.criCree-create');
    }

    public function ocupacionCriCreeStore(Request $request)
    {
        // Validamos los datos
        $request->validate([
            'unidad' => 'required|string',
            'area' => 'required|string',
            'subarea' => 'required|string',
            'ocupacion' => 'required|string',
            'orden' => 'required|string',
        ],[
            'unidad.required' => 'El campo unidad es obligatorio.',
            'unidad.string' => 'El campo unidad debe ser una cadena de texto.',
            
            'area.required' => 'El campo área es obligatorio.',
            'area.string' => 'El campo área debe ser una cadena de texto.',
            
            'subarea.required' => 'El campo subárea es obligatorio.',
            'subarea.string' => 'El campo subárea debe ser una cadena de texto.',
            
            'ocupacion.required' => 'El campo ocupación es obligatorio.',
            'ocupacion.string' => 'El campo ocupación debe ser una cadena de texto.',

            'orden.required' => 'El campo ocupación es obligatorio.',
            'orden.string' => 'El campo ocupación debe ser una cadena de texto.',
        ]);

        // Creamos el objeto
        $ocupacion = new CatOcupacionCriCree();

        // Asignamos los valores
        $ocupacion->unidad = $request->unidad;
        $ocupacion->area = $request->area;
        $ocupacion->subarea = $request->subarea;
        $ocupacion->ocupacion = $request->ocupacion;
        $ocupacion->orden = $request->orden;

        // Guardamos los valores
        $ocupacion->save();

        // Retornamos a la vista
        return redirect()->route('ocupacionCriCreeIndex')->with('success', 'Registro realizado correctamente');
    }

    public function ocupacionCriCreeEdit($id)
    {
        // Consultamos los datos del registro
        $ocupacion = CatOcupacionCriCree::findOrFail($id);

        // Regresamos a la vista con el arreglo
        return view('settings.ocupacion.criCree.criCree-edit', compact('ocupacion'));
    }

    public function ocupacionCriCreeUpdate(Request $request, $id)
    {
        // Validamos los datos
        $request->validate([
            'unidad' => 'required|string',
            'area' => 'required|string',
            'subarea' => 'required|string',
            'ocupacion' => 'required|string',
            'orden' => 'required|string',
        ],[
            'unidad.required' => 'El campo unidad es obligatorio.',
            'unidad.string' => 'El campo unidad debe ser una cadena de texto.',
            
            'area.required' => 'El campo área es obligatorio.',
            'area.string' => 'El campo área debe ser una cadena de texto.',
            
            'subarea.required' => 'El campo subárea es obligatorio.',
            'subarea.string' => 'El campo subárea debe ser una cadena de texto.',
            
            'ocupacion.required' => 'El campo ocupación es obligatorio.',
            'ocupacion.string' => 'El campo ocupación debe ser una cadena de texto.',

            'orden.required' => 'El campo ocupación es obligatorio.',
            'orden.string' => 'El campo ocupación debe ser una cadena de texto.',
        ]);

        // Buscamos el registro
        $ocupacion = CatOcupacionCriCree::findOrFail($id);

        // Asignamos los valores del formulario al modelo
        $ocupacion->unidad = $request->unidad;
        $ocupacion->area = $request->area;
        $ocupacion->subarea = $request->subarea;
        $ocupacion->ocupacion = $request->ocupacion;
        $ocupacion->orden = $request->orden;

        // Guardamos los cambios
        $ocupacion->save();

        ProfesionalOcupacionCriCree::where('id_catalogo_uno', $id)
                                        ->update([
                                            'unidad_uno' => $request->unidad,
                                            'area_uno' => $request->area,
                                            'subarea_uno' => $request->subarea,
                                            'ocupacion_uno' => $request->ocupacion,
                                        ]);

        ProfesionalOcupacionCriCree::where('id_catalogo_dos', $id)
                                        ->update([
                                            'unidad_dos' => $request->unidad,
                                            'area_dos' => $request->area,
                                            'subarea_dos' => $request->subarea,
                                            'ocupacion_dos' => $request->ocupacion,
                                        ]);

        // Redirigimos con un mensaje de éxito
        return redirect()->route('ocupacionCriCreeIndex')->with('update', 'Ocupación actualizada correctamente.');
    }

    public function ocupacionCriCreeDestroy($id)
    {
        // Buscamos el registro
        $ocupacion = CatOcupacionCriCree::findOrFail($id);

        // Eliminamos el regisrtro
        $ocupacion->delete();

        // Limpiamos los registros
        ProfesionalOcupacionCriCree::where('id_catalogo_uno', $id)
                                        ->update([
                                            'unidad_uno' => NULL,
                                            'area_uno' => NULL,
                                            'subarea_uno' => NULL,
                                            'ocupacion_uno' => NULL,
                                        ]);
        
        ProfesionalOcupacionCriCree::where('id_catalogo_dos', $id)
                                        ->update([
                                            'unidad_dos' => NULL,
                                            'area_dos' => NULL,
                                            'subarea_dos' => NULL,
                                            'ocupacion_dos' => NULL,
                                        ]);

        return redirect()->route('ocupacionCriCreeIndex')->with('delete', 'Ocupación eliminada correctamente.');
    }

}
