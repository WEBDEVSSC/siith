<?php

namespace App\Exports;

use App\Models\Profesional;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ProfesionalesRiesgosEstatalExport implements FromView, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
     public function view(): View
    {
        $profesionales = Profesional::with([
            'puesto',
            'horario',
            'credencializacion',
            'sueldo',
            'gradoAcademico',
            'areaMedica',
            'certificacion'
        ])
        ->whereRelation('puesto', 'vigencia', 'ACTIVO')
        ->whereHas('puesto', function($q) {
            $q->whereIn('nomina_pago', [
                'FED - Federal (Unidad 420)',
                'FOR - Formalizado 1',
                'FO2 - Formalizado 2',
                'FO3 - Formalizado 3',
                'REG - Regularizado',
            ]);
        })
        ->get();

         return view('export.profesionales-riesgos-estatal-export', [
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

            // Estilo para el modulo de PUESTO
            'I1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A8D5BA']]],
            'J1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A8D5BA']]],
            'K1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A8D5BA']]],
            'L1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A8D5BA']]],
            'M1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A8D5BA']]],
            'N1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A8D5BA']]],
            'O1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A8D5BA']]],
            'P1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A8D5BA']]],

            // Estilo para el modulo de GRADO ACADEMICO
            'Q1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '8A98A6']]],
            'R1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '8A98A6']]],
            'S1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '8A98A6']]],
            'T1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '8A98A6']]],
            'U1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '8A98A6']]],
            'V1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '8A98A6']]],
            'W1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '8A98A6']]],
            'X1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '8A98A6']]],
            'Y1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '8A98A6']]],
            'Z1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '8A98A6']]],
            'AA1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '8A98A6']]],
            'AB1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '8A98A6']]],

            // Estilo para el modulo de HORARIOS
            'AC1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6BA66B']]],
            'AD1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6BA66B']]],
            'AE1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6BA66B']]],
            'AF1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6BA66B']]],
            'AG1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6BA66B']]],
            'AH1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6BA66B']]],
            'AI1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6BA66B']]],
            'AJ1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6BA66B']]],
            'AK1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6BA66B']]],
            'AL1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6BA66B']]],
            'AM1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6BA66B']]],
            'AN1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6BA66B']]],
            'AO1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6BA66B']]],
            'AP1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6BA66B']]],
            'AQ1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6BA66B']]],
            'AR1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6BA66B']]],
            'AS1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6BA66B']]],
            'AT1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6BA66B']]],
            'AU1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6BA66B']]],
            'AV1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6BA66B']]],
            'AW1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6BA66B']]],
            'AX1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6BA66B']]],
            'AY1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6BA66B']]],
            'AZ1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6BA66B']]],
            'BA1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6BA66B']]],
            

            

            

        ];
    }
}
