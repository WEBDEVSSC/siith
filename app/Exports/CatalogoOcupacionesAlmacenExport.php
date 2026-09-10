<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class CatalogoOcupacionesAlmacenExport implements FromView, ShouldAutoSize
{
     protected $ocupaciones;

    public function __construct($ocupaciones)
    {
        $this->ocupaciones = $ocupaciones;
    }

    public function view(): View
    {
        return view('settings.ocupacion.almacen.almacen-excel', [
            'ocupaciones' => $this->ocupaciones
        ]);
    }
}
