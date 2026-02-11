<?php

namespace App\Http\Controllers;

use App\Models\Profesional;
use Illuminate\Http\Request;

class VinculacionController extends Controller
{
    //
   public function indexVYE()
    {
        $allende = Profesional::whereHas('puesto', function ($q) {
            $q->where('vigencia', 'ACTIVO')
            ->where('clues_adscripcion_municipio', 'ALLENDE');
        })->count();

        $guerrero = Profesional::whereHas('puesto', function ($q) {
            $q->where('vigencia', 'ACTIVO')
            ->where('clues_adscripcion_municipio', 'GUERRERO');
        })->count();

        $hidalgo = Profesional::whereHas('puesto', function ($q) {
            $q->where('vigencia', 'ACTIVO')
            ->where('clues_adscripcion_municipio', 'HIDALGO');
        })->count();

        $nava = Profesional::whereHas('puesto', function ($q) {
            $q->where('vigencia', 'ACTIVO')
            ->where('clues_adscripcion_municipio', 'NAVA');
        })->count();

        $piedrasNegras = Profesional::whereHas('puesto', function ($q) {
            $q->where('vigencia', 'ACTIVO')
            ->where('clues_adscripcion_municipio', 'PIEDRAS NEGRAS');
        })->count();

        $villaUnion = Profesional::whereHas('puesto', function ($q) {
            $q->where('vigencia', 'ACTIVO')
            ->where('clues_adscripcion_municipio', 'VILLA UNIÓN');
        })->count();
    
        $municipios = [
            // JURISDICCION 1 PIEDRAS NEGRAS
            'Allende' => ['color' => '#1F3A5F', 'total' => $allende],
            'Guerrero' => ['color' => '#1F3A5F', 'total' => $guerrero],
            'Hidalgo' => ['color' => '#1F3A5F', 'total' => $hidalgo],
            'Nava' => ['color' => '#1F3A5F', 'total' => $nava],
            'Piedras Negras' => ['color' => '#1F3A5F', 'total' => $piedrasNegras],
            'Villa Unión' => ['color' => '#1F3A5F', 'total' => $villaUnion],

            // JURISDICCION 2 ACUÑA
            'Acuña' => ['color' => '#E67E22', 'total' => 80],
            'Jiménez' => ['color' => '#E67E22', 'total' => 80],
            'Morelos' => ['color' => '#E67E22', 'total' => 80],
            'Zaragoza' => ['color' => '#E67E22', 'total' => 80],

            // JURISDICCION 3 SABINAS
            'Juárez' => ['color' => '#27AE60', 'total' => 80],
            'Múzquiz' => ['color' => '#27AE60  ', 'total' => 80],
            'Progreso' => ['color' => '#27AE60  ', 'total' => 80],
            'Sabinas' => ['color' => '#27AE60  ', 'total' => 80],
            'San Juan de Sabinas' => ['color' => '#27AE60  ', 'total' => 80],

            // JURISDICCION 4 MONCLOVA
            'Abasolo' => ['color' => '#8E44AD', 'total' => 80],
            'Candela' => ['color' => '#8E44AD', 'total' => 80],
            'Castaños' => ['color' => '#8E44AD', 'total' => 80],
            'Escobedo' => ['color' => '#8E44AD', 'total' => 80],
            'Frontera' => ['color' => '#8E44AD', 'total' => 80],
            'Monclova' => ['color' => '#8E44AD', 'total' => 80],
            'Nadadores' => ['color' => '#8E44AD', 'total' => 80],
            'San Buenaventura' => ['color' => '#8E44AD', 'total' => 80],

            // JURISDICCION 5 CUATRO CIENEGAS
            'Cuatro Ciénegas' => ['color' => '#C0392B', 'total' => 80],
            'Lamadrid' => ['color' => '#C0392B', 'total' => 80],
            'Ocampo' => ['color' => '#C0392B', 'total' => 80],
            'Sacramento' => ['color' => '#C0392B', 'total' => 80],
            'Sierra Mojada' => ['color' => '#C0392B', 'total' => 80],

            // JURISDICCION 6 TORREON
            'Matamoros' => ['color' => '#16A085', 'total' => 80],
            'Torreón' => ['color' => '#16A085', 'total' => 80],
            'Viesca' => ['color' => '#16A085', 'total' => 80],

            // JURISDICCION 7 FOC. I. MADERO
            'Francisco I. Madero' => ['color' => '#F1C40F', 'total' => 80],
            'San Pedro' => ['color' => '#F1C40F', 'total' => 80],

            // JURISDICCION 8 SALTILLO
            'Arteaga' => ['color' => '#2C3E50', 'total' => 80],
            'General Cepeda' => ['color' => '#2C3E50', 'total' => 80],
            'Parras' => ['color' => '#2C3E50', 'total' => 80],
            'Ramos Arizpe' => ['color' => '#2C3E50', 'total' => 80],
            'Saltillo' => ['color' => '#2C3E50', 'total' => 80],






        ];

        return view('vinculacion.index', compact('municipios'));
    }
}
