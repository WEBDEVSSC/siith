<?php

namespace App\Http\Controllers;

use App\Models\CatOcupacionHospitalNino;
use App\Models\ProfesionalOcupacionHospitalNino;
use Illuminate\Http\Request;

class CatalogoOcupacionHospitalNinoController extends Controller
{
    //
    public function ocupacionHospitalNinoIndex()
    {
        // Cargamos todos los registros de la tabla
        $ocupaciones = CatOcupacionHospitalNino::orderBy('orden')->get();

        // Retornamos la vista con el arreglo
        return view('settings.ocupacion.hospital-nino.hospital-nino-index', compact('ocupaciones'));
    }

    public function ocupacionHospitalNinoCreate()
    {
        // Cargamos la vista del formulario
        return view('settings.ocupacion.hospital-nino.hospital-nino-create');
    }

    public function ocupacionHospitalNinoStore(Request $request)
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
            
            'subarea.required' => 'El campo subarea es obligatorio.',
            'subarea.string' => 'El campo subarea debe ser una cadena de texto.',
            
            'ocupacion.required' => 'El campo ocupación es obligatorio.',
            'ocupacion.string' => 'El campo ocupación debe ser una cadena de texto.',
            
            'orden.required' => 'El campo orden es obligatorio.',
            'orden.string' => 'El campo orden debe ser una cadena de texto.',
        ]);

        // Creamos el objeto
        $ocupacion = new CatOcupacionHospitalNino();

        // Asignamos los valores
        $ocupacion->unidad = $request->unidad;
        $ocupacion->area = $request->area;
        $ocupacion->subarea = $request->subarea;
        $ocupacion->ocupacion = $request->ocupacion;
        $ocupacion->orden = $request->orden;

        // Guardamos los valores
        $ocupacion->save();

        // Retornamos a la vista
        return redirect()->route('ocupacionHospitalNinoIndex')->with('success', 'Registro realizado correctamente');
    }

    public function ocupacionHospitalNinoEdit($id)
    {
        // Consultamos los datos del registro
        $ocupacion = CatOcupacionHospitalNino::findOrFail($id);

        // Regresamos a la vista con el arreglo
        return view('settings.ocupacion.hospital-nino.hospital-nino-edit', compact('ocupacion'));
    }

    public function ocupacionHospitalNinoUpdate(Request $request, $id)
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
            
            'subarea.required' => 'El campo subarea es obligatorio.',
            'subarea.string' => 'El campo subarea debe ser una cadena de texto.',
            
            'ocupacion.required' => 'El campo ocupación es obligatorio.',
            'ocupacion.string' => 'El campo ocupación debe ser una cadena de texto.',
            
            'orden.required' => 'El campo orden es obligatorio.',
            'orden.string' => 'El campo orden debe ser una cadena de texto.',
        ]);


        // Buscamos el registro
        $ocupacion = CatOcupacionHospitalNino::findOrFail($id);

        // Asignamos los valores del formulario al modelo
        $ocupacion->unidad = $request->unidad;
        $ocupacion->area = $request->area;
        $ocupacion->subarea = $request->subarea;
        $ocupacion->ocupacion = $request->ocupacion;
        $ocupacion->orden = $request->orden;

        // Guardamos los cambios
        $ocupacion->save();

        ProfesionalOcupacionHospitalNino::where('id_catalogo_uno', $id)
                                        ->update([
                                            'unidad_uno' => $request->unidad,
                                            'area_uno' => $request->area,
                                            'subarea_uno' => $request->subarea,
                                            'ocupacion_uno' => $request->ocupacion,
                                        ]);

        ProfesionalOcupacionHospitalNino::where('id_catalogo_dos', $id)
                                        ->update([
                                            'unidad_dos' => $request->unidad,
                                            'area_dos' => $request->area,
                                            'subarea_dos' => $request->subarea,
                                            'ocupacion_dos' => $request->ocupacion,
                                        ]);

        // Redirigimos con un mensaje de éxito
        return redirect()->route('ocupacionHospitalNinoIndex')->with('update', 'Ocupación actualizada correctamente.');
    }

    public function ocupacionHospitalNinoDestroy($id)
    {
        // Buscamos el registro
        $ocupacion = CatOcupacionHospitalNino::findOrFail($id);

        // Eliminamos el regisrtro
        $ocupacion->delete();

        // Limpiamos los registros
        ProfesionalOcupacionHospitalNino::where('id_catalogo_uno', $id)
                                        ->update([
                                            'unidad_uno' => NULL,
                                            'area_uno' => NULL,
                                            'subarea_uno' => NULL,
                                            'ocupacion_uno' => NULL,
                                        ]);
        
        ProfesionalOcupacionHospitalNino::where('id_catalogo_dos', $id)
                                        ->update([
                                            'unidad_dos' => NULL,
                                            'area_dos' => NULL,
                                            'subarea_dos' => NULL,
                                            'ocupacion_dos' => NULL,
                                        ]);

        return redirect()->route('ocupacionHospitalNinoIndex')->with('delete', 'Ocupación eliminada correctamente.');
    }
}
