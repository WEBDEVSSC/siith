<?php

namespace App\Http\Controllers;

use App\Models\CatOcupacionCeam;
use App\Models\ProfesionalOcupacionCeam;
use Illuminate\Http\Request;

class CatalogoOcupacionCeamController extends Controller
{
    public function ocupacionCeamIndex()
    {
        // Cargamos todos los registros de la tabla
        $ocupaciones = CatOcupacionCeam::orderBy('orden')->get();

        // Retornamos la vista con el arreglo
        return view('settings.ocupacion.ceam.ceam-index', compact('ocupaciones'));
    }

    public function ocupacionCeamCreate()
    {
        // Cargamos la vista del formulario
        return view('settings.ocupacion.ceam.ceam-create');
    }

    public function ocupacionCeamStore(Request $request)
    {
        // Validamos los datos
        $request->validate([
            'unidad' => 'required|string',
            'area' => 'required|string',
            'subarea_servicio' => 'required|string',
            'componente' => 'required|string',
            'ocupacion' => 'required|string',
            'orden' => 'required|string',
            's_area_trabajo' => 'nullable|string',
            's_ocupacion' => 'nullable|string'
        ],[            
            'unidad.required' => 'El campo unidad es obligatorio.',
            'unidad.string' => 'El campo unidad debe ser una cadena de texto.',
            
            'area.required' => 'El campo área es obligatorio.',
            'area.string' => 'El campo área debe ser una cadena de texto.',
            
            'subarea_servicio.required' => 'El campo subarea servicio es obligatorio.',
            'subarea_servicio.string' => 'El campo subarea servicio debe ser una cadena de texto.',

            'componente.required' => 'El campo componente es obligatorio.',
            'componente.string' => 'El campo componente debe ser una cadena de texto.',
            
            'ocupacion.required' => 'El campo ocupación es obligatorio.',
            'ocupacion.string' => 'El campo ocupación debe ser una cadena de texto.',
            
            'orden.required' => 'El campo orden es obligatorio.',
            'orden.string' => 'El campo orden debe ser una cadena de texto.',

            's_area_trabajo.string' => 'El campo área de trabajo debe ser una cadena de texto.',
            's_ocupacion.string' => 'El campo ocupación debe ser una cadena de texto.',
        ]);

        // Creamos el objeto
        $ocupacion = new CatOcupacionCeam();

        // Asignamos los valores
        $ocupacion->unidad = $request->unidad;
        $ocupacion->area = $request->area;
        $ocupacion->subarea_servicio = $request->subarea_servicio;
        $ocupacion->componente = $request->componente;
        $ocupacion->ocupacion = $request->ocupacion;
        $ocupacion->orden = $request->orden;
        $ocupacion->s_area_trabajo = $request->s_area_trabajo;
        $ocupacion->s_ocupacion = $request->s_ocupacion;

        // Guardamos los valores
        $ocupacion->save();

        // Retornamos a la vista
        return redirect()->route('ocupacionCeamIndex')->with('success', 'Registro realizado correctamente');
    }

    public function ocupacionCeamEdit($id)
    {
        // Consultamos los datos del registro
        $ocupacion = CatOcupacionCeam::findOrFail($id);

        // Regresamos a la vista con el arreglo
        return view('settings.ocupacion.ceam.ceam-edit', compact('ocupacion'));
    }

    public function ocupacionCeamUpdate(Request $request, $id)
    {
        // Validamos los datos
        $request->validate([
            'unidad' => 'required|string',
            'area' => 'required|string',
            'subarea_servicio' => 'required|string',
            'componente' => 'required|string',
            'ocupacion' => 'required|string',
            'orden' => 'required|string',
            's_area_trabajo' => 'nullable|string',
            's_ocupacion' => 'nullable|string', 
        ],[            
            'unidad.required' => 'El campo unidad es obligatorio.',
            'unidad.string' => 'El campo unidad debe ser una cadena de texto.',
            
            'area.required' => 'El campo área es obligatorio.',
            'area.string' => 'El campo área debe ser una cadena de texto.',
            
            'subarea_servicio.required' => 'El campo subarea servicio es obligatorio.',
            'subarea_servicio.string' => 'El campo subarea servicio debe ser una cadena de texto.',

            'componente.required' => 'El campo componente es obligatorio.',
            'componente.string' => 'El campo componente debe ser una cadena de texto.',
            
            'ocupacion.required' => 'El campo ocupación es obligatorio.',
            'ocupacion.string' => 'El campo ocupación debe ser una cadena de texto.',
            
            'orden.required' => 'El campo orden es obligatorio.',
            'orden.string' => 'El campo orden debe ser una cadena de texto.',

            's_area_trabajo.string' => 'El campo área de trabajo debe ser una cadena de texto.',
            's_ocupacion.string' => 'El campo ocupación debe ser una cadena de texto.',
        ]);

        // Buscamos el registro
        $ocupacion = CatOcupacionCeam::findOrFail($id);

        // Asignamos los valores del formulario al modelo
        $ocupacion->unidad = $request->unidad;
        $ocupacion->area = $request->area;
        $ocupacion->subarea_servicio = $request->subarea_servicio;
        $ocupacion->componente = $request->componente;
        $ocupacion->ocupacion = $request->ocupacion;
        $ocupacion->orden = $request->orden;
        $ocupacion->s_area_trabajo = $request->s_area_trabajo;
        $ocupacion->s_ocupacion = $request->s_ocupacion;

        // Guardamos los cambios
        $ocupacion->save();

        ProfesionalOcupacionCeam::where('id_catalogo_uno', $id)
                                        ->update([
                                            'unidad_uno' => $request->unidad,
                                            'area_uno' => $request->area,
                                            'subarea_servicio_uno' => $request->subarea_servicio,
                                            'componente_uno' => $request->componente,
                                            'ocupacion_uno' => $request->ocupacion,
                                            's_area_trabajo_uno' => $request->s_area_trabajo,
                                            's_ocupacion_uno' => $request->s_ocupacion,
                                        ]);

        ProfesionalOcupacionCeam::where('id_catalogo_dos', $id)
                                        ->update([
                                            'unidad_dos' => $request->unidad,
                                            'area_dos' => $request->area,
                                            'subarea_servicio_dos' => $request->subarea_servicio,
                                            'componente_dos' => $request->componente,
                                            'ocupacion_dos' => $request->ocupacion,
                                            's_area_trabajo_dos' => $request->s_area_trabajo,
                                            's_ocupacion_dos' => $request->s_ocupacion,
                                        ]);

        // Redirigimos con un mensaje de éxito
        return redirect()->route('ocupacionCeamIndex')->with('update', 'Ocupación actualizada correctamente.');
    }

    public function ocupacionCeamDestroy($id)
    {
        // Buscamos el registro
        $ocupacion = CatOcupacionCeam::findOrFail($id);

        // Eliminamos el regisrtro
        $ocupacion->delete();

        // Limpiamos los registros
        ProfesionalOcupacionCeam::where('id_catalogo_uno', $id)
                                        ->update([
                                            'unidad_uno' => NULL,
                                            'area_uno' => NULL,
                                            'subarea_servicio_uno' => NULL,
                                            'componente_uno' => NULL,
                                            'ocupacion_uno' => NULL,
                                            's_area_trabajo_uno' => NULL,
                                            's_ocupacion_uno' => NULL,
                                        ]);
        
        ProfesionalOcupacionCeam::where('id_catalogo_dos', $id)
                                        ->update([
                                            'unidad_dos' => NULL,
                                            'area_dos' => NULL,
                                            'subarea_servicio_dos' => NULL,
                                            'componente_dos' => NULL,
                                            'ocupacion_dos' => NULL,
                                            's_area_trabajo_dos' => NULL,
                                            's_ocupacion_dos' => NULL,
                                        ]);

        return redirect()->route('ocupacionCeamIndex')->with('delete', 'Ocupación eliminada correctamente.');
    }
}
