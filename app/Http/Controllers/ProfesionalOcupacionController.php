<?php

namespace App\Http\Controllers;

use App\Models\CatOcupacionCentroSalud;
use App\Models\Profesional;
use App\Models\ProfesionalOcupacionCentroSalud;
use Illuminate\Http\Request;

class ProfesionalOcupacionController extends Controller
{
    //
    public function createCentrosDeSalud($id)
    {
        // Consultamos los datos del profesional
        $profesional = Profesional::findOrFail($id);

        // Llenamos el select de ocupaciones
        $ocupaciones = CatOcupacionCentroSalud::orderBy('orden', 'asc')->get();

        // Consultamos si tiene registros en la tabla
        $profesionalOcupaciones = ProfesionalOcupacionCentroSalud::where('id_profesional',$id)->get();

        // Retornamos la vista con todos los objetos
        return view('ocupacion.csuyr-create', compact('profesional','ocupaciones','profesionalOcupaciones'));
    }

    public function storeCentrosDeSalud(Request $request)
    {
        // Validamos los datos
        $request->validate([
            'id_profesional'=>'required',
            'ocupacion_uno'=>'required',
            'ocupacion_dos'=>'nullable'
        ],[]);

        // Consultamos los datos para registrar
        $ocupacionUno = CatOcupacionCentroSalud::where('id',$request->ocupacion_uno)->first();
        $ocupacionDos = CatOcupacionCentroSalud::where('id',$request->ocupacion_dos)->first();

        // Activamos el modulo
        $mdl_status = 1;

        // Creamos el objeto
        $ocupacion = new ProfesionalOcupacionCentroSalud();

        // Asignamos los valores
        $ocupacion->id_profesional = $request->id_profesional;

        $ocupacion->id_catalogo_uno = $request->ocupacion_uno;
        $ocupacion->unidad_uno = $ocupacionUno->unidad;
        $ocupacion->area_uno = $ocupacionUno->area;
        $ocupacion->subarea_uno = $ocupacionUno->subarea;
        $ocupacion->ocupacion_uno = $ocupacionUno->ocupacion;

        $ocupacion->id_catalogo_dos = $request->ocupacion_dos;
        $ocupacion->unidad_dos = $ocupacionDos->unidad;
        $ocupacion->area_dos = $ocupacionDos->area;
        $ocupacion->subarea_dos = $ocupacionDos->subarea;
        $ocupacion->ocupacion_dos = $ocupacionDos->ocupacion;

        $ocupacion->mdl_status = $mdl_status;

        // Registramos los datos
        $ocupacion->save();

        // Regresamos a la vista con su mensaje
        return redirect()->route('profesionalIndex')->with('successCentrosDeSalud', 'Ocupaciones registradas correctamente.');
    }
}
