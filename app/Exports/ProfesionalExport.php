<?php

namespace App\Exports;

use App\Models\Profesional;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;

use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ProfesionalExport implements FromView, WithStyles
{

    public function view(): View
    {
        // Consultamos todos los profesionales con sus relaciones (puesto y horario)
        $profesionales = Profesional::with(['puesto', 'horario', 'sueldo', 'gradoAcademico', 'areaMedica'])->get();

        // Pasamos los datos a la vista
        return view('export.profesionales-export', [
            'profesionales' => $profesionales
        ]);
    }

    public function styles(Worksheet $sheet)
    {
        return [
            
            // Estilo para la columna ID
            'A1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'D3D3D3']]],

            // Estilo para el modulo de DATOS GENERALES
            'B1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A7C7E7']]],
            'C1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A7C7E7']]],
            'D1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A7C7E7']]],
            'E1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A7C7E7']]],
            'F1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A7C7E7']]],
            'G1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A7C7E7']]],
            'H1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A7C7E7']]],
            'I1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A7C7E7']]],
            'J1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A7C7E7']]],
            'K1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A7C7E7']]],
            'L1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A7C7E7']]],
            'M1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A7C7E7']]],
            'N1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A7C7E7']]],
            'O1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A7C7E7']]],
            'P1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A7C7E7']]],
            'Q1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A7C7E7']]],

            // Estilo para el modulo de PUESTO
            'R1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A8D5BA']]],
            'S1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A8D5BA']]],
            'T1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A8D5BA']]],
            'U1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A8D5BA']]],
            'V1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A8D5BA']]],
            'W1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A8D5BA']]],
            'X1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A8D5BA']]],
            'Y1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A8D5BA']]],
            'Z1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A8D5BA']]],
            'AA1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A8D5BA']]],
            'AB1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A8D5BA']]],
            'AC1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A8D5BA']]],
            'AD1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A8D5BA']]],
            'AE1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A8D5BA']]],
            'AF1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A8D5BA']]],
            'AG1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A8D5BA']]],
            'AH1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A8D5BA']]],
            'AI1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A8D5BA']]],
            'AJ1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A8D5BA']]],
            'AK1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A8D5BA']]],
            'AL1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A8D5BA']]],
            'AM1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A8D5BA']]],

            // Estilo para el modulo de HORARIOS
            'AN1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6C7A89']]],
            'AO1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6C7A89']]],
            'AP1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6C7A89']]],
            'AQ1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6C7A89']]],
            'AR1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6C7A89']]],
            'AS1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6C7A89']]],
            'AT1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6C7A89']]],
            'AU1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6C7A89']]],
            'AV1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6C7A89']]],

            // Estilo para el modulo de CREDENCIALIZACION
            'AW1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'F1C40F']]],

            // Estilo para el modulo de SUELDO
            'AX1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'C7D36F']]],
            'AY1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'C7D36F']]],
            'AZ1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'C7D36F']]],
            'BA1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'C7D36F']]],
            'BB1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'C7D36F']]],
            'BC1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'C7D36F']]],

            // Estilo para el modulo de GRADO ACADEMICO
            'BD1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '8A98A6']]],
            'BE1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '8A98A6']]],
            'BF1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '8A98A6']]],
            'BG1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '8A98A6']]],
            'BH1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '8A98A6']]],
            'BI1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '8A98A6']]],
            'BJ1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '8A98A6']]],
            'BK1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '8A98A6']]],

            //Estilos para el modulo de AREA MEDICA
            'BL1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A66B6B']]],
            'BM1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A66B6B']]],
            'BN1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A66B6B']]],
            'BO1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A66B6B']]],
            'BP1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A66B6B']]],
            'BQ1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A66B6B']]],
            'BR1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A66B6B']]],
            'BS1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A66B6B']]],
            'BT1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A66B6B']]],

        ];
    }

}
