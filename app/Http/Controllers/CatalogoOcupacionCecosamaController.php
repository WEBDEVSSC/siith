<?php

namespace App\Http\Controllers;

use App\Models\CatOcupacionCecosama;
use App\Models\ProfesionalOcupacionCecosama;
use Illuminate\Http\Request;

class CatalogoOcupacionCecosamaController extends Controller
{
    //
    public function ocupacionCecosamaIndex()
    {
        // Cargamos todos los registros de la tabla
        $ocupaciones = CatOcupacionCecosama::orderBy('orden')->get();

        // Retornamos la vista con el arreglo
        return view('settings.ocupacion.cecosama.cecosama-index', compact('ocupaciones'));
    }

    public function ocupacionCecosamaCreate()
    {
        // Cargamos la vista del formulario
        return view('settings.ocupacion.cecosama.cecosama-create');
    }

    public function ocupacionCecosamaStore(Request $request)
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
            
            'subarea.required' => 'El campo subarea servicio es obligatorio.',
            'subarea.string' => 'El campo subarea servicio debe ser una cadena de texto.',
            
            'ocupacion.required' => 'El campo ocupación es obligatorio.',
            'ocupacion.string' => 'El campo ocupación debe ser una cadena de texto.',
            
            'orden.required' => 'El campo orden es obligatorio.',
            'orden.string' => 'El campo orden debe ser una cadena de texto.',
        ]);

        // Creamos el objeto
        $ocupacion = new CatOcupacionCecosama();

        // Asignamos los valores
        $ocupacion->unidad = $request->unidad;
        $ocupacion->area = $request->area;
        $ocupacion->subarea = $request->subarea;
        $ocupacion->ocupacion = $request->ocupacion;
        $ocupacion->orden = $request->orden;

        // Guardamos los valores
        $ocupacion->save();

        // Retornamos a la vista
        return redirect()->route('ocupacionCecosamaIndex')->with('success', 'Registro realizado correctamente');
    }

    public function ocupacionCecosamaEdit($id)
    {
        // Consultamos los datos del registro
        $ocupacion = CatOcupacionCecosama::findOrFail($id);

        // Regresamos a la vista con el arreglo
        return view('settings.ocupacion.cecosama.cecosama-edit', compact('ocupacion'));
    }

    public function ocupacionCecosamaUpdate(Request $request, $id)
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
            
            'subarea.required' => 'El campo subarea servicio es obligatorio.',
            'subarea.string' => 'El campo subarea servicio debe ser una cadena de texto.',
            
            'ocupacion.required' => 'El campo ocupación es obligatorio.',
            'ocupacion.string' => 'El campo ocupación debe ser una cadena de texto.',
            
            'orden.required' => 'El campo orden es obligatorio.',
            'orden.string' => 'El campo orden debe ser una cadena de texto.',
        ]);

        // Buscamos el registro
        $ocupacion = CatOcupacionCecosama::findOrFail($id);

        // Asignamos los valores del formulario al modelo
        $ocupacion->unidad = $request->unidad;
        $ocupacion->area = $request->area;
        $ocupacion->subarea = $request->subarea;
        $ocupacion->ocupacion = $request->ocupacion;
        $ocupacion->orden = $request->orden;

        // Guardamos los cambios
        $ocupacion->save();

        ProfesionalOcupacionCecosama::where('id_catalogo', $id)
                                        ->update([
                                            'unidad' => $request->unidad,
                                            'area' => $request->area,
                                            'subarea' => $request->subarea,
                                            'ocupacion' => $request->ocupacion,
                                        ]);

        // Redirigimos con un mensaje de éxito
        return redirect()->route('ocupacionCecosamaIndex')->with('update', 'Ocupación actualizada correctamente.');
    }

    public function ocupacionCecosamaDestroy($id)
    {
        // Buscamos el registro
        $ocupacion = CatOcupacionCecosama::findOrFail($id);

        // Eliminamos el regisrtro
        $ocupacion->delete();

        // Limpiamos los registros
        ProfesionalOcupacionCecosama::where('id_catalogo', $id)
                                        ->update([
                                            'unidad' => NULL,
                                            'area' => NULL,
                                            'subarea' => NULL,
                                            'ocupacion' => NULL,
                                        ]);

        return redirect()->route('ocupacionCecosamaIndex')->with('delete', 'Ocupación eliminada correctamente.');
    }
}