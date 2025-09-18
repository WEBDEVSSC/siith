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

        $nominaIssreei = Profesional::whereRelation('puesto', 'nomina_pago', 'ISSREEI - Nomina')
            ->whereRelation('puesto', 'vigencia', 'ACTIVO')
            ->count();

        $nominaUmmFam = Profesional::whereRelation('puesto', 'nomina_pago', 'UMM - FAM')
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

        return view('home', compact(
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

        ));
    }
}
