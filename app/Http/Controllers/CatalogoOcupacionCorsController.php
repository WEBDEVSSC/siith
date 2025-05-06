<?php

namespace App\Http\Controllers;

use App\Models\CatOcupacionCors;
use App\Models\ProfesionalOcupacionCors;
use Illuminate\Http\Request;

class CatalogoOcupacionCorsController extends Controller
{
    //
    public function ocupacionCorsIndex()
    {
        // Cargamos todos los registros de la tabla
        $ocupaciones = CatOcupacionCors::orderBy('id')->get();

        // Retornamos la vista con el arreglo
        return view('settings.ocupacion.cors.cors-index', compact('ocupaciones'));
    }

    public function ocupacionCorsCreate()
    {
        // Cargamos la vista del formulario
        return view('settings.ocupacion.cors.cors-create');
    }

    public function ocupacionCorsStore(Request $request)
    {
        // Validamos los datos
        $request->validate([
            'unidad' => 'required|string',
            'area' => 'required|string',
            'subarea_servicio' => 'required|string',
            'componente' => 'required|string',
            'ocupacion' => 'required|string',
            'orden' => 'required|string',
        ],[            
            'unidad.required' => 'El campo unidad es obligatorio.',
            'unidad.string' => 'El campo unidad debe ser una cadena de texto.',
            
            'area.required' => 'El campo área es obligatorio.',
            'area.string' => 'El campo área debe ser una cadena de texto.',
            
            'subarea_servicio.required' => 'El campo subárea servicio es obligatorio.',
            'subarea_servicio.string' => 'El campo subárea servicio debe ser una cadena de texto.',

            'componente.required' => 'El campo componentees obligatorio.',
            'componente.string' => 'El campo componente debe ser una cadena de texto.',

            'ocupacion.required' => 'El campo ocupacion es obligatorio.',
            'ocupacion.string' => 'El campo ocupacion debe ser una cadena de texto.',

            'orden.required' => 'El campo orden es obligatorio.',
            'orden.string' => 'El campo orden debe ser una cadena de texto.',
        ]);

        // Creamos el objeto
        $ocupacion = new CatOcupacionCors();

        // Asignamos los valores
        $ocupacion->unidad = $request->unidad;
        $ocupacion->area = $request->area;
        $ocupacion->subarea_servicio = $request->subarea_servicio;
        $ocupacion->componente = $request->componente;
        $ocupacion->ocupacion = $request->ocupacion;
        $ocupacion->orden = $request->orden;

        // Guardamos los valores
        $ocupacion->save();

        // Retornamos a la vista
        return redirect()->route('ocupacionCorsIndex')->with('success', 'Registro realizado correctamente');
    }

    public function ocupacionCorsEdit($id)
    {
        // Consultamos los datos del registro
        $ocupacion = CatOcupacionCors::findOrFail($id);

        // Regresamos a la vista con el arreglo
        return view('settings.ocupacion.cors.cors-edit', compact('ocupacion'));
    }

    public function ocupacionCorsUpdate(Request $request, $id)
    {
        // Validamos los datos
        $request->validate([
            'unidad' => 'required|string',
            'area' => 'required|string',
            'subarea_servicio' => 'required|string',
            'componente' => 'required|string',
            'ocupacion' => 'required|string',
            'orden' => 'required|string',
        ],[            
            'unidad.required' => 'El campo unidad es obligatorio.',
            'unidad.string' => 'El campo unidad debe ser una cadena de texto.',
            
            'area.required' => 'El campo área es obligatorio.',
            'area.string' => 'El campo área debe ser una cadena de texto.',
            
            'subarea_servicio.required' => 'El campo subárea servicio es obligatorio.',
            'subarea_servicio.string' => 'El campo subárea servicio debe ser una cadena de texto.',

            'componente.required' => 'El campo componentees obligatorio.',
            'componente.string' => 'El campo componente debe ser una cadena de texto.',

            'ocupacion.required' => 'El campo ocupacion es obligatorio.',
            'ocupacion.string' => 'El campo ocupacion debe ser una cadena de texto.',

            'orden.required' => 'El campo orden es obligatorio.',
            'orden.string' => 'El campo orden debe ser una cadena de texto.',
        ]);

        // Buscamos el registro
        $ocupacion = CatOcupacionCors::findOrFail($id);

        // Asignamos los valores
        $ocupacion->unidad = $request->unidad;
        $ocupacion->area = $request->area;
        $ocupacion->subarea_servicio = $request->subarea_servicio;
        $ocupacion->componente = $request->componente;
        $ocupacion->ocupacion = $request->ocupacion;
        $ocupacion->orden = $request->orden;

        // Guardamos los cambios
        $ocupacion->save();

        ProfesionalOcupacionCors::where('id_catalogo_uno', $id)
                                        ->update([
                                            'unidad_uno' => $request->unidad,
                                            'area_uno' => $request->area,
                                            'subarea_servicio_uno' => $request->subarea_servicio,
                                            'componente_uno' => $request->componente,
                                            'ocupacion_uno' => $request->ocupacion,
                                        ]);

        ProfesionalOcupacionCors::where('id_catalogo_dos', $id)
                                        ->update([
                                            'unidad_dos' => $request->unidad,
                                            'area_dos' => $request->area,
                                            'subarea_servicio_dos' => $request->subarea_servicio,
                                            'componente_dos' => $request->componente,
                                            'ocupacion_dos' => $request->ocupacion,
                                        ]);

        // Redirigimos con un mensaje de éxito
        return redirect()->route('ocupacionCorsIndex')->with('update', 'Ocupación actualizada correctamente.');
    }

    public function ocupacionCorsDestroy($id)
    {
        // Buscamos el registro
        $ocupacion = CatOcupacionCors::findOrFail($id);

        // Eliminamos el regisrtro
        $ocupacion->delete();

        // Limpiamos los registros
        ProfesionalOcupacionCors::where('id_catalogo_uno', $id)
                                        ->update([
                                            'unidad_uno' => NULL,
                                            'area_uno' => NULL,
                                            'subarea_servicio_uno' => NULL,
                                            'componente_uno' => NULL,
                                            'ocupacion_uno' => NULL,
                                        ]);
        
        ProfesionalOcupacionCors::where('id_catalogo_dos', $id)
                                        ->update([
                                            'unidad_dos' => NULL,
                                            'area_dos' => NULL,
                                            'subarea_servicio_dos' => NULL,
                                            'componente_dos' => NULL,
                                            'ocupacion_dos' => NULL,
                                        ]);

        return redirect()->route('ocupacionCorsIndex')->with('delete', 'Ocupación eliminada correctamente.');
    }
}
