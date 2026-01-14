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

            'G1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],
            'H1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],
            'I1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],
            'J1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],
            'K1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],
            'L1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],
            'M1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],

            'N1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],

            'O1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],
            'P1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],
            'Q1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],
            'R1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],
            'S1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],
            'T1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],

            'U1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],
            'V1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],
            'W1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],
            'X1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],
            'Y1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],
            'Z1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],

            'AA1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],
            'AB1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],

            'AC1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],
            'AD1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],
            'AE1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],
            'AF1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],

            'AG1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],
            'AH1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],
            'AI1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],
            'AJ1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],
            'AK1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],
            'AL1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],
            'AM1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],
            'AN1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],
            'AN1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],
            'AO1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],
            'AP1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],
            'AQ1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],
            'AR1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],
            'AS1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],
            'AT1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],
            'AU1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],
            'AV1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],
            'AX1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],
            'AY1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],
            'AW1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],
            'AZ1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],
            'BA1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],
            'BB1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],
            'BC1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],
            'BD1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],

            'BE1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],

            'BF1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],
            'BG1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],
            'BH1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],
            'BI1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],
            'BJ1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],
            'BK1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],

            'BL1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],
            'BM1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],
            'BN1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],
            'BO1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],

            'BP1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],
            'BQ1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],
            'BR1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],
            'BS1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],

            //Estilos para el modulo de AREA MEDICA
            'BT1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],
            'BT1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],
            'BU1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],
            'BV1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],
            'BW1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],
            'BX1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],

            // Estilos para el modulo de CERTIFICAION
            'BY1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],
            'BY1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],
            'BZ1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],
            'CA1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],
            'CB1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],
            'CC1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],
            'CD1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],
            'CE1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],
            'CF1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],
            'CG1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],
            'CH1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],
            'CI1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],
            'CJ1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],
            'CK1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],
            'CL1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],

            'CM1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],
            'CN1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],
            'CO1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],
            'CP1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],
            'CQ1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],
            'CR1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],
            'CS1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],
            'CT1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],
            'CU1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],
            'CV1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],
            'CW1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],
            'CX1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],
            'CY1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],
            'CZ1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],

            'DA1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],
            'DB1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],
            'DC1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],
            'DD1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],
            'DE1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],
            'DF1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],
            'DG1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],
            'DH1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '1E1A4D']]],

        ];
    }
}
