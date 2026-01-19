<?php

namespace App\Http\Controllers;

use App\Models\CatOcupacionAlmacen;
use App\Models\CatOcupacionCeam;
use App\Models\CatOcupacionCecosama;
use App\Models\CatOcupacionCentroSalud;
use App\Models\CatOcupacionCesame;
use App\Models\CatOcupacionCetsLesp;
use App\Models\CatOcupacionCors;
use App\Models\CatOcupacionCriCree;
use App\Models\CatOcupacionEnsenanza;
use App\Models\CatOcupacionHospital;
use App\Models\CatOcupacionHospitalNino;
use App\Models\CatOcupacionIssreei;
use App\Models\CatOcupacionOficinaCentral;
use App\Models\CatOcupacionOfJurisdiccional;
use App\Models\CatOcupacionPsiParras;
use App\Models\CatOcupacionSamuCrum;
use App\Models\Profesional;
use App\Models\ProfesionalOcupacionAlmacen;
use App\Models\ProfesionalOcupacionCeam;
use App\Models\ProfesionalOcupacionCecosama;
use App\Models\ProfesionalOcupacionCentroSalud;
use App\Models\ProfesionalOcupacionCesame;
use App\Models\ProfesionalOcupacionCetsLesp;
use App\Models\ProfesionalOcupacionCors;
use App\Models\ProfesionalOcupacionCriCree;
use App\Models\ProfesionalOcupacionEnsenanza;
use App\Models\ProfesionalOcupacionHospital;
use App\Models\ProfesionalOcupacionHospitalNino;
use App\Models\ProfesionalOcupacionIssreei;
use App\Models\ProfesionalOcupacionOficinaCentral;
use App\Models\ProfesionalOcupacionOfJurisdiccional;
use App\Models\ProfesionalOcupacionPsiParras;
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
        ],[
            'ocupacion_uno.required' => 'Debe elegir al menos una opción; en caso contrario, comuníquese con la Coord. de Mejora Continua.',
        ]);

        // Consultamos los datos para registrar
        $ocupacionUno = CatOcupacionCentroSalud::where('id',$request->ocupacion_uno)->first();

        $ocupacionDos = null;

        if ($request->ocupacion_dos) 
        {
            $ocupacionDos = CatOcupacionCentroSalud::where('id',$request->ocupacion_dos)->first();
        }

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

        $ocupacion->id_catalogo_dos = $request?->ocupacion_dos;
        $ocupacion->unidad_dos = $ocupacionDos?->unidad;
        $ocupacion->area_dos = $ocupacionDos?->area;
        $ocupacion->subarea_dos = $ocupacionDos?->subarea;
        $ocupacion->ocupacion_dos = $ocupacionDos?->ocupacion;

        $ocupacion->mdl_status = $mdl_status;

        // Registramos los datos
        $ocupacion->save();

        // Regresamos a la vista con su mensaje
        return redirect()->route('profesionalShow',$request->id_profesional)->with('success', 'Ocupaciones registradas correctamente.');
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
        // Validamos los datos
        $request->validate([
            'ocupacion_uno' => 'required',
            'ocupacion_dos' => 'nullable',
            'eliminar_ocupacion' => 'nullable'
        ],[
            'ocupacion_uno.required' => 'Debe elegir al menos una opción; en caso contrario, comuníquese con la Coord. de Mejora Continua.',
        ]);

         // Consultamos los datos para registrar
         $ocupacionUno = CatOcupacionCentroSalud::where('id',$request->ocupacion_uno)->first();

         $ocupacionDos = null;

        if ($request->ocupacion_dos) 
        {
            $ocupacionDos = CatOcupacionCentroSalud::where('id',$request->ocupacion_dos)->first();
        }

         // Consultamos el id
         $ocupacion = ProfesionalOcupacionCentroSalud::findOrFail($id);

         if($request->eliminar_ocupacion == 1)
        {
           $ocupacion->delete();
            return redirect()->route('profesionalShow',$ocupacion->id_profesional)->with('destroy', 'Ocupación eliminada correctamente.');
        }
        else
        {
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
        }

         // Regresamos a la vista con su mensaje
         return redirect()->route('profesionalShow',$ocupacion->id_profesional)->with('update', 'Ocupaciones actualizadas correctamente.');
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
        ],[
            'ocupacion_uno.required' => 'Debe elegir al menos una opción; en caso contrario, comuníquese con la Coord. de Mejora Continua.',
        ]);

        // Consultamos los datos para registrar
        $ocupacionUno = CatOcupacionHospital::where('id',$request->ocupacion_uno)->first();
        
        $ocupacionDos = null;

        if ($request->ocupacion_dos) 
        {
            $ocupacionDos = CatOcupacionHospital::where('id',$request->ocupacion_dos)->first();
        }

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

        $ocupacion->id_catalogo_dos = $request?->ocupacion_dos;
        $ocupacion->unidad_dos = $ocupacionDos?->unidad;
        $ocupacion->area_dos = $ocupacionDos?->area;
        $ocupacion->subarea_dos = $ocupacionDos?->subarea;
        $ocupacion->puesto_dos = $ocupacionDos?->puesto;

        $ocupacion->mdl_status = $mdl_status;

        // Registramos los datos
        $ocupacion->save();

        // Regresamos a la vista con su mensaje
        return redirect()->route('profesionalShow',$request->id_profesional)->with('success', 'Ocupaciones registradas correctamente.');
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
            'ocupacion_dos' => 'nullable',
            'eliminar_ocupacion' => 'nullable'
        ],[
            'ocupacion_uno.required' => 'Debe elegir al menos una opción; en caso contrario, comuníquese con la Coord. de Mejora Continua.',
        ]);

         // Consultamos los datos para registrar
         $ocupacionUno = CatOcupacionHospital::where('id',$request->ocupacion_uno)->first();

         $ocupacionDos = null;

        if ($request->ocupacion_dos) 
        {
            $ocupacionDos = CatOcupacionHospital::where('id',$request->ocupacion_dos)->first();
        }

         // Consultamos el id
         $ocupacion = ProfesionalOcupacionHospital::findOrFail($id);

         if($request->eliminar_ocupacion == 1)
        {
           $ocupacion->delete();
            return redirect()->route('profesionalShow',$ocupacion->id_profesional)->with('destroy', 'Ocupación eliminada correctamente.');
        }
        else
        {
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
        
        }
         // Regresamos a la vista con su mensaje
         return redirect()->route('profesionalShow',$ocupacion->id_profesional)->with('update', 'Ocupaciones actualizadas correctamente.');
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
        ],[
            'ocupacion_uno.required' => 'Debe elegir al menos una opción; en caso contrario, comuníquese con la Coord. de Mejora Continua.',
        ]);

        // Consultamos los datos para registrar
        $ocupacionUno = CatOcupacionOfJurisdiccional::where('id',$request->ocupacion_uno)->first();

        $ocupacionDos = null;

        if ($request->ocupacion_dos) 
        {
            $ocupacionDos = CatOcupacionOfJurisdiccional::where('id', $request->ocupacion_dos)->first();
        }

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

        $ocupacion->id_catalogo_dos = $request?->ocupacion_dos;
        $ocupacion->unidad_dos = $ocupacionDos?->unidad;
        $ocupacion->area_dos = $ocupacionDos?->area;
        $ocupacion->subarea_dos = $ocupacionDos?->subarea;        
        $ocupacion->servicio_dos = $ocupacionDos?->servicio;
        $ocupacion->ocupacion_dos = $ocupacionDos?->ocupacion;

        $ocupacion->mdl_status = $mdl_status;

        // Registramos los datos
        $ocupacion->save();

        // Regresamos a la vista con su mensaje
        return redirect()->route('profesionalShow',$request->id_profesional)->with('success', 'Ocupaciones registradas correctamente.');
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
            'ocupacion_dos'=>'nullable',
            'eliminar_ocupacion' => 'nullable'
        ],[
            'ocupacion_uno.required' => 'Debe elegir al menos una opción; en caso contrario, comuníquese con la Coord. de Mejora Continua.',
        ]);

        // Consultamos los datos para registrar
        $ocupacionUno = CatOcupacionOfJurisdiccional::where('id',$request->ocupacion_uno)->first();

        $ocupacionDos = null;

        if ($request->ocupacion_dos) 
        {
            $ocupacionDos = CatOcupacionOfJurisdiccional::where('id', $request->ocupacion_dos)->first();
        }

        // Buscamos el registro a editar
        $ocupaciones = ProfesionalOcupacionOfJurisdiccional::findOrFail($id);

        // Buscamos el registro a editar
        $ocupaciones = ProfesionalOcupacionOfJurisdiccional::findOrFail($id);

        if($request->eliminar_ocupacion == 1)
        {
            $ocupaciones->delete();
            return redirect()->route('profesionalShow',$ocupaciones->id_profesional)->with('destroy', 'Ocupación eliminada correctamente.');
        }
        else
        {
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
            
        }
        // Redireccionar con un mensaje de éxito
        return redirect()->route('profesionalShow',$ocupaciones->id_profesional)->with('update', 'Ocupaciones actualizadas correctamente.');

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
        ],[
            'ocupacion_uno.required' => 'Debe elegir al menos una opción; en caso contrario, comuníquese con la Coord. de Mejora Continua.',
        ]);

        // Consultamos los datos para registrar
        $ocupacionUno = CatOcupacionCriCree::where('id',$request->ocupacion_uno)->first();
        
        $ocupacionDos = null;

        if ($request->ocupacion_dos) 
        {
            $ocupacionDos = CatOcupacionCriCree::where('id',$request->ocupacion_dos)->first();
        }

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

        $ocupacion->id_catalogo_dos = $request?->ocupacion_dos;
        $ocupacion->unidad_dos = $ocupacionDos?->unidad;
        $ocupacion->area_dos = $ocupacionDos?->area;
        $ocupacion->subarea_dos = $ocupacionDos?->subarea;   
        $ocupacion->ocupacion_dos = $ocupacionDos?->ocupacion;

        $ocupacion->mdl_status = $mdl_status;

        // Registramos los datos
        $ocupacion->save();

        // Regresamos a la vista con su mensaje
        return redirect()->route('profesionalShow',$request->id_profesional)->with('success', 'Ocupaciones registradas correctamente.');
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
            'ocupacion_dos'=>'nullable',
            'eliminar_ocupacion' => 'nullable'
        ],[
            'ocupacion_uno.required' => 'Debe elegir al menos una opción; en caso contrario, comuníquese con la Coord. de Mejora Continua.',
        ]);

        // Consultamos los datos para registrar
        $ocupacionUno = CatOcupacionCriCree::where('id',$request->ocupacion_uno)->first();

        $ocupacionDos = null;

        if ($request->ocupacion_dos) 
        {
            $ocupacionDos = CatOcupacionCriCree::where('id', $request->ocupacion_dos)->first();
        }

        // Buscamos el registro a editar
        $ocupaciones = ProfesionalOcupacionCriCree::findOrFail($id);

        if($request->eliminar_ocupacion == 1)
        {
           $ocupaciones->delete();
            return redirect()->route('profesionalShow',$ocupaciones->id_profesional)->with('destroy', 'Ocupación eliminada correctamente.');
        }
        else
        {
            // Asignamos los valores
            $ocupaciones->update([
                'id_catalogo_uno'=>$request->ocupacion_uno,
                'unidad_uno'=>$ocupacionUno->unidad,
                'area_uno'=>$ocupacionUno->area,
                'subarea_uno'=>$ocupacionUno->subarea,
                'ocupacion_uno'=>$ocupacionUno->ocupacion,

                'id_catalogo_dos' => $request?->ocupacion_dos,
                'unidad_dos' => $ocupacionDos?->unidad,
                'area_dos' => $ocupacionDos?->area,
                'subarea_dos' => $ocupacionDos?->subarea,
                'ocupacion_dos' => $ocupacionDos?->ocupacion,
            ]);
        }

        // Redireccionar con un mensaje de éxito
        return redirect()->route('profesionalShow',$ocupaciones->id_profesional)->with('update', 'Ocupaciones actualizadas correctamente.');

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
        ],[
            'ocupacion_uno.required' => 'Debe elegir al menos una opción; en caso contrario, comuníquese con la Coord. de Mejora Continua.',
        ]);

        // Consultamos los datos para registrar
        $ocupacionUno = CatOcupacionSamuCrum::where('id',$request->ocupacion_uno)->first();
        
        $ocupacionDos = null;

        if ($request->ocupacion_dos) 
        {
            $ocupacionDos = CatOcupacionSamuCrum::where('id',$request->ocupacion_dos)->first();
        }

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

        $ocupacion->id_catalogo_dos = $request?->ocupacion_dos;
        $ocupacion->unidad_dos = $ocupacionDos?->unidad;
        $ocupacion->area_dos = $ocupacionDos?->area;
        $ocupacion->subarea_dos = $ocupacionDos?->subarea;   
        $ocupacion->componente_dos = $ocupacionDos?->componente;   
        $ocupacion->ocupacion_dos = $ocupacionDos?->ocupacion;

        $ocupacion->mdl_status = $mdl_status;

        // Registramos los datos
        $ocupacion->save();

        // Regresamos a la vista con su mensaje
        return redirect()->route('profesionalShow',$request->id_profesional)->with('success', 'Ocupaciones registradas correctamente.');
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
            'ocupacion_dos'=>'nullable',
            'eliminar_ocupacion' => 'nullable'
        ],[
            'ocupacion_uno.required' => 'Debe elegir al menos una opción; en caso contrario, comuníquese con la Coord. de Mejora Continua.',
        ]);

        // Consultamos los datos para registrar
        $ocupacionUno = CatOcupacionSamuCrum::where('id',$request->ocupacion_uno)->first();

        $ocupacionDos = null;

        if ($request->ocupacion_dos) 
        {
            $ocupacionDos = CatOcupacionSamuCrum::where('id', $request->ocupacion_dos)->first();
        }

        // Buscamos el registro a editar
        $ocupaciones = ProfesionalOcupacionSamuCrum::findOrFail($id);

        if($request->eliminar_ocupacion == 1)
        {
           $ocupaciones->delete();
            return redirect()->route('profesionalShow',$ocupaciones->id_profesional)->with('destroy', 'Ocupación eliminada correctamente.');
        }
        else
        {
            // Asignamos los valores
            $ocupaciones->update([
                'id_catalogo_uno'=>$request->ocupacion_uno,
                'unidad_uno'=>$ocupacionUno->unidad,
                'area_uno'=>$ocupacionUno->area,
                'subarea_uno'=>$ocupacionUno->subarea,
                'componente_uno'=>$ocupacionUno->componente,
                'ocupacion_uno'=>$ocupacionUno->ocupacion,

                'id_catalogo_dos' => $request?->ocupacion_dos,
                'unidad_dos' => $ocupacionDos?->unidad,
                'area_dos' => $ocupacionDos?->area,
                'subarea_dos' => $ocupacionDos?->subarea,
                'componente_dos' => $ocupacionDos?->componente,
                'ocupacion_dos' => $ocupacionDos?->ocupacion,
            ]);
        
        }

        // Redireccionar con un mensaje de éxito
        return redirect()->route('profesionalShow',$ocupaciones->id_profesional)->with('update', 'Ocupaciones actualizadas correctamente.');

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
        ],[
            'ocupacion_uno.required' => 'Debe elegir al menos una opción; en caso contrario, comuníquese con la Coord. de Mejora Continua.',
        ]);

        // Consultamos los datos para registrar
        $ocupacionUno = CatOcupacionOficinaCentral::where('id',$request->ocupacion_uno)->first();
        
        $ocupacionDos = null;

        if ($request->ocupacion_dos) 
        {
            $ocupacionDos = CatOcupacionOficinaCentral::where('id',$request->ocupacion_dos)->first();
        }

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

        $ocupacion->id_catalogo_dos = $request?->ocupacion_dos;
        $ocupacion->area_dos = $ocupacionDos?->area;
        $ocupacion->subarea_dos = $ocupacionDos?->subarea;   
        $ocupacion->programa_dos = $ocupacionDos?->programa;   
        $ocupacion->componente_dos = $ocupacionDos?->componente;   
        $ocupacion->ocupacion_dos = $ocupacionDos?->ocupacion;

        $ocupacion->mdl_status = $mdl_status;

        // Registramos los datos
        $ocupacion->save();

        // Regresamos a la vista con su mensaje
        return redirect()->route('profesionalShow',$request->id_profesional)->with('success', 'Ocupaciones registradas correctamente.');
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
            'ocupacion_dos'=>'nullable',
            'eliminar_ocupacion' => 'nullable'
        ],[
            'ocupacion_uno.required' => 'Debe elegir al menos una opción; en caso contrario, comuníquese con la Coord. de Mejora Continua.',
        ]);

        // Consultamos los datos para registrar
        $ocupacionUno = CatOcupacionOficinaCentral::where('id',$request->ocupacion_uno)->first();

        $ocupacionDos = null;

        if ($request->ocupacion_dos) 
        {
            $ocupacionDos = CatOcupacionOficinaCentral::where('id', $request->ocupacion_dos)->first();
        }

        // Buscamos el registro a editar
        $ocupaciones = ProfesionalOcupacionOficinaCentral::findOrFail($id);

        if($request->eliminar_ocupacion == 1)
        {
           $ocupaciones->delete();
            return redirect()->route('profesionalShow',$ocupaciones->id_profesional)->with('destroy', 'Ocupación eliminada correctamente.');
        }
        else
        {
            // Asignamos los valores
            $ocupaciones->update([
                'id_catalogo_uno'=>$request->ocupacion_uno,
                'area_uno'=>$ocupacionUno->area,
                'subarea_uno'=>$ocupacionUno->subarea,
                'programa_uno'=>$ocupacionUno->programa,
                'componente_uno'=>$ocupacionUno->componente,
                'ocupacion_uno'=>$ocupacionUno->ocupacion,

                'id_catalogo_dos' => $request?->ocupacion_dos,
                'area_dos' => $ocupacionDos?->area,
                'subarea_dos' => $ocupacionDos?->subarea,
                'programa_dos' => $ocupacionDos?->programa,
                'componente_dos' => $ocupacionDos?->componente,
                'ocupacion_dos' => $ocupacionDos?->ocupacion,
            ]);

        }

        // Redireccionar con un mensaje de éxito
        return redirect()->route('profesionalShow',$ocupaciones->id_profesional)->with('update', 'Ocupaciones actualizadas correctamente.');

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
        ],[
            'ocupacion_uno.required' => 'Debe elegir al menos una opción; en caso contrario, comuníquese con la Coord. de Mejora Continua.',
        ]);

        // Consultamos los datos para registrar
        $ocupacionUno = CatOcupacionAlmacen::where('id',$request->ocupacion_uno)->first();

        $ocupacionDos = null;

        if ($request->ocupacion_dos) 
        {
            $ocupacionDos = CatOcupacionAlmacen::where('id',$request->ocupacion_dos)->first();
        }

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

        $ocupacion->id_catalogo_dos = $request?->ocupacion_dos;
        $ocupacion->area_dos = $ocupacionDos?->area;
        $ocupacion->subarea_dos = $ocupacionDos?->subarea;   
        $ocupacion->jefatura_dos = $ocupacionDos?->jefatura;   
        $ocupacion->departamento_dos = $ocupacionDos?->departamento;   
        $ocupacion->ocupacion_dos = $ocupacionDos?->ocupacion;

        $ocupacion->mdl_status = $mdl_status;

        // Registramos los datos
        $ocupacion->save();

        // Regresamos a la vista con su mensaje
        return redirect()->route('profesionalShow',$request->id_profesional)->with('success', 'Ocupaciones registradas correctamente.');
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
            'ocupacion_dos'=>'nullable',
            'eliminar_ocupacion' => 'nullable'
        ],[
            'ocupacion_uno.required' => 'Debe elegir al menos una opción; en caso contrario, comuníquese con la Coord. de Mejora Continua.',
        ]);

        // Consultamos los datos para registrar
        $ocupacionUno = CatOcupacionAlmacen::where('id',$request->ocupacion_uno)->first();

        $ocupacionDos = null;

        if ($request->ocupacion_dos) 
        {
            $ocupacionDos = CatOcupacionAlmacen::where('id', $request->ocupacion_dos)->first();
        }

        // Buscamos el registro a editar
        $ocupaciones = ProfesionalOcupacionAlmacen::findOrFail($id);

        if($request->eliminar_ocupacion == 1)
        {
           $ocupaciones->delete();
            return redirect()->route('profesionalShow',$ocupaciones->id_profesional)->with('destroy', 'Ocupación eliminada correctamente.');
        }
        else
        {
            // Asignamos los valores
            $ocupaciones->update([
                'id_catalogo_uno'=>$request->ocupacion_uno,
                'area_uno'=>$ocupacionUno->area,
                'subarea_uno'=>$ocupacionUno->subarea,
                'jefatura_uno'=>$ocupacionUno->jefatura,
                'departamento_uno'=>$ocupacionUno->departamento,
                'ocupacion_uno'=>$ocupacionUno->ocupacion,

                'id_catalogo_dos' => $request?->ocupacion_dos,
                'area_dos' => $ocupacionDos?->area,
                'subarea_dos' => $ocupacionDos?->subarea,
                'jefatura_dos' => $ocupacionDos?->jefatura,
                'departamento_dos' => $ocupacionDos?->departamento,
                'ocupacion_dos' => $ocupacionDos?->ocupacion,
            ]);
        }

        

        // Redireccionar con un mensaje de éxito
        return redirect()->route('profesionalShow',$ocupaciones->id_profesional)->with('update', 'Ocupaciones actualizadas correctamente.');

    }

     /** ************************************************************************************************************************************************
     * 
     * 
     * CENTRO ONCOLOGICO DE LA REGION SURESTE
     * 
     * 
     ***************************************************************************************************************************************************/

     public function createCors($id)
    {
        // Consultamos los datos del profesional
        $profesional = Profesional::findOrFail($id);

        // Llenamos el select de ocupaciones
        $ocupaciones = CatOcupacionCors::orderBy('orden', 'asc')->get();

        // Retornamos la vista con todos los objetos
        return view('ocupacion.cors-create', compact('profesional','ocupaciones'));
    }

    public function storeCors(Request $request)
    {
        // Validamos los datos
        $request->validate([
            'id_profesional'=>'required',
            'ocupacion_uno'=>'required',
            'ocupacion_dos'=>'nullable'
        ],[
            'ocupacion_uno.required' => 'Debe elegir al menos una opción; en caso contrario, comuníquese con la Coord. de Mejora Continua.',
        ]);

        // Consultamos los datos para registrar
        $ocupacionUno = CatOcupacionCors::where('id',$request->ocupacion_uno)->first();

        $ocupacionDos = null;

        if ($request->ocupacion_dos) 
        {
            $ocupacionDos = CatOcupacionCors::where('id',$request->ocupacion_dos)->first();
        }

        // Activamos el modulo
        $mdl_status = 1;

        // Creamos el objeto
        $ocupacion = new ProfesionalOcupacionCors();

        // Asignamos los valores
        $ocupacion->id_profesional = $request->id_profesional;

        $ocupacion->id_catalogo_uno = $request->ocupacion_uno;
        $ocupacion->unidad_uno = $ocupacionUno->unidad;
        $ocupacion->area_uno = $ocupacionUno->area;
        $ocupacion->subarea_servicio_uno = $ocupacionUno->subarea_servicio;
        $ocupacion->componente_uno = $ocupacionUno->componente;
        $ocupacion->ocupacion_uno = $ocupacionUno->ocupacion;

        $ocupacion->id_catalogo_dos = $request?->ocupacion_dos;
        $ocupacion->unidad_dos = $ocupacionDos?->unidad;
        $ocupacion->area_dos = $ocupacionDos?->area;
        $ocupacion->subarea_servicio_dos = $ocupacionDos?->subarea_servicio;   
        $ocupacion->componente_dos = $ocupacionDos?->componente;   
        $ocupacion->ocupacion_dos = $ocupacionDos?->ocupacion;

        $ocupacion->mdl_status = $mdl_status;

        // Registramos los datos
        $ocupacion->save();

        // Regresamos a la vista con su mensaje
        return redirect()->route('profesionalShow',$request->id_profesional)->with('success', 'Ocupaciones registradas correctamente.');
    }

    public function editCors($id)
    {
        // Consultamos los datos del profesional
        $profesional = Profesional::findOrFail($id);

        // Llenamos el select de ocupaciones
        $ocupaciones = CatOcupacionCors::orderBy('orden', 'asc')->get();

        // Consultamos si tiene registros en la tabla
        $profesionalOcupaciones = ProfesionalOcupacionCors::where('id_profesional',$id)->first();

        // Retornamos la vista con todos los objetos
        return view('ocupacion.cors-edit', compact('profesional','ocupaciones','profesionalOcupaciones'));
    }

    public function updateCors(Request $request, $id)
    {
        // Validamos los datos
        $request->validate([
            'ocupacion_uno'=>'required',
            'ocupacion_dos'=>'nullable',
            'eliminar_ocupacion' => 'nullable'
        ],[
            'ocupacion_uno.required' => 'Debe elegir al menos una opción; en caso contrario, comuníquese con la Coord. de Mejora Continua.',
        ]);

        // Consultamos los datos para registrar
        $ocupacionUno = CatOcupacionCors::where('id',$request->ocupacion_uno)->first();

        $ocupacionDos = null;

        if ($request->ocupacion_dos) 
        {
            $ocupacionDos = CatOcupacionCors::where('id', $request->ocupacion_dos)->first();
        }

        // Buscamos el registro a editar
        $ocupaciones = ProfesionalOcupacionCors::findOrFail($id);

        if($request->eliminar_ocupacion == 1)
        {
           $ocupaciones->delete();
            return redirect()->route('profesionalShow',$ocupaciones->id_profesional)->with('destroy', 'Ocupación eliminada correctamente.');
        }
        else
        {


        // Asignamos los valores
        $ocupaciones->update([
            'id_catalogo_uno'=>$request->ocupacion_uno,
            'unidad_uno'=>$ocupacionUno->unidad,
            'area_uno'=>$ocupacionUno->area,
            'subarea_servicio_uno'=>$ocupacionUno->subarea_servicio,
            'componente_uno'=>$ocupacionUno->componente,
            'ocupacion_uno'=>$ocupacionUno->ocupacion,

            'id_catalogo_dos' => $request?->ocupacion_dos,
            'unidad_dos' => $ocupacionDos?->unidad,
            'area_dos' => $ocupacionDos?->area,
            'subarea_servicio_dos' => $ocupacionDos?->subarea_servicio,
            'componente_dos' => $ocupacionDos?->componente,
            'ocupacion_dos' => $ocupacionDos?->ocupacion,
        ]);

    }

        // Redireccionar con un mensaje de éxito
        return redirect()->route('profesionalShow',$ocupaciones->id_profesional)->with('update', 'Ocupaciones actualizadas correctamente.');

    }

     /** ************************************************************************************************************************************************
     * 
     * 
     * CETS LESP
     * 
     * 
     ***************************************************************************************************************************************************/

     public function createCetsLesp($id)
    {
        // Consultamos los datos del profesional
        $profesional = Profesional::findOrFail($id);

        // Llenamos el select de ocupaciones
        $ocupaciones = CatOcupacionCetsLesp::orderBy('orden', 'asc')->get();

        // Retornamos la vista con todos los objetos
        return view('ocupacion.cetsLesp-create', compact('profesional','ocupaciones'));
    }

    public function storeCetsLesp(Request $request)
    {
        // Validamos los datos
        $request->validate([
            'id_profesional'=>'required',
            'ocupacion_uno'=>'required',
            'ocupacion_dos'=>'nullable'
        ],[
            'ocupacion_uno.required' => 'Debe elegir al menos una opción; en caso contrario, comuníquese con la Coord. de Mejora Continua.',
        ]);

        // Consultamos los datos para registrar
        $ocupacionUno = CatOcupacionCetsLesp::where('id',$request->ocupacion_uno)->first();
        
        $ocupacionDos = null;

        if ($request->ocupacion_dos) 
        {
            $ocupacionDos = CatOcupacionCetsLesp::where('id',$request->ocupacion_dos)->first();
        }

        // Activamos el modulo
        $mdl_status = 1;

        // Creamos el objeto
        $ocupacion = new ProfesionalOcupacionCetsLesp();

        // Asignamos los valores
        $ocupacion->id_profesional = $request->id_profesional;

        $ocupacion->id_catalogo_uno = $request->ocupacion_uno;
        $ocupacion->area_uno = $ocupacionUno->area;
        $ocupacion->subarea_uno = $ocupacionUno->subarea;
        $ocupacion->jefatura_programa_uno = $ocupacionUno->jefatura_programa;
        $ocupacion->componente_uno = $ocupacionUno->componente;
        $ocupacion->ocupacion_uno = $ocupacionUno->ocupacion;

        $ocupacion->id_catalogo_dos = $request?->ocupacion_dos;
        $ocupacion->area_dos = $ocupacionDos?->area;
        $ocupacion->subarea_dos = $ocupacionDos?->subarea;
        $ocupacion->jefatura_programa_dos = $ocupacionDos?->jefatura_programa;
        $ocupacion->componente_dos = $ocupacionDos?->componente;
        $ocupacion->ocupacion_dos = $ocupacionDos?->ocupacion;

        $ocupacion->mdl_status = $mdl_status;

        // Registramos los datos
        $ocupacion->save();

        // Regresamos a la vista con su mensaje
        return redirect()->route('profesionalShow',$request->id_profesional)->with('success', 'Ocupaciones registradas correctamente.');
    }

    public function editCetsLesp($id)
    {
        // Consultamos los datos del profesional
        $profesional = Profesional::findOrFail($id);

        // Llenamos el select de ocupaciones
        $ocupaciones = CatOcupacionCetsLesp::orderBy('orden', 'asc')->get();

        // Consultamos si tiene registros en la tabla
        $profesionalOcupaciones = ProfesionalOcupacionCetsLesp::where('id_profesional',$id)->first();

        // Retornamos la vista con todos los objetos
        return view('ocupacion.cetsLesp-edit', compact('profesional','ocupaciones','profesionalOcupaciones'));
    }

    public function updateCetsLesp(Request $request, $id)
    {
        // Validamos los datos
        $request->validate([
            'ocupacion_uno'=>'required',
            'ocupacion_dos'=>'nullable',
            'eliminar_ocupacion' => 'nullable'
        ],[
            'ocupacion_uno.required' => 'Debe elegir al menos una opción; en caso contrario, comuníquese con la Coord. de Mejora Continua.',
        ]);

        // Consultamos los datos para registrar
        $ocupacionUno = CatOcupacionCetsLesp::where('id',$request->ocupacion_uno)->first();

        $ocupacionDos = null;

        if ($request->ocupacion_dos) 
        {
            $ocupacionDos = CatOcupacionCetsLesp::where('id', $request->ocupacion_dos)->first();
        }

        // Buscamos el registro a editar
        $ocupaciones = ProfesionalOcupacionCetsLesp::findOrFail($id);

        if($request->eliminar_ocupacion == 1)
        {
            $ocupaciones->delete();
            return redirect()->route('profesionalShow',$ocupaciones->id_profesional)->with('destroy', 'Ocupación eliminada correctamente.');
        }
        else
        {
            // Asignamos los valores
            $ocupaciones->update([

                'id_catalogo_uno'=>$request->ocupacion_uno,
                'area_uno'=>$ocupacionUno->area,
                'subarea_uno'=>$ocupacionUno->subarea,
                'jefatura_programa_uno'=>$ocupacionUno->jefatura_programa,
                'componente_uno'=>$ocupacionUno->componente,
                'ocupacion_uno'=>$ocupacionUno->ocupacion,

                'id_catalogo_dos' => $request?->ocupacion_dos,
                'area_dos' => $ocupacionDos?->area,
                'subarea_dos' => $ocupacionDos?->subarea,
                'jefatura_programa_dos' => $ocupacionDos?->jefatura_programa,
                'componente_dos' => $ocupacionDos?->componente,
                'ocupacion_dos' => $ocupacionDos?->ocupacion,
            ]);

        }

        // Redireccionar con un mensaje de éxito
        return redirect()->route('profesionalShow',$ocupaciones->id_profesional)->with('update', 'Ocupaciones actualizadas correctamente.');

    }

    /** ************************************************************************************************************************************************
     * 
     * 
     * CESAME
     * 
     * 
     ***************************************************************************************************************************************************/

     public function createCesame($id)
    {
        // Consultamos los datos del profesional
        $profesional = Profesional::findOrFail($id);

        // Llenamos el select de ocupaciones
        $ocupaciones = CatOcupacionCesame::orderBy('orden', 'asc')->get();

        // Retornamos la vista con todos los objetos
        return view('ocupacion.cesame-create', compact('profesional','ocupaciones'));
    }

    public function storeCesame(Request $request)
    {
        // Validamos los datos
        $request->validate([
            'id_profesional'=>'required',
            'ocupacion_uno'=>'required',
            'ocupacion_dos'=>'nullable'
        ],[
            'ocupacion_uno.required' => 'Debe elegir al menos una opción; en caso contrario, comuníquese con la Coord. de Mejora Continua.',
        ]);

        // Consultamos los datos para registrar
        $ocupacionUno = CatOcupacionCesame::where('id',$request->ocupacion_uno)->first();

        $ocupacionDos = null;

        if ($request->ocupacion_dos) 
        {
            $ocupacionDos = CatOcupacionCesame::where('id',$request->ocupacion_dos)->first();
        }

        // Activamos el modulo
        $mdl_status = 1;

        // Creamos el objeto
        $ocupacion = new ProfesionalOcupacionCesame();

        // Asignamos los valores
        $ocupacion->id_profesional = $request->id_profesional;

        $ocupacion->id_catalogo_uno = $request->ocupacion_uno;
        $ocupacion->unidad_uno = $ocupacionUno->unidad;
        $ocupacion->area_uno = $ocupacionUno->area;
        $ocupacion->subarea_servicio_uno = $ocupacionUno->subarea_servicio;
        $ocupacion->componente_uno = $ocupacionUno->componente;
        $ocupacion->ocupacion_uno = $ocupacionUno->ocupacion;

        $ocupacion->id_catalogo_dos = $request?->ocupacion_dos;
        $ocupacion->unidad_dos = $ocupacionDos?->unidad;
        $ocupacion->area_dos = $ocupacionDos?->area;
        $ocupacion->subarea_servicio_dos = $ocupacionDos?->subarea_servicio;
        $ocupacion->componente_dos = $ocupacionDos?->componente;
        $ocupacion->ocupacion_dos = $ocupacionDos?->ocupacion;

        $ocupacion->mdl_status = $mdl_status;

        // Registramos los datos
        $ocupacion->save();

        // Regresamos a la vista con su mensaje
        return redirect()->route('profesionalShow',$request->id_profesional)->with('success', 'Ocupaciones registradas correctamente.');
    }

    public function editCesame($id)
    {
        // Consultamos los datos del profesional
        $profesional = Profesional::findOrFail($id);

        // Llenamos el select de ocupaciones
        $ocupaciones = CatOcupacionCesame::orderBy('orden', 'asc')->get();

        // Consultamos si tiene registros en la tabla
        $profesionalOcupaciones = ProfesionalOcupacionCesame::where('id_profesional',$id)->first();

        // Retornamos la vista con todos los objetos
        return view('ocupacion.cesame-edit', compact('profesional','ocupaciones','profesionalOcupaciones'));
    }

    public function updateCesame(Request $request, $id)
    {
        // Validamos los datos
        $request->validate([
            'ocupacion_uno'=>'required',
            'ocupacion_dos'=>'nullable',
            'eliminar_ocupacion' => 'nullable'
        ],[
            'ocupacion_uno.required' => 'Debe elegir al menos una opción; en caso contrario, comuníquese con la Coord. de Mejora Continua.',
        ]);

        // Consultamos los datos para registrar
        $ocupacionUno = CatOcupacionCesame::where('id',$request->ocupacion_uno)->first();

        $ocupacionDos = null;

        if ($request->ocupacion_dos) 
        {
            $ocupacionDos = CatOcupacionCesame::where('id', $request->ocupacion_dos)->first();
        }

        // Buscamos el registro a editar
        $ocupaciones = ProfesionalOcupacionCesame::findOrFail($id);

        if($request->eliminar_ocupacion == 1)
        {
           $ocupaciones->delete();
            return redirect()->route('profesionalShow',$ocupaciones->id_profesional)->with('destroy', 'Ocupación eliminada correctamente.');
        }
        else
        {

            // Asignamos los valores
            $ocupaciones->update([

                'id_catalogo_uno'=>$request->ocupacion_uno,
                'unidad_uno'=>$ocupacionUno->unidad,
                'area_uno'=>$ocupacionUno->area,
                'subarea_servicio_uno'=>$ocupacionUno->subarea_servicio,
                'componente_uno'=>$ocupacionUno->componente,
                'ocupacion_uno'=>$ocupacionUno->ocupacion,

                'id_catalogo_dos' => $request?->ocupacion_dos,
                'unidad_dos' => $ocupacionDos?->unidad,
                'area_dos' => $ocupacionDos?->area,
                'subarea_servicio_dos' => $ocupacionDos?->subarea_servicio,
                'componente_dos' => $ocupacionDos?->componente,
                'ocupacion_dos' => $ocupacionDos?->ocupacion,
            ]);

        }

        // Redireccionar con un mensaje de éxito
        return redirect()->route('profesionalShow',$ocupaciones->id_profesional)->with('update', 'Ocupaciones actualizadas correctamente.');

    }

    /** ************************************************************************************************************************************************
     * 
     * 
     * PSI PARRAS
     * 
     * 
     ***************************************************************************************************************************************************/

     public function createPsiParras($id)
    {
        // Consultamos los datos del profesional
        $profesional = Profesional::findOrFail($id);

        // Llenamos el select de ocupaciones
        $ocupaciones = CatOcupacionPsiParras::orderBy('orden', 'asc')->get();

        // Retornamos la vista con todos los objetos
        return view('ocupacion.psiParras-create', compact('profesional','ocupaciones'));
    }

    public function storePsiParras(Request $request)
    {
        // Validamos los datos
        $request->validate([
            'id_profesional'=>'required',
            'ocupacion_uno'=>'required',
            'ocupacion_dos'=>'nullable'
        ],[
            'ocupacion_uno.required' => 'Debe elegir al menos una opción; en caso contrario, comuníquese con la Coord. de Mejora Continua.',
        ]);

        // Consultamos los datos para registrar
        $ocupacionUno = CatOcupacionPsiParras::where('id',$request->ocupacion_uno)->first();
        
        $ocupacionDos = null;

        if ($request->ocupacion_dos) 
        {
            $ocupacionDos = CatOcupacionPsiParras::where('id',$request->ocupacion_dos)->first();
        }

        // Activamos el modulo
        $mdl_status = 1;

        // Creamos el objeto
        $ocupacion = new ProfesionalOcupacionPsiParras();

        // Asignamos los valores
        $ocupacion->id_profesional = $request->id_profesional;

        $ocupacion->id_catalogo_uno = $request->ocupacion_uno;
        $ocupacion->unidad_uno = $ocupacionUno->unidad;
        $ocupacion->area_uno = $ocupacionUno->area;
        $ocupacion->subarea_servicio_uno = $ocupacionUno->subarea_servicio;
        $ocupacion->componente_uno = $ocupacionUno->componente;
        $ocupacion->ocupacion_uno = $ocupacionUno->ocupacion;

        $ocupacion->id_catalogo_dos = $request?->ocupacion_dos;
        $ocupacion->unidad_dos = $ocupacionDos?->unidad;
        $ocupacion->area_dos = $ocupacionDos?->area;
        $ocupacion->subarea_servicio_dos = $ocupacionDos?->subarea_servicio;
        $ocupacion->componente_dos = $ocupacionDos?->componente;
        $ocupacion->ocupacion_dos = $ocupacionDos?->ocupacion;

        $ocupacion->mdl_status = $mdl_status;

        // Registramos los datos
        $ocupacion->save();

        // Regresamos a la vista con su mensaje
        return redirect()->route('profesionalShow',$request->id_profesional)->with('success', 'Ocupaciones registradas correctamente.');
    }

    public function editPsiParras($id)
    {
        // Consultamos los datos del profesional
        $profesional = Profesional::findOrFail($id);

        // Llenamos el select de ocupaciones
        $ocupaciones = CatOcupacionPsiParras::orderBy('orden', 'asc')->get();

        // Consultamos si tiene registros en la tabla
        $profesionalOcupaciones = ProfesionalOcupacionPsiParras::where('id_profesional',$id)->first();

        // Retornamos la vista con todos los objetos
        return view('ocupacion.psiParras-edit', compact('profesional','ocupaciones','profesionalOcupaciones'));
    }

    public function updatePsiParras(Request $request, $id)
    {
        // Validamos los datos
        $request->validate([
            'ocupacion_uno'=>'required',
            'ocupacion_dos'=>'nullable',
            'eliminar_ocupacion' => 'nullable'
        ],[
            'ocupacion_uno.required' => 'Debe elegir al menos una opción; en caso contrario, comuníquese con la Coord. de Mejora Continua.',
        ]);

        // Consultamos los datos para registrar
        $ocupacionUno = CatOcupacionPsiParras::where('id',$request->ocupacion_uno)->first();

        $ocupacionDos = null;

        if ($request->ocupacion_dos) 
        {
            $ocupacionDos = CatOcupacionPsiParras::where('id', $request->ocupacion_dos)->first();
        }

        // Buscamos el registro a editar
        $ocupaciones = ProfesionalOcupacionPsiParras::findOrFail($id);

        if($request->eliminar_ocupacion == 1)
        {
           $ocupaciones->delete();
            return redirect()->route('profesionalShow',$ocupaciones->id_profesional)->with('destroy', 'Ocupación eliminada correctamente.');
        }
        else
        {
            // Asignamos los valores
            $ocupaciones->update([

                'id_catalogo_uno'=>$request->ocupacion_uno,
                'unidad_uno'=>$ocupacionUno->unidad,
                'area_uno'=>$ocupacionUno->area,
                'subarea_servicio_uno'=>$ocupacionUno->subarea_servicio,
                'componente_uno'=>$ocupacionUno->componente,
                'ocupacion_uno'=>$ocupacionUno->ocupacion,

                'id_catalogo_dos' => $request?->ocupacion_dos,
                'unidad_dos' => $ocupacionDos?->unidad,
                'area_dos' => $ocupacionDos?->area,
                'subarea_servicio_dos' => $ocupacionDos?->subarea_servicio,
                'componente_dos' => $ocupacionDos?->componente,
                'ocupacion_dos' => $ocupacionDos?->ocupacion,
            ]);

        }

        // Redireccionar con un mensaje de éxito
        return redirect()->route('profesionalShow',$ocupaciones->id_profesional)->with('update', 'Ocupaciones actualizadas correctamente.');

    }

    /** ************************************************************************************************************************************************
     * 
     * 
     * HOSPITAL DEL NIÑO
     * 
     * 
     ***************************************************************************************************************************************************/

     public function createHospitalNino($id)
    {
        // Consultamos los datos del profesional
        $profesional = Profesional::findOrFail($id);

        // Llenamos el select de ocupaciones
        $ocupaciones = CatOcupacionHospitalNino::orderBy('orden', 'asc')->get();

        // Retornamos la vista con todos los objetos
        return view('ocupacion.hospitalNino-create', compact('profesional','ocupaciones'));
    }

    public function storeHospitalNino(Request $request)
    {
        // Validamos los datos
        $request->validate([
            'id_profesional'=>'required',
            'ocupacion_uno'=>'required',
            'ocupacion_dos'=>'nullable'
        ],[
            'ocupacion_uno.required' => 'Debe elegir al menos una opción; en caso contrario, comuníquese con la Coord. de Mejora Continua.',
        ]);

        // Consultamos los datos para registrar
        $ocupacionUno = CatOcupacionHospitalNino::where('id',$request->ocupacion_uno)->first();

        $ocupacionDos = null;

        if ($request->ocupacion_dos) 
        {
            $ocupacionDos = CatOcupacionHospitalNino::where('id',$request->ocupacion_dos)->first();
        }

        // Activamos el modulo
        $mdl_status = 1;

        // Creamos el objeto
        $ocupacion = new ProfesionalOcupacionHospitalNino();

        // Asignamos los valores
        $ocupacion->id_profesional = $request->id_profesional;

        $ocupacion->id_catalogo_uno = $request->ocupacion_uno;
        $ocupacion->unidad_uno = $ocupacionUno->unidad;
        $ocupacion->area_uno = $ocupacionUno->area;
        $ocupacion->subarea_uno = $ocupacionUno->subarea;
        $ocupacion->ocupacion_uno = $ocupacionUno->ocupacion;

        $ocupacion->id_catalogo_dos = $request?->ocupacion_dos;
        $ocupacion->unidad_dos = $ocupacionDos?->unidad;
        $ocupacion->area_dos = $ocupacionDos?->area;
        $ocupacion->subarea_dos = $ocupacionDos?->subarea;
        $ocupacion->ocupacion_dos = $ocupacionDos?->ocupacion;

        $ocupacion->mdl_status = $mdl_status;

        // Registramos los datos
        $ocupacion->save();

        // Regresamos a la vista con su mensaje
        return redirect()->route('profesionalShow',$request->id_profesional)->with('success', 'Ocupaciones registradas correctamente.');
    }

    public function editHospitalNino($id)
    {
        // Consultamos los datos del profesional
        $profesional = Profesional::findOrFail($id);

        // Llenamos el select de ocupaciones
        $ocupaciones = CatOcupacionHospitalNino::orderBy('orden', 'asc')->get();

        // Consultamos si tiene registros en la tabla
        $profesionalOcupaciones = ProfesionalOcupacionHospitalNino::where('id_profesional',$id)->first();

        // Retornamos la vista con todos los objetos
        return view('ocupacion.hospitalNino-edit', compact('profesional','ocupaciones','profesionalOcupaciones'));
    }

    public function updateHospitalNino(Request $request, $id)
    {
        // Validamos los datos
        $request->validate([
            'ocupacion_uno'=>'required',
            'ocupacion_dos'=>'nullable',
            'eliminar_ocupacion' => 'nullable'
        ],[
            'ocupacion_uno.required' => 'Debe elegir al menos una opción; en caso contrario, comuníquese con la Coord. de Mejora Continua.',
        ]);

        // Consultamos los datos para registrar
        $ocupacionUno = CatOcupacionHospitalNino::where('id',$request->ocupacion_uno)->first();

        $ocupacionDos = null;

        if ($request->ocupacion_dos) 
        {
            $ocupacionDos = CatOcupacionHospitalNino::where('id', $request->ocupacion_dos)->first();
        }

        // Buscamos el registro a editar
        $ocupaciones = ProfesionalOcupacionHospitalNino::findOrFail($id);

        if($request->eliminar_ocupacion == 1)
        {
           $ocupaciones->delete();
            return redirect()->route('profesionalShow',$ocupaciones->id_profesional)->with('destroy', 'Ocupación eliminada correctamente.');
        }
        else
        {
            // Asignamos los valores
            $ocupaciones->update([

                'id_catalogo_uno'=>$request->ocupacion_uno,
                'unidad_uno'=>$ocupacionUno->unidad,
                'area_uno'=>$ocupacionUno->area,
                'subarea_uno'=>$ocupacionUno->subarea,
                'ocupacion_uno'=>$ocupacionUno->ocupacion,

                'id_catalogo_dos' => $request?->ocupacion_dos,
                'unidad_dos' => $ocupacionDos?->unidad,
                'area_dos' => $ocupacionDos?->area,
                'subarea_dos' => $ocupacionDos?->subarea,
                'ocupacion_dos' => $ocupacionDos?->ocupacion,
            ]);

        }

        // Redireccionar con un mensaje de éxito
        return redirect()->route('profesionalShow',$ocupaciones->id_profesional)->with('update', 'Ocupaciones actualizadas correctamente.');

    }

    /** ************************************************************************************************************************************************
     * 
     * 
     * CEAM
     * 
     * 
     ***************************************************************************************************************************************************/

     public function createCeam($id)
    {
        // Consultamos los datos del profesional
        $profesional = Profesional::findOrFail($id);

        // Llenamos el select de ocupaciones
        $ocupaciones = CatOcupacionCeam::orderBy('orden', 'asc')->get();

        // Retornamos la vista con todos los objetos
        return view('ocupacion.ceam-create', compact('profesional','ocupaciones'));
    }

    public function storeCeam(Request $request)
    {
        // Validamos los datos
        $request->validate([
            'id_profesional'=>'required',
            'ocupacion_uno'=>'required',
            'ocupacion_dos'=>'nullable'
        ],[
            'ocupacion_uno.required' => 'Debe elegir al menos una opción; en caso contrario, comuníquese con la Coord. de Mejora Continua.',
        ]);

        // Consultamos los datos para registrar
        $ocupacionUno = CatOcupacionCeam::where('id',$request->ocupacion_uno)->first();
        
        $ocupacionDos = null;

        if ($request->ocupacion_dos) 
        {
            $ocupacionDos = CatOcupacionCeam::where('id',$request->ocupacion_dos)->first();
        }

        // Activamos el modulo
        $mdl_status = 1;

        // Creamos el objeto
        $ocupacion = new ProfesionalOcupacionCeam();

        // Asignamos los valores
        $ocupacion->id_profesional = $request->id_profesional;

        $ocupacion->id_catalogo_uno = $request->ocupacion_uno;
        $ocupacion->unidad_uno = $ocupacionUno->unidad;
        $ocupacion->area_uno = $ocupacionUno->area;
        $ocupacion->subarea_servicio_uno = $ocupacionUno->subarea_servicio;
        $ocupacion->componente_uno = $ocupacionUno->componente;
        $ocupacion->ocupacion_uno = $ocupacionUno->ocupacion;

        $ocupacion->id_catalogo_dos = $request?->ocupacion_dos;
        $ocupacion->unidad_dos = $ocupacionDos?->unidad;
        $ocupacion->area_dos = $ocupacionDos?->area;
        $ocupacion->subarea_servicio_dos = $ocupacionDos?->subarea_servicio;
        $ocupacion->componente_dos = $ocupacionDos?->componente;
        $ocupacion->ocupacion_dos = $ocupacionDos?->ocupacion;

        $ocupacion->mdl_status = $mdl_status;

        // Registramos los datos
        $ocupacion->save();

        // Regresamos a la vista con su mensaje
        return redirect()->route('profesionalShow',$request->id_profesional)->with('success', 'Ocupaciones registradas correctamente.');
    }

    public function editCeam($id)
    {
        // Consultamos los datos del profesional
        $profesional = Profesional::findOrFail($id);

        // Llenamos el select de ocupaciones
        $ocupaciones = CatOcupacionCeam::orderBy('orden', 'asc')->get();

        // Consultamos si tiene registros en la tabla
        $profesionalOcupaciones = ProfesionalOcupacionCeam::where('id_profesional',$id)->first();

        // Retornamos la vista con todos los objetos
        return view('ocupacion.ceam-edit', compact('profesional','ocupaciones','profesionalOcupaciones'));
    }

    public function updateCeam(Request $request, $id)
    {
        // Validamos los datos
        $request->validate([
            'ocupacion_uno'=>'required',
            'ocupacion_dos'=>'nullable',
            'eliminar_ocupacion' => 'nullable'
        ],[
            'ocupacion_uno.required' => 'Debe elegir al menos una opción; en caso contrario, comuníquese con la Coord. de Mejora Continua.',
        ]);

        // Consultamos los datos para registrar
        $ocupacionUno = CatOcupacionCeam::where('id',$request->ocupacion_uno)->first();

        $ocupacionDos = null;

        if ($request->ocupacion_dos) 
        {
            $ocupacionDos = CatOcupacionCeam::where('id', $request->ocupacion_dos)->first();
        }

        // Buscamos el registro a editar
        $ocupaciones = ProfesionalOcupacionCeam::findOrFail($id);

        if($request->eliminar_ocupacion == 1)
        {
           $ocupaciones->delete();
            return redirect()->route('profesionalShow',$ocupaciones->id_profesional)->with('destroy', 'Ocupación eliminada correctamente.');
        }
        else
        {
            // Asignamos los valores
            $ocupaciones->update([

                'id_catalogo_uno'=>$request->ocupacion_uno,
                'unidad_uno'=>$ocupacionUno->unidad,
                'area_uno'=>$ocupacionUno->area,
                'subarea_servicio_uno'=>$ocupacionUno->subarea_servicio,
                'componente_uno'=>$ocupacionUno->componente,
                'ocupacion_uno'=>$ocupacionUno->ocupacion,

                'id_catalogo_dos' => $request?->ocupacion_dos,
                'unidad_dos' => $ocupacionDos?->unidad,
                'area_dos' => $ocupacionDos?->area,
                'subarea_servicio_dos' => $ocupacionDos?->subarea_servicio,
                'componente_dos' => $ocupacionDos?->componente,
                'ocupacion_dos' => $ocupacionDos?->ocupacion,
            ]);

        }

        // Redireccionar con un mensaje de éxito
        return redirect()->route('profesionalShow',$ocupaciones->id_profesional)->with('update', 'Ocupaciones actualizadas correctamente.');

    }

    /** ************************************************************************************************************************************************
     * 
     * 
     * ISSREEI
     * 
     * 
     ***************************************************************************************************************************************************/

     public function createIssreei($id)
    {
        // Consultamos los datos del profesional
        $profesional = Profesional::findOrFail($id);

        // Llenamos el select de ocupaciones
        $ocupaciones = CatOcupacionIssreei::orderBy('orden', 'asc')->get();

        // Retornamos la vista con todos los objetos
        return view('ocupacion.issreei-create', compact('profesional','ocupaciones'));
    }

    public function storeIssreei(Request $request)
    {
        // Validamos los datos
        $request->validate([
            'id_profesional'=>'required',
            'ocupacion_uno'=>'required',
        ],[
            'ocupacion_uno.required' => 'Debe elegir al menos una opción; en caso contrario, comuníquese con la Coord. de Mejora Continua.',
        ]);

        // Consultamos los datos para registrar
        $ocupacionUno = CatOcupacionIssreei::where('id',$request->ocupacion_uno)->first();

        // Activamos el modulo
        $mdl_status = 1;

        // Creamos el objeto
        $ocupacion = new ProfesionalOcupacionIssreei();

        // Asignamos los valores
        $ocupacion->id_profesional = $request->id_profesional;

        $ocupacion->id_catalogo_uno = $request->ocupacion_uno;
        $ocupacion->unidad_uno = $ocupacionUno->unidad;
        $ocupacion->area_uno = $ocupacionUno->area;
        $ocupacion->subarea_uno = $ocupacionUno->subarea;
        $ocupacion->ocupacion_uno = $ocupacionUno->ocupacion;

        $ocupacion->mdl_status = $mdl_status;

        // Registramos los datos
        $ocupacion->save();

        // Regresamos a la vista con su mensaje
        return redirect()->route('profesionalShow',$request->id_profesional)->with('success', 'Ocupaciones registradas correctamente.');
    }

    public function editIssreei($id)
    {
        // Consultamos los datos del profesional
        $profesional = Profesional::findOrFail($id);

        // Llenamos el select de ocupaciones
        $ocupaciones = CatOcupacionIssreei::orderBy('orden', 'asc')->get();

        // Consultamos si tiene registros en la tabla
        $profesionalOcupaciones = ProfesionalOcupacionIssreei::where('id_profesional',$id)->first();

        // Retornamos la vista con todos los objetos
        return view('ocupacion.issreei-edit', compact('profesional','ocupaciones','profesionalOcupaciones'));
    }

    public function updateIssreei(Request $request, $id)
    {
        // Validamos los datos
        $request->validate([
            'ocupacion_uno'=>'required',
            'eliminar_ocupacion' => 'nullable'
        ],[
            'ocupacion_uno.required' => 'Debe elegir al menos una opción; en caso contrario, comuníquese con la Coord. de Mejora Continua.',
        ]);

        // Consultamos los datos para registrar
        $ocupacionUno = CatOcupacionIssreei::where('id',$request->ocupacion_uno)->first();

        // Buscamos el registro a editar
        $ocupaciones = ProfesionalOcupacionIssreei::findOrFail($id);

        if($request->eliminar_ocupacion == 1)
        {
           $ocupaciones->delete();
            return redirect()->route('profesionalShow',$ocupaciones->id_profesional)->with('destroy', 'Ocupación eliminada correctamente.');
        }
        else
        {
            // Asignamos los valores
            $ocupaciones->update([

                'id_catalogo_uno'=>$request->ocupacion_uno,
                'unidad_uno'=>$ocupacionUno->unidad,
                'area_uno'=>$ocupacionUno->area,
                'subarea_uno'=>$ocupacionUno->subarea,
                'ocupacion_uno'=>$ocupacionUno->ocupacion,
            ]);

        }

        // Redireccionar con un mensaje de éxito
        return redirect()->route('profesionalShow',$ocupaciones->id_profesional)->with('update', 'Ocupaciones actualizadas correctamente.');

    }

    /** ************************************************************************************************************************************************
     * 
     * 
     * PASANTES MEDICOS Y ENFERMERIA
     * 
     * 
     ***************************************************************************************************************************************************/

     public function createEnsenanza($id)
    {
        // Consultamos los datos del profesional
        $profesional = Profesional::findOrFail($id);

        // Llenamos el select de ocupaciones
        $ocupaciones = CatOcupacionEnsenanza::all();

        // Retornamos la vista con todos los objetos
        return view('ocupacion.ensenanza-create', compact('profesional','ocupaciones'));
    }

    public function storeEnsenanza(Request $request)
    {
        // Validamos los datos
        $request->validate([
            'id_profesional'=>'required',
            'ocupacion_uno'=>'required',
        ],[
            'ocupacion_uno.required' => 'Debe elegir al menos una opción; en caso contrario, comuníquese con la Coord. de Mejora Continua.',
        ]);

        // Consultamos los datos para registrar
        $ocupacionUno = CatOcupacionEnsenanza::where('id',$request->ocupacion_uno)->first();

        // Activamos el modulo
        $mdl_status = 1;

        // Creamos el objeto
        $ocupacion = new ProfesionalOcupacionEnsenanza();

        // Asignamos los valores
        $ocupacion->id_profesional = $request->id_profesional;

        $ocupacion->id_catalogo = $request->ocupacion_uno;
        $ocupacion->unidad = $ocupacionUno->unidad;
        $ocupacion->area = $ocupacionUno->area;
        $ocupacion->subarea = $ocupacionUno->subarea;
        $ocupacion->ocupacion = $ocupacionUno->ocupacion;

        $ocupacion->mdl_status = $mdl_status;

        // Registramos los datos
        $ocupacion->save();

        // Regresamos a la vista con su mensaje
        return redirect()->route('profesionalShow',$request->id_profesional)->with('success', 'Ocupaciones registradas correctamente.');
    }

    public function editEnsenanza($id)
    {
        // Consultamos los datos del profesional
        $profesional = Profesional::findOrFail($id);

        // Llenamos el select de ocupaciones
        $ocupaciones = CatOcupacionEnsenanza::all();

        // Consultamos si tiene registros en la tabla
        $profesionalOcupaciones = ProfesionalOcupacionEnsenanza::where('id_profesional',$id)->first();

        // Retornamos la vista con todos los objetos
        return view('ocupacion.ensenanza-edit', compact('profesional','ocupaciones','profesionalOcupaciones'));
    }

    public function updateEnsenanza(Request $request, $id)
    {
        // Validamos los datos
        $request->validate([
            'ocupacion_uno'=>'required',
            'eliminar_ocupacion' => 'nullable'
        ],[
            'ocupacion_uno.required' => 'Debe elegir al menos una opción; en caso contrario, comuníquese con la Coord. de Mejora Continua.',
        ]);

        // Consultamos los datos para registrar
        $ocupacionUno = CatOcupacionEnsenanza::where('id',$request->ocupacion_uno)->first();

        // Buscamos el registro a editar
        $ocupaciones = ProfesionalOcupacionEnsenanza::findOrFail($id);

        if($request->eliminar_ocupacion == 1)
        {
           $ocupaciones->delete();
            return redirect()->route('profesionalShow',$ocupaciones->id_profesional)->with('destroy', 'Ocupación eliminada correctamente.');
        }
        else
        {
            // Asignamos los valores
            $ocupaciones->update([

                'id_catalogo'=>$request->ocupacion_uno,
                'unidad'=>$ocupacionUno->unidad,
                'area'=>$ocupacionUno->area,
                'subarea'=>$ocupacionUno->subarea,
                'ocupacion'=>$ocupacionUno->ocupacion,
            ]);

        }

        // Redireccionar con un mensaje de éxito
        return redirect()->route('profesionalShow',$ocupaciones->id_profesional)->with('update', 'Ocupaciones actualizadas correctamente.');

    }

    /** ************************************************************************************************************************************************
     * 
     * 
     * CECOSAMA
     * 
     * 
     ***************************************************************************************************************************************************/

     public function createCecosama($id)
    {
        // Consultamos los datos del profesional
        $profesional = Profesional::findOrFail($id);

        // Llenamos el select de ocupaciones
        $ocupaciones = CatOcupacionCecosama::all();

        // Retornamos la vista con todos los objetos
        return view('ocupacion.cecosama-create', compact('profesional','ocupaciones'));
    }

    public function storeCecosama(Request $request)
    {
        // Validamos los datos
        $request->validate([
            'id_profesional'=>'required',
            'ocupacion_uno'=>'required',
        ],[
            'ocupacion_uno.required' => 'Debe elegir al menos una opción; en caso contrario, comuníquese con la Coord. de Mejora Continua.',
        ]);

        // Consultamos los datos para registrar
        $ocupacionUno = CatOcupacionCecosama::where('id',$request->ocupacion_uno)->first();

        // Activamos el modulo
        $mdl_status = 1;

        // Creamos el objeto
        $ocupacion = new ProfesionalOcupacionCecosama();

        // Asignamos los valores
        $ocupacion->id_profesional = $request->id_profesional;

        $ocupacion->id_catalogo = $request->ocupacion_uno;
        $ocupacion->unidad = $ocupacionUno->unidad;
        $ocupacion->area = $ocupacionUno->area;
        $ocupacion->subarea = $ocupacionUno->subarea;
        $ocupacion->ocupacion = $ocupacionUno->ocupacion;

        $ocupacion->mdl_status = $mdl_status;

        // Registramos los datos
        $ocupacion->save();

        // Regresamos a la vista con su mensaje
        return redirect()->route('profesionalShow',$request->id_profesional)->with('success', 'Ocupaciones registradas correctamente.');
    }

    public function editCecosama($id)
    {
        // Consultamos los datos del profesional
        $profesional = Profesional::findOrFail($id);

        // Llenamos el select de ocupaciones
        $ocupaciones = CatOcupacionCecosama::all();

        // Consultamos si tiene registros en la tabla
        $profesionalOcupaciones = ProfesionalOcupacionCecosama::where('id_profesional',$id)->first();

        // Retornamos la vista con todos los objetos
        return view('ocupacion.cecosama-edit', compact('profesional','ocupaciones','profesionalOcupaciones'));
    }

    public function updateCecosama(Request $request, $id)
    {
        // Validamos los datos
        $request->validate([
            'ocupacion'=>'required',
            'eliminar_ocupacion' => 'nullable'
        ],[
            'ocupacion.required' => 'Debe elegir al menos una opción; en caso contrario, comuníquese con la Coord. de Mejora Continua.',
        ]);

        // Consultamos los datos para registrar
        $ocupacionUno = CatOcupacionCecosama::where('id',$request->ocupacion)->first();

        // Buscamos el registro a editar
        $ocupaciones = ProfesionalOcupacionCecosama::findOrFail($id);

        if($request->eliminar_ocupacion == 1)
        {
           $ocupaciones->delete();
            return redirect()->route('profesionalShow',$ocupaciones->id_profesional)->with('destroy', 'Ocupación eliminada correctamente.');
        }
        else
        {
            // Asignamos los valores
            $ocupaciones->update([

                'id_catalogo'=>$request->ocupacion,
                'unidad'=>$ocupacionUno->unidad,
                'area'=>$ocupacionUno->area,
                'subarea'=>$ocupacionUno->subarea,
                'ocupacion'=>$ocupacionUno->ocupacion,
                
            ]);

        }

        // Redireccionar con un mensaje de éxito
        return redirect()->route('profesionalShow',$ocupaciones->id_profesional)->with('update', 'Ocupaciones actualizadas correctamente.');

    }
}