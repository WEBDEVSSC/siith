<?php

namespace App\Exports;

use App\Models\Profesional;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ProfesionalExport implements FromView
{

    public function view(): View
    {
        // Filtramos los eventos por el rango de fechas
        $profesionales = Profesional::all();

        // Pasamos los eventos a la vista
        return view('export.profesionales-export', [
            'profesionales' => $profesionales
        ]);
        
    }

}
