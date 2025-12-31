<?php

namespace App\Http\Controllers;

use App\Models\Clue;
use App\Models\Profesional;
use App\Models\ProfesionalBitacora;
use App\Models\ProfesionalOcupacionAlmacen;
use App\Models\ProfesionalOcupacionCeam;
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
use App\Models\ProfesionalPuesto;
use App\Models\ProfesionalVigencia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfesionalRecontratacionController extends Controller
{
    //
    public function findRecontratacionProfesional()
    {
        // Mostramos el formulario de busqueda por CURP
        return view('recontratacion.buscar-profesional');
    }

    public function showRecontratacionProfesional(Request $request)
    {
        // Convertimos la CURP a mayusuclas
        $request->merge([
            'curp' => strtoupper($request->curp),
        ]);
        
        //Validamos el registro
        $request->validate([
            //'curp' => 'required|regex:/^[A-Z]{4}[0-9]{6}[A-Z]{6}[0-9]{2}$/',
            'curp' => 'required|regex:/^[A-Z]{4}[0-9]{6}[HM][A-Z]{5}[A-Z0-9][0-9]$/',
        ], [
            'curp.required' => 'El campo CURP es obligatorio.',
            'curp.regex' => 'El formato del CURP no es válido. Asegúrate de que esté correctamente escrito (18 caracteres: letras y números en mayúsculas).',
        ]);
        
        // Buscamos el registro con la CURP
        $profesional = Profesional::where('curp', $request->curp)->first();

        // Si no se encontró el profesional, regresamos con un mensaje de error
        if (!$profesional) {
            return redirect()->back()
                            ->with('error', 'No se encontró ningún profesional con esa CURP.')
                            ->withInput();
        }

        // Obtenemos el puesto
        $puesto = $profesional->puesto;

        // Verificamos clues_nomina
        if ($puesto->vigencia == 'ACTIVO' || $puesto->vigencia == 'BAJA TEMPORAL') {
            return redirect()->back()
                            ->with('error', 'El registro se encuentra Activo o en Baja Temporal, no se puede realizar la recontratación')
                            ->withInput();
        }

        $credencializacion = $profesional->credencializacion;
        $fotografia = $credencializacion ? $credencializacion->fotografia : null;

        // Generamos la URL de la fotografía desde storage
        $fotoUrl = $fotografia 
            ? asset('storage/credencializacion/thumbs/' . $fotografia) 
            : null;

        // Regresamos la vista con el objeto
        return view('recontratacion.mostrar-profesional', compact('profesional', 'fotoUrl'));
    }

    public function createRecontratacion($id)
    {
        // Cargamos el profesional
        $profesional = Profesional::findOrFail($id);

        $credencializacion = $profesional->credencializacion;
        $fotografia = $credencializacion ? $credencializacion->fotografia : null;

        // Generamos la URL de la fotografía desde storage
        $fotoUrl = $fotografia 
            ? asset('storage/credencializacion/thumbs/' . $fotografia) 
            : null;
        
        // Cargamos al usuario que inicio
        $user = Auth::user();
        
        // Clues para administrador - muestra todas las clues
        if($user->role == 'admin')
        {   
            // Cargamos los clues
            $clues = Clue::all();
        }
        // Para oficina jurisdiccional muestra solo las clues de su jurisdiccion
        elseif($user->role == 'ofJurisdiccional')
        {
            // Cargamos los clues
            $clues = Clue::where('clave_jurisdiccion',$user->jurisdiccion_unidad)->get();
        }
        elseif($user->role == 'criCree')
        {
            // Cargamos los clues
            $clues = Clue::whereIn('clues', ['CLSSA009989','CLSSA009988','CLSSA009987','CLSSA009986','CLSSA009985'])
                        ->get();
        }
        elseif($user->role == 'samuCrum')
        {
            // Cargamos los clues
            $clues = Clue::whereIn('clues', ['CLSSA009997','CLSSA009996','CLSSA009995','CLSSA009994','CLSSA009993','CLSSA009992','CLSSA009991','CLSSA009990','CLSSA002093-SC'])
                        ->get();
        }
        elseif($user->role == 'ofCentral')
        {
            // Cargamos los clues
            $clues = Clue::whereIn('clues', ['CLSSA002093','CLSSA002093-SC'])
                        ->get();
        }
        // Para los otros muestra solo la clues que le pertenece al usuario
        else
        {
            // Cargamos los clues
            $clues = Clue::where('id',$user->id_unidad)->get();
        }

        return view('recontratacion.create-profesional', compact('profesional', 'clues', 'fotoUrl'));
    }

    public function storeRecontratacion(Request $request)
    {
        $request->validate([
            'id_profesional' => 'required',
            'clues' => 'required',
            'fecha_inicio' => 'required|date',
        ],[
            'id_profesional.required' => 'El profesional es obligatorio.',
            'id_profesional.exists'   => 'El profesional seleccionado no existe.',

            'clues.required' => 'La unidad (CLUES) es obligatoria.',
            'clues.exists' => 'La CLUES seleccionada no es válida.',

            'fecha_inicio.required' => 'La fecha de inicio es obligatoria.',
            'fecha_inicio.date' => 'La fecha de inicio no tiene un formato válido.',
        ]);

        // Consultamos los datos de la clues
        $clues = Clue::findOrFail($request->clues);

        // Actualizamos el registro de PUESTO

        $puesto = ProfesionalPuesto::where('id_profesional',$request->id_profesional)->first();
        
        $puesto->vigencia = "ACTIVO";
        $puesto->vigencia_motivo = "ACTIVO";
        $puesto->clues_adscripcion = $clues->clues;
        $puesto->clues_adscripcion_nombre = $clues->nombre;
        $puesto->clues_adscripcion_municipio = $clues->municipio;
        $puesto->clues_adscripcion_jurisdiccion = $clues->clave_jurisdiccion;
        $puesto->clues_adscripcion_tipo = $clues->clave_establecimiento;
        $puesto->fecha_ingreso = $request->fecha_inicio;

        $puesto->save();

        // Eliminamos todos los registros del CATALOGO DE OCUPACION

        // Catalogo 1 - CENTROS DE SALUD URBANOS Y RURALES
        $buscarOcupacionCentroSalud = ProfesionalOcupacionCentroSalud::where('id_profesional',$request->id_profesional)->first()?->delete();

        // Catalogo 2 - HOSPITALES
        $buscarOcupacionHospital = ProfesionalOcupacionHospital::where('id_profesional',$request->id_profesional)->first()?->delete();

        // Catalogo 3 - OFICINAS JURISDICCIONALES
        $buscarOcupacionOficinaCentral = ProfesionalOcupacionOfJurisdiccional::where('id_profesional',$request->id_profesional)->first()?->delete();

        // Catalogo 4 - CRI CREE
        $buscarOcupacionCriCree = ProfesionalOcupacionCriCree::where('id_profesional',$request->id_profesional)->first()?->delete();

        // Catalogo 5 - SAMU CRUM
        $buscarOcupacionSamuCrum = ProfesionalOcupacionSamuCrum::where('id_profesional',$request->id_profesional)->first()?->delete();

        // Catalogo 6 - OFICINA CENTRAL
        $buscarOcupacionOficinaCentral = ProfesionalOcupacionOficinaCentral::where('id_profesional',$request->id_profesional)->first()?->delete();

        // Catalogo 7 - ALMACEN
        $buscarOcupacionAlmacen = ProfesionalOcupacionAlmacen::where('id_profesional',$request->id_profesional)->first()?->delete();

        // Catalogo 8 - LESP CETS
        $buscarOcupacionCetsLesp = ProfesionalOcupacionCetsLesp::where('id_profesional',$request->id_profesional)->first()?->delete();

        // Catalogo 9 - CORS
        $buscarOcupacionCors = ProfesionalOcupacionCors::where('id_profesional',$request->id_profesional)->first()?->delete();

        // Catalogo 10 - ISSREEI
        $buscarOcupacionIssreei = ProfesionalOcupacionIssreei::where('id_profesional',$request->id_profesional)->first()?->delete();

        // Catalogo 11 - CESAME
        $buscarOcupacionCesame = ProfesionalOcupacionCesame::where('id_profesional',$request->id_profesional)->first()?->delete();

        // Catalogo 12 - PSI PARRAS
        $buscarOcupacionPsiParras = ProfesionalOcupacionPsiParras::where('id_profesional',$request->id_profesional)->first()?->delete();

        // Catalogo 13 - CEAM
        $buscarOcupacionCeam = ProfesionalOcupacionCeam::where('id_profesional',$request->id_profesional)->first()?->delete();

        // Catalogo 14 - HOSPITAL DEL NIÑO
        $buscarOcupacionHospitalNino = ProfesionalOcupacionHospitalNino::where('id_profesional',$request->id_profesional)->first()?->delete();

        // Catalogo 15 - PERSONAL EN FORMACION

        $buscarOcupacionPersonalEnFormacion = ProfesionalOcupacionEnsenanza::where('id_profesional',$request->id_profesional)->first()?->delete();

        // Actualizamos la bitacora de VIGENCIAS
        $vigencia = new ProfesionalVigencia();

        $vigencia->id_profesional = $request->id_profesional;
        $vigencia->vigencia = "ACTIVO";
        $vigencia->vigencia_motivo = "ACTIVO";
        $vigencia->fecha_inicio = $request->fecha_inicio;

        $vigencia->save();

        // Actualizamos la bitacora de MOVIMIENTOS

        $usuario = Auth::user();

        $bitacora = new ProfesionalBitacora();

        $bitacora->id_capturista = $usuario->id;
        $bitacora->capturista_label = $usuario->responsable;
        $bitacora->accion = "RECONTRATACION DE PROFESIONAL";
        $bitacora->id_profesional = $request->id_profesional;

        $bitacora->save();

        // Redireccionamos al perfil del usuario
        return redirect()->route('profesionalShow',$request->id_profesional)->with('success', 'Trabajador recontratado correctamente');
    }
}
