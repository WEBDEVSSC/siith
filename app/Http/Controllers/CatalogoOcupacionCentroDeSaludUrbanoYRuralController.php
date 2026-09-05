<?php

namespace App\Http\Controllers;

use App\Exports\CatalogoOcupacionesCsuyrExport;
use App\Models\CatOcupacionCentroSalud;
use App\Models\ProfesionalOcupacionCentroSalud;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class CatalogoOcupacionCentroDeSaludUrbanoYRuralController extends Controller
{
    //
    public function ocupacionCsuyrIndex()
    {
        // Cargamos todos los registros de la tabla
        $ocupaciones = CatOcupacionCentroSalud::orderBy('orden')->get();

        // Retornamos la vista con el arreglo
        return view('settings.ocupacion.csuyr.csuyr-index', compact('ocupaciones'));
    }

    public function ocupacionCsuyrCreate()
    {
        // Cargamos la vista del formulario
        return view('settings.ocupacion.csuyr.csuyr-create');
    }

    public function ocupacionCsuyrStore(Request $request)
    {
        // Validamos los datos
        $request->validate([
            'unidad' => 'required|string',
            'area' => 'required|string',
            'subarea' => 'required|string',
            'ocupacion' => 'required|string',
            'orden' => 'required|numeric|regex:/^\d{1,4}(\.\d{1,6})?$/',
            's_area_trabajo' => 'nullable|string',
            's_ocupacion' => 'nullable|string'
        ],[
            'unidad.required' => 'El campo unidad es obligatorio.',
            'unidad.string' => 'El campo unidad debe ser una cadena de texto.',
            
            'area.required' => 'El campo área es obligatorio.',
            'area.string' => 'El campo área debe ser una cadena de texto.',
            
            'subarea.required' => 'El campo subárea es obligatorio.',
            'subarea.string' => 'El campo subárea debe ser una cadena de texto.',
            
            'ocupacion.required' => 'El campo ocupación es obligatorio.',
            'ocupacion.string' => 'El campo ocupación debe ser una cadena de texto.',
            
            'orden.required' => 'El campo orden es obligatorio.',
            'orden.string' => 'El campo orden debe ser una cadena de texto.',

            's_area_trabajo.string' => 'El campo área de trabajo debe ser una cadena de texto.',
            's_ocupacion.string' => 'El campo ocupación debe ser una cadena de texto.',

        ]);

        // Creamos el objeto
        $ocupacion = new CatOcupacionCentroSalud();

        // Asignamos los valores
        $ocupacion->unidad = $request->unidad;
        $ocupacion->area = $request->area;
        $ocupacion->subarea = $request->subarea;
        $ocupacion->ocupacion = $request->ocupacion;
        $ocupacion->orden = $request->orden;
        $ocupacion->s_area_trabajo = $request->s_area_trabajo;
        $ocupacion->s_ocupacion = $request->s_ocupacion;

        // Guardamos los valores
        $ocupacion->save();

        // Retornamos a la vista
        return redirect()->route('ocupacionCsuyrIndex')->with('success', 'Registro realizado correctamente');
    }

    public function ocupacionCsuyrEdit($id)
    {
        // Consultamos los datos del registro
        $ocupacion = CatOcupacionCentroSalud::findOrFail($id);

        // Regresamos a la vista con el arreglo
        return view('settings.ocupacion.csuyr.csuyr-edit', compact('ocupacion'));
    }

    public function ocupacionCsuyrUpdate(Request $request, $id)
    {
        // Validamos los datos
        $request->validate([
            'unidad' => 'required|string',
            'area' => 'required|string',
            'subarea' => 'required|string',
            'ocupacion' => 'required|string',
            'orden' => 'required|numeric|regex:/^\d{1,4}(\.\d{1,6})?$/',
            's_area_trabajo' => 'nullable|string',
            's_ocupacion' => 'nullable|string'
        ],[
            'unidad.required' => 'El campo unidad es obligatorio.',
            'unidad.string' => 'El campo unidad debe ser una cadena de texto.',
            
            'area.required' => 'El campo área es obligatorio.',
            'area.string' => 'El campo área debe ser una cadena de texto.',
            
            'subarea.required' => 'El campo subárea es obligatorio.',
            'subarea.string' => 'El campo subárea debe ser una cadena de texto.',
            
            'ocupacion.required' => 'El campo ocupación es obligatorio.',
            'ocupacion.string' => 'El campo ocupación debe ser una cadena de texto.',
            
            'orden.required' => 'El campo orden es obligatorio.',
            'orden.string' => 'El campo orden debe ser una cadena de texto.',

            's_area_trabajo.string' => 'El campo área de trabajo debe ser una cadena de texto.',
            's_ocupacion.string' => 'El campo ocupación debe ser una cadena de texto.',
        ]);

        // Buscamos el registro
        $ocupacion = CatOcupacionCentroSalud::findOrFail($id);

        // Asignamos los valores del formulario al modelo
        $ocupacion->unidad = $request->unidad;
        $ocupacion->area = $request->area;
        $ocupacion->subarea = $request->subarea;
        $ocupacion->ocupacion = $request->ocupacion;
        $ocupacion->orden = $request->orden;
        $ocupacion->s_area_trabajo = $request->s_area_trabajo;
        $ocupacion->s_ocupacion = $request->s_ocupacion;

        // Guardamos los cambios
        $ocupacion->save();

        ProfesionalOcupacionCentroSalud::where('id_catalogo_uno', $id)
                                        ->update([
                                            'unidad_uno' => $request->unidad,
                                            'area_uno' => $request->area,
                                            'subarea_uno' => $request->subarea,
                                            'ocupacion_uno' => $request->ocupacion,
                                            's_area_trabajo_uno' => $request->s_area_trabajo,
                                            's_ocupacion_uno' => $request->s_ocupacion,
                                        ]);

        ProfesionalOcupacionCentroSalud::where('id_catalogo_dos', $id)
                                        ->update([
                                            'unidad_dos' => $request->unidad,
                                            'area_dos' => $request->area,
                                            'subarea_dos' => $request->subarea,
                                            'ocupacion_dos' => $request->ocupacion,
                                            's_area_trabajo_dos' => $request->s_area_trabajo,
                                            's_ocupacion_dos' => $request->s_ocupacion,
                                        ]);

        // Redirigimos con un mensaje de éxito
        return redirect()->route('ocupacionCsuyrIndex')->with('update', 'Ocupación actualizada correctamente.');
    }

    public function ocupacionCsuyrDestroy($id)
    {
        // Buscamos el registro
        $ocupacion = CatOcupacionCentroSalud::findOrFail($id);

        // Eliminamos el regisrtro
        $ocupacion->delete();

        // Limpiamos los registros
        ProfesionalOcupacionCentroSalud::where('id_catalogo_uno', $id)
                                        ->update([
                                            'unidad_uno' => NULL,
                                            'area_uno' => NULL,
                                            'subarea_uno' => NULL,
                                            'ocupacion_uno' => NULL,
                                            's_area_trabajo_uno' => NULL,
                                            's_ocupacion_uno' => NULL
                                        ]);
        
        ProfesionalOcupacionCentroSalud::where('id_catalogo_dos', $id)
                                        ->update([
                                            'unidad_dos' => NULL,
                                            'area_dos' => NULL,
                                            'subarea_dos' => NULL,
                                            'ocupacion_dos' => NULL,
                                            's_area_trabajo_dos' => NULL,
                                            's_ocupacion_dos' => NULL
                                        ]);

        return redirect()->route('ocupacionCsuyrIndex')->with('delete', 'Ocupación eliminada correctamente.');
    }

    public function ocupacionCsuyrPDF()
    {
        $ocupaciones = CatOcupacionCentroSalud::orderBy('orden')->get();

        $pdf = Pdf::loadView('settings.ocupacion.csuyr.csuyr-pdf', compact('ocupaciones'))
                    ->setPaper('letter', 'landscape');

        return $pdf->stream('catalogo-ocupaciones-csuyr.pdf');
    }

    public function ocupacionCsuyrExcel()
    {
        $ocupaciones = CatOcupacionCentroSalud::orderBy('orden')->get();

        $filename = 'catalogo-ocupaciones-csuyr.xlsx';

        return Excel::download(new CatalogoOcupacionesCsuyrExport($ocupaciones), $filename);
    }
}
