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
            //'fecha_final'      => 'nullable|required_if:vigencia,BAJA TEMPORAL|date_format:Y-m-d|after:fecha_inicio',
            'fecha_final'      => 'nullable|required_if:vigencia_motivo,BECA,INCAPACIDAD MEDICA,LIC. MEDICA,LIC. SIN GOCE DE SUELDO,LIC. SIN GOCE DE SUELDO PARA CURSAR RESIDENCIA MEDICA EN INSTITUCIONES FUERA DE LA SECRETARIA DE SALUD,LIC. SIN GOCE DE SUELDO PARA CURSAR RESIDENCIA MEDICA EN LA SECRETARIA DE SALUD,LIC. SIN GOCE DE SUELDO PARA DESEMPENO DE UN CARGO DE ELECCION POPULAR,LIC. SIN GOCE DE SUELDO PARA EL DISFRUTE DE UNA BECA DENTRO O FUERA DEL PAIS,LIC. SIN GOCE DE SUELDO PARA OCUPAR PUESTO DE CONFIAZAN EN LA SECRETARIA DE SALUD,LIC. SIN GOCE DE SUELDO POR ASUNTOS PARTICULARES,LIC. SIN GOCE DE SUELDO POR COM. EXT. PARA OCUPAR PUESTO DE CONF. FUERA DE LA SS Y DENTRO DEL SECTOR PUBLICO FEDERAL|date_format:Y-m-d|after:fecha_inicio',
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

        // Consulta la ultima vigencia
        $ultimaVigencia = ProfesionalVigencia::where('id_profesional', $request->id_profesional)
                    ->latest()
                    ->first();

        // La fecha de ingreso debe ser mayor a la fecha de ingreso de la ultima nomina
        if($ultimaVigencia?->fecha_inicio > $request->fecha_inicio)
        {
            return redirect()->back()
                            ->with('error', 'La fecha de ingreso debe ser mayor a la fecha de ingreso del último cambio de vigencia')
                            ->withInput();
        }     

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
        return redirect()->route('profesionalShow', $request->id_profesional)->with('success', 'Vigencia actualizada correctamente.');
    }

    public function editVigencia($id)
    {
        // Buscamos el registro
        $profesionalVigencia = ProfesionalVigencia::findOrFail($id);

        // Buscamos al profesional
        $profesional = Profesional::where('id',$profesionalVigencia->id_profesional)->first();

        // Llenamos los select
        $vigencias = Vigencia::all();

        // Regresamos la vista con el objeto
        return view('vigencia.edit', compact('id','profesionalVigencia','profesional','vigencias'));

    }

    public function updateVigencia(Request $request, $id)
    {
        // Validamos los datos
        $request->validate([
            'vigencia'=>'required',
            'vigencia_motivo'=>'required',
            'fecha_inicio'=>'required',
            'fecha_termino'=>'nullable',
        ],[

        ]);

        // Buscamos el registro a editar
        $profesionalVigencia = ProfesionalVigencia::findOrFail($id);

        // Asignamos los valores
        $profesionalVigencia->vigencia = $request->vigencia;
        $profesionalVigencia->vigencia_motivo = $request->vigencia_motivo;
        $profesionalVigencia->fecha_inicio = $request->fecha_inicio;
        $profesionalVigencia->fecha_final = $request->fecha_termino;

        $profesionalVigencia->save();

        // Retornar o redirigir a donde lo necesites, por ejemplo:
        return redirect()->route('profesionalShow', $profesionalVigencia->id_profesional)->with('success', 'Vigencia actualizada correctamente.');
    }
}
