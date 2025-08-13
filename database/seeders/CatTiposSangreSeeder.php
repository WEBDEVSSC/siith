<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CatTiposSangreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tipos = [
            ['tipo_sangre' => 'A+'],
            ['tipo_sangre' => 'A-'],
            ['tipo_sangre' => 'B+'],
            ['tipo_sangre' => 'B-'],
            ['tipo_sangre' => 'AB+'],
            ['tipo_sangre' => 'AB-'],
            ['tipo_sangre' => 'O+'],
            ['tipo_sangre' => 'O-'],
        ];

        DB::table('cat_tipos_sangre')->insert($tipos);
    }
}
