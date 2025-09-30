<?php

namespace App\Http\Controllers;

use App\Models\Profesional;
use App\Models\ProfesionalBitacora;
use App\Models\ProfesionalPuesto;
use App\Models\ProfesionalVigencia;
use App\Models\Vigencia;
use App\Models\VigenciaMotivo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfesionalVigenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createVigencia($id)
    {
        // Consultar los datos del profesional
        $profesional = Profesional::findOrFail($id);

        // Llenamos el select de Vigencia
        $vigencias = Vigencia::all();

        // Llenamos el select de vigencias motivos
        $vigenciasMotivos = VigenciaMotivo::orderBy('id_vigencia','asc')->get();

        // Cargamos el historico de las vigencias del profesional
        $profesionalVigencias = ProfesionalVigencia::where('id_profesional',$id)
                                ->orderBy('created_at', 'desc')
                                ->get();

        // Regresamos al form con el objeto
        return view('vigencia.create', compact(
            'profesional',
            'id',
            'vigencias',
            'vigenciasMotivos',
            'profesionalVigencias',
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeVigencia(Request $request)
    {        
       $request->validate([
            'id_profesional'   => 'required',
            'vigencia'         => 'required',
            'vigencia_motivo'  => 'required',
            'fecha_inicio'     => 'required|date_format:Y-m-d',
            'fecha_final'      => 'nullable|required_if:vigencia,BAJA TEMPORAL|date_format:Y-m-d|after:fecha_inicio',
        ],[
            'id_profesional.required'   => 'El campo profesional es obligatorio.',
            'vigencia.required'         => 'La vigencia es obligatoria.',
            'vigencia_motivo.required'  => 'El motivo de la vigencia es obligatorio.',
            'fecha_inicio.required'     => 'La fecha de inicio es obligatoria.',
            'fecha_inicio.date'         => 'La fecha de inicio debe ser una fecha válida.',
            'fecha_final.required_if'   => 'La fecha de término es obligatoria cuando la vigencia es BAJA TEMPORAL.',
            'fecha_final.date'          => 'La fecha final debe ser una fecha válida.',
            'fecha_final.after'         => 'La fecha final debe ser posterior a la fecha de inicio.',
            'fecha_inicio.date_format'  => 'La fecha de inicio debe tener el formato DD-MM-AAAA.',
            'fecha_final.date_format'   => 'La fecha de termino debe tener el formato DD-MM-AAAA.',
        ]);

        $vigencia = new ProfesionalVigencia();

        $vigencia->id_profesional = $request->id_profesional;
        $vigencia->vigencia = $request->vigencia;
        $vigencia->vigencia_motivo = $request->vigencia_motivo;
        $vigencia->fecha_inicio = $request->fecha_inicio;
        $vigencia->fecha_final = $request->fecha_final;

        $vigencia->save();

        $usuario = Auth::user();

        // Guaradmos la bitacora
        $bitacora = new ProfesionalBitacora();

        $bitacora->id_capturista = $usuario->id;
        $bitacora->capturista_label = $usuario->responsable;
        $bitacora->accion = "ACTUALIZACION DEL MODULO DE VIGENCIAS";
        $bitacora->id_profesional = $vigencia->id_profesional;

        $bitacora->save();

        // Cambiamos el status

        $profesional = Profesional::findOrFail($request->id_profesional);

        $profesional->puesto->vigencia = $request->vigencia;
        $profesional->puesto->vigencia_motivo = $request->vigencia_motivo;

        $profesional->puesto->save();

        // Retornar o redirigir a donde lo necesites, por ejemplo:
        return redirect()->route('profesionalShow', $request->id_profesional)->with('successVigencia', 'Registro realizado correctamente.');
    }
}
