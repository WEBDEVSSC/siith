<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CatPaisesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $paises = [
            'ECUADOR',
            'EGIPTO',
            'ARUBA',
            'AFGANISTÁN',
            'ANGOLA',
            'ANGUILA',
            'ALBANIA',
            'ANDORRA',
            'ANTILLAS NEERLANDESAS',
            'EMIRATOS ÁRABES UNIDOS',
            'ARGENTINA',
            'ARMENIA',
            'SAMOA ESTADOUNIDENSE',
            'ANTÁRTIDA',
            'TERRITORIOS FRANCESES DEL SUR',
            'ANTIGUA Y BARBUDA',
            'AUSTRALIA',
            'AUSTRIA',
            'AZERBAIYÁN',
            'BURUNDI',
            'BÉLGICA',
            'BENÍN',
            'BURKINA FASO',
            'BANGLADESH',
            'BULGARIA',
            'BAHREIN',
            'BAHAMAS',
            'BOSNIA Y HERZEGOVINA',
            'BELARÚS',
            'BELICE',
            'BERMUDAS',
            'BOLIVIA',
            'BRASIL',
            'BARBADOS',
            'BRUNÉI DARUSSALAM',
            'BUTÁN',
            'BIRMANIA',
            'ISLA BOUVET',
            'BOTSWANA',
            'REPÚBLICA CENTROAFRICANA',
            'CANADÁ',
            'COSTA RICA',
            'COLOMBIA',
            'CUBA',
            'CHILE',
            'CHINA',
            'ALEMANIA',
            'ESPAÑA',
            'ESTADOS UNIDOS',
            'FRANCIA',
            'GUATEMALA',
            'HONDURAS',
            'ITALIA',
            'JAPÓN',
            'MÉXICO',
            'NICARAGUA',
            'PANAMÁ',
            'PERÚ',
            'PUERTO RICO',
            'URUGUAY',
            'VENEZUELA',
            'ZAMBIA',
            'ZIMBABWE'
        ];

        foreach ($paises as $pais) {
            DB::table('cat_paises_nacimiento')->insert([
                'pais' => $pais,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
