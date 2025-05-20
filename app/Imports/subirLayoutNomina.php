<?php

namespace App\Imports;

use App\Models\ProfesionalFirmaNomina;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Str;

class subirLayoutNomina implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        //dd($row); // Esto detiene la ejecución y muestra el contenido
        
        return new ProfesionalFirmaNomina([
            //
            'curp' => $row['curp'],
            'cantidad' => $row['cantidad'],
            'quincena_numero' => $row['quincena_numero'],
            'concepto' => $row['concepto'],
            'anio' => $row['anio'],
            'token' => Str::upper(Str::random(16)),
        ]);
    }
}
