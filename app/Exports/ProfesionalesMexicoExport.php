<?php

namespace App\Exports;

use App\Models\Profesional;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ProfesionalesMexicoExport implements FromView, WithStyles
{
    public function view(): View
    {

        /*$profesionales = Profesional::with([
            'puesto', 
            'horario', 
            'sueldo', 
            'gradoAcademico', 
            'areaMedica', 
            
            'ocupacionCeam',
            'ocupacionAlmacen'
            ])
        ->whereHas('puesto', function ($query) {
            $query->where('vigencia', 'ACTIVO');
        })
        ->get();*/

        $profesionales = Profesional::with([
            'puesto', 
            'horario', 
            'sueldo', 
            'gradoAcademico', 
            'areaMedica', 
            'ocupacionCeam',
            'ocupacionAlmacen'
        ])->get();

        // Pasamos los datos a la vista
        return view('export.profesionales-mexico-export', ['profesionales' => $profesionales]);
    }

    public function styles(Worksheet $sheet)
    {
        return [

            'A1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],
            'B1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],
            'C1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],
            'D1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],
            'E1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],
            'F1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],

            'G1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'FB2C36']]],
            'H1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'FB2C36']]],
            'I1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'FB2C36']]],
            'J1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'FB2C36']]],
            'K1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'FB2C36']]],
            'L1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'FB2C36']]],
            'M1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'FB2C36']]],

            'N1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],

            'O1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '432004']]],
            'P1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '432004']]],
            'Q1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '432004']]],
            'R1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '432004']]],
            'S1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '432004']]],
            'T1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '432004']]],

            'U1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'FB2C36']]],
            'V1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'FB2C36']]],
            'W1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'FB2C36']]],
            'X1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'FB2C36']]],
            'Y1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'FB2C36']]],
            'Z1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'FB2C36']]],


            'AA1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '432004']]],
            'AB1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '432004']]],

            'AC1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'FB2C36']]],
            'AD1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'FB2C36']]],
            'AE1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'FB2C36']]],
            'AF1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'FB2C36']]],

            'AG1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '432004']]],
            'AH1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '432004']]],
            'AI1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '432004']]],
            'AJ1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '432004']]],
            'AK1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '432004']]],
            'AL1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '432004']]],
            'AM1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '432004']]],
            'AN1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '432004']]],
            'AN1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '432004']]],
            'AO1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '432004']]],
            'AP1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '432004']]],
            'AQ1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '432004']]],
            'AR1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '432004']]],
            'AS1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '432004']]],
            'AT1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '432004']]],
            'AU1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '432004']]],
            'AV1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '432004']]],
            'AX1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '432004']]],
            'AY1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '432004']]],
            'AW1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '432004']]],
            'AZ1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '432004']]],
            'BA1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '432004']]],
            'BB1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '432004']]],
            'BC1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '432004']]],
            'BD1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '432004']]],

            'BE1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '05DF72']]],

            'BF1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '9810FA']]],
            'BG1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '9810FA']]],
            'BH1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '9810FA']]],
            'BI1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '9810FA']]],
            'BJ1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '9810FA']]],
            'BK1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '9810FA']]],

            'BL2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '8A98A6']]],
            'BM2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '8A98A6']]],
            'BN2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '8A98A6']]],
            'BO2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '8A98A6']]],

            'BP2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '8A98A6']]],
            'BQ2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '8A98A6']]],
            'BR2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '8A98A6']]],
            'BS2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '8A98A6']]],

            //Estilos para el modulo de AREA MEDICA
            'BT1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A66B6B']]],
            'BT2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A66B6B']]],
            'BU2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A66B6B']]],
            'BV2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A66B6B']]],
            'BW2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A66B6B']]],
            'BX2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A66B6B']]],

            // Estilos para el modulo de CERTIFICAION
            'BY1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6BA66B']]],
            'BY2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6BA66B']]],
            'BZ2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6BA66B']]],
            'CA2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6BA66B']]],
            'CB2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6BA66B']]],
            'CC2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6BA66B']]],
            'CD2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6BA66B']]],

        ];
    }
}
