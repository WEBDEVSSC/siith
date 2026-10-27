<?php

namespace App\Exports;

use App\Models\ProfesionalIne;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProfesionalExportIne implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // Cargamos los datos junto con su relación por si deseas mostrar algo del profesional
        return ProfesionalIne::with('profesional')->get();
    }

    /**
     * Define los encabezados de las columnas en el Excel.
     */
    public function headings(): array
    {
        return [
            'ID Registro',
            'ID Profesional',
            'Clave de Elector',
            'Sección',
            'Vigencia',
            'DL',
            'DF',
        ];
    }

    /**
     * Mapea cada fila para darle formato a las columnas.
     */
    public function map($row): array
    {
        return [
            $row->id,
            $row->sid_profesional,
            $row->clave_elector,
            $row->seccion,
            $row->vigencia,
            $row->dl,
            $row->df,
        ];
    }
}
