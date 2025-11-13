<?php

namespace App\Http\Controllers;

use App\Models\Profesional;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Contador para el total de registro activos
        $profesionalesActivos = Profesional::whereRelation('puesto', 'vigencia', 'ACTIVO')->count();

        $profesionalesBajaTemporal = Profesional::whereRelation('puesto', 'vigencia', 'BAJA TEMPORAL')->count();

        $profesionalesActivosMasculino = Profesional::where('sexo','M')
                ->whereRelation('puesto', 'vigencia', 'ACTIVO')
                ->count();

        $profesionalesActivosFemenino = Profesional::where('sexo','F')
                ->whereRelation('puesto', 'vigencia', 'ACTIVO')
                ->count();

        // CONTADOR PARA EL PERSONAL DE JURISDICCION 1
        $profesionalesJurisdiccion1 = Profesional::whereRelation('puesto', 'clues_adscripcion_jurisdiccion', '1')
        ->whereRelation('puesto', 'vigencia', 'ACTIVO')
        ->count();

        $profesionalesJurisdiccion2 = Profesional::whereRelation('puesto', 'clues_adscripcion_jurisdiccion', '2')
        ->whereRelation('puesto', 'vigencia', 'ACTIVO')
        ->count();

        $profesionalesJurisdiccion3 = Profesional::whereRelation('puesto', 'clues_adscripcion_jurisdiccion', '3')
        ->whereRelation('puesto', 'vigencia', 'ACTIVO')
        ->count();

        $profesionalesJurisdiccion4 = Profesional::whereRelation('puesto', 'clues_adscripcion_jurisdiccion', '4')
        ->whereRelation('puesto', 'vigencia', 'ACTIVO')
        ->count();

        $profesionalesJurisdiccion5 = Profesional::whereRelation('puesto', 'clues_adscripcion_jurisdiccion', '5')
        ->whereRelation('puesto', 'vigencia', 'ACTIVO')
        ->count();

        $profesionalesJurisdiccion6 = Profesional::whereRelation('puesto', 'clues_adscripcion_jurisdiccion', '6')
        ->whereRelation('puesto', 'vigencia', 'ACTIVO')
        ->count();

        $profesionalesJurisdiccion7 = Profesional::whereRelation('puesto', 'clues_adscripcion_jurisdiccion', '7')
        ->whereRelation('puesto', 'vigencia', 'ACTIVO')
        ->count();

        $profesionalesJurisdiccion8 = Profesional::whereRelation('puesto', 'clues_adscripcion_jurisdiccion', '8')
        ->whereRelation('puesto', 'vigencia', 'ACTIVO')
        ->count();

        $profesionalesJurisdiccion9 = Profesional::whereRelation('puesto', 'clues_adscripcion_jurisdiccion', '9')
        ->whereRelation('puesto', 'vigencia', 'ACTIVO')
        ->count();

        // CONTADOR PARA GRAFICA DE TIPO DE NOMINA
        $nominaRegularizado = Profesional::whereRelation('puesto', 'nomina_pago', 'REG - Regularizado')
            ->whereRelation('puesto', 'vigencia', 'ACTIVO')
            ->count();

        $nominaFormalizadoUno = Profesional::whereRelation('puesto', 'nomina_pago', 'FOR - Formalizado 1')
            ->whereRelation('puesto', 'vigencia', 'ACTIVO')
            ->count();

        $nominaFormalizadoDos = Profesional::whereRelation('puesto', 'nomina_pago', 'FO2 - Formalizado 2')
            ->whereRelation('puesto', 'vigencia', 'ACTIVO')
            ->count();

        $nominaFormalizadoTres = Profesional::whereRelation('puesto', 'nomina_pago', 'FO3 - Formalizado 3')
            ->whereRelation('puesto', 'vigencia', 'ACTIVO')
            ->count();

        $nominaPasanteServicioSocial = Profesional::whereRelation('puesto', 'nomina_pago', '610 - Pasante en Servicio Social')
            ->whereRelation('puesto', 'vigencia', 'ACTIVO')
            ->count();

        $nominaMedicoResidente = Profesional::whereRelation('puesto', 'nomina_pago', '6MR - Médico Residente')
            ->whereRelation('puesto', 'vigencia', 'ACTIVO')
            ->count();

        $nominaFederal420 = Profesional::whereRelation('puesto', 'nomina_pago', 'FED - Federal (Unidad 420)')
            ->whereRelation('puesto', 'vigencia', 'ACTIVO')
            ->count();

        $nominaEventual = Profesional::whereRelation('puesto', 'nomina_pago', 'EVE - Eventual')
            ->whereRelation('puesto', 'vigencia', 'ACTIVO')
            ->count();

        $nominaHomogado = Profesional::whereRelation('puesto', 'nomina_pago', 'HOM - Homologado')
            ->whereRelation('puesto', 'vigencia', 'ACTIVO')
            ->count();

        $nominaBurocrata = Profesional::whereRelation('puesto', 'nomina_pago', 'BUR - Burócrata')
            ->whereRelation('puesto', 'vigencia', 'ACTIVO')
            ->count();

        $nominaImssBienestar = Profesional::whereRelation('puesto', 'nomina_pago', 'IB - IMSS-BIENESTAR')
            ->whereRelation('puesto', 'vigencia', 'ACTIVO')
            ->count();

        $nominaUnemes = Profesional::whereRelation('puesto', 'nomina_pago', 'UNE - UNEMES')
            ->whereRelation('puesto', 'vigencia', 'ACTIVO')
            ->count();

        $nominaDifPs = Profesional::whereRelation('puesto', 'nomina_pago', 'DIF PS')
            ->whereRelation('puesto', 'vigencia', 'ACTIVO')
            ->count();

        $nominaDifOc = Profesional::whereRelation('puesto', 'nomina_pago', 'DIF O.F. CENTRAL')
            ->whereRelation('puesto', 'vigencia', 'ACTIVO')
            ->count();

        $nominaRamoDoce = Profesional::whereRelation('puesto', 'nomina_pago', 'Ramo 12')
            ->whereRelation('puesto', 'vigencia', 'ACTIVO')
            ->count();
        
        $nominaPasanteSinPago = Profesional::whereRelation('puesto', 'nomina_pago', 'Pasante - Sin pago')
            ->whereRelation('puesto', 'vigencia', 'ACTIVO')
            ->count();

        $nominaHonorarios = Profesional::whereRelation('puesto', 'nomina_pago', 'HON - Honorarios')
            ->whereRelation('puesto', 'vigencia', 'ACTIVO')
            ->count();

        $nominaIssreei = Profesional::whereRelation('puesto', 'nomina_pago', 'ISSREEI - Nómina')
            ->whereRelation('puesto', 'vigencia', 'ACTIVO')
            ->count();

        $nominaUmmFam = Profesional::whereRelation('puesto', 'nomina_pago', 'FAM - UMM - IMSS B.')
            ->whereRelation('puesto', 'vigencia', 'ACTIVO')
            ->count();

        // GRAFICA POR TIPO DE CONTRATO
        $contratoConfianza = Profesional::whereRelation('puesto', 'tipo_contrato', 'CONFIANZA')
            ->whereRelation('puesto', 'vigencia', 'ACTIVO')
            ->count();

        $contratoBase = Profesional::whereRelation('puesto', 'tipo_contrato', 'BASE')
            ->whereRelation('puesto', 'vigencia', 'ACTIVO')
            ->count();

        $contratoEventual = Profesional::whereRelation('puesto', 'tipo_contrato', 'EVENTUAL')
            ->whereRelation('puesto', 'vigencia', 'ACTIVO')
            ->count();

        $contratoHonorarios = Profesional::whereRelation('puesto', 'tipo_contrato', 'HONORARIOS')
            ->whereRelation('puesto', 'vigencia', 'ACTIVO')
            ->count();

        $contratoBecas = Profesional::whereRelation('puesto', 'tipo_contrato', 'BECAS')
            ->whereRelation('puesto', 'vigencia', 'ACTIVO')
            ->count();

        $contratoOtros = Profesional::whereRelation('puesto', 'tipo_contrato', 'OTROS')
            ->whereRelation('puesto', 'vigencia', 'ACTIVO')
            ->count();

        // GRAFICA POR EDADES
        $hoy = Carbon::now();

        $edadMenor20 = Profesional::where('fecha_nacimiento', '>', $hoy->copy()->subYears(20))
            ->whereRelation('puesto', 'vigencia', 'ACTIVO')
            ->count();

        $edad20a29 = Profesional::whereBetween('fecha_nacimiento', [
            $hoy->copy()->subYears(30),
            $hoy->copy()->subYears(20)->subDay()
        ])
        ->whereRelation('puesto', 'vigencia', 'ACTIVO')
        ->count();

        $edad30a39 = Profesional::whereBetween('fecha_nacimiento', [
            $hoy->copy()->subYears(40),
            $hoy->copy()->subYears(30)->subDay()
        ])
        ->whereRelation('puesto', 'vigencia', 'ACTIVO')
        ->count();

        $edad40a49 = Profesional::whereBetween('fecha_nacimiento', [
            $hoy->copy()->subYears(50),
            $hoy->copy()->subYears(40)->subDay()
        ])
        ->whereRelation('puesto', 'vigencia', 'ACTIVO')
        ->count();

        $edad50a59 = Profesional::whereBetween('fecha_nacimiento', [
            $hoy->copy()->subYears(60),
            $hoy->copy()->subYears(50)->subDay()
        ])
        ->whereRelation('puesto', 'vigencia', 'ACTIVO')
        ->count();

        $edad60a69 = Profesional::whereBetween('fecha_nacimiento', [
            $hoy->copy()->subYears(70),
            $hoy->copy()->subYears(60)->subDay()
        ])
        ->whereRelation('puesto', 'vigencia', 'ACTIVO')
        ->count();

        $edad70a79 = Profesional::whereBetween('fecha_nacimiento', [
            $hoy->copy()->subYears(80),
            $hoy->copy()->subYears(70)->subDay()
        ])
        ->whereRelation('puesto', 'vigencia', 'ACTIVO')
        ->count();

        $edad80a89 = Profesional::whereBetween('fecha_nacimiento', [
            $hoy->copy()->subYears(90),
            $hoy->copy()->subYears(80)->subDay()
        ])
        ->whereRelation('puesto', 'vigencia', 'ACTIVO')
        ->count();

        /*
        *
        *
        * CONSULTAS PARA UNIDADES
        *
        *
        */

        $usuario = Auth::user();

        // Contador para el total de registro activos
        $profesionalesActivosUnidad = Profesional::whereRelation('puesto', 'vigencia', 'ACTIVO')
                ->whereRelation('puesto', 'clues_adscripcion', $usuario->clues_unidad)
                ->count();

        $profesionalesBajaTemporalUnidad = Profesional::whereRelation('puesto', 'vigencia', 'BAJA TEMPORAL')
                ->whereRelation('puesto', 'clues_adscripcion', $usuario->clues_unidad)
                ->count();

        $profesionalesActivosMasculinoUnidad = Profesional::where('sexo','M')
                ->whereRelation('puesto', 'vigencia', 'ACTIVO')
                ->whereRelation('puesto', 'clues_adscripcion', $usuario->clues_unidad)
                ->count();

        $profesionalesActivosFemeninoUnidad = Profesional::where('sexo','F')
                ->whereRelation('puesto', 'vigencia', 'ACTIVO')
                ->whereRelation('puesto', 'clues_adscripcion', $usuario->clues_unidad)
                ->count();

        $hoy = Carbon::today();

        $profesionalesHonomastico = Profesional::whereMonth('fecha_nacimiento', $hoy->month)
            ->whereDay('fecha_nacimiento', $hoy->day)
            ->whereRelation('puesto', 'vigencia', 'ACTIVO')
            ->whereRelation('puesto', 'clues_adscripcion', $usuario->clues_unidad)
            ->get();

        // CONSULTAS PARA GRAFICA DE RAMAS

        $ramaPersonalEnFormacion = Profesional::whereRelation('puesto', function($query) {
            $query->whereIn('codigo', ['AM98572', 'EP98572', 'EP98582', 'EP98592', 'IP98510', 'M04001','M04002','M04003', 'M04004', 'MP98512', 'MP98522', 'MP98532', 'OP98542', 'OP98552', 'OP98562', 'R12033'])
              ->where('vigencia', 'ACTIVO');
        })
        ->count();

        $ramaAdministrativa = Profesional::whereRelation('puesto', function ($query) {
            $query->whereIn('codigo', ['ATO0216', 'ATO0301', 'ATO0616', 'ATO0701', 'ATO0703', 'ATO1001', 'CF01030', 'CF21135', 'CF21905', 'CF34068', 'CF34245', 'CF34260', 'CF34261', 'CF34263', 'CF40002', 'CF40003', 'CF40004', 'CF41001', 'CF41004', 'CF41006', 'CF41007', 'CF41011', 'CF41013', 'CF41014', 'CF52254', 'CF53083', 'CFOA001', 'DAC0001', 'DGA0001', 'M01004', 'M03005', 'M03018', 'M03019', 'M03020', 'M03021', 'M03022', 'M03023', 'M03024', 'M03025', 'MM01001', 'MM02001', 'MM04001', 'MM05001', 'MM06001', 'MM07001', 'MMS0301', 'MMS0401', 'MMS0101', 'SO08001', 'SO08803', 'SO08805', 'SO10801', 'SO16801', 'SSA0001', 'SSB0001', 'AD01', 'AD02', 'MM01', 'MM05'])
                ->where('vigencia', 'ACTIVO');
        })
        ->count();

        $ramaAFin = Profesional::whereRelation('puesto', function($query) {
            $query->whereIn('codigo', ['MM01', 'ATO0502', 'ATO0702', 'CF01030', 'CF41015','CF41016','CF41038','CF41040','CF41059','CF41060','CF41061','CF41062','CF41063','CF41064','CF41065','CF41074','M02047','M02072','M02112','M03002','M03004','M03005','M03006','M03009','M03010','M03011','M03012','M03013','M03025',])
            ->where('vigencia', 'ACTIVO');
        })
        ->count();

        $ramaEnfermeria = Profesional::whereRelation('puesto', function($query) {
            $query->whereIn('codigo', ['ATO0311','ATO0411','ATO1011','CF41024','CF41052','M02031','M02032','M02034','M02035','M02036','M02081','M02082','M02087','M02105','M02107','SO08017',])
            ->where('vigencia', 'ACTIVO');
        })
        ->count();

        $ramaMedica = Profesional::whereRelation('puesto', function($query) {
            $query->whereIn('codigo', ['MM07','ATO0123','CF41001','CFOA001','M01003','M01004','M01006','M01007','M01008','M01009','M01010','M01011','M01015','M03001','MM02001','MM06001','MMS0401',])
            ->where('vigencia', 'ACTIVO');
        })
        ->count();

        $ramaParamedica = Profesional::whereRelation('puesto', function($query) {
            $query->whereIn('codigo', ['ATO0313','ATO0509','ATO0609','CF41018','CF41030','CF41031','CF41032','CF41054','CF41056','CF41057','CF41058','CF41075','CF41076','M01006','M02001','M02003','M02006','M02009','M02011','M02012','M02015','M02016','M02029','M02037','M02038','M02040','M02042','M02043','M02044','M02045','M02046','M02047','M02048','M02049','M02050','M02055','M02057','M02058','M02059','M02060','M02061','M02066','M02068','M02069','M02073','M02074','M02076','M02077','M02078','M02085','M02086','M02088','M02089','M02090','M02091','M02095','M02097','M02110','MM04001','MM05001','SO08043',])
            ->where('vigencia', 'ACTIVO');
        })
        ->count();

        // -----------------------------------------------------------------------------------------------
        // ENSENANZA CONTADORES
        // -----------------------------------------------------------------------------------------------

        $contadorEnsenanza610 = Profesional::whereRelation('puesto', 'nomina_pago', '610 - Pasante en Servicio Social')
            ->whereRelation('puesto', 'vigencia', 'ACTIVO')
            ->count();

        $contadorEnsenanza6MR = Profesional::whereRelation('puesto', 'nomina_pago', '6MR - Médico Residente')
            ->whereRelation('puesto', 'vigencia', 'ACTIVO')
            ->count();

        $contadorEnsenanzaPSP = Profesional::whereRelation('puesto', 'nomina_pago', 'Pasante - Sin pago')
            ->whereRelation('puesto', 'vigencia', 'ACTIVO')
            ->count();

        $contadorEnsenanzaEnfIB = Profesional::whereRelation('puesto', 'nomina_pago', 'PASANTE ENF. - BN')
            ->whereRelation('puesto', 'vigencia', 'ACTIVO')
            ->count();
        
        $contadorEnsenanzaJ1 = Profesional::whereRelation('puesto', 'clues_adscripcion_jurisdiccion', '1')
            ->whereRelation('puesto', 'vigencia', 'ACTIVO')
            ->whereHas('puesto', function ($query) {
                $query->whereIn('nomina_pago', [
                    '610 - Pasante en Servicio Social',
                    '6MR - Médico Residente',
                    'Pasante - Sin pago',
                    'PASANTE ENF. - BN',
                ]);
            })
            ->count();   

        $contadorEnsenanzaJ2 = Profesional::whereRelation('puesto', 'clues_adscripcion_jurisdiccion', '2')
            ->whereRelation('puesto', 'vigencia', 'ACTIVO')
            ->whereHas('puesto', function ($query) {
                $query->whereIn('nomina_pago', [
                    '610 - Pasante en Servicio Social',
                    '6MR - Médico Residente',
                    'Pasante - Sin pago',
                    'PASANTE ENF. - BN',
                ]);
            })
            ->count();

        $contadorEnsenanzaJ3 = Profesional::whereRelation('puesto', 'clues_adscripcion_jurisdiccion', '3')
            ->whereRelation('puesto', 'vigencia', 'ACTIVO')
            ->whereHas('puesto', function ($query) {
                $query->whereIn('nomina_pago', [
                    '610 - Pasante en Servicio Social',
                    '6MR - Médico Residente',
                    'Pasante - Sin pago',
                    'PASANTE ENF. - BN',
                ]);
            })
            ->count();

        $contadorEnsenanzaJ4 = Profesional::whereRelation('puesto', 'clues_adscripcion_jurisdiccion', '4')
            ->whereRelation('puesto', 'vigencia', 'ACTIVO')
            ->whereHas('puesto', function ($query) {
                $query->whereIn('nomina_pago', [
                    '610 - Pasante en Servicio Social',
                    '6MR - Médico Residente',
                    'Pasante - Sin pago',
                    'PASANTE ENF. - BN',
                ]);
            })
            ->count();

        $contadorEnsenanzaJ5 = Profesional::whereRelation('puesto', 'clues_adscripcion_jurisdiccion', '5')
            ->whereRelation('puesto', 'vigencia', 'ACTIVO')
            ->whereHas('puesto', function ($query) {
                $query->whereIn('nomina_pago', [
                    '610 - Pasante en Servicio Social',
                    '6MR - Médico Residente',
                    'Pasante - Sin pago',
                    'PASANTE ENF. - BN',
                ]);
            })
            ->count();

        $contadorEnsenanzaJ6 = Profesional::whereRelation('puesto', 'clues_adscripcion_jurisdiccion', '6')
            ->whereRelation('puesto', 'vigencia', 'ACTIVO')
            ->whereHas('puesto', function ($query) {
                $query->whereIn('nomina_pago', [
                    '610 - Pasante en Servicio Social',
                    '6MR - Médico Residente',
                    'Pasante - Sin pago',
                    'PASANTE ENF. - BN',
                ]);
            })
            ->count();

        $contadorEnsenanzaJ7 = Profesional::whereRelation('puesto', 'clues_adscripcion_jurisdiccion', '7')
            ->whereRelation('puesto', 'vigencia', 'ACTIVO')
            ->whereHas('puesto', function ($query) {
                $query->whereIn('nomina_pago', [
                    '610 - Pasante en Servicio Social',
                    '6MR - Médico Residente',
                    'Pasante - Sin pago',
                    'PASANTE ENF. - BN',
                ]);
            })
            ->count();

        $contadorEnsenanzaJ8 = Profesional::whereRelation('puesto', 'clues_adscripcion_jurisdiccion', '8')
            ->whereRelation('puesto', 'vigencia', 'ACTIVO')
            ->whereHas('puesto', function ($query) {
                $query->whereIn('nomina_pago', [
                    '610 - Pasante en Servicio Social',
                    '6MR - Médico Residente',
                    'Pasante - Sin pago',
                    'PASANTE ENF. - BN',
                ]);
            })
            ->count();

        $contadorEnsenanzaJ9 = Profesional::whereRelation('puesto', 'clues_adscripcion_jurisdiccion', '9')
            ->whereRelation('puesto', 'vigencia', 'ACTIVO')
            ->whereHas('puesto', function ($query) {
                $query->whereIn('nomina_pago', [
                    '610 - Pasante en Servicio Social',
                    '6MR - Médico Residente',
                    'Pasante - Sin pago',
                    'PASANTE ENF. - BN',
                ]);
            })
            ->count();

        /**
         * 
         * 
         * CONTADORES PARA SAMU
         *  
         * 
         */

        $totalSamu = Profesional::whereRelation('puesto', function($query) {
            $query->whereIn('clues_adscripcion', ['CLSSA009997','CLSSA009996','CLSSA009995','CLSSA009994','CLSSA009993','CLSSA009992','CLSSA009991','CLSSA009990','CLSSA002093-SC'])
            ->where('vigencia', 'ACTIVO');
        })
        ->count();

        // -----------------------------------------------------------------------------------------------

        return view('home', compact(

            'contadorEnsenanza610',
            'contadorEnsenanza6MR',
            'contadorEnsenanzaPSP',
            'contadorEnsenanzaEnfIB',
            'contadorEnsenanzaJ1',
            'contadorEnsenanzaJ2',
            'contadorEnsenanzaJ3',
            'contadorEnsenanzaJ4',
            'contadorEnsenanzaJ5',
            'contadorEnsenanzaJ6',
            'contadorEnsenanzaJ7',
            'contadorEnsenanzaJ8',
            'contadorEnsenanzaJ9',

            'profesionalesActivos',
            'profesionalesBajaTemporal',
            'profesionalesActivosMasculino',
            'profesionalesActivosFemenino',
            'profesionalesJurisdiccion1',
            'profesionalesJurisdiccion2',
            'profesionalesJurisdiccion3',
            'profesionalesJurisdiccion4',
            'profesionalesJurisdiccion5',
            'profesionalesJurisdiccion6',
            'profesionalesJurisdiccion7',
            'profesionalesJurisdiccion8',
            'profesionalesJurisdiccion9',

            'nominaRegularizado',
            'nominaFormalizadoUno',
            'nominaFormalizadoDos',
            'nominaFormalizadoTres',
            'nominaPasanteServicioSocial',
            'nominaMedicoResidente',
            'nominaFederal420',
            'nominaEventual',
            'nominaHomogado',
            'nominaBurocrata',
            'nominaImssBienestar',
            'nominaUnemes',
            'nominaDifOc',
            'nominaRamoDoce',
            'nominaPasanteSinPago',
            'nominaHonorarios',
            'nominaIssreei',
            'nominaUmmFam',
            'nominaDifPs',

            'contratoConfianza',
            'contratoBase',
            'contratoEventual',
            'contratoHonorarios',
            'contratoBecas',
            'contratoOtros',

            'edadMenor20',
            'edad20a29',
            'edad30a39',
            'edad40a49',
            'edad50a59',
            'edad60a69',
            'edad70a79',
            'edad80a89',

            'profesionalesActivosUnidad',
            'profesionalesBajaTemporalUnidad',
            'profesionalesActivosMasculinoUnidad',
            'profesionalesActivosFemeninoUnidad',
            'profesionalesHonomastico',

            'ramaPersonalEnFormacion',
            'ramaAdministrativa',
            'ramaAFin',
            'ramaEnfermeria',
            'ramaMedica',
            'ramaParamedica',

            'totalSamu'
        ));
    }
}
