<?php

namespace App\Exports;

use App\Models\ProfesionalBitacoraCartera;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithStyles;

class BitacoraCarteraExport implements FromView, WithStyles
{
    protected $fecha_inicio;
    protected $fecha_fin;

    public function __construct($fecha_inicio, $fecha_fin)
    {
        $this->fecha_inicio = $fecha_inicio;
        $this->fecha_fin = $fecha_fin;
    }

    public function view(): View
    {
        $registros = ProfesionalBitacoraCartera::whereBetween('created_at', [
            $this->fecha_inicio,
            $this->fecha_fin
        ])
        ->orderBy('created_at', 'desc')
        ->get();

        return view('export.bitacora_cartera', compact('registros'));
    }

    public function styles(Worksheet $sheet)
    {
        return [

            'A1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '4A4A4A']]],
            'B1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '4A4A4A']]],
            'C1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '4A4A4A']]],
            'D1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '4A4A4A']]],
            'E1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '4A4A4A']]],
            'F1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '4A4A4A']]],
            'G1' => ['fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '4A4A4A']]],
        ];
    }
}