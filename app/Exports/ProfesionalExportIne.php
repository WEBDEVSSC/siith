<?php

namespace App\Exports;

use App\Models\Profesional;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ProfesionalExportIne implements FromView, WithStyles, ShouldAutoSize
{
    public function view(): View
    {
        ini_set('memory_limit', '512M');
        
        // Cargamos todas las relaciones requeridas por el switch de la vista para evitar consultas N+1
        $profesionales = Profesional::with([
            'puesto',
            'ine',
            'ocupacionCentroSalud',
            'ocupacionHospital',
            'ocupacionOfJurisidccion',
            'ocupacionCriCree',
            'ocupacionSamuCrum',
            'ocupacionOficinaCentral',
            'ocupacionAlmacen',
            'ocupacionCetsLesp',
            'ocupacionCors',
            'ocupacionIssreei',
            'ocupacionCesame',
            'ocupacionPsiParras',
            'ocupacionCeam',
            'ocupacionHospitalNino',
            'ocupacionEnsenanza',
            'ocupacionCecosama',
        ])
        ->whereHas('puesto', function ($query) {
            $query->whereIn('vigencia', ['ACTIVO', 'BAJA TEMPORAL']);
        })
        ->get();

        return view('export.profesionales_ine', [
            'profesionales' => $profesionales
        ]);
    }

    /**
     * Aplica estilos a la hoja de cálculo
     */
    public function styles(Worksheet $sheet)
    {
        return [
            // Aplica estilos a la Fila 1 (Encabezados)
            1 => [
                'font' => [
                    'bold' => true,
                    'color' => ['argb' => 'FFFFFF'], // Texto blanco
                ],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => [
                        'argb' => 'B19CD9', // Lila / Púrpura pastel
                    ],
                ],
            ],
        ];
    }
}