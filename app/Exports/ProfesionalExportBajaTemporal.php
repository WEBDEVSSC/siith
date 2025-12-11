<?php

namespace App\Exports;

use App\Models\Profesional;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use Illuminate\Support\Facades\Auth;

use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ProfesionalExportBajaTemporal implements FromView, WithStyles
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
            $query->where('vigencia', 'BAJA TEMPORAL');

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
            elseif($user->role == 'ensenanza')
            {
                $query->whereHas('profesional.puesto', function ($q) {
                    $q->whereIn('nomina_pago', ['610 - Pasante en Servicio Social', '6MR - Médico Residente ','Pasante - Sin pago','PASANTE ENF. - BN']);
                });
            }
            elseif ($user->role == 'universitario') 
            {
                $query->where('clues_adscripcion', 'CLHUN000015');
            }
            elseif ($user->role == 'criCree') 
            {
                $query->whereHas('profesional.puesto', function ($q) {
                    $q->whereIn('clues_adscripcion', ['CLSSA009989','CLSSA009988','CLSSA009987','CLSSA009986','CLSSA009985']);
                });
            }
            elseif($user->role == 'samuCrum')
            {
                $query->whereHas('profesional.puesto', function ($q) {
                    $q->whereIn('clues_adscripcion', ['CLSSA009997','CLSSA009996','CLSSA009995','CLSSA009994','CLSSA009993','CLSSA009992','CLSSA009991','CLSSA009990','CLSSA002093-SC']);
                });
            }
            else 
            {
                // No mostrar nada
                $query->whereRaw('1 = 0');
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

            // Estilos para el modulo de OCUPACIONES
            'CE1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A66BA6']]],
            'CE2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A66BA6']]],
            'CF2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A66BA6']]],
            'CG2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A66BA6']]],
            'CH2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A66BA6']]],
            'CI2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A66BA6']]],
            'CJ2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A66BA6']]],
            'CK2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A66BA6']]],
            'CL2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A66BA6']]],
            'CM2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A66BA6']]],
            'CN2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A66BA6']]],
            'CO2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A66BA6']]],
            'CP2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A66BA6']]],
            'CQ2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A66BA6']]],
            'CR2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A66BA6']]],
            'CS2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A66BA6']]],
            'CT2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A66BA6']]],
            'CU2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A66BA6']]],
            'CV2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A66BA6']]],
            'CW2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A66BA6']]],
            'CX2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A66BA6']]],
            'CY2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A66BA6']]],
            'CZ2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A66BA6']]],
            'DA2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A66BA6']]],
            'DB2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A66BA6']]],
            'DC2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A66BA6']]],

            // Estilos para el modulo de EMERGENCIAS
            'DD1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6BA66B']]],
            'DD2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6BA66B']]],
            'DE2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6BA66B']]],
            'DF2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6BA66B']]],
            'DG2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6BA66B']]],
            'DH2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6BA66B']]],
            'DI2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6BA66B']]],
            'DJ2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6BA66B']]],
            'DK2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6BA66B']]],
            'DL2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6BA66B']]],
            'DM2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6BA66B']]],
            'DN2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6BA66B']]],
            'DO2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6BA66B']]],
            'DP2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6BA66B']]],
            'DQ2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6BA66B']]],
            'DR2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6BA66B']]],
            'DS2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6BA66B']]],
            'DT2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6BA66B']]],
            'DU2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6BA66B']]],
            'DV2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6BA66B']]],
            'DW2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6BA66B']]],
            'DX2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6BA66B']]],
            'DY2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6BA66B']]],
            'DZ2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6BA66B']]],
            'EA2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6BA66B']]],
            'EB2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6BA66B']]],
            'EC2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6BA66B']]],
            'ED2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6BA66B']]],
            'EE2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6BA66B']]],
            'EF2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6BA66B']]],
            'EG2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6BA66B']]],
            'EH2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6BA66B']]],
            'EI2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6BA66B']]],
            'EJ2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6BA66B']]],
            'EK2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6BA66B']]],
            'EL2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6BA66B']]],
        ];
    }

}
