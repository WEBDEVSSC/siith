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
            $jornadas = Jornada::whereNotIn('jornada', ['Rolador', 'Jornada Especial'])->get();
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
            'horario_entrada' => 'nullable|date_format:H:i',
            'horario_salida' => 'nullable|date_format:H:i',

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
            'jornada.required' => 'El campo es obligatorio',
            'horario_entrada.required' => 'El campo es obligatorio',
            'horario_salida.required' => 'El campo es obligatorio',
        ]);

        // Consultamos el label de Jornada Mexico
        $jornadaMexico = Jornada::findOrFail($request->jornada);

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

            /****************************************************************************************** */

            $entradas = [
                $entrada_lunes,
                $entrada_martes,
                $entrada_miercoles,
                $entrada_jueves,
                $entrada_viernes,
                $entrada_sabado,
                $entrada_domingo,
                $entrada_festivo,
            ];

            // Convertir cada hora a segundos (ignorando NULL y 00:00:00)
            $entradasSegundos = [];

            foreach ($entradas as $t) {
                if (!empty($t) && $t !== "00:00:00") {
                    $entradasSegundos[] = strtotime($t) - strtotime('TODAY');
                }
            }

            $entrada_promedio = null;

            if (count($entradasSegundos) > 0) {
                $avg = array_sum($entradasSegundos) / count($entradasSegundos);
                $entrada_promedio = gmdate("H:i:s", $avg);
            }

            /****************************************************************************************** */

            $salidas = [
                $salida_lunes,
                $salida_martes,
                $salida_miercoles,
                $salida_jueves,
                $salida_viernes,
                $salida_sabado,
                $salida_domingo,
                $salida_festivo,
            ];

            $salidasSegundos = [];

            foreach ($salidas as $t) {
                if (!empty($t) && $t !== "00:00:00") {
                    $salidasSegundos[] = strtotime($t) - strtotime('TODAY');
                }
            }

            $salida_promedio = null;

            if (count($salidasSegundos) > 0) {
                $avg = array_sum($salidasSegundos) / count($salidasSegundos);
                $salida_promedio = gmdate("H:i:s", $avg);
            }
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

            /****************************************************************************************** */

            $entradas = [
                $entrada_lunes,
                $entrada_martes,
                $entrada_miercoles,
                $entrada_jueves,
                $entrada_viernes,
                $entrada_sabado,
                $entrada_domingo,
                $entrada_festivo,
            ];

            // Convertir cada hora a segundos (ignorando NULL y 00:00:00)
            $entradasSegundos = [];

            foreach ($entradas as $t) {
                if (!empty($t) && $t !== "00:00:00") {
                    $entradasSegundos[] = strtotime($t) - strtotime('TODAY');
                }
            }

            $entrada_promedio = null;

            if (count($entradasSegundos) > 0) {
                $avg = array_sum($entradasSegundos) / count($entradasSegundos);
                $entrada_promedio = gmdate("H:i:s", $avg);
            }

            /****************************************************************************************** */

            $salidas = [
                $salida_lunes,
                $salida_martes,
                $salida_miercoles,
                $salida_jueves,
                $salida_viernes,
                $salida_sabado,
                $salida_domingo,
                $salida_festivo,
            ];

            $salidasSegundos = [];

            foreach ($salidas as $t) {
                if (!empty($t) && $t !== "00:00:00") {
                    $salidasSegundos[] = strtotime($t) - strtotime('TODAY');
                }
            }

            $salida_promedio = null;

            if (count($salidasSegundos) > 0) {
                $avg = array_sum($salidasSegundos) / count($salidasSegundos);
                $salida_promedio = gmdate("H:i:s", $avg);
            }
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

            /****************************************************************************************** */

            $entradas = [
                $entrada_lunes,
                $entrada_martes,
                $entrada_miercoles,
                $entrada_jueves,
                $entrada_viernes,
                $entrada_sabado,
                $entrada_domingo,
                $entrada_festivo,
            ];

            // Convertir cada hora a segundos (ignorando NULL y 00:00:00)
            $entradasSegundos = [];

            foreach ($entradas as $t) {
                if (!empty($t) && $t !== "00:00:00") {
                    $entradasSegundos[] = strtotime($t) - strtotime('TODAY');
                }
            }

            $entrada_promedio = null;

            if (count($entradasSegundos) > 0) {
                $avg = array_sum($entradasSegundos) / count($entradasSegundos);
                $entrada_promedio = gmdate("H:i:s", $avg);
            }

            /****************************************************************************************** */

            $salidas = [
                $salida_lunes,
                $salida_martes,
                $salida_miercoles,
                $salida_jueves,
                $salida_viernes,
                $salida_sabado,
                $salida_domingo,
                $salida_festivo,
            ];

            $salidasSegundos = [];

            foreach ($salidas as $t) {
                if (!empty($t) && $t !== "00:00:00") {
                    $salidasSegundos[] = strtotime($t) - strtotime('TODAY');
                }
            }

            $salida_promedio = null;

            if (count($salidasSegundos) > 0) {
                $avg = array_sum($salidasSegundos) / count($salidasSegundos);
                $salida_promedio = gmdate("H:i:s", $avg);
            }
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

            /****************************************************************************************** */

            $entradas = [
                $entrada_lunes,
                $entrada_martes,
                $entrada_miercoles,
                $entrada_jueves,
                $entrada_viernes,
                $entrada_sabado,
                $entrada_domingo,
                $entrada_festivo,
            ];

            // Convertir cada hora a segundos (ignorando NULL y 00:00:00)
            $entradasSegundos = [];

            foreach ($entradas as $t) {
                if (!empty($t) && $t !== "00:00:00") {
                    $entradasSegundos[] = strtotime($t) - strtotime('TODAY');
                }
            }

            $entrada_promedio = null;

            if (count($entradasSegundos) > 0) {
                $avg = array_sum($entradasSegundos) / count($entradasSegundos);
                $entrada_promedio = gmdate("H:i:s", $avg);
            }

            /****************************************************************************************** */

            $salidas = [
                $salida_lunes,
                $salida_martes,
                $salida_miercoles,
                $salida_jueves,
                $salida_viernes,
                $salida_sabado,
                $salida_domingo,
                $salida_festivo,
            ];

            $salidasSegundos = [];

            foreach ($salidas as $t) {
                if (!empty($t) && $t !== "00:00:00") {
                    $salidasSegundos[] = strtotime($t) - strtotime('TODAY');
                }
            }

            $salida_promedio = null;

            if (count($salidasSegundos) > 0) {
                $avg = array_sum($salidasSegundos) / count($salidasSegundos);
                $salida_promedio = gmdate("H:i:s", $avg);
            }
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

            /****************************************************************************************** */

            $entradas = [
                $entrada_lunes,
                $entrada_martes,
                $entrada_miercoles,
                $entrada_jueves,
                $entrada_viernes,
                $entrada_sabado,
                $entrada_domingo,
                $entrada_festivo,
            ];

            // Convertir cada hora a segundos (ignorando NULL y 00:00:00)
            $entradasSegundos = [];

            foreach ($entradas as $t) {
                if (!empty($t) && $t !== "00:00:00") {
                    $entradasSegundos[] = strtotime($t) - strtotime('TODAY');
                }
            }

            $entrada_promedio = null;

            if (count($entradasSegundos) > 0) {
                $avg = array_sum($entradasSegundos) / count($entradasSegundos);
                $entrada_promedio = gmdate("H:i:s", $avg);
            }

            /****************************************************************************************** */

            $salidas = [
                $salida_lunes,
                $salida_martes,
                $salida_miercoles,
                $salida_jueves,
                $salida_viernes,
                $salida_sabado,
                $salida_domingo,
                $salida_festivo,
            ];

            $salidasSegundos = [];

            foreach ($salidas as $t) {
                if (!empty($t) && $t !== "00:00:00") {
                    $salidasSegundos[] = strtotime($t) - strtotime('TODAY');
                }
            }

            $salida_promedio = null;

            if (count($salidasSegundos) > 0) {
                $avg = array_sum($salidasSegundos) / count($salidasSegundos);
                $salida_promedio = gmdate("H:i:s", $avg);
            }
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

            /****************************************************************************************** */

            $entradas = [
                $entrada_lunes,
                $entrada_martes,
                $entrada_miercoles,
                $entrada_jueves,
                $entrada_viernes,
                $entrada_sabado,
                $entrada_domingo,
                $entrada_festivo,
            ];

            // Convertir cada hora a segundos (ignorando NULL y 00:00:00)
            $entradasSegundos = [];

            foreach ($entradas as $t) {
                if (!empty($t) && $t !== "00:00:00") {
                    $entradasSegundos[] = strtotime($t) - strtotime('TODAY');
                }
            }

            $entrada_promedio = null;

            if (count($entradasSegundos) > 0) {
                $avg = array_sum($entradasSegundos) / count($entradasSegundos);
                $entrada_promedio = gmdate("H:i:s", $avg);
            }

            /****************************************************************************************** */

            $salidas = [
                $salida_lunes,
                $salida_martes,
                $salida_miercoles,
                $salida_jueves,
                $salida_viernes,
                $salida_sabado,
                $salida_domingo,
                $salida_festivo,
            ];

            $salidasSegundos = [];

            foreach ($salidas as $t) {
                if (!empty($t) && $t !== "00:00:00") {
                    $salidasSegundos[] = strtotime($t) - strtotime('TODAY');
                }
            }

            $salida_promedio = null;

            if (count($salidasSegundos) > 0) {
                $avg = array_sum($salidasSegundos) / count($salidasSegundos);
                $salida_promedio = gmdate("H:i:s", $avg);
            }
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

            /****************************************************************************************** */

            $entradas = [
                $entrada_lunes,
                $entrada_martes,
                $entrada_miercoles,
                $entrada_jueves,
                $entrada_viernes,
                $entrada_sabado,
                $entrada_domingo,
                $entrada_festivo,
            ];

            // Convertir cada hora a segundos (ignorando NULL y 00:00:00)
            $entradasSegundos = [];

            foreach ($entradas as $t) {
                if (!empty($t) && $t !== "00:00:00") {
                    $entradasSegundos[] = strtotime($t) - strtotime('TODAY');
                }
            }

            $entrada_promedio = null;

            if (count($entradasSegundos) > 0) {
                $avg = array_sum($entradasSegundos) / count($entradasSegundos);
                $entrada_promedio = gmdate("H:i:s", $avg);
            }

            /****************************************************************************************** */

            $salidas = [
                $salida_lunes,
                $salida_martes,
                $salida_miercoles,
                $salida_jueves,
                $salida_viernes,
                $salida_sabado,
                $salida_domingo,
                $salida_festivo,
            ];

            $salidasSegundos = [];

            foreach ($salidas as $t) {
                if (!empty($t) && $t !== "00:00:00") {
                    $salidasSegundos[] = strtotime($t) - strtotime('TODAY');
                }
            }

            $salida_promedio = null;

            if (count($salidasSegundos) > 0) {
                $avg = array_sum($salidasSegundos) / count($salidasSegundos);
                $salida_promedio = gmdate("H:i:s", $avg);
            }
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

            /****************************************************************************************** */

            $entradas = [
                $entrada_lunes,
                $entrada_martes,
                $entrada_miercoles,
                $entrada_jueves,
                $entrada_viernes,
                $entrada_sabado,
                $entrada_domingo,
                $entrada_festivo,
            ];

            // Convertir cada hora a segundos (ignorando NULL y 00:00:00)
            $entradasSegundos = [];

            foreach ($entradas as $t) {
                if (!empty($t) && $t !== "00:00:00") {
                    $entradasSegundos[] = strtotime($t) - strtotime('TODAY');
                }
            }

            $entrada_promedio = null;

            if (count($entradasSegundos) > 0) {
                $avg = array_sum($entradasSegundos) / count($entradasSegundos);
                $entrada_promedio = gmdate("H:i:s", $avg);
            }

            /****************************************************************************************** */

            $salidas = [
                $salida_lunes,
                $salida_martes,
                $salida_miercoles,
                $salida_jueves,
                $salida_viernes,
                $salida_sabado,
                $salida_domingo,
                $salida_festivo,
            ];

            $salidasSegundos = [];

            foreach ($salidas as $t) {
                if (!empty($t) && $t !== "00:00:00") {
                    $salidasSegundos[] = strtotime($t) - strtotime('TODAY');
                }
            }

            $salida_promedio = null;

            if (count($salidasSegundos) > 0) {
                $avg = array_sum($salidasSegundos) / count($salidasSegundos);
                $salida_promedio = gmdate("H:i:s", $avg);
            }
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

            /****************************************************************************************** */

            $entradas = [
                $entrada_lunes,
                $entrada_martes,
                $entrada_miercoles,
                $entrada_jueves,
                $entrada_viernes,
                $entrada_sabado,
                $entrada_domingo,
                $entrada_festivo,
            ];

            // Convertir cada hora a segundos (ignorando NULL y 00:00:00)
            $entradasSegundos = [];

            foreach ($entradas as $t) {
                if (!empty($t) && $t !== "00:00:00") {
                    $entradasSegundos[] = strtotime($t) - strtotime('TODAY');
                }
            }

            $entrada_promedio = null;

            if (count($entradasSegundos) > 0) {
                $avg = array_sum($entradasSegundos) / count($entradasSegundos);
                $entrada_promedio = gmdate("H:i:s", $avg);
            }

            /****************************************************************************************** */

            $salidas = [
                $salida_lunes,
                $salida_martes,
                $salida_miercoles,
                $salida_jueves,
                $salida_viernes,
                $salida_sabado,
                $salida_domingo,
                $salida_festivo,
            ];

            $salidasSegundos = [];

            foreach ($salidas as $t) {
                if (!empty($t) && $t !== "00:00:00") {
                    $salidasSegundos[] = strtotime($t) - strtotime('TODAY');
                }
            }

            $salida_promedio = null;

            if (count($salidasSegundos) > 0) {
                $avg = array_sum($salidasSegundos) / count($salidasSegundos);
                $salida_promedio = gmdate("H:i:s", $avg);
            }
        }

        // ROLADOR

        elseif($request->jornada == 10)
        {
            $entrada_lunes = $request->entrada_lunes;
            $salida_lunes = $request->salida_lunes;
            $entrada_martes = $request->entrada_martes;
            $salida_martes = $request->salida_martes;
            $entrada_miercoles = $request->entrada_miercoles;
            $salida_miercoles = $request->salida_miercoles;
            $entrada_jueves = $request->entrada_jueves;
            $salida_jueves = $request->salida_jueves;
            $entrada_viernes = $request->entrada_viernes;
            $salida_viernes = $request->salida_viernes;
            $entrada_sabado = $request->entrada_sabado;
            $salida_sabado = $request->salida_sabado;
            $entrada_domingo = $request->entrada_domingo;
            $salida_domingo = $request->salida_domingo;
            $entrada_festivo = $request->entrada_festivo;
            $salida_festivo =$request->salida_festivo;

            $label_jornada = "Rolador";

            /****************************************************************************************** */

            $entradas = [
                $entrada_lunes,
                $entrada_martes,
                $entrada_miercoles,
                $entrada_jueves,
                $entrada_viernes,
                $entrada_sabado,
                $entrada_domingo,
                $entrada_festivo,
            ];

            // Convertir cada hora a segundos (ignorando NULL y 00:00:00)
            $entradasSegundos = [];

            foreach ($entradas as $t) {
                if (!empty($t) && $t !== "00:00:00") {
                    $entradasSegundos[] = strtotime($t) - strtotime('TODAY');
                }
            }

            $entrada_promedio = null;

            if (count($entradasSegundos) > 0) {
                $avg = array_sum($entradasSegundos) / count($entradasSegundos);
                $entrada_promedio = gmdate("H:i:s", $avg);
            }

            /****************************************************************************************** */

            $salidas = [
                $salida_lunes,
                $salida_martes,
                $salida_miercoles,
                $salida_jueves,
                $salida_viernes,
                $salida_sabado,
                $salida_domingo,
                $salida_festivo,
            ];

            $salidasSegundos = [];

            foreach ($salidas as $t) {
                if (!empty($t) && $t !== "00:00:00") {
                    $salidasSegundos[] = strtotime($t) - strtotime('TODAY');
                }
            }

            $salida_promedio = null;

            if (count($salidasSegundos) > 0) {
                $avg = array_sum($salidasSegundos) / count($salidasSegundos);
                $salida_promedio = gmdate("H:i:s", $avg);
            }
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

            $entrada_promedio =  NULL;
            $salida_promedio =  NULL;

            $label_jornada = "ERROR - VALIDACION DE JORNADA";
        }
        
        $horario_status = 1;

        $horario = new ProfesionalHorario();

        $horario->id_profesional = $request->id_profesional;
        $horario->id_jornada = $request->jornada;
        $horario->jornada = $label_jornada;
        $horario->jornada_mexico = $jornadaMexico->jornada_mexico;

        $horario->entrada_promedio = $entrada_promedio;
        $horario->salida_promedio = $salida_promedio;

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

    }

    public function editHorario($id)
    {        
        // Consultamos el registro con el ID
        $horario = ProfesionalHorario::where('id_profesional',$id)->first();

        // Consultamos los datos del profesional
        $profesional = Profesional::findOrFail($id);

        
        $usuario = Auth::user();

        if($usuario->role == 'ofJurisdiccional')
        {
            $jornadas = Jornada::whereNotIn('jornada', ['Rolador', 'Jornada Especial'])->get();
        }
        else
        {
            $jornadas = Jornada::orderBy('orden', 'asc')->get();
        }

        return view('horario.edit', compact('horario','profesional','jornadas'));
    }

    public function updateHorario(Request $request, $id)
    {             
        //dd($request->entrada_lunes);
        
        $request->validate([
            'jornada' => 'required',
            'horario_entrada' => 'nullable|date_format:H:i',
            'horario_salida' => 'nullable|date_format:H:i',

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
            'jornada.required' => 'El campo es obligatorio',
            'horario_entrada.required' => 'El campo es obligatorio',
            'horario_salida.required' => 'El campo es obligatorio',
        ]);

        // Consultamos el label de Jornada Mexico
        $jornadaMexico = Jornada::findOrFail($request->jornada);

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

            /****************************************************************************************** */

            $entradas = [
                $entrada_lunes,
                $entrada_martes,
                $entrada_miercoles,
                $entrada_jueves,
                $entrada_viernes,
                $entrada_sabado,
                $entrada_domingo,
                $entrada_festivo,
            ];

            // Convertir cada hora a segundos (ignorando NULL y 00:00:00)
            $entradasSegundos = [];

            foreach ($entradas as $t) {
                if (!empty($t) && $t !== "00:00:00") {
                    $entradasSegundos[] = strtotime($t) - strtotime('TODAY');
                }
            }

            $entrada_promedio = null;

            if (count($entradasSegundos) > 0) {
                $avg = array_sum($entradasSegundos) / count($entradasSegundos);
                $entrada_promedio = gmdate("H:i:s", $avg);
            }

            /****************************************************************************************** */

            $salidas = [
                $salida_lunes,
                $salida_martes,
                $salida_miercoles,
                $salida_jueves,
                $salida_viernes,
                $salida_sabado,
                $salida_domingo,
                $salida_festivo,
            ];

            $salidasSegundos = [];

            foreach ($salidas as $t) {
                if (!empty($t) && $t !== "00:00:00") {
                    $salidasSegundos[] = strtotime($t) - strtotime('TODAY');
                }
            }

            $salida_promedio = null;

            if (count($salidasSegundos) > 0) {
                $avg = array_sum($salidasSegundos) / count($salidasSegundos);
                $salida_promedio = gmdate("H:i:s", $avg);
            }
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

            /****************************************************************************************** */

            $entradas = [
                $entrada_lunes,
                $entrada_martes,
                $entrada_miercoles,
                $entrada_jueves,
                $entrada_viernes,
                $entrada_sabado,
                $entrada_domingo,
                $entrada_festivo,
            ];

            // Convertir cada hora a segundos (ignorando NULL y 00:00:00)
            $entradasSegundos = [];

            foreach ($entradas as $t) {
                if (!empty($t) && $t !== "00:00:00") {
                    $entradasSegundos[] = strtotime($t) - strtotime('TODAY');
                }
            }

            $entrada_promedio = null;

            if (count($entradasSegundos) > 0) {
                $avg = array_sum($entradasSegundos) / count($entradasSegundos);
                $entrada_promedio = gmdate("H:i:s", $avg);
            }

            /****************************************************************************************** */

            $salidas = [
                $salida_lunes,
                $salida_martes,
                $salida_miercoles,
                $salida_jueves,
                $salida_viernes,
                $salida_sabado,
                $salida_domingo,
                $salida_festivo,
            ];

            $salidasSegundos = [];

            foreach ($salidas as $t) {
                if (!empty($t) && $t !== "00:00:00") {
                    $salidasSegundos[] = strtotime($t) - strtotime('TODAY');
                }
            }

            $salida_promedio = null;

            if (count($salidasSegundos) > 0) {
                $avg = array_sum($salidasSegundos) / count($salidasSegundos);
                $salida_promedio = gmdate("H:i:s", $avg);
            }
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

            /****************************************************************************************** */

            $entradas = [
                $entrada_lunes,
                $entrada_martes,
                $entrada_miercoles,
                $entrada_jueves,
                $entrada_viernes,
                $entrada_sabado,
                $entrada_domingo,
                $entrada_festivo,
            ];

            // Convertir cada hora a segundos (ignorando NULL y 00:00:00)
            $entradasSegundos = [];

            foreach ($entradas as $t) {
                if (!empty($t) && $t !== "00:00:00") {
                    $entradasSegundos[] = strtotime($t) - strtotime('TODAY');
                }
            }

            $entrada_promedio = null;

            if (count($entradasSegundos) > 0) {
                $avg = array_sum($entradasSegundos) / count($entradasSegundos);
                $entrada_promedio = gmdate("H:i:s", $avg);
            }

            /****************************************************************************************** */

            $salidas = [
                $salida_lunes,
                $salida_martes,
                $salida_miercoles,
                $salida_jueves,
                $salida_viernes,
                $salida_sabado,
                $salida_domingo,
                $salida_festivo,
            ];

            $salidasSegundos = [];

            foreach ($salidas as $t) {
                if (!empty($t) && $t !== "00:00:00") {
                    $salidasSegundos[] = strtotime($t) - strtotime('TODAY');
                }
            }

            $salida_promedio = null;

            if (count($salidasSegundos) > 0) {
                $avg = array_sum($salidasSegundos) / count($salidasSegundos);
                $salida_promedio = gmdate("H:i:s", $avg);
            }
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

            /****************************************************************************************** */

            $entradas = [
                $entrada_lunes,
                $entrada_martes,
                $entrada_miercoles,
                $entrada_jueves,
                $entrada_viernes,
                $entrada_sabado,
                $entrada_domingo,
                $entrada_festivo,
            ];

            // Convertir cada hora a segundos (ignorando NULL y 00:00:00)
            $entradasSegundos = [];

            foreach ($entradas as $t) {
                if (!empty($t) && $t !== "00:00:00") {
                    $entradasSegundos[] = strtotime($t) - strtotime('TODAY');
                }
            }

            $entrada_promedio = null;

            if (count($entradasSegundos) > 0) {
                $avg = array_sum($entradasSegundos) / count($entradasSegundos);
                $entrada_promedio = gmdate("H:i:s", $avg);
            }

            /****************************************************************************************** */

            $salidas = [
                $salida_lunes,
                $salida_martes,
                $salida_miercoles,
                $salida_jueves,
                $salida_viernes,
                $salida_sabado,
                $salida_domingo,
                $salida_festivo,
            ];

            $salidasSegundos = [];

            foreach ($salidas as $t) {
                if (!empty($t) && $t !== "00:00:00") {
                    $salidasSegundos[] = strtotime($t) - strtotime('TODAY');
                }
            }

            $salida_promedio = null;

            if (count($salidasSegundos) > 0) {
                $avg = array_sum($salidasSegundos) / count($salidasSegundos);
                $salida_promedio = gmdate("H:i:s", $avg);
            }
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

            /****************************************************************************************** */

            $entradas = [
                $entrada_lunes,
                $entrada_martes,
                $entrada_miercoles,
                $entrada_jueves,
                $entrada_viernes,
                $entrada_sabado,
                $entrada_domingo,
                $entrada_festivo,
            ];

            // Convertir cada hora a segundos (ignorando NULL y 00:00:00)
            $entradasSegundos = [];

            foreach ($entradas as $t) {
                if (!empty($t) && $t !== "00:00:00") {
                    $entradasSegundos[] = strtotime($t) - strtotime('TODAY');
                }
            }

            $entrada_promedio = null;

            if (count($entradasSegundos) > 0) {
                $avg = array_sum($entradasSegundos) / count($entradasSegundos);
                $entrada_promedio = gmdate("H:i:s", $avg);
            }

            /****************************************************************************************** */

            $salidas = [
                $salida_lunes,
                $salida_martes,
                $salida_miercoles,
                $salida_jueves,
                $salida_viernes,
                $salida_sabado,
                $salida_domingo,
                $salida_festivo,
            ];

            $salidasSegundos = [];

            foreach ($salidas as $t) {
                if (!empty($t) && $t !== "00:00:00") {
                    $salidasSegundos[] = strtotime($t) - strtotime('TODAY');
                }
            }

            $salida_promedio = null;

            if (count($salidasSegundos) > 0) {
                $avg = array_sum($salidasSegundos) / count($salidasSegundos);
                $salida_promedio = gmdate("H:i:s", $avg);
            }
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

            /****************************************************************************************** */

            $entradas = [
                $entrada_lunes,
                $entrada_martes,
                $entrada_miercoles,
                $entrada_jueves,
                $entrada_viernes,
                $entrada_sabado,
                $entrada_domingo,
                $entrada_festivo,
            ];

            // Convertir cada hora a segundos (ignorando NULL y 00:00:00)
            $entradasSegundos = [];

            foreach ($entradas as $t) {
                if (!empty($t) && $t !== "00:00:00") {
                    $entradasSegundos[] = strtotime($t) - strtotime('TODAY');
                }
            }

            $entrada_promedio = null;

            if (count($entradasSegundos) > 0) {
                $avg = array_sum($entradasSegundos) / count($entradasSegundos);
                $entrada_promedio = gmdate("H:i:s", $avg);
            }

            /****************************************************************************************** */

            $salidas = [
                $salida_lunes,
                $salida_martes,
                $salida_miercoles,
                $salida_jueves,
                $salida_viernes,
                $salida_sabado,
                $salida_domingo,
                $salida_festivo,
            ];

            $salidasSegundos = [];

            foreach ($salidas as $t) {
                if (!empty($t) && $t !== "00:00:00") {
                    $salidasSegundos[] = strtotime($t) - strtotime('TODAY');
                }
            }

            $salida_promedio = null;

            if (count($salidasSegundos) > 0) {
                $avg = array_sum($salidasSegundos) / count($salidasSegundos);
                $salida_promedio = gmdate("H:i:s", $avg);
            }
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

            /****************************************************************************************** */

            $entradas = [
                $entrada_lunes,
                $entrada_martes,
                $entrada_miercoles,
                $entrada_jueves,
                $entrada_viernes,
                $entrada_sabado,
                $entrada_domingo,
                $entrada_festivo,
            ];

            // Convertir cada hora a segundos (ignorando NULL y 00:00:00)
            $entradasSegundos = [];

            foreach ($entradas as $t) {
                if (!empty($t) && $t !== "00:00:00") {
                    $entradasSegundos[] = strtotime($t) - strtotime('TODAY');
                }
            }

            $entrada_promedio = null;

            if (count($entradasSegundos) > 0) {
                $avg = array_sum($entradasSegundos) / count($entradasSegundos);
                $entrada_promedio = gmdate("H:i:s", $avg);
            }

            /****************************************************************************************** */

            $salidas = [
                $salida_lunes,
                $salida_martes,
                $salida_miercoles,
                $salida_jueves,
                $salida_viernes,
                $salida_sabado,
                $salida_domingo,
                $salida_festivo,
            ];

            $salidasSegundos = [];

            foreach ($salidas as $t) {
                if (!empty($t) && $t !== "00:00:00") {
                    $salidasSegundos[] = strtotime($t) - strtotime('TODAY');
                }
            }

            $salida_promedio = null;

            if (count($salidasSegundos) > 0) {
                $avg = array_sum($salidasSegundos) / count($salidasSegundos);
                $salida_promedio = gmdate("H:i:s", $avg);
            }
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

            /****************************************************************************************** */

            $entradas = [
                $entrada_lunes,
                $entrada_martes,
                $entrada_miercoles,
                $entrada_jueves,
                $entrada_viernes,
                $entrada_sabado,
                $entrada_domingo,
                $entrada_festivo,
            ];

            // Convertir cada hora a segundos (ignorando NULL y 00:00:00)
            $entradasSegundos = [];

            foreach ($entradas as $t) {
                if (!empty($t) && $t !== "00:00:00") {
                    $entradasSegundos[] = strtotime($t) - strtotime('TODAY');
                }
            }

            $entrada_promedio = null;

            if (count($entradasSegundos) > 0) {
                $avg = array_sum($entradasSegundos) / count($entradasSegundos);
                $entrada_promedio = gmdate("H:i:s", $avg);
            }

            /****************************************************************************************** */

            $salidas = [
                $salida_lunes,
                $salida_martes,
                $salida_miercoles,
                $salida_jueves,
                $salida_viernes,
                $salida_sabado,
                $salida_domingo,
                $salida_festivo,
            ];

            $salidasSegundos = [];

            foreach ($salidas as $t) {
                if (!empty($t) && $t !== "00:00:00") {
                    $salidasSegundos[] = strtotime($t) - strtotime('TODAY');
                }
            }

            $salida_promedio = null;

            if (count($salidasSegundos) > 0) {
                $avg = array_sum($salidasSegundos) / count($salidasSegundos);
                $salida_promedio = gmdate("H:i:s", $avg);
            }
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

            /****************************************************************************************** */

            $entradas = [
                $entrada_lunes,
                $entrada_martes,
                $entrada_miercoles,
                $entrada_jueves,
                $entrada_viernes,
                $entrada_sabado,
                $entrada_domingo,
                $entrada_festivo,
            ];

            // Convertir cada hora a segundos (ignorando NULL y 00:00:00)
            $entradasSegundos = [];

            foreach ($entradas as $t) {
                if (!empty($t) && $t !== "00:00:00") {
                    $entradasSegundos[] = strtotime($t) - strtotime('TODAY');
                }
            }

            $entrada_promedio = null;

            if (count($entradasSegundos) > 0) {
                $avg = array_sum($entradasSegundos) / count($entradasSegundos);
                $entrada_promedio = gmdate("H:i:s", $avg);
            }

            /****************************************************************************************** */

            $salidas = [
                $salida_lunes,
                $salida_martes,
                $salida_miercoles,
                $salida_jueves,
                $salida_viernes,
                $salida_sabado,
                $salida_domingo,
                $salida_festivo,
            ];

            $salidasSegundos = [];

            foreach ($salidas as $t) {
                if (!empty($t) && $t !== "00:00:00") {
                    $salidasSegundos[] = strtotime($t) - strtotime('TODAY');
                }
            }

            $salida_promedio = null;

            if (count($salidasSegundos) > 0) {
                $avg = array_sum($salidasSegundos) / count($salidasSegundos);
                $salida_promedio = gmdate("H:i:s", $avg);
            }
        }

        // ROLADOR

        elseif($request->jornada == 10)
        {
            $entrada_lunes = $request->entrada_lunes;
            $salida_lunes = $request->salida_lunes;
            $entrada_martes = $request->entrada_martes;
            $salida_martes = $request->salida_martes;
            $entrada_miercoles = $request->entrada_miercoles;
            $salida_miercoles = $request->salida_miercoles;
            $entrada_jueves = $request->entrada_jueves;
            $salida_jueves = $request->salida_jueves;
            $entrada_viernes = $request->entrada_viernes;
            $salida_viernes = $request->salida_viernes;
            $entrada_sabado = $request->entrada_sabado;
            $salida_sabado = $request->salida_sabado;
            $entrada_domingo = $request->entrada_domingo;
            $salida_domingo = $request->salida_domingo;
            $entrada_festivo = $request->entrada_festivo;
            $salida_festivo =$request->salida_festivo;

            $label_jornada = "Rolador";

            /****************************************************************************************** */

            $entradas = [
                $entrada_lunes,
                $entrada_martes,
                $entrada_miercoles,
                $entrada_jueves,
                $entrada_viernes,
                $entrada_sabado,
                $entrada_domingo,
                $entrada_festivo,
            ];

            // Convertir cada hora a segundos (ignorando NULL y 00:00:00)
            $entradasSegundos = [];

            foreach ($entradas as $t) {
                if (!empty($t) && $t !== "00:00:00") {
                    $entradasSegundos[] = strtotime($t) - strtotime('TODAY');
                }
            }

            $entrada_promedio = null;

            if (count($entradasSegundos) > 0) {
                $avg = array_sum($entradasSegundos) / count($entradasSegundos);
                $entrada_promedio = gmdate("H:i:s", $avg);
            }

            /****************************************************************************************** */

            $salidas = [
                $salida_lunes,
                $salida_martes,
                $salida_miercoles,
                $salida_jueves,
                $salida_viernes,
                $salida_sabado,
                $salida_domingo,
                $salida_festivo,
            ];

            $salidasSegundos = [];

            foreach ($salidas as $t) {
                if (!empty($t) && $t !== "00:00:00") {
                    $salidasSegundos[] = strtotime($t) - strtotime('TODAY');
                }
            }

            $salida_promedio = null;

            if (count($salidasSegundos) > 0) {
                $avg = array_sum($salidasSegundos) / count($salidasSegundos);
                $salida_promedio = gmdate("H:i:s", $avg);
            }
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

            $entrada_promedio = NULL;
            $salida_promedio = NULL;

            $label_jornada = "ERROR - VALIDACION DE JORNADA";


        }
        
        $horario_status = 1;
        
        // Buscamos el registro

        $horario = ProfesionalHorario::findOrFail($id);
        
        // Buscamos al profesional
        $profesional = Profesional::where('id', $horario->id_profesional)->first();

        $horario->id_jornada = $request->jornada;
        $horario->jornada = $label_jornada;
        $horario->jornada_mexico = $jornadaMexico->jornada_mexico;

        $horario->entrada_promedio = $entrada_promedio;
        $horario->salida_promedio = $salida_promedio;

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
        
    }
}
