<?php

namespace App\Exports;

use App\Models\ProfesionalBitacoraCartera;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class BitacoraCarteraExport implements FromView
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
        ])->get();

        return view('export.bitacora_cartera', compact('registros'));
    }
}