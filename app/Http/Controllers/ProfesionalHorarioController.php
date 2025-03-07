<?php

namespace App\Http\Controllers;

use App\Models\Jornada;
use App\Models\Profesional;
use App\Models\ProfesionalHorario;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProfesionalHorarioController extends Controller
{
    //
    public function createHorario($id)
    {
        //Consultamos los datos del profesional
        $profesional = Profesional::findOrFail($id);
        
        // Llenamos el select de Jornadas
        $jornadas = Jornada::orderBy('orden', 'asc')->get();

        // Retornamos la vista con el arreglo
        return view('horario.create', compact('profesional','jornadas'));
    }

    public function storeHorario(Request $request)
    {
        
        //Validamos los datos
        $validated = $request->validate([
            'id_profesional' => 'required',
            'jornada' => 'required',
            'entrada_lunes' => 'nullable|date_format:H:i',
            'salida_lunes' => 'nullable|date_format:H:i',
            'entrada_martes' => 'nullable|date_format:H:i',
            'salida_martes' => 'nullable|date_format:H:i',
            'entrada_miercoles' => 'nullable|date_format:H:i',
            'salida_miercoles' => 'nullable|date_format:H:i',
            'entrada_jueves' => 'nullable|date_format:H:i',
            'salida_jueves' => 'nullable|date_format:H:i',
            'entrada_viernes' => 'nullable|date_format:H:i',
            'salida_viernes' => 'nullable|date_format:H:i',
            'entrada_sabado' => 'nullable|date_format:H:i',
            'salida_sabado' => 'nullable|date_format:H:i',
            'entrada_domingo' => 'nullable|date_format:H:i',
            'salida_domingo' => 'nullable|date_format:H:i',
            'entrada_festivo' => 'nullable|date_format:H:i',
            'salida_festivo' => 'nullable|date_format:H:i',
        ],[
            'id_profesional.required' => 'El campo "Profesional" es obligatorio.',
            'jornada.required' => 'El campo "Jornada" es obligatorio.',
            'entrada_lunes.date_format' => 'La hora de entrada del lunes debe estar en formato 24 horas (HH:MM).',
            'salida_lunes.date_format' => 'La hora de salida del lunes debe estar en formato 24 horas (HH:MM).',
            'entrada_martes.date_format' => 'La hora de entrada del martes debe estar en formato 24 horas (HH:MM).',
            'salida_martes.date_format' => 'La hora de salida del martes debe estar en formato 24 horas (HH:MM).',
            'entrada_miercoles.date_format' => 'La hora de entrada del miércoles debe estar en formato 24 horas (HH:MM).',
            'salida_miercoles.date_format' => 'La hora de salida del miércoles debe estar en formato 24 horas (HH:MM).',
            'entrada_jueves.date_format' => 'La hora de entrada del jueves debe estar en formato 24 horas (HH:MM).',
            'salida_jueves.date_format' => 'La hora de salida del jueves debe estar en formato 24 horas (HH:MM).',
            'entrada_viernes.date_format' => 'La hora de entrada del viernes debe estar en formato 24 horas (HH:MM).',
            'salida_viernes.date_format' => 'La hora de salida del viernes debe estar en formato 24 horas (HH:MM).',
            'entrada_sabado.date_format' => 'La hora de entrada del sábado debe estar en formato 24 horas (HH:MM).',
            'salida_sabado.date_format' => 'La hora de salida del sábado debe estar en formato 24 horas (HH:MM).',
            'entrada_domingo.date_format' => 'La hora de entrada del domingo debe estar en formato 24 horas (HH:MM).',
            'salida_domingo.date_format' => 'La hora de salida del domingo debe estar en formato 24 horas (HH:MM).',
            'entrada_festivo.date_format' => 'La hora de entrada del festivo debe estar en formato 24 horas (HH:MM).',
            'salida_festivo.date_format' => 'La hora de salida del festivo debe estar en formato 24 horas (HH:MM).',
        ]);

        $horario_status = 1;

        $horario = new ProfesionalHorario();

        $horario->id_profesional = $request->id_profesional;
        $horario->jornada = $request->jornada;
        $horario->entrada_lunes = $request->entrada_lunes;
        $horario->salida_lunes = $request->salida_lunes;
        $horario->entrada_martes = $request->entrada_martes;
        $horario->salida_martes = $request->salida_martes;
        $horario->entrada_miercoles = $request->entrada_miercoles;
        $horario->salida_miercoles = $request->salida_miercoles;
        $horario->entrada_jueves = $request->entrada_jueves;
        $horario->salida_jueves = $request->salida_jueves;
        $horario->entrada_viernes = $request->entrada_viernes;
        $horario->salida_viernes = $request->salida_viernes;
        $horario->entrada_sabado = $request->entrada_sabado;
        $horario->salida_sabado = $request->salida_sabado;
        $horario->entrada_domingo = $request->entrada_domingo;
        $horario->salida_domingo = $request->salida_domingo;
        $horario->entrada_festivo = $request->entrada_festivo;
        $horario->salida_festivo = $request->salida_festivo;
        $horario->mdl_horario = $horario_status;

        $horario -> save();

        return redirect()->route('profesionalIndex')->with('successHorario', 'Registro realizado correctamente.');

    }

    public function editHorario($id)
    {        
        // Consultamos el registro con el ID
        $horario = ProfesionalHorario::where('id_profesional',$id)->first();

        // Consultamos los datos del profesional
        $profesional = Profesional::findOrFail($id);

        // Llenamos el select de Jornadas
        $jornadas = Jornada::orderBy('orden', 'asc')->get();

        return view('horario.edit', compact('horario','profesional','jornadas'));
    }

    public function updateHorario(Request $request, $id)
    {     

        //Validamos los datos
        $validated = $request->validate([
            'id_profesional' => 'required',
            'jornada' => 'required',
            'entrada_lunes' => 'nullable|date_format:H:i',
            'salida_lunes' => 'nullable|date_format:H:i',
            'entrada_martes' => 'nullable|date_format:H:i',
            'salida_martes' => 'nullable|date_format:H:i',
            'entrada_miercoles' => 'nullable|date_format:H:i',
            'salida_miercoles' => 'nullable|date_format:H:i',
            'entrada_jueves' => 'nullable|date_format:H:i',
            'salida_jueves' => 'nullable|date_format:H:i',
            'entrada_viernes' => 'nullable|date_format:H:i',
            'salida_viernes' => 'nullable|date_format:H:i',
            'entrada_sabado' => 'nullable|date_format:H:i',
            'salida_sabado' => 'nullable|date_format:H:i',
            'entrada_domingo' => 'nullable|date_format:H:i',
            'salida_domingo' => 'nullable|date_format:H:i',
            'entrada_festivo' => 'nullable|date_format:H:i',
            'salida_festivo' => 'nullable|date_format:H:i',
        ],[
            'id_profesional.required' => 'El campo "Profesional" es obligatorio.',
            'jornada.required' => 'El campo "Jornada" es obligatorio.',
            'entrada_lunes.date_format' => 'La hora de entrada del lunes debe estar en formato 24 horas (HH:MM).',
            'salida_lunes.date_format' => 'La hora de salida del lunes debe estar en formato 24 horas (HH:MM).',
            'entrada_martes.date_format' => 'La hora de entrada del martes debe estar en formato 24 horas (HH:MM).',
            'salida_martes.date_format' => 'La hora de salida del martes debe estar en formato 24 horas (HH:MM).',
            'entrada_miercoles.date_format' => 'La hora de entrada del miércoles debe estar en formato 24 horas (HH:MM).',
            'salida_miercoles.date_format' => 'La hora de salida del miércoles debe estar en formato 24 horas (HH:MM).',
            'entrada_jueves.date_format' => 'La hora de entrada del jueves debe estar en formato 24 horas (HH:MM).',
            'salida_jueves.date_format' => 'La hora de salida del jueves debe estar en formato 24 horas (HH:MM).',
            'entrada_viernes.date_format' => 'La hora de entrada del viernes debe estar en formato 24 horas (HH:MM).',
            'salida_viernes.date_format' => 'La hora de salida del viernes debe estar en formato 24 horas (HH:MM).',
            'entrada_sabado.date_format' => 'La hora de entrada del sábado debe estar en formato 24 horas (HH:MM).',
            'salida_sabado.date_format' => 'La hora de salida del sábado debe estar en formato 24 horas (HH:MM).',
            'entrada_domingo.date_format' => 'La hora de entrada del domingo debe estar en formato 24 horas (HH:MM).',
            'salida_domingo.date_format' => 'La hora de salida del domingo debe estar en formato 24 horas (HH:MM).',
            'entrada_festivo.date_format' => 'La hora de entrada del festivo debe estar en formato 24 horas (HH:MM).',
            'salida_festivo.date_format' => 'La hora de salida del festivo debe estar en formato 24 horas (HH:MM).',
        ]);

        //dd($request->entrada_miercoles);

        // Buscamos el registro a editar
        $horario = ProfesionalHorario::findOrFail($id);

        // Asignamos los valores
        $horario->update([
            'jornada'=> $request->jornada,
            'entrada_lunes' => $request->entrada_lunes,
            'salida_lunes' => $request->salida_lunes,
            'entrada_martes' => $request->entrada_martes,
            'salida_martes' => $request->salida_martes, 
            'entrada_miercoles' => $request->entrada_miercoles,
            'salida_miercoles' => $request->salida_miercoles,
            'entrada_jueves' => $request->entrada_jueves,
            'salida_jueves' => $request->salida_jueves,
            'entrada_viernes' => $request->entrada_viernes,
            'salida_viernes' => $request->salida_viernes,
            'entrada_sabado' => $request->entrada_sabado,
            'salida_sabado' => $request->salida_sabado,
            'entrada_domingo' => $request->entrada_domingo,
            'salida_domingo' => $request->salida_domingo,
            'entrada_festivo' => $request->entrada_festivo,
            'salida_festivo' => $request->salida_festivo,
        ]);

        // Redireccionar con un mensaje de éxito
        return redirect()->route('profesionalIndex')->with('successUpdateHorario', 'Registro actualizado correctamente.');
    }
}
