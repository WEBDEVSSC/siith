<?php

namespace App\Exports;

use App\Models\Profesional;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ProfesionalExportIne implements FromView, WithStyles
{
    public function view(): View
    {
        // Obtenemos los datos con los filtros y relaciones necesarios
        $profesionales = Profesional::with(['puesto', 'ine'])
            ->whereHas('puesto', function ($query) {
                $query->whereIn('vigencia', ['ACTIVO', 'BAJA TEMPORAL']);
            })
            ->get();

        // Retornamos la vista pasándole la variable (la vista ya no necesita estilos en línea)
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
                        'argb' => 'B19CD9', // Color de fondo (Azul oscuro HEX sin el #)
                    ],
                ],
            ],
        ];
    }
}