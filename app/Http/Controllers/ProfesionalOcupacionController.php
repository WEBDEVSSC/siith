<?php

namespace App\Http\Controllers;

use App\Models\CatOcupacionAlmacen;
use App\Models\CatOcupacionCentroSalud;
use App\Models\CatOcupacionCriCree;
use App\Models\CatOcupacionHospital;
use App\Models\CatOcupacionOficinaCentral;
use App\Models\CatOcupacionOfJurisdiccional;
use App\Models\CatOcupacionSamuCrum;
use App\Models\Profesional;
use App\Models\ProfesionalOcupacionAlmacen;
use App\Models\ProfesionalOcupacionCentroSalud;
use App\Models\ProfesionalOcupacionCriCree;
use App\Models\ProfesionalOcupacionHospital;
use App\Models\ProfesionalOcupacionOficinaCentral;
use App\Models\ProfesionalOcupacionOfJurisdiccional;
use App\Models\ProfesionalOcupacionSamuCrum;
use Illuminate\Http\Request;

class ProfesionalOcupacionController extends Controller
{
    /** ************************************************************************************************************************************************
     * 
     * 
     * CENTROS DE SALUD URBANOS Y RURALES
     * 
     * 
     ***************************************************************************************************************************************************/
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

    /** ************************************************************************************************************************************************
     * 
     * 
     * HOSPITALES
     * 
     * 
     ***************************************************************************************************************************************************/

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
        return view('ocupacion.hospital-edit', compact('profesional','ocupaciones','profesionalOcupaciones'));
    }

    public function updateHospital(Request $request, $id)
    {            
        // Validamos los datos
        $request->validate([
            'ocupacion_uno' => 'required',
            'ocupacion_dos' => 'nullable'
        ],[]);

         // Consultamos los datos para registrar
         $ocupacionUno = CatOcupacionHospital::where('id',$request->ocupacion_uno)->first();

         $ocupacionDos = null;

        if ($request->ocupacion_dos) 
        {
            $ocupacionDos = CatOcupacionHospital::where('id',$request->ocupacion_dos)->first();
        }

         // Consultamos el id
         $ocupacion = ProfesionalOcupacionHospital::findOrFail($id);

         // Asignamos los valores al registro
         $ocupacion->update([
            'id_catalogo_uno'=>$request->ocupacion_uno,
            'unidad_uno'=>$ocupacionUno->unidad_uno,
            'area_uno'=>$ocupacionUno->area_uno,
            'subarea_uno'=>$ocupacionUno->subarea_uno,
            'puesto_uno'=>$ocupacionUno->puesto_uno,

            'id_catalogo_dos'=>$request?->ocupacion_dos,
            'unidad_dos'=>$ocupacionDos?->unidad_dos,
            'area_dos'=>$ocupacionDos?->area_dos,
            'subarea_dos'=>$ocupacionDos?->subarea_dos,
            'puesto_dos'=>$ocupacionDos?->ocupacion_dos,
         ]);

         // Regresamos a la vista con su mensaje
        return redirect()->route('profesionalIndex')->with('updateHospital', 'Ocupaciones actualizadas correctamente.');
    }


    /** ************************************************************************************************************************************************
     * 
     * 
     * OFICINA JURISDICCIONAL
     * 
     * 
     ***************************************************************************************************************************************************/

    public function createOfJurisdiccional($id)
    {
        // Consultamos los datos del profesional
        $profesional = Profesional::findOrFail($id);

        // Llenamos el select de ocupaciones
        $ocupaciones = CatOcupacionOfJurisdiccional::orderBy('area', 'asc')->get();

        // Retornamos la vista con todos los objetos
        return view('ocupacion.ofJurisdiccional-create', compact('profesional','ocupaciones'));
    }

    public function storeOfJurisdiccional(Request $request)
    {
        // Validamos los datos
        $request->validate([
            'id_profesional'=>'required',
            'ocupacion_uno'=>'required',
            'ocupacion_dos'=>'nullable'
        ],[]);

        // Consultamos los datos para registrar
        $ocupacionUno = CatOcupacionOfJurisdiccional::where('id',$request->ocupacion_uno)->first();
        $ocupacionDos = CatOcupacionOfJurisdiccional::where('id',$request->ocupacion_dos)->first();

        // Activamos el modulo
        $mdl_status = 1;

        // Creamos el objeto
        $ocupacion = new ProfesionalOcupacionOfJurisdiccional();

        // Asignamos los valores
        $ocupacion->id_profesional = $request->id_profesional;

        $ocupacion->id_catalogo_uno = $request->ocupacion_uno;
        $ocupacion->unidad_uno = $ocupacionUno->unidad;
        $ocupacion->area_uno = $ocupacionUno->area;
        $ocupacion->subarea_uno = $ocupacionUno->subarea;
        $ocupacion->servicio_uno = $ocupacionUno->servicio;
        $ocupacion->ocupacion_uno = $ocupacionUno->ocupacion;

        $ocupacion->id_catalogo_dos = $request->ocupacion_dos;
        $ocupacion->unidad_dos = $ocupacionDos->unidad;
        $ocupacion->area_dos = $ocupacionDos->area;
        $ocupacion->subarea_dos = $ocupacionDos->subarea;        
        $ocupacion->servicio_dos = $ocupacionDos->servicio;
        $ocupacion->ocupacion_dos = $ocupacionDos->ocupacion;

        $ocupacion->mdl_status = $mdl_status;

        // Registramos los datos
        $ocupacion->save();

        // Regresamos a la vista con su mensaje
        return redirect()->route('profesionalIndex')->with('successOfJurisdiccional', 'Ocupaciones registradas correctamente.');
    }

    public function editOfJurisdiccional($id)
    {
        // Consultamos los datos del profesional
        $profesional = Profesional::findOrFail($id);

        // Llenamos el select de ocupaciones
        $ocupaciones = CatOcupacionOfJurisdiccional::orderBy('area', 'asc')->get();

        // Consultamos si tiene registros en la tabla
        $profesionalOcupaciones = ProfesionalOcupacionOfJurisdiccional::where('id_profesional',$id)->first();

        // Retornamos la vista con todos los objetos
        return view('ocupacion.ofJurisdiccional-edit', compact('profesional','ocupaciones','profesionalOcupaciones'));
    }

    public function updateOfJurisdiccional(Request $request, $id)
    {
        // Validamos los datos
        $request->validate([
            'ocupacion_uno'=>'required',
            'ocupacion_dos'=>'nullable'
        ],[]);

        // Consultamos los datos para registrar
        $ocupacionUno = CatOcupacionOfJurisdiccional::where('id',$request->ocupacion_uno)->first();

        $ocupacionDos = null;

        if ($request->ocupacion_dos) 
        {
            $ocupacionDos = CatOcupacionOfJurisdiccional::where('id', $request->ocupacion_dos)->first();
        }

        // Buscamos el registro a editar
        $ocupaciones = ProfesionalOcupacionOfJurisdiccional::findOrFail($id);

        // Asignamos los valores
        $ocupaciones->update([
            'id_catalogo_uno'=>$request->ocupacion_uno,
            'unidad_uno'=>$ocupacionUno->unidad,
            'area_uno'=>$ocupacionUno->area,
            'subarea_uno'=>$ocupacionUno->subarea,
            'servicio_uno'=>$ocupacionUno->servicio,
            'ocupacion_uno'=>$ocupacionUno->ocupacion,

            'id_catalogo_dos' => $request->ocupacion_dos,
            'unidad_dos' => $ocupacionDos?->unidad,
            'area_dos' => $ocupacionDos?->area,
            'subarea_dos' => $ocupacionDos?->subarea,
            'servicio_dos' => $ocupacionDos?->servicio,
            'ocupacion_dos' => $ocupacionDos?->ocupacion,
        ]);

        // Redireccionar con un mensaje de éxito
        return redirect()->route('profesionalIndex')->with('updateOfJurisdiccional', 'Ocupaciones actualizadas correctamente.');

    }

    /** ************************************************************************************************************************************************
     * 
     * 
     * CRI CREE
     * 
     * 
     ***************************************************************************************************************************************************/

     public function createCriCree($id)
    {
        // Consultamos los datos del profesional
        $profesional = Profesional::findOrFail($id);

        // Llenamos el select de ocupaciones
        $ocupaciones = CatOcupacionCriCree::orderBy('orden', 'asc')->get();

        // Retornamos la vista con todos los objetos
        return view('ocupacion.criCree-create', compact('profesional','ocupaciones'));
    }

    public function storeCriCree(Request $request)
    {
        // Validamos los datos
        $request->validate([
            'id_profesional'=>'required',
            'ocupacion_uno'=>'required',
            'ocupacion_dos'=>'nullable'
        ],[]);

        // Consultamos los datos para registrar
        $ocupacionUno = CatOcupacionCriCree::where('id',$request->ocupacion_uno)->first();
        $ocupacionDos = CatOcupacionCriCree::where('id',$request->ocupacion_dos)->first();

        // Activamos el modulo
        $mdl_status = 1;

        // Creamos el objeto
        $ocupacion = new ProfesionalOcupacionCriCree();

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
        return redirect()->route('profesionalIndex')->with('successCriCree', 'Ocupaciones registradas correctamente.');
    }

    public function editCriCree($id)
    {
        // Consultamos los datos del profesional
        $profesional = Profesional::findOrFail($id);

        // Llenamos el select de ocupaciones
        $ocupaciones = CatOcupacionCriCree::orderBy('orden', 'asc')->get();

        // Consultamos si tiene registros en la tabla
        $profesionalOcupaciones = ProfesionalOcupacionCriCree::where('id_profesional',$id)->first();

        // Retornamos la vista con todos los objetos
        return view('ocupacion.criCree-edit', compact('profesional','ocupaciones','profesionalOcupaciones'));
    }

    public function updateCriCree(Request $request, $id)
    {
        // Validamos los datos
        $request->validate([
            'ocupacion_uno'=>'required',
            'ocupacion_dos'=>'nullable'
        ],[]);

        // Consultamos los datos para registrar
        $ocupacionUno = CatOcupacionCriCree::where('id',$request->ocupacion_uno)->first();

        $ocupacionDos = null;

        if ($request->ocupacion_dos) 
        {
            $ocupacionDos = CatOcupacionCriCree::where('id', $request->ocupacion_dos)->first();
        }

        // Buscamos el registro a editar
        $ocupaciones = ProfesionalOcupacionCriCree::findOrFail($id);

        // Asignamos los valores
        $ocupaciones->update([
            'id_catalogo_uno'=>$request->ocupacion_uno,
            'unidad_uno'=>$ocupacionUno->unidad,
            'area_uno'=>$ocupacionUno->area,
            'subarea_uno'=>$ocupacionUno->subarea,
            'ocupacion_uno'=>$ocupacionUno->ocupacion,

            'id_catalogo_dos' => $request->ocupacion_dos,
            'unidad_dos' => $ocupacionDos?->unidad,
            'area_dos' => $ocupacionDos?->area,
            'subarea_dos' => $ocupacionDos?->subarea,
            'ocupacion_dos' => $ocupacionDos?->ocupacion,
        ]);

        // Redireccionar con un mensaje de éxito
        return redirect()->route('profesionalIndex')->with('updateCriCree', 'Ocupaciones actualizadas correctamente.');

    }

    /** ************************************************************************************************************************************************
     * 
     * 
     * SAMU CRUM
     * 
     * 
     ***************************************************************************************************************************************************/

     public function createSamuCrum($id)
    {
        // Consultamos los datos del profesional
        $profesional = Profesional::findOrFail($id);

        // Llenamos el select de ocupaciones
        $ocupaciones = CatOcupacionSamuCrum::orderBy('orden', 'asc')->get();

        // Retornamos la vista con todos los objetos
        return view('ocupacion.samuCrum-create', compact('profesional','ocupaciones'));
    }

    public function storeSamuCrum(Request $request)
    {
        // Validamos los datos
        $request->validate([
            'id_profesional'=>'required',
            'ocupacion_uno'=>'required',
            'ocupacion_dos'=>'nullable'
        ],[]);

        // Consultamos los datos para registrar
        $ocupacionUno = CatOcupacionSamuCrum::where('id',$request->ocupacion_uno)->first();
        $ocupacionDos = CatOcupacionSamuCrum::where('id',$request->ocupacion_dos)->first();

        // Activamos el modulo
        $mdl_status = 1;

        // Creamos el objeto
        $ocupacion = new ProfesionalOcupacionSamuCrum();

        // Asignamos los valores
        $ocupacion->id_profesional = $request->id_profesional;

        $ocupacion->id_catalogo_uno = $request->ocupacion_uno;
        $ocupacion->unidad_uno = $ocupacionUno->unidad;
        $ocupacion->area_uno = $ocupacionUno->area;
        $ocupacion->subarea_uno = $ocupacionUno->subarea;
        $ocupacion->componente_uno = $ocupacionUno->componente;
        $ocupacion->ocupacion_uno = $ocupacionUno->ocupacion;

        $ocupacion->id_catalogo_dos = $request->ocupacion_dos;
        $ocupacion->unidad_dos = $ocupacionDos->unidad;
        $ocupacion->area_dos = $ocupacionDos->area;
        $ocupacion->subarea_dos = $ocupacionDos->subarea;   
        $ocupacion->componente_dos = $ocupacionDos->componente;   
        $ocupacion->ocupacion_dos = $ocupacionDos->ocupacion;

        $ocupacion->mdl_status = $mdl_status;

        // Registramos los datos
        $ocupacion->save();

        // Regresamos a la vista con su mensaje
        return redirect()->route('profesionalIndex')->with('successSamuCrum', 'Ocupaciones SAMU CRUM registradas correctamente.');
    }

    public function editSamuCrum($id)
    {
        // Consultamos los datos del profesional
        $profesional = Profesional::findOrFail($id);

        // Llenamos el select de ocupaciones
        $ocupaciones = CatOcupacionSamuCrum::orderBy('orden', 'asc')->get();

        // Consultamos si tiene registros en la tabla
        $profesionalOcupaciones = ProfesionalOcupacionSamuCrum::where('id_profesional',$id)->first();

        // Retornamos la vista con todos los objetos
        return view('ocupacion.samuCrum-edit', compact('profesional','ocupaciones','profesionalOcupaciones'));
    }

    public function updateSamuCrum(Request $request, $id)
    {
        // Validamos los datos
        $request->validate([
            'ocupacion_uno'=>'required',
            'ocupacion_dos'=>'nullable'
        ],[]);

        // Consultamos los datos para registrar
        $ocupacionUno = CatOcupacionSamuCrum::where('id',$request->ocupacion_uno)->first();

        $ocupacionDos = null;

        if ($request->ocupacion_dos) 
        {
            $ocupacionDos = CatOcupacionSamuCrum::where('id', $request->ocupacion_dos)->first();
        }

        // Buscamos el registro a editar
        $ocupaciones = ProfesionalOcupacionSamuCrum::findOrFail($id);

        // Asignamos los valores
        $ocupaciones->update([
            'id_catalogo_uno'=>$request->ocupacion_uno,
            'unidad_uno'=>$ocupacionUno->unidad,
            'area_uno'=>$ocupacionUno->area,
            'subarea_uno'=>$ocupacionUno->subarea,
            'componente_uno'=>$ocupacionUno->componente,
            'ocupacion_uno'=>$ocupacionUno->ocupacion,

            'id_catalogo_dos' => $request->ocupacion_dos,
            'unidad_dos' => $ocupacionDos?->unidad,
            'area_dos' => $ocupacionDos?->area,
            'subarea_dos' => $ocupacionDos?->subarea,
            'componente_dos' => $ocupacionDos?->componente,
            'ocupacion_dos' => $ocupacionDos?->ocupacion,
        ]);

        // Redireccionar con un mensaje de éxito
        return redirect()->route('profesionalIndex')->with('updateSamuCrum', 'Ocupaciones SAMU CRUM actualizadas correctamente.');

    }

    /** ************************************************************************************************************************************************
     * 
     * 
     * OFICINA CENTRAL
     * 
     * 
     ***************************************************************************************************************************************************/

    public function createOficinaCentral($id)
    {
        // Consultamos los datos del profesional
        $profesional = Profesional::findOrFail($id);

        // Llenamos el select de ocupaciones
        $ocupaciones = CatOcupacionOficinaCentral::orderBy('orden', 'asc')->get();

        // Retornamos la vista con todos los objetos
        return view('ocupacion.oficinaCentral-create', compact('profesional','ocupaciones'));
    }

    public function storeOficinaCentral(Request $request)
    {
        // Validamos los datos
        $request->validate([
            'id_profesional'=>'required',
            'ocupacion_uno'=>'required',
            'ocupacion_dos'=>'nullable'
        ],[]);

        // Consultamos los datos para registrar
        $ocupacionUno = CatOcupacionOficinaCentral::where('id',$request->ocupacion_uno)->first();
        $ocupacionDos = CatOcupacionOficinaCentral::where('id',$request->ocupacion_dos)->first();

        // Activamos el modulo
        $mdl_status = 1;

        // Creamos el objeto
        $ocupacion = new ProfesionalOcupacionOficinaCentral();

        // Asignamos los valores
        $ocupacion->id_profesional = $request->id_profesional;

        $ocupacion->id_catalogo_uno = $request->ocupacion_uno;
        $ocupacion->area_uno = $ocupacionUno->area;
        $ocupacion->subarea_uno = $ocupacionUno->subarea;
        $ocupacion->programa_uno = $ocupacionUno->programa;
        $ocupacion->componente_uno = $ocupacionUno->componente;
        $ocupacion->ocupacion_uno = $ocupacionUno->ocupacion;

        $ocupacion->id_catalogo_dos = $request->ocupacion_dos;
        $ocupacion->area_dos = $ocupacionDos->area;
        $ocupacion->subarea_dos = $ocupacionDos->subarea;   
        $ocupacion->programa_dos = $ocupacionDos->programa;   
        $ocupacion->componente_dos = $ocupacionDos->componente;   
        $ocupacion->ocupacion_dos = $ocupacionDos->ocupacion;

        $ocupacion->mdl_status = $mdl_status;

        // Registramos los datos
        $ocupacion->save();

        // Regresamos a la vista con su mensaje
        return redirect()->route('profesionalIndex')->with('successOficinaCentral', 'Ocupaciones OFICINA CENTRAL registradas correctamente.');
    }

    public function editOficinaCentral($id)
    {
        // Consultamos los datos del profesional
        $profesional = Profesional::findOrFail($id);

        // Llenamos el select de ocupaciones
        $ocupaciones = CatOcupacionOficinaCentral::orderBy('orden', 'asc')->get();

        // Consultamos si tiene registros en la tabla
        $profesionalOcupaciones = ProfesionalOcupacionOficinaCentral::where('id_profesional',$id)->first();

        // Retornamos la vista con todos los objetos
        return view('ocupacion.oficinaCentral-edit', compact('profesional','ocupaciones','profesionalOcupaciones'));
    }
    
    public function updateOficinaCentral(Request $request, $id)
    {
        // Validamos los datos
        $request->validate([
            'ocupacion_uno'=>'required',
            'ocupacion_dos'=>'nullable'
        ],[]);

        // Consultamos los datos para registrar
        $ocupacionUno = CatOcupacionOficinaCentral::where('id',$request->ocupacion_uno)->first();

        $ocupacionDos = null;

        if ($request->ocupacion_dos) 
        {
            $ocupacionDos = CatOcupacionOficinaCentral::where('id', $request->ocupacion_dos)->first();
        }

        // Buscamos el registro a editar
        $ocupaciones = ProfesionalOcupacionOficinaCentral::findOrFail($id);

        // Asignamos los valores
        $ocupaciones->update([
            'id_catalogo_uno'=>$request->ocupacion_uno,
            'area_uno'=>$ocupacionUno->area,
            'subarea_uno'=>$ocupacionUno->subarea,
            'programa_uno'=>$ocupacionUno->programa,
            'componente_uno'=>$ocupacionUno->componente,
            'ocupacion_uno'=>$ocupacionUno->ocupacion,

            'id_catalogo_dos' => $request->ocupacion_dos,
            'area_dos' => $ocupacionDos?->area,
            'subarea_dos' => $ocupacionDos?->subarea,
            'programa_dos' => $ocupacionDos?->programa,
            'componente_dos' => $ocupacionDos?->componente,
            'ocupacion_dos' => $ocupacionDos?->ocupacion,
        ]);

        // Redireccionar con un mensaje de éxito
        return redirect()->route('profesionalIndex')->with('updateOficinaCentral', 'Ocupaciones OFICINA CENTRAL actualizadas correctamente.');

    }

    /** ************************************************************************************************************************************************
     * 
     * 
     * ALMACEN
     * 
     * 
     ***************************************************************************************************************************************************/

    public function createAlmacen($id)
    {
        // Consultamos los datos del profesional
        $profesional = Profesional::findOrFail($id);

        // Llenamos el select de ocupaciones
        $ocupaciones = CatOcupacionAlmacen::orderBy('orden', 'asc')->get();

        // Retornamos la vista con todos los objetos
        return view('ocupacion.almacen-create', compact('profesional','ocupaciones'));
    }

    public function storeAlmacen(Request $request)
    {
        // Validamos los datos
        $request->validate([
            'id_profesional'=>'required',
            'ocupacion_uno'=>'required',
            'ocupacion_dos'=>'nullable'
        ],[]);

        // Consultamos los datos para registrar
        $ocupacionUno = CatOcupacionAlmacen::where('id',$request->ocupacion_uno)->first();
        $ocupacionDos = CatOcupacionAlmacen::where('id',$request->ocupacion_dos)->first();

        // Activamos el modulo
        $mdl_status = 1;

        // Creamos el objeto
        $ocupacion = new ProfesionalOcupacionAlmacen();

        // Asignamos los valores
        $ocupacion->id_profesional = $request->id_profesional;

        $ocupacion->id_catalogo_uno = $request->ocupacion_uno;
        $ocupacion->area_uno = $ocupacionUno->area;
        $ocupacion->subarea_uno = $ocupacionUno->subarea;
        $ocupacion->jefatura_uno = $ocupacionUno->jefatura;
        $ocupacion->departamento_uno = $ocupacionUno->departamento;
        $ocupacion->ocupacion_uno = $ocupacionUno->ocupacion;

        $ocupacion->id_catalogo_dos = $request->ocupacion_dos;
        $ocupacion->area_dos = $ocupacionDos->area;
        $ocupacion->subarea_dos = $ocupacionDos->subarea;   
        $ocupacion->jefatura_dos = $ocupacionDos->jefatura;   
        $ocupacion->departamento_dos = $ocupacionDos->departamento;   
        $ocupacion->ocupacion_dos = $ocupacionDos->ocupacion;

        $ocupacion->mdl_status = $mdl_status;

        // Registramos los datos
        $ocupacion->save();

        // Regresamos a la vista con su mensaje
        return redirect()->route('profesionalIndex')->with('successAlmacen', 'Ocupaciones ALMACEN ESTATAL registradas correctamente.');
    }

    public function editAlmacen($id)
    {
        // Consultamos los datos del profesional
        $profesional = Profesional::findOrFail($id);

        // Llenamos el select de ocupaciones
        $ocupaciones = CatOcupacionAlmacen::orderBy('orden', 'asc')->get();

        // Consultamos si tiene registros en la tabla
        $profesionalOcupaciones = ProfesionalOcupacionAlmacen::where('id_profesional',$id)->first();

        // Retornamos la vista con todos los objetos
        return view('ocupacion.almacen-edit', compact('profesional','ocupaciones','profesionalOcupaciones'));
    }

    public function updateAlmacen(Request $request, $id)
    {
        // Validamos los datos
        $request->validate([
            'ocupacion_uno'=>'required',
            'ocupacion_dos'=>'nullable'
        ],[]);

        // Consultamos los datos para registrar
        $ocupacionUno = CatOcupacionAlmacen::where('id',$request->ocupacion_uno)->first();

        $ocupacionDos = null;

        if ($request->ocupacion_dos) 
        {
            $ocupacionDos = CatOcupacionAlmacen::where('id', $request->ocupacion_dos)->first();
        }

        // Buscamos el registro a editar
        $ocupaciones = ProfesionalOcupacionAlmacen::findOrFail($id);

        // Asignamos los valores
        $ocupaciones->update([
            'id_catalogo_uno'=>$request->ocupacion_uno,
            'area_uno'=>$ocupacionUno->area,
            'subarea_uno'=>$ocupacionUno->subarea,
            'jefatura_uno'=>$ocupacionUno->jefatura,
            'departamento_uno'=>$ocupacionUno->departamento,
            'ocupacion_uno'=>$ocupacionUno->ocupacion,

            'id_catalogo_dos' => $request->ocupacion_dos,
            'area_dos' => $ocupacionDos?->area,
            'subarea_dos' => $ocupacionDos?->subarea,
            'jefatura_dos' => $ocupacionDos?->jefatura,
            'departamento_dos' => $ocupacionDos?->departamento,
            'ocupacion_dos' => $ocupacionDos?->ocupacion,
        ]);

        // Redireccionar con un mensaje de éxito
        return redirect()->route('profesionalIndex')->with('updateAlmacen', 'Ocupaciones ALMACEN ESTATAL actualizadas correctamente.');

    }
}