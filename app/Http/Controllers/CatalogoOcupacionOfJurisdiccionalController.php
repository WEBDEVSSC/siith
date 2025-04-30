<?php

namespace App\Http\Controllers;

use App\Models\CatOcupacionOfJurisdiccional;
use App\Models\ProfesionalOcupacionOfJurisdiccional;
use Illuminate\Http\Request;

class CatalogoOcupacionOfJurisdiccionalController extends Controller
{
    //
    public function ocupacionOfJurisdiccionalIndex()
    {
        // Cargamos todos los registros de la tabla
        $ocupaciones = CatOcupacionOfJurisdiccional::orderBy('id')->get();

        // Retornamos la vista con el arreglo
        return view('settings.ocupacion.oficina-jurisdiccional.oficina-jurisdiccional-index', compact('ocupaciones'));
    }

    public function ocupacionOfJurisdiccionalCreate()
    {
        // Cargamos la vista del formulario
        return view('settings.ocupacion.oficina-jurisdiccional.oficina-jurisdiccional-create');
    }

    public function ocupacionOfJurisdiccionalStore(Request $request)
    {
        // Validamos los datos
        $request->validate([
            'unidad' => 'required|string',
            'area' => 'required|string',
            'subarea' => 'required|string',
            'servicio' => 'required|string',
            'ocupacion' => 'required|string',
        ],[
            'unidad.required' => 'El campo unidad es obligatorio.',
            'unidad.string' => 'El campo unidad debe ser una cadena de texto.',
            
            'area.required' => 'El campo área es obligatorio.',
            'area.string' => 'El campo área debe ser una cadena de texto.',
            
            'subarea.required' => 'El campo subárea es obligatorio.',
            'subarea.string' => 'El campo subárea debe ser una cadena de texto.',
            
            'servicio.required' => 'El campo servicio es obligatorio.',
            'servicio.string' => 'El campo servicio debe ser una cadena de texto.',

            'ocupacion.required' => 'El campo ocupación es obligatorio.',
            'ocupacion.string' => 'El campo ocupación debe ser una cadena de texto.',
        ]);

        // Creamos el objeto
        $ocupacion = new CatOcupacionOfJurisdiccional();

        // Asignamos los valores
        $ocupacion->unidad = $request->unidad;
        $ocupacion->area = $request->area;
        $ocupacion->subarea = $request->subarea;
        $ocupacion->servicio = $request->servicio;
        $ocupacion->ocupacion = $request->ocupacion;

        // Guardamos los valores
        $ocupacion->save();

        // Retornamos a la vista
        return redirect()->route('ocupacionOfJurisdiccionalIndex')->with('success', 'Registro realizado correctamente');
    }

    public function ocupacionOfJurisdiccionalEdit($id)
    {   
        // Consultamos los datos del registro
        $ocupacion = CatOcupacionOfJurisdiccional::findOrFail($id);

        // Regresamos a la vista con el arreglo
        return view('settings.ocupacion.oficina-jurisdiccional.oficina-jurisdiccional-edit', compact('ocupacion'));
    }

    public function ocupacionOfJurisdiccionalUpdate(Request $request, $id)
    {
        // Validamos los datos
        $request->validate([
            'unidad' => 'required|string',
            'area' => 'required|string',
            'subarea' => 'required|string',
            'servicio' => 'required|string',
            'ocupacion' => 'required|string',
        ],[
            'unidad.required' => 'El campo unidad es obligatorio.',
            'unidad.string' => 'El campo unidad debe ser una cadena de texto.',
            
            'area.required' => 'El campo área es obligatorio.',
            'area.string' => 'El campo área debe ser una cadena de texto.',
            
            'subarea.required' => 'El campo subárea es obligatorio.',
            'subarea.string' => 'El campo subárea debe ser una cadena de texto.',
            
            'servicio.required' => 'El campo ocupación es obligatorio.',
            'servicio.string' => 'El campo ocupación debe ser una cadena de texto.',

            'ocupacion.required' => 'El campo ocupación es obligatorio.',
            'ocupacion.string' => 'El campo ocupación debe ser una cadena de texto.',
        ]);

        // Buscamos el registro
        $ocupacion = CatOcupacionOfJurisdiccional::findOrFail($id);

        // Asignamos los valores del formulario al modelo
        $ocupacion->unidad = $request->unidad;
        $ocupacion->area = $request->area;
        $ocupacion->subarea = $request->subarea;
        $ocupacion->servicio = $request->servicio;
        $ocupacion->ocupacion = $request->ocupacion;

        // Guardamos los cambios
        $ocupacion->save();

        ProfesionalOcupacionOfJurisdiccional::where('id_catalogo_uno', $id)
                                        ->update([
                                            'unidad_uno' => $request->unidad,
                                            'area_uno' => $request->area,
                                            'subarea_uno' => $request->subarea,
                                            'servicio_uno' => $request->servicio,
                                            'ocupacion_uno' => $request->ocupacion,
                                        ]);

        ProfesionalOcupacionOfJurisdiccional::where('id_catalogo_dos', $id)
                                        ->update([
                                            'unidad_dos' => $request->unidad,
                                            'area_dos' => $request->area,
                                            'subarea_dos' => $request->subarea,
                                            'servicio_dos' => $request->servicio,
                                            'ocupacion_dos' => $request->ocupacion,
                                        ]);

        // Redirigimos con un mensaje de éxito
        return redirect()->route('ocupacionOfJurisdiccionalIndex')->with('update', 'Ocupación actualizada correctamente.');
    }

    public function ocupacionOfJurisdiccionalDestroy($id)
    {
        // Buscamos el registro
        $ocupacion = CatOcupacionOfJurisdiccional::findOrFail($id);

        // Eliminamos el regisrtro
        $ocupacion->delete();

        // Limpiamos los registros
        ProfesionalOcupacionOfJurisdiccional::where('id_catalogo_uno', $id)
                                        ->update([
                                            'unidad_uno' => NULL,
                                            'area_uno' => NULL,
                                            'subarea_uno' => NULL,
                                            'servicio_uno' => NULL,
                                            'ocupacion_uno' => NULL,
                                        ]);
        
        ProfesionalOcupacionOfJurisdiccional::where('id_catalogo_dos', $id)
                                        ->update([
                                            'unidad_dos' => NULL,
                                            'area_dos' => NULL,
                                            'subarea_dos' => NULL,
                                            'servicio_dos' => NULL,
                                            'ocupacion_dos' => NULL,
                                        ]);

        return redirect()->route('ocupacionOfJurisdiccionalIndex')->with('delete', 'Ocupación eliminada correctamente.');
    }
}
