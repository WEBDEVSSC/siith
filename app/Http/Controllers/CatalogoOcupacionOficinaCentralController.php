<?php

namespace App\Http\Controllers;

use App\Models\CatOcupacionOficinaCentral;
use App\Models\ProfesionalOcupacionOficinaCentral;
use Illuminate\Http\Request;

class CatalogoOcupacionOficinaCentralController extends Controller
{
    //
    public function ocupacionOficinaCentralIndex()
    {
        // Cargamos todos los registros de la tabla
        $ocupaciones = CatOcupacionOficinaCentral::orderBy('id')->get();

        // Retornamos la vista con el arreglo
        return view('settings.ocupacion.oficina-central.oficinaCentral-index', compact('ocupaciones'));
    }

    public function ocupacionOficinaCentralCreate()
    {
        // Cargamos la vista del formulario
        return view('settings.ocupacion.oficina-central.oficinaCentral-create');
    }

    public function ocupacionOficinaCentralStore(Request $request)
    {
        // Validamos los datos
        $request->validate([
            'area' => 'required|string',
            'subarea' => 'required|string',
            'programa' => 'required|string',
            'componente' => 'required|string',
            'ocupacion' => 'required|string',
            'orden' => ['required', 'regex:/^\d{1,2}(\.\d{1,6})?$/'],
        ],[            
            'area.required' => 'El campo área es obligatorio.',
            'area.string' => 'El campo área debe ser una cadena de texto.',
            
            'subarea.required' => 'El campo subárea es obligatorio.',
            'subarea.string' => 'El campo subárea debe ser una cadena de texto.',
            
            'programa.required' => 'El campo programa es obligatorio.',
            'programa.string' => 'El campo programa debe ser una cadena de texto.',

            'componente.required' => 'El campo componente es obligatorio.',
            'componente.string' => 'El campo componente debe ser una cadena de texto.',

            'ocupacion.required' => 'El campo ocupacion es obligatorio.',
            'ocupacion.string' => 'El campo ocupacion debe ser una cadena de texto.',

            'orden.required' => 'El campo orden es obligatorio.',
            'orden.regex' => 'El campo orden debe ser un número decimal con un máximo de 8 dígitos en total y hasta 6 decimales.',
        ]);

        // Creamos el objeto
        $ocupacion = new CatOcupacionOficinaCentral();

        // Asignamos los valores
        $ocupacion->area = $request->area;
        $ocupacion->subarea = $request->subarea;
        $ocupacion->programa = $request->programa;
        $ocupacion->componente = $request->componente;
        $ocupacion->ocupacion = $request->ocupacion;
        $ocupacion->orden = $request->orden;

        // Guardamos los valores
        $ocupacion->save();

        // Retornamos a la vista
        return redirect()->route('ocupacionOficinaCentralIndex')->with('success', 'Registro realizado correctamente');
    }

    public function ocupacionOficinaCentralEdit($id)
    {   
        // Consultamos los datos del registro
        $ocupacion = CatOcupacionOficinaCentral::findOrFail($id);

        // Regresamos a la vista con el arreglo
        return view('settings.ocupacion.oficina-central.oficinaCentral-edit', compact('ocupacion'));
    }

    public function ocupacionOficinaCentralUpdate(Request $request, $id)
    {
        // Validamos los datos
        $request->validate([
            'area' => 'required|string',
            'subarea' => 'required|string',
            'programa' => 'required|string',
            'componente' => 'required|string',
            'ocupacion' => 'required|string',
        ],[            
            'area.required' => 'El campo área es obligatorio.',
            'area.string' => 'El campo área debe ser una cadena de texto.',
            
            'subarea.required' => 'El campo subárea es obligatorio.',
            'subarea.string' => 'El campo subárea debe ser una cadena de texto.',
            
            'programa.required' => 'El campo programa es obligatorio.',
            'programa.string' => 'El campo programa debe ser una cadena de texto.',

            'componente.required' => 'El campo componente es obligatorio.',
            'componente.string' => 'El campo componente debe ser una cadena de texto.',

            'ocupacion.required' => 'El campo ocupacion es obligatorio.',
            'ocupacion.string' => 'El campo ocupacion debe ser una cadena de texto.',
        ]);

        // Buscamos el registro
        $ocupacion = CatOcupacionOficinaCentral::findOrFail($id);

        // Asignamos los valores del formulario al modelo
        $ocupacion->area = $request->area;
        $ocupacion->subarea = $request->subarea;
        $ocupacion->programa = $request->programa;
        $ocupacion->componente = $request->componente;
        $ocupacion->ocupacion = $request->ocupacion;

        // Guardamos los cambios
        $ocupacion->save();

        ProfesionalOcupacionOficinaCentral::where('id_catalogo_uno', $id)
                                        ->update([                                            
                                            'area_uno' => $request->area,
                                            'subarea_uno' => $request->subarea,
                                            'programa_uno' => $request->programa,
                                            'componente_uno' => $request->componente,
                                            'ocupacion_uno' => $request->ocupacion,
                                        ]);

        ProfesionalOcupacionOficinaCentral::where('id_catalogo_dos', $id)
                                        ->update([                                            
                                            'area_dos' => $request->area,
                                            'subarea_dos' => $request->subarea,
                                            'programa_dos' => $request->programa,
                                            'componente_dos' => $request->componente,
                                            'ocupacion_dos' => $request->ocupacion,
                                        ]);

        // Redirigimos con un mensaje de éxito
        return redirect()->route('ocupacionOficinaCentralIndex')->with('update', 'Ocupación actualizada correctamente.');
    }

    public function ocupacionOficinaCentralDestroy($id)
    {
        // Buscamos el registro
        $ocupacion = CatOcupacionOficinaCentral::findOrFail($id);

        // Eliminamos el regisrtro
        $ocupacion->delete();

        // Limpiamos los registros
        ProfesionalOcupacionOficinaCentral::where('id_catalogo_uno', $id)
                                        ->update([
                                            'area_uno' => NULL,
                                            'subarea_uno' => NULL,
                                            'programa_uno' => NULL,
                                            'componente_uno' => NULL,
                                            'ocupacion_uno' => NULL,
                                        ]);
        
        ProfesionalOcupacionOficinaCentral::where('id_catalogo_dos', $id)
                                        ->update([
                                            'area_dos' => NULL,
                                            'subarea_dos' => NULL,
                                            'programa_dos' => NULL,
                                            'componente_dos' => NULL,
                                            'ocupacion_dos' => NULL,
                                        ]);

        return redirect()->route('ocupacionOficinaCentralIndex')->with('delete', 'Ocupación eliminada correctamente.');
    }
}
