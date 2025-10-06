<?php

namespace App\Http\Controllers;

use App\Models\Jornada;
use App\Models\Profesional;
use App\Models\ProfesionalHorario;
use Carbon\Carbon;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfesionalHorarioController extends Controller
{
    //
    public function createHorario($id)
    {
        //Consultamos los datos del profesional
        $profesional = Profesional::findOrFail($id);
        
        // Llenamos el select de Jornadas
        //$jornadas = Jornada::orderBy('orden', 'asc')->get();

        $usuario = Auth::user();

        if($usuario->role == 'ofJurisdiccional')
        {
            $jornadas = Jornada::whereIn('jornada', [
                            'Jornada Diurna (Matutina L-V)',
                            'Jornada Mixta (Vespertino L-V)'
                        ])->get();
        }
        else
        {
            $jornadas = Jornada::orderBy('orden', 'asc')->get();
        }

        // Retornamos la vista con el arreglo
        return view('horario.create', compact('profesional','jornadas'));
    }

    public function storeHorario(Request $request)
    {
        $request->validate([
            'jornada' => 'required',
            'id_profesional' => 'required',
            'horario_entrada' => 'required',
            'horario_salida' => 'required',
        ],[
            'jornada.required' => 'El campo es obligatorio',
            'horario_entrada.required' => 'El campo es obligatorio',
            'horario_salida.required' => 'El campo es obligatorio',
        ]);

        /**********************************************************************************
         * 
         * 
         * ARREGLO PARA ASIGNAR LOS VALORES A CADA DIA
         * 
         * 
         ***********************************************************************************/

        // 1 -> JORNADA DIURNA MATUTINA L - V

        if($request->jornada == 1)
        {
            $entrada_lunes = $request->horario_entrada;
            $salida_lunes = $request->horario_salida;
            $entrada_martes = $request->horario_entrada;
            $salida_martes = $request->horario_salida;
            $entrada_miercoles = $request->horario_entrada;
            $salida_miercoles = $request->horario_salida;
            $entrada_jueves = $request->horario_entrada;
            $salida_jueves = $request->horario_salida;
            $entrada_viernes = $request->horario_entrada;
            $salida_viernes = $request->horario_salida;
            $entrada_sabado = NULL;
            $salida_sabado = NULL;
            $entrada_domingo = NULL;
            $salida_domingo = NULL;
            $entrada_festivo = NULL;
            $salida_festivo =NULL;

            $label_jornada = "Jornada Diurna (Matutina L-V)";
        }

        // 2 -> JORNADA MIXTA VESPERTINO L - V

        elseif($request->jornada == 2)
        {
            $entrada_lunes = $request->horario_entrada;
            $salida_lunes = $request->horario_salida;
            $entrada_martes = $request->horario_entrada;
            $salida_martes = $request->horario_salida;
            $entrada_miercoles = $request->horario_entrada;
            $salida_miercoles = $request->horario_salida;
            $entrada_jueves = $request->horario_entrada;
            $salida_jueves = $request->horario_salida;
            $entrada_viernes = $request->horario_entrada;
            $salida_viernes = $request->horario_salida;
            $entrada_sabado = NULL;
            $salida_sabado = NULL;
            $entrada_domingo = NULL;
            $salida_domingo = NULL;
            $entrada_festivo = NULL;
            $salida_festivo =NULL;

            $label_jornada = "Jornada Mixta (Vespertino L-V)";
        }

        // 3 -> JORNADA ESPECIAL NOCTURNO A L - M - V

        elseif($request->jornada == 3)
        {
            $entrada_lunes = $request->horario_entrada;
            $salida_lunes = $request->horario_salida;
            $entrada_martes = NULL;
            $salida_martes = NULL;
            $entrada_miercoles = $request->horario_entrada;
            $salida_miercoles = $request->horario_salida;
            $entrada_jueves = NULL;
            $salida_jueves = NULL;
            $entrada_viernes = $request->horario_entrada;
            $salida_viernes = $request->horario_salida;
            $entrada_sabado = NULL;
            $salida_sabado = NULL;
            $entrada_domingo = NULL;
            $salida_domingo = NULL;
            $entrada_festivo = NULL;
            $salida_festivo =NULL;

            $label_jornada = "Jornada Especial (Nocturno A LUN-MIE-VIE)";
        }

        // 4 -> JORNADA ESPECIAL NOCTURNO B M - J - S

        elseif($request->jornada == 6)
        {
            $entrada_lunes = NULL;
            $salida_lunes = NULL;
            $entrada_martes = $request->horario_entrada;
            $salida_martes = $request->horario_salida;
            $entrada_miercoles = NULL;
            $salida_miercoles = NULL;
            $entrada_jueves = $request->horario_entrada;
            $salida_jueves = $request->horario_salida;
            $entrada_viernes = NULL;
            $salida_viernes = NULL;
            $entrada_sabado = $request->horario_entrada;
            $salida_sabado = $request->horario_salida;
            $entrada_domingo = NULL;
            $salida_domingo = NULL;
            $entrada_festivo = NULL;
            $salida_festivo =NULL;

            $label_jornada = "Jornada Especial (Nocturno B MAR-JUE-SAB)";
        }

        // 5 -> JORNADA ESPECIAL NOCTURNO C M - J - d

        elseif($request->jornada == 7)
        {
            $entrada_lunes = NULL;
            $salida_lunes = NULL;
            $entrada_martes = $request->horario_entrada;
            $salida_martes = $request->horario_salida;
            $entrada_miercoles = NULL;
            $salida_miercoles = NULL;
            $entrada_jueves = $request->horario_entrada;
            $salida_jueves = $request->horario_salida;
            $entrada_viernes = NULL;
            $salida_viernes = NULL;
            $entrada_sabado = NULL;
            $salida_sabado = NULL;
            $entrada_domingo = $request->horario_entrada;
            $salida_domingo = $request->horario_salida;
            $entrada_festivo = NULL;
            $salida_festivo =NULL;

            $label_jornada = "Jornada Especial (Nocturno C MAR-JUE-DOM)";
        }

        // 6 -> JORNADA ESPECIAL NOCTURNO D M - V - D

        elseif($request->jornada == 8)
        {
            $entrada_lunes = NULL;
            $salida_lunes = NULL;
            $entrada_martes = NULL;
            $salida_martes = NULL;
            $entrada_miercoles = $request->horario_entrada;
            $salida_miercoles = $request->horario_salida;
            $entrada_jueves = NULL;
            $salida_jueves = NULL;
            $entrada_viernes = $request->horario_entrada;
            $salida_viernes = $request->horario_salida;
            $entrada_sabado = NULL;
            $salida_sabado = NULL;
            $entrada_domingo = $request->horario_entrada;
            $salida_domingo = $request->horario_salida;
            $entrada_festivo = NULL;
            $salida_festivo =NULL;

            $label_jornada = "Jornada Especial (Nocturno D MIE-VIE-DOM)";
        }

        // 7 -> JORNADA ESPECIAL S - D - F

        elseif($request->jornada == 9)
        {
            $entrada_lunes = NULL;
            $salida_lunes = NULL;
            $entrada_martes = NULL;
            $salida_martes = NULL;
            $entrada_miercoles = NULL;
            $salida_miercoles = NULL;
            $entrada_jueves = NULL;
            $salida_jueves = NULL;
            $entrada_viernes = NULL;
            $salida_viernes = NULL;
            $entrada_sabado = $request->horario_entrada;
            $salida_sabado = $request->horario_salida;
            $entrada_domingo = $request->horario_entrada;
            $salida_domingo = $request->horario_salida;
            $entrada_festivo = $request->horario_entrada;
            $salida_festivo =$request->horario_salida;

            $label_jornada = "Jornada Especial (Acumulada Diurno S-D-F)";
        }

         // 8 -> JORNADA ESPECIAL S - D - F

        elseif($request->jornada == 11)
        {
            $entrada_lunes = NULL;
            $salida_lunes = NULL;
            $entrada_martes = NULL;
            $salida_martes = NULL;
            $entrada_miercoles = NULL;
            $salida_miercoles = NULL;
            $entrada_jueves = NULL;
            $salida_jueves = NULL;
            $entrada_viernes = NULL;
            $salida_viernes = NULL;
            $entrada_sabado = $request->horario_entrada;
            $salida_sabado = $request->horario_salida;
            $entrada_domingo = $request->horario_entrada;
            $salida_domingo = $request->horario_salida;
            $entrada_festivo = $request->horario_entrada;
            $salida_festivo =$request->horario_salida;

            $label_jornada = "Jornada Especial (Acumulada Nocturno S-D-F)";
        }   

        // JORNADA ESPECIAL

        elseif($request->jornada == 4)
        {
            $entrada_lunes = $request->horario_entrada;
            $salida_lunes = $request->horario_salida;
            $entrada_martes = $request->horario_entrada;
            $salida_martes = $request->horario_salida;
            $entrada_miercoles = $request->horario_entrada;
            $salida_miercoles = $request->horario_salida;
            $entrada_jueves = $request->horario_entrada;
            $salida_jueves = $request->horario_salida;
            $entrada_viernes = $request->horario_entrada;
            $salida_viernes = $request->horario_salida;
            $entrada_sabado = $request->horario_entrada;
            $salida_sabado = $request->horario_salida;
            $entrada_domingo = $request->horario_entrada;
            $salida_domingo = $request->horario_salida;
            $entrada_festivo = $request->horario_entrada;
            $salida_festivo =$request->horario_salida;

            $label_jornada = "Jornada Especial";
        }

        // ROLADOR

        elseif($request->jornada == 10)
        {
            $entrada_lunes = $request->horario_entrada;
            $salida_lunes = $request->horario_salida;
            $entrada_martes = $request->horario_entrada;
            $salida_martes = $request->horario_salida;
            $entrada_miercoles = $request->horario_entrada;
            $salida_miercoles = $request->horario_salida;
            $entrada_jueves = $request->horario_entrada;
            $salida_jueves = $request->horario_salida;
            $entrada_viernes = $request->horario_entrada;
            $salida_viernes = $request->horario_salida;
            $entrada_sabado = $request->horario_entrada;
            $salida_sabado = $request->horario_salida;
            $entrada_domingo = $request->horario_entrada;
            $salida_domingo = $request->horario_salida;
            $entrada_festivo = $request->horario_entrada;
            $salida_festivo =$request->horario_salida;

            $label_jornada = "Rolador";
        }

        else
        {
            $entrada_lunes = NULL;
            $salida_lunes = NULL;
            $entrada_martes = NULL;
            $salida_martes = NULL;
            $entrada_miercoles = NULL;
            $salida_miercoles = NULL;
            $entrada_jueves = NULL;
            $salida_jueves = NULL;
            $entrada_viernes = NULL;
            $salida_viernes = NULL;
            $entrada_sabado = NULL;
            $salida_sabado = NULL;
            $entrada_domingo = NULL;
            $salida_domingo = NULL;
            $entrada_festivo = NULL;
            $salida_festivo = NULL;

            $label_jornada = "ERROR - VALIDACION DE JORNADA";
        }
        
        $horario_status = 1;

        $horario = new ProfesionalHorario();

        $horario->id_profesional = $request->id_profesional;
        $horario->id_jornada = $request->jornada;
        $horario->jornada = $label_jornada;

        $horario->entrada_lunes = $entrada_lunes;
        $horario->salida_lunes = $salida_lunes;
        $horario->entrada_martes = $entrada_martes;
        $horario->salida_martes = $salida_martes;
        $horario->entrada_miercoles = $entrada_miercoles;
        $horario->salida_miercoles = $salida_miercoles;
        $horario->entrada_jueves = $entrada_jueves;
        $horario->salida_jueves = $salida_jueves;
        $horario->entrada_viernes = $entrada_viernes;
        $horario->salida_viernes = $salida_viernes;
        $horario->entrada_sabado = $entrada_sabado;
        $horario->salida_sabado = $salida_sabado;
        $horario->entrada_domingo = $entrada_domingo;
        $horario->salida_domingo = $salida_domingo;
        $horario->entrada_festivo = $entrada_festivo;
        $horario->salida_festivo = $salida_festivo;

        $horario->mdl_horario = $horario_status;

        $horario -> save();

        return redirect()->route('profesionalShow',$request->id_profesional)->with('successHorario', 'Registro realizado correctamente.');

        /*
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
        */
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
        $request->validate([
            'jornada' => 'required',
            'horario_entrada' => 'required',
            'horario_salida' => 'required',
        ],[
            'jornada.required' => 'El campo es obligatorio',
            'horario_entrada.required' => 'El campo es obligatorio',
            'horario_salida.required' => 'El campo es obligatorio',
        ]);

        

        /**********************************************************************************
         * 
         * 
         * ARREGLO PARA ASIGNAR LOS VALORES A CADA DIA
         * 
         * 
         ***********************************************************************************/

        // 1 -> JORNADA DIURNA MATUTINA L - V

        if($request->jornada == 1)
        {
            $entrada_lunes = $request->horario_entrada;
            $salida_lunes = $request->horario_salida;
            $entrada_martes = $request->horario_entrada;
            $salida_martes = $request->horario_salida;
            $entrada_miercoles = $request->horario_entrada;
            $salida_miercoles = $request->horario_salida;
            $entrada_jueves = $request->horario_entrada;
            $salida_jueves = $request->horario_salida;
            $entrada_viernes = $request->horario_entrada;
            $salida_viernes = $request->horario_salida;
            $entrada_sabado = NULL;
            $salida_sabado = NULL;
            $entrada_domingo = NULL;
            $salida_domingo = NULL;
            $entrada_festivo = NULL;
            $salida_festivo =NULL;

            $label_jornada = "Jornada Diurna (Matutina L-V)";
        }

        // 2 -> JORNADA MIXTA VESPERTINO L - V

        elseif($request->jornada == 2)
        {
            $entrada_lunes = $request->horario_entrada;
            $salida_lunes = $request->horario_salida;
            $entrada_martes = $request->horario_entrada;
            $salida_martes = $request->horario_salida;
            $entrada_miercoles = $request->horario_entrada;
            $salida_miercoles = $request->horario_salida;
            $entrada_jueves = $request->horario_entrada;
            $salida_jueves = $request->horario_salida;
            $entrada_viernes = $request->horario_entrada;
            $salida_viernes = $request->horario_salida;
            $entrada_sabado = NULL;
            $salida_sabado = NULL;
            $entrada_domingo = NULL;
            $salida_domingo = NULL;
            $entrada_festivo = NULL;
            $salida_festivo =NULL;

            $label_jornada = "Jornada Mixta (Vespertino L-V)";
        }

        // 3 -> JORNADA ESPECIAL NOCTURNO A L - M - V

        elseif($request->jornada == 3)
        {
            $entrada_lunes = $request->horario_entrada;
            $salida_lunes = $request->horario_salida;
            $entrada_martes = NULL;
            $salida_martes = NULL;
            $entrada_miercoles = $request->horario_entrada;
            $salida_miercoles = $request->horario_salida;
            $entrada_jueves = NULL;
            $salida_jueves = NULL;
            $entrada_viernes = $request->horario_entrada;
            $salida_viernes = $request->horario_salida;
            $entrada_sabado = NULL;
            $salida_sabado = NULL;
            $entrada_domingo = NULL;
            $salida_domingo = NULL;
            $entrada_festivo = NULL;
            $salida_festivo =NULL;

            $label_jornada = "Jornada Especial (Nocturno A LUN-MIE-VIE)";
        }

        // 4 -> JORNADA ESPECIAL NOCTURNO B M - J - S

        elseif($request->jornada == 6)
        {
            $entrada_lunes = NULL;
            $salida_lunes = NULL;
            $entrada_martes = $request->horario_entrada;
            $salida_martes = $request->horario_salida;
            $entrada_miercoles = NULL;
            $salida_miercoles = NULL;
            $entrada_jueves = $request->horario_entrada;
            $salida_jueves = $request->horario_salida;
            $entrada_viernes = NULL;
            $salida_viernes = NULL;
            $entrada_sabado = $request->horario_entrada;
            $salida_sabado = $request->horario_salida;
            $entrada_domingo = NULL;
            $salida_domingo = NULL;
            $entrada_festivo = NULL;
            $salida_festivo =NULL;

            $label_jornada = "Jornada Especial (Nocturno B MAR-JUE-SAB)";
        }

        // 5 -> JORNADA ESPECIAL NOCTURNO C M - J - d

        elseif($request->jornada == 7)
        {
            $entrada_lunes = NULL;
            $salida_lunes = NULL;
            $entrada_martes = $request->horario_entrada;
            $salida_martes = $request->horario_salida;
            $entrada_miercoles = NULL;
            $salida_miercoles = NULL;
            $entrada_jueves = $request->horario_entrada;
            $salida_jueves = $request->horario_salida;
            $entrada_viernes = NULL;
            $salida_viernes = NULL;
            $entrada_sabado = NULL;
            $salida_sabado = NULL;
            $entrada_domingo = $request->horario_entrada;
            $salida_domingo = $request->horario_salida;
            $entrada_festivo = NULL;
            $salida_festivo =NULL;

            $label_jornada = "Jornada Especial (Nocturno C MAR-JUE-DOM)";
        }

        // 6 -> JORNADA ESPECIAL NOCTURNO D M - V - D

        elseif($request->jornada == 8)
        {
            $entrada_lunes = NULL;
            $salida_lunes = NULL;
            $entrada_martes = NULL;
            $salida_martes = NULL;
            $entrada_miercoles = $request->horario_entrada;
            $salida_miercoles = $request->horario_salida;
            $entrada_jueves = NULL;
            $salida_jueves = NULL;
            $entrada_viernes = $request->horario_entrada;
            $salida_viernes = $request->horario_salida;
            $entrada_sabado = NULL;
            $salida_sabado = NULL;
            $entrada_domingo = $request->horario_entrada;
            $salida_domingo = $request->horario_salida;
            $entrada_festivo = NULL;
            $salida_festivo =NULL;

            $label_jornada = "Jornada Especial (Nocturno D MIE-VIE-DOM)";
        }

        // 7 -> JORNADA ESPECIAL S - D - F

        elseif($request->jornada == 9)
        {
            $entrada_lunes = NULL;
            $salida_lunes = NULL;
            $entrada_martes = NULL;
            $salida_martes = NULL;
            $entrada_miercoles = NULL;
            $salida_miercoles = NULL;
            $entrada_jueves = NULL;
            $salida_jueves = NULL;
            $entrada_viernes = NULL;
            $salida_viernes = NULL;
            $entrada_sabado = $request->horario_entrada;
            $salida_sabado = $request->horario_salida;
            $entrada_domingo = $request->horario_entrada;
            $salida_domingo = $request->horario_salida;
            $entrada_festivo = $request->horario_entrada;
            $salida_festivo =$request->horario_salida;

            $label_jornada = "Jornada Especial (Acumulada Diurno S-D-F)";
        }

         // 8 -> JORNADA ESPECIAL S - D - F

        elseif($request->jornada == 11)
        {
            $entrada_lunes = NULL;
            $salida_lunes = NULL;
            $entrada_martes = NULL;
            $salida_martes = NULL;
            $entrada_miercoles = NULL;
            $salida_miercoles = NULL;
            $entrada_jueves = NULL;
            $salida_jueves = NULL;
            $entrada_viernes = NULL;
            $salida_viernes = NULL;
            $entrada_sabado = $request->horario_entrada;
            $salida_sabado = $request->horario_salida;
            $entrada_domingo = $request->horario_entrada;
            $salida_domingo = $request->horario_salida;
            $entrada_festivo = $request->horario_entrada;
            $salida_festivo =$request->horario_salida;

            $label_jornada = "Jornada Especial (Acumulada Nocturno S-D-F)";
        }   

        // JORNADA ESPECIAL

        elseif($request->jornada == 4)
        {
            $entrada_lunes = $request->horario_entrada;
            $salida_lunes = $request->horario_salida;
            $entrada_martes = $request->horario_entrada;
            $salida_martes = $request->horario_salida;
            $entrada_miercoles = $request->horario_entrada;
            $salida_miercoles = $request->horario_salida;
            $entrada_jueves = $request->horario_entrada;
            $salida_jueves = $request->horario_salida;
            $entrada_viernes = $request->horario_entrada;
            $salida_viernes = $request->horario_salida;
            $entrada_sabado = $request->horario_entrada;
            $salida_sabado = $request->horario_salida;
            $entrada_domingo = $request->horario_entrada;
            $salida_domingo = $request->horario_salida;
            $entrada_festivo = $request->horario_entrada;
            $salida_festivo =$request->horario_salida;

            $label_jornada = "Jornada Especial";
        }

        // ROLADOR

        elseif($request->jornada == 10)
        {
            $entrada_lunes = $request->horario_entrada;
            $salida_lunes = $request->horario_salida;
            $entrada_martes = $request->horario_entrada;
            $salida_martes = $request->horario_salida;
            $entrada_miercoles = $request->horario_entrada;
            $salida_miercoles = $request->horario_salida;
            $entrada_jueves = $request->horario_entrada;
            $salida_jueves = $request->horario_salida;
            $entrada_viernes = $request->horario_entrada;
            $salida_viernes = $request->horario_salida;
            $entrada_sabado = $request->horario_entrada;
            $salida_sabado = $request->horario_salida;
            $entrada_domingo = $request->horario_entrada;
            $salida_domingo = $request->horario_salida;
            $entrada_festivo = $request->horario_entrada;
            $salida_festivo =$request->horario_salida;

            $label_jornada = "Rolador";
        }

        else
        {
            $entrada_lunes = NULL;
            $salida_lunes = NULL;
            $entrada_martes = NULL;
            $salida_martes = NULL;
            $entrada_miercoles = NULL;
            $salida_miercoles = NULL;
            $entrada_jueves = NULL;
            $salida_jueves = NULL;
            $entrada_viernes = NULL;
            $salida_viernes = NULL;
            $entrada_sabado = NULL;
            $salida_sabado = NULL;
            $entrada_domingo = NULL;
            $salida_domingo = NULL;
            $entrada_festivo = NULL;
            $salida_festivo = NULL;

            $label_jornada = "ERROR - VALIDACION DE JORNADA";
        }
        
        $horario_status = 1;
        
        // Buscamos el registro

        $horario = ProfesionalHorario::findOrFail($id);
        
        // Buscamos al profesional
        $profesional = Profesional::where('id', $horario->id_profesional)->first();

        $horario->id_jornada = $request->jornada;
        $horario->jornada = $label_jornada;

        $horario->entrada_lunes = $entrada_lunes;
        $horario->salida_lunes = $salida_lunes;
        $horario->entrada_martes = $entrada_martes;
        $horario->salida_martes = $salida_martes;
        $horario->entrada_miercoles = $entrada_miercoles;
        $horario->salida_miercoles = $salida_miercoles;
        $horario->entrada_jueves = $entrada_jueves;
        $horario->salida_jueves = $salida_jueves;
        $horario->entrada_viernes = $entrada_viernes;
        $horario->salida_viernes = $salida_viernes;
        $horario->entrada_sabado = $entrada_sabado;
        $horario->salida_sabado = $salida_sabado;
        $horario->entrada_domingo = $entrada_domingo;
        $horario->salida_domingo = $salida_domingo;
        $horario->entrada_festivo = $entrada_festivo;
        $horario->salida_festivo = $salida_festivo;

        $horario->mdl_horario = $horario_status;

        $horario -> save();

        return redirect()->route('profesionalShow',$profesional->id)->with('successHorario', 'Registro realizado correctamente.');
        
        /*
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
        return redirect()->route('profesionalIndex')->with('successUpdateHorario', 'Registro actualizado correctamente.');*/
    }
}
