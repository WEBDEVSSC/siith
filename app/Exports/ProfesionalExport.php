<?php

namespace App\Exports;

use App\Models\Profesional;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;

use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ProfesionalExport implements FromView, WithStyles, WithColumnFormatting
{

    public function columnFormats(): array
    {
        return [
            'D' => NumberFormat::FORMAT_TEXT, // Columna de homoclave en tu Excel
            'C' => NumberFormat::FORMAT_TEXT, // Si quieres también proteger RFC
            'B' => NumberFormat::FORMAT_TEXT, // Si CURP va como texto
        ];
    }
    
    public function view(): View
    {
        // Cargamos los datos del usuario que inicio sesion
        $user = Auth::user();

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
            // Catalogo 6 - Oficina Central
            elseif ($user->role == 'ofCentral') 
            {
                //$query->where('clues_adscripcion', 'CLSSA002093');
                $query->whereHas('profesional.puesto', function ($q) {
                    $q->whereIn('clues_adscripcion', ['CLSSA002093','CLSSA009997','CLSSA009996','CLSSA009995','CLSSA009994','CLSSA009993','CLSSA009992','CLSSA009991','CLSSA009990','CLSSA002093-SC']);
                });
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
            elseif ($user->role == 'psiParras') 
            {
                $query->where('clues_adscripcion', 'CLSSA000832');
            }
            elseif ($user->role == 'cets') 
            {
                $query->where('clues_adscripcion', 'CLSSA002076');
            }
            elseif ($user->role == 'lesp') 
            {
                $query->where('clues_adscripcion', 'CLSSA002052');
            }
            elseif ($user->role == 'cesame') 
            {
                $query->where('clues_adscripcion', 'CLSSA001141');
            }
            elseif ($user->role == 'ceam') 
            {
                $query->where('clues_adscripcion', 'CLSSA002192');
            }
            elseif ($user->role == 'hospitalNino') 
            {
                $query->where('clues_adscripcion', 'CLSSA001136');
            }
            elseif ($user->role == 'csuyr') 
            {
                $query->where('clues_adscripcion', $user->clues_unidad);
            }
            elseif ($user->role !== 'admin') {

                $query->whereRaw('1 = 0'); 
            }
            else 
            {
                
            }
            
        });

        $profesionales = $profesionalesQuery->get();

        // Pasamos los datos a la vista
        return view('export.profesionales-export', [
            'profesionales' => $profesionales
        ]);
    }

    public function styles(Worksheet $sheet)
    {       

        return [

            // Estilo para la columna CONSECUTIVO
            'A1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'D3D3D3']]],
            'A2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'D3D3D3']]],

            // Estilo para el modulo de CREDENCIALIZACION
            'B1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A7C7E7']]],
            'B2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A7C7E7']]],

            // Estilo para el modulo de CATALOGO/CARTERA SERVICIOS (PRINCIPAL)
            'C1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A8D5BA']]],

            'C2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A8D5BA']]],
            'D2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A8D5BA']]],
            'E2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A8D5BA']]],
            'F2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A8D5BA']]],
            'G2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A8D5BA']]],
            'H2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A8D5BA']]],
            'I2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A8D5BA']]],
            'J2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A8D5BA']]],
            'K2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A8D5BA']]],
            'L2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A8D5BA']]],
            'M2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A8D5BA']]],
            'N2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A8D5BA']]],
            'O2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A8D5BA']]],
            
            'P1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '8CC7A3']]],
            'P2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '8CC7A3']]],
            'Q2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '8CC7A3']]],
            'R2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '8CC7A3']]],
            'S2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '8CC7A3']]],
            'T2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '8CC7A3']]],
            'U2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '8CC7A3']]],
            'V2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '8CC7A3']]],
            'W2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '8CC7A3']]],
            'X2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '8CC7A3']]],
            'Y2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '8CC7A3']]],
            'Z2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '8CC7A3']]],
            'AA2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '8CC7A3']]],
            
            // Estilo para el modulo de DATOS GENERALES
            'AB1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6C7A89']]],
            'AB2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6C7A89']]],
            'AC1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6C7A89']]],
            'AC2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6C7A89']]],
            'AD2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6C7A89']]],
            'AE2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6C7A89']]],
            'AF2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6C7A89']]],
            'AG2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6C7A89']]],
            'AH2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6C7A89']]],
            'AI2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6C7A89']]],
            'AJ2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6C7A89']]],
            'AK2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6C7A89']]],
            'AL2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6C7A89']]],
            'AM2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6C7A89']]],
            'AN1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6C7A89']]],
            'AN2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6C7A89']]],
            'AO2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6C7A89']]],
            'AP2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6C7A89']]],

            // Estilo para el modulo de PUESTO           
            'AQ1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'F1C40F']]],
            'AQ2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'F1C40F']]],
            'AR2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'F1C40F']]],
            'AS2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'F1C40F']]],
            'AT2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'F1C40F']]],
            'AU2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'F1C40F']]],
            'AV2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'F1C40F']]],
            'AW1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'F1C40F']]],
            'AW2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'F1C40F']]],
            'AX1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'F1C40F']]],
            'AX2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'F1C40F']]],
            'AY2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'F1C40F']]],
            'AZ2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'F1C40F']]],
            'BA2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'F1C40F']]],
            'BB2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'F1C40F']]],
            'BC2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'F1C40F']]],
            'BD1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'F1C40F']]],
            'BD2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'F1C40F']]],
            'BE2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'F1C40F']]],
            'BF2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'F1C40F']]],
            'BG2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'F1C40F']]],
            'BH2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'F1C40F']]],
            'BI2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'F1C40F']]],
            'BJ2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'F1C40F']]],
            'BK2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'F1C40F']]],
            'BL2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'F1C40F']]],

            //Estilos para el modulo de JORNADA LABORAL
            'BM1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '8A98A6']]],
            'BM2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '8A98A6']]],
            'BN2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '8A98A6']]],
            'BO2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '8A98A6']]],
            'BP2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '8A98A6']]],
            'BQ2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '8A98A6']]],
            'BR2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '8A98A6']]],
            'BS2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '8A98A6']]],
            'BT1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '8A98A6']]],
            'BT2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '8A98A6']]],
            'BU2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '8A98A6']]],
            'BV2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '8A98A6']]],
            'BW2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '8A98A6']]],

            //Estilos para el modulo de GRADO ACADEMICO
            'BX1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A66BA6']]],
            'BX2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A66BA6']]],

            // Estilos para el modulo de CERTIFICAION
            'BY1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A66BA6']]],
            'BY2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A66BA6']]],
            'BZ2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A66BA6']]],
            'CA2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A66BA6']]],
            'CB2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A66BA6']]],
            'CC2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A66BA6']]],
            'CD2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'A66BA6']]],
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

            // Estilos para el modulo de CERTIFICACIONES

            'CN1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '66BBA6']]],
            'CN2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '66BBA6']]],
            'CO2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '66BBA6']]],
            'CP2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '66BBA6']]],
            'CQ2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '66BBA6']]],
            'CR2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '66BBA6']]],
            'CS2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '66BBA6']]],

            // Estilos para el modulo de PERSONAL ESTUDIANDO ACTUALMENTE

            'CT1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'BB66A5']]],
            'CT2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'BB66A5']]],
            'CU2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'BB66A5']]],
            'CV2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'BB66A5']]],
            'CW2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'BB66A5']]],
            'CX2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'BB66A5']]],

            'CY1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6A66BB']]],
            'CY2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6A66BB']]],
            'CZ2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6A66BB']]],
            'DA2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6A66BB']]],
            'DB2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6A66BB']]],
            'DC2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6A66BB']]],

            // Estilos para el modulo de EMERGENCIAS
            'DD1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6A66BB']]],
            'DD2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6A66BB']]],
            'DE2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6A66BB']]],
            'DF2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6A66BB']]],
            'DG2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6A66BB']]],
            'DH2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6A66BB']]],
            'DI2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6A66BB']]],
            'DJ2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6A66BB']]],
            'DK2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6A66BB']]],
            'DL2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6A66BB']]],
            'DM2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6A66BB']]],
            'DN2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6A66BB']]],
            'DO2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6A66BB']]],
            'DP2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6A66BB']]],
            'DQ2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6A66BB']]],
            'DR2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6A66BB']]],
            'DS2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6A66BB']]],
            'DT2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6A66BB']]],
            'DU2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6A66BB']]],
            'DV2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6A66BB']]],
            'DW2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6A66BB']]],
            'DX2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6A66BB']]],
            'DY2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6A66BB']]],
            'DZ2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6A66BB']]],
            'EA2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6A66BB']]],
            'EB2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6A66BB']]],
            'EC2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6A66BB']]],
            'ED2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6A66BB']]],
            'EE2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6A66BB']]],
            'EF2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6A66BB']]],
            'EG2' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6A66BB']]],
    
        ];
    }

    

}
