<?php

namespace App\Http\Controllers;

use App\Models\Profesional;
use Illuminate\Http\Request;

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

        return view('home', compact(
            'profesionalesActivos',
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
        ));
    }
}
