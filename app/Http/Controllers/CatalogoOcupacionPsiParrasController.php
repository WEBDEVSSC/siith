<?php

namespace App\Http\Controllers;

use App\Models\CatOcupacionPsiParras;
use App\Models\ProfesionalOcupacionPsiParras;
use Illuminate\Http\Request;

class CatalogoOcupacionPsiParrasController extends Controller
{
    //
    public function ocupacionPsiParrasIndex()
    {
        // Cargamos todos los registros de la tabla
        $ocupaciones = CatOcupacionPsiParras::orderBy('orden')->get();

        // Retornamos la vista con el arreglo
        return view('settings.ocupacion.psi-parras.psi-parras-index', compact('ocupaciones'));
    }

    public function ocupacionPsiParrasCreate()
    {
        // Cargamos la vista del formulario
        return view('settings.ocupacion.psi-parras.psi-parras-create');
    }

    public function ocupacionPsiParrasStore(Request $request)
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
            
            'subarea_servicio.required' => 'El campo subarea servicio es obligatorio.',
            'subarea_servicio.string' => 'El campo subarea servicio debe ser una cadena de texto.',

            'componente.required' => 'El campo componente es obligatorio.',
            'componente.string' => 'El campo componente debe ser una cadena de texto.',
            
            'ocupacion.required' => 'El campo ocupación es obligatorio.',
            'ocupacion.string' => 'El campo ocupación debe ser una cadena de texto.',
            
            'orden.required' => 'El campo orden es obligatorio.',
            'orden.string' => 'El campo orden debe ser una cadena de texto.',
        ]);

        // Creamos el objeto
        $ocupacion = new CatOcupacionPsiParras();

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
        return redirect()->route('ocupacionPsiParrasIndex')->with('success', 'Registro realizado correctamente');
    }

    public function ocupacionPsiParrasEdit($id)
    {
        // Consultamos los datos del registro
        $ocupacion = CatOcupacionPsiParras::findOrFail($id);

        // Regresamos a la vista con el arreglo
        return view('settings.ocupacion.psi-parras.psi-parras-edit', compact('ocupacion'));
    }

    public function ocupacionPsiParrasUpdate(Request $request, $id)
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
            
            'subarea_servicio.required' => 'El campo subarea servicio es obligatorio.',
            'subarea_servicio.string' => 'El campo subarea servicio debe ser una cadena de texto.',

            'componente.required' => 'El campo componente es obligatorio.',
            'componente.string' => 'El campo componente debe ser una cadena de texto.',
            
            'ocupacion.required' => 'El campo ocupación es obligatorio.',
            'ocupacion.string' => 'El campo ocupación debe ser una cadena de texto.',
            
            'orden.required' => 'El campo orden es obligatorio.',
            'orden.string' => 'El campo orden debe ser una cadena de texto.',
        ]);

        // Buscamos el registro
        $ocupacion = CatOcupacionPsiParras::findOrFail($id);

        // Asignamos los valores del formulario al modelo
        $ocupacion->unidad = $request->unidad;
        $ocupacion->area = $request->area;
        $ocupacion->subarea_servicio = $request->subarea_servicio;
        $ocupacion->componente = $request->componente;
        $ocupacion->ocupacion = $request->ocupacion;
        $ocupacion->orden = $request->orden;

        // Guardamos los cambios
        $ocupacion->save();

        ProfesionalOcupacionPsiParras::where('id_catalogo_uno', $id)
                                        ->update([
                                            'unidad_uno' => $request->unidad,
                                            'area_uno' => $request->area,
                                            'subarea_servicio_uno' => $request->subarea_servicio,
                                            'componente_uno' => $request->componente,
                                            'ocupacion_uno' => $request->ocupacion,
                                        ]);

        ProfesionalOcupacionPsiParras::where('id_catalogo_dos', $id)
                                        ->update([
                                            'unidad_dos' => $request->unidad,
                                            'area_dos' => $request->area,
                                            'subarea_servicio_dos' => $request->subarea_servicio,
                                            'componente_dos' => $request->componente,
                                            'ocupacion_dos' => $request->ocupacion,
                                        ]);

        // Redirigimos con un mensaje de éxito
        return redirect()->route('ocupacionPsiParrasIndex')->with('update', 'Ocupación actualizada correctamente.');
    }

    public function ocupacionPsiParrasDestroy($id)
    {
        // Buscamos el registro
        $ocupacion = CatOcupacionPsiParras::findOrFail($id);

        // Eliminamos el regisrtro
        $ocupacion->delete();

        // Limpiamos los registros
        ProfesionalOcupacionPsiParras::where('id_catalogo_uno', $id)
                                        ->update([
                                            'unidad_uno' => NULL,
                                            'area_uno' => NULL,
                                            'subarea_servicio_uno' => NULL,
                                            'componente_uno' => NULL,
                                            'ocupacion_uno' => NULL,
                                        ]);
        
        ProfesionalOcupacionPsiParras::where('id_catalogo_dos', $id)
                                        ->update([
                                            'unidad_dos' => NULL,
                                            'area_dos' => NULL,
                                            'subarea_servicio_dos' => NULL,
                                            'componente_dos' => NULL,
                                            'ocupacion_dos' => NULL,
                                        ]);

        return redirect()->route('ocupacionPsiParrasIndex')->with('delete', 'Ocupación eliminada correctamente.');
    }
}
