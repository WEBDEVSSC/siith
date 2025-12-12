<?php

namespace App\Http\Controllers;

use App\Models\CatOcupacionHospital;
use App\Models\ProfesionalOcupacionHospital;
use Illuminate\Http\Request;

class CatalogoOcupacionHospitalController extends Controller
{
    //
    public function ocupacionHospitalIndex()
    {
        // Cargamos todos los registros de la tabla
        $ocupaciones = CatOcupacionHospital::orderBy('id')->get();

        // Retornamos la vista con el arreglo
        return view('settings.ocupacion.hospital.hospital-index', compact('ocupaciones'));
    }

    public function ocupacionHospitalCreate()
    {
        // Cargamos la vista del formulario
        return view('settings.ocupacion.hospital.hospital-create');
    }

    public function ocupacionHospitalStore(Request $request)
    {
        // Validamos los datos
        $request->validate([
            'unidad' => 'required|string',
            'area' => 'required|string',
            'subarea' => 'required|string',
            'puesto' => 'required|string',
            'orden' => 'required',
        ],[
            'unidad.required' => 'El campo unidad es obligatorio.',
            'unidad.string' => 'El campo unidad debe ser una cadena de texto.',
            
            'area.required' => 'El campo área es obligatorio.',
            'area.string' => 'El campo área debe ser una cadena de texto.',
            
            'subarea.required' => 'El campo subárea es obligatorio.',
            'subarea.string' => 'El campo subárea debe ser una cadena de texto.',
            
            'puesto.required' => 'El campo ocupación es obligatorio.',
            'puesto.string' => 'El campo ocupación debe ser una cadena de texto.',
        ]);

        // Creamos el objeto
        $ocupacion = new CatOcupacionHospital();

        // Asignamos los valores
        $ocupacion->unidad = $request->unidad;
        $ocupacion->area = $request->area;
        $ocupacion->subarea = $request->subarea;
        $ocupacion->puesto = $request->puesto;
        $ocupacion->orden = $request->orden;

        // Guardamos los valores
        $ocupacion->save();

        // Retornamos a la vista
        return redirect()->route('ocupacionHospitalIndex')->with('success', 'Registro realizado correctamente');
    }

    public function ocupacionHospitalEdit($id)
    {
        // Consultamos los datos del registro
        $ocupacion = CatOcupacionHospital::findOrFail($id);

        // Regresamos a la vista con el arreglo
        return view('settings.ocupacion.hospital.hospital-edit', compact('ocupacion'));
    }

    public function ocupacionHospitalUpdate(Request $request, $id)
    {
        // Validamos los datos
        $request->validate([
            'unidad' => 'required|string',
            'area' => 'required|string',
            'subarea' => 'required|string',
            'puesto' => 'required|string',
            'orden' => 'required',
        ],[
            'unidad.required' => 'El campo unidad es obligatorio.',
            'unidad.string' => 'El campo unidad debe ser una cadena de texto.',
            
            'area.required' => 'El campo área es obligatorio.',
            'area.string' => 'El campo área debe ser una cadena de texto.',
            
            'subarea.required' => 'El campo subárea es obligatorio.',
            'subarea.string' => 'El campo subárea debe ser una cadena de texto.',
            
            'puesto.required' => 'El campo ocupación es obligatorio.',
            'puesto.string' => 'El campo ocupación debe ser una cadena de texto.',
        ]);

        // Buscamos el registro
        $ocupacion = CatOcupacionHospital::findOrFail($id);

        // Asignamos los valores del formulario al modelo
        $ocupacion->unidad = $request->unidad;
        $ocupacion->area = $request->area;
        $ocupacion->subarea = $request->subarea;
        $ocupacion->puesto = $request->puesto;
        $ocupacion->orden = $request->orden;

        // Guardamos los cambios
        $ocupacion->save();

        ProfesionalOcupacionHospital::where('id_catalogo_uno', $id)
                                        ->update([
                                            'unidad_uno' => $request->unidad,
                                            'area_uno' => $request->area,
                                            'subarea_uno' => $request->subarea,
                                            'puesto_uno' => $request->puesto,
                                        ]);

        ProfesionalOcupacionHospital::where('id_catalogo_dos', $id)
                                        ->update([
                                            'unidad_dos' => $request->unidad,
                                            'area_dos' => $request->area,
                                            'subarea_dos' => $request->subarea,
                                            'puesto_dos' => $request->puesto,
                                        ]);

        // Redirigimos con un mensaje de éxito
        return redirect()->route('ocupacionHospitalIndex')->with('update', 'Ocupación actualizada correctamente.');
    }

    public function ocupacionHospitalDestroy($id)
    {
        // Buscamos el registro
        $ocupacion = CatOcupacionHospital::findOrFail($id);

        // Eliminamos el regisrtro
        $ocupacion->delete();

        // Limpiamos los registros
        ProfesionalOcupacionHospital::where('id_catalogo_uno', $id)
                                        ->update([
                                            'unidad_uno' => NULL,
                                            'area_uno' => NULL,
                                            'subarea_uno' => NULL,
                                            'puesto_uno' => NULL,
                                        ]);
        
        ProfesionalOcupacionHospital::where('id_catalogo_dos', $id)
                                        ->update([
                                            'unidad_dos' => NULL,
                                            'area_dos' => NULL,
                                            'subarea_dos' => NULL,
                                            'puesto_dos' => NULL,
                                        ]);

        return redirect()->route('ocupacionHospitalIndex')->with('delete', 'Ocupación eliminada correctamente.');
    }
}
