<?php

namespace App\Exports;

use App\Models\Profesional;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use Illuminate\Support\Facades\Auth;

use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ProfesionalExport implements FromView, WithStyles
{

    public function view(): View
    {
        // Cargamos los datos del usuario que inicio sesion
        $user = Auth::user();

        $userRol = $user->role;

        // Filtramos la consulta por el nivel del usuario

        $profesionalesQuery = Profesional::with([
            'puesto', 
            'horario', 
            'sueldo', 
            'gradoAcademico', 
            'areaMedica', 
            'ocupacionCeam',
            'ocupacionAlmacen'
        ]);

            $profesionalesQuery->whereHas('puesto', function ($query) use ($user) {
            $query->where('vigencia', 'ACTIVO');

            // Agregamos el filtro por rol

            // Catalogo 2 - Hospitales
            if ($user->role == 'hospital') 
            {
                $query->where('clues_adscripcion', $user->clues_unidad);
            }
            // Catalogo 3 - Oficina Jurisdiccional
            elseif ($user->role == 'ofJurisdiccional') 
            {
                $query->where('clues_adscripcion_jurisdiccion', $user->jurisdiccion_unidad);
            }
            // Catalogo 4 - CRI CREE
            elseif ($user->role == 'ofJurisdiccional') 
            {
                $query->where('clues_adscripcion_jurisdiccion', $user->jurisdiccion_unidad);
            }
            // Catalogo 6 - Oficina Central
            elseif ($user->role == 'ofCentral') 
            {
                $query->where('clues_adscripcion', 'CLSSA002093');
            }
            // Catalogo 7 - Almacen
            elseif ($user->role == 'almacen') 
            {
                $query->where('clues_adscripcion', 'CLSSA002064');
            }
            // Catalogo 9 - Oncologico
            elseif ($user->role == 'oncologico') 
            {
                $query->where('clues_adscripcion', 'CLSSA002932');
            }
        });

        $profesionales = $profesionalesQuery->get();

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
            'A2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'D3D3D3']]],

            // Estilo para el modulo de DATOS GENERALES
            'B1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A7C7E7']]],
            'B2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A7C7E7']]],
            'C2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A7C7E7']]],
            'D2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A7C7E7']]],
            'E2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A7C7E7']]],
            'F2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A7C7E7']]],
            'G2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A7C7E7']]],
            'H2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A7C7E7']]],
            'I2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A7C7E7']]],
            'J2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A7C7E7']]],
            'K2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A7C7E7']]],
            'L2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A7C7E7']]],
            'M2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A7C7E7']]],
            'N2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A7C7E7']]],
            'O2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A7C7E7']]],
            'P2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A7C7E7']]],
            'Q2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A7C7E7']]],

            // Estilo para el modulo de PUESTO
            'R1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A8D5BA']]],
            'R2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A8D5BA']]],
            'S2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A8D5BA']]],
            'T2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A8D5BA']]],
            'U2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A8D5BA']]],
            'V2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A8D5BA']]],
            'W2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A8D5BA']]],
            'X2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A8D5BA']]],
            'Y2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A8D5BA']]],
            'Z2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A8D5BA']]],
            'AA2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A8D5BA']]],
            'AB2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A8D5BA']]],
            'AC2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A8D5BA']]],
            'AD2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A8D5BA']]],
            'AE2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A8D5BA']]],
            'AF2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A8D5BA']]],
            'AG2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A8D5BA']]],
            'AH2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A8D5BA']]],
            'AI2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A8D5BA']]],
            'AJ2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A8D5BA']]],
            'AK2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A8D5BA']]],
            'AL2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A8D5BA']]],
            'AM2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A8D5BA']]],

            // Estilo para el modulo de HORARIOS
            'AN1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6C7A89']]],
            'AN2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6C7A89']]],
            'AO2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6C7A89']]],
            'AP2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6C7A89']]],
            'AQ2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6C7A89']]],
            'AR2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6C7A89']]],
            'AS2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6C7A89']]],
            'AT2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6C7A89']]],
            'AU2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6C7A89']]],
            'AV2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6C7A89']]],

            // Estilo para el modulo de CREDENCIALIZACION
            'AW1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'F1C40F']]],
            'AW2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'F1C40F']]],

            // Estilo para el modulo de SUELDO
            'AX1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'C7D36F']]],
            'AX2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'C7D36F']]],
            'AY2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'C7D36F']]],
            'AZ2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'C7D36F']]],
            'BA2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'C7D36F']]],
            'BB2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'C7D36F']]],
            'BC2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'C7D36F']]],

            // Estilo para el modulo de GRADO ACADEMICO
            'BD1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '8A98A6']]],
            'BD2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '8A98A6']]],
            'BE2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '8A98A6']]],
            'BF2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '8A98A6']]],
            'BG2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '8A98A6']]],
            'BH2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '8A98A6']]],
            'BI2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '8A98A6']]],
            'BJ2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '8A98A6']]],
            'BK2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '8A98A6']]],

            //Estilos para el modulo de AREA MEDICA
            'BL1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A66B6B']]],
            'BL2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A66B6B']]],
            'BM2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A66B6B']]],
            'BN2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A66B6B']]],
            'BO2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A66B6B']]],
            'BP2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A66B6B']]],

            // Estilos para el modulo de CERTIFICAION
            'BQ1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6BA66B']]],
            'BQ2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6BA66B']]],
            'BR2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6BA66B']]],
            'BS2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6BA66B']]],
            'BT2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6BA66B']]],
            'BU2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6BA66B']]],
            'BV2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6BA66B']]],

            // Estilos para el modulo de OCUPACIONES
            'BW1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A66BA6']]],
            'BW2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A66BA6']]],
        ];
    }

}
