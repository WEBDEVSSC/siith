<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CatAlergiasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
         $categorias = [
            ['tipo_alergia' => 'Ninguna'],
            ['tipo_alergia' => 'Alergias respiratorias'],
            ['tipo_alergia' => 'Alergias alimentarias'],
            ['tipo_alergia' => 'Alergias por picaduras e insectos'],
            ['tipo_alergia' => 'Alergias por contacto'],
            ['tipo_alergia' => 'Alergias a medicamentos'],
        ];

        DB::table('cat_alergias')->insert($categorias);
    }
}
