<?php

namespace App\Http\Controllers;

use App\Models\CatOcupacionCentroSalud;
use App\Models\CatOcupacionHospital;
use App\Models\Profesional;
use App\Models\ProfesionalOcupacionCentroSalud;
use App\Models\ProfesionalOcupacionHospital;
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

        // Retornamos la vista con todos los objetos
        return view('ocupacion.csuyr-create', compact('profesional','ocupaciones'));
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

    public function editCentrosDeSalud($id)
    {  
        // Consultamos los datos del profesional
        $profesional = Profesional::findOrFail($id);

        // Llenamos el select de ocupaciones
        $ocupaciones = CatOcupacionCentroSalud::orderBy('orden', 'asc')->get();

        // Consultamos si tiene registros en la tabla
        $profesionalOcupaciones = ProfesionalOcupacionCentroSalud::where('id_profesional',$id)->first();

        // Retornamos la vista con todos los objetos
        return view('ocupacion.csuyr-edit', compact('profesional','ocupaciones','profesionalOcupaciones'));
    }

    public function updateCentrosDeSalud(Request $request, $id)
    {        
        dd($request->ocupacion_dos);
        
        // Validamos los datos
        $request->validate([
            'id_profesional' => 'required|exists:profesionales,id',
            'ocupacion_uno' => 'required',
            'ocupacion_dos' => 'nullable'
        ],[]);

         // Consultamos los datos para registrar
         $ocupacionUno = CatOcupacionCentroSalud::where('id',$request->ocupacion_uno)->first();
         $ocupacionDos = CatOcupacionCentroSalud::where('id',$request->ocupacion_dos)->first();

         // Consultamos el id
         $ocupacion = ProfesionalOcupacionCentroSalud::findOrFail($id);

         // Asignamos los valores al registro
         $ocupacion->update([
            'id_catalogo_uno'=>$request->ocupacion_uno,
            'unidad_uno'=>$ocupacionUno->unidad,
            'area_uno'=>$ocupacionUno->area,
            'subarea_uno'=>$ocupacionUno->subarea,
            'ocupacion_uno'=>$ocupacionUno->ocupacion,

            'id_catalogo_dos'=>$request?->ocupacion_dos,
            'unidad_dos'=>$ocupacionDos?->unidad,
            'area_dos'=>$ocupacionDos?->area,
            'subarea_dos'=>$ocupacionDos?->subarea,
            'ocupacion_dos'=>$ocupacionDos?->ocupacion,
         ]);

         // Regresamos a la vista con su mensaje
        return redirect()->route('profesionalIndex')->with('updateCentrosDeSalud', 'Ocupaciones actualizadas correctamente.');
    }

    /**
     * 
     * 
     * HOSPITALES
     * 
     * 
     */

    public function createHospital($id)
    {
        // Consultamos los datos del profesional
        $profesional = Profesional::findOrFail($id);

        // Llenamos el select de ocupaciones
        $ocupaciones = CatOcupacionHospital::orderBy('area', 'asc')->get();

        // Retornamos la vista con todos los objetos
        return view('ocupacion.hospital-create', compact('profesional','ocupaciones'));

    }

    public function storeHospital(Request $request)
    {
        // Validamos los datos
        $request->validate([
            'id_profesional'=>'required',
            'ocupacion_uno'=>'required',
            'ocupacion_dos'=>'nullable'
        ],[]);

        // Consultamos los datos para registrar
        $ocupacionUno = CatOcupacionHospital::where('id',$request->ocupacion_uno)->first();
        $ocupacionDos = CatOcupacionHospital::where('id',$request->ocupacion_dos)->first();

        // Activamos el modulo
        $mdl_status = 1;

        // Creamos el objeto
        $ocupacion = new ProfesionalOcupacionHospital();

        // Asignamos los valores
        $ocupacion->id_profesional = $request->id_profesional;

        $ocupacion->id_catalogo_uno = $request->ocupacion_uno;
        $ocupacion->unidad_uno = $ocupacionUno->unidad;
        $ocupacion->area_uno = $ocupacionUno->area;
        $ocupacion->subarea_uno = $ocupacionUno->subarea;
        $ocupacion->puesto_uno = $ocupacionUno->puesto;

        $ocupacion->id_catalogo_dos = $request->ocupacion_dos;
        $ocupacion->unidad_dos = $ocupacionDos->unidad;
        $ocupacion->area_dos = $ocupacionDos->area;
        $ocupacion->subarea_dos = $ocupacionDos->subarea;
        $ocupacion->puesto_dos = $ocupacionDos->puesto;

        $ocupacion->mdl_status = $mdl_status;

        // Registramos los datos
        $ocupacion->save();

        // Regresamos a la vista con su mensaje
        return redirect()->route('profesionalIndex')->with('successHospital', 'Ocupaciones registradas correctamente.');
    }

    public function editHospital($id)
    {  
        // Consultamos los datos del profesional
        $profesional = Profesional::findOrFail($id);

        // Llenamos el select de ocupaciones
        $ocupaciones = CatOcupacionHospital::orderBy('area', 'asc')->get();

        // Consultamos si tiene registros en la tabla
        $profesionalOcupaciones = ProfesionalOcupacionHospital::where('id_profesional',$id)->first();

        // Retornamos la vista con todos los objetos
        return view('ocupacion.csuyr-edit', compact('profesional','ocupaciones','profesionalOcupaciones'));
    }
}