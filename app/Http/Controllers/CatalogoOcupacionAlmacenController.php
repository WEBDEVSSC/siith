<?php

namespace App\Http\Controllers;

use App\Models\CatOcupacionAlmacen;
use App\Models\ProfesionalOcupacionAlmacen;
use Illuminate\Http\Request;

class CatalogoOcupacionAlmacenController extends Controller
{
    //
    public function ocupacionAlmacenIndex()
    {
        // Cargamos todos los registros de la tabla
        $ocupaciones = CatOcupacionAlmacen::orderBy('orden')->get();

        // Retornamos la vista con el arreglo
        return view('settings.ocupacion.almacen.almacen-index', compact('ocupaciones'));
    }

    public function ocupacionAlmacenCreate()
    {
        // Cargamos la vista del formulario
        return view('settings.ocupacion.almacen.almacen-create');
    }

    public function ocupacionAlmacenStore(Request $request)
    {
        // Validamos los datos
        $request->validate([
            'area' => 'required|string',
            'subarea' => 'required|string',
            'jefatura' => 'required|string',
            'departamento' => 'required|string',
            'ocupacion' => 'required|string',
            'orden' => 'required|string',
        ],[            
            'area.required' => 'El campo área es obligatorio.',
            'area.string' => 'El campo área debe ser una cadena de texto.',
            
            'subarea.required' => 'El campo subárea es obligatorio.',
            'subarea.string' => 'El campo subárea debe ser una cadena de texto.',

            'jefatura.required' => 'El campo jefatura es obligatorio.',
            'jefatura.string' => 'El campo jefatura debe ser una cadena de texto.',

            'departamento.required' => 'El campo departamento es obligatorio.',
            'departamento.string' => 'El campo departamento debe ser una cadena de texto.',
            
            'ocupacion.required' => 'El campo ocupación es obligatorio.',
            'ocupacion.string' => 'El campo ocupación debe ser una cadena de texto.',
            
            'orden.required' => 'El campo orden es obligatorio.',
            'orden.string' => 'El campo orden debe ser una cadena de texto.',
        ]);

        // Creamos el objeto
        $ocupacion = new CatOcupacionAlmacen();

        // Asignamos los valores
        $ocupacion->area = $request->area;
        $ocupacion->subarea = $request->subarea;
        $ocupacion->jefatura = $request->jefatura;
        $ocupacion->departamento = $request->departamento;
        $ocupacion->ocupacion = $request->ocupacion;
        $ocupacion->orden = $request->orden;

        // Guardamos los valores
        $ocupacion->save();

        // Retornamos a la vista
        return redirect()->route('ocupacionAlmacenIndex')->with('successOcupacion', 'Ocupacion registrada correctamente');
    }

    public function ocupacionAlmacenEdit($id)
    {
        // Consultamos los datos del registro
        $ocupacion = CatOcupacionAlmacen::findOrFail($id);

        // Regresamos a la vista con el arreglo
        return view('settings.ocupacion.almacen.almacen-edit', compact('ocupacion'));
    }

    public function ocupacionAlmacenUpdate(Request $request, $id)
    {
        // Validamos los datos
        $request->validate([
            'area' => 'required|string',
            'subarea' => 'required|string',
            'jefatura' => 'required|string',
            'departamento' => 'required|string',
            'ocupacion' => 'required|string',
            'orden' => 'required|string',
        ],[            
            'area.required' => 'El campo área es obligatorio.',
            'area.string' => 'El campo área debe ser una cadena de texto.',
            
            'subarea.required' => 'El campo subárea es obligatorio.',
            'subarea.string' => 'El campo subárea debe ser una cadena de texto.',

            'jefatura.required' => 'El campo jefatura es obligatorio.',
            'jefatura.string' => 'El campo jefatura debe ser una cadena de texto.',

            'departamento.required' => 'El campo departamento es obligatorio.',
            'departamento.string' => 'El campo departamento debe ser una cadena de texto.',
            
            'ocupacion.required' => 'El campo ocupación es obligatorio.',
            'ocupacion.string' => 'El campo ocupación debe ser una cadena de texto.',
            
            'orden.required' => 'El campo orden es obligatorio.',
            'orden.string' => 'El campo orden debe ser una cadena de texto.',
        ]);

        // Buscamos el registro
        $ocupacion = CatOcupacionAlmacen::findOrFail($id);

        // Asignamos los valores del formulario al modelo
        $ocupacion->area = $request->area;
        $ocupacion->subarea = $request->subarea;
        $ocupacion->jefatura = $request->jefatura;
        $ocupacion->departamento = $request->departamento;
        $ocupacion->ocupacion = $request->ocupacion;
        $ocupacion->orden = $request->orden;

        // Guardamos los cambios
        $ocupacion->save();

        ProfesionalOcupacionAlmacen::where('id_catalogo_uno', $id)
                                        ->update([
                                            'area_uno' => $request->area,
                                            'subarea_uno' => $request->subarea,
                                            'jefatura_uno' => $request->jefatura,
                                            'departamento_uno' => $request->departamento,
                                            'ocupacion_uno' => $request->ocupacion,
                                        ]);

        ProfesionalOcupacionAlmacen::where('id_catalogo_dos', $id)
                                        ->update([
                                            'area_dos' => $request->area,
                                            'subarea_dos' => $request->subarea,
                                            'jefatura_dos' => $request->jefatura,
                                            'departamento_dos' => $request->departamento,
                                            'ocupacion_dos' => $request->ocupacion,
                                        ]);

        // Redirigimos con un mensaje de éxito
        return redirect()->route('ocupacionAlmacenIndex')->with('updateOcupacion', 'Ocupación actualizada correctamente.');
    }

    public function ocupacionAlmacenDestroy($id)
    {
        // Buscamos el registro
        $ocupacion = CatOcupacionAlmacen::findOrFail($id);

        // Eliminamos el regisrtro
        $ocupacion->delete();

        // Limpiamos los registros
        ProfesionalOcupacionAlmacen::where('id_catalogo_uno', $id)
                                        ->update([
                                            'area_uno' => NULL,
                                            'subarea_uno' => NULL,
                                            'jefatura_uno' => NULL,
                                            'departamento_uno' => NULL,
                                            'ocupacion_uno' => NULL,
                                        ]);
        
        ProfesionalOcupacionAlmacen::where('id_catalogo_dos', $id)
                                        ->update([
                                            'area_dos' => NULL,
                                            'subarea_dos' => NULL,
                                            'jefatura_dos' => NULL,
                                            'departamento_dos' => NULL,
                                            'ocupacion_dos' => NULL,
                                        ]);

        return redirect()->route('ocupacionAlmacenIndex')->with('delete', 'Ocupación eliminada correctamente.');
    }
}
