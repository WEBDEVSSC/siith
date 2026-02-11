<?php

namespace App\Http\Controllers;

use App\Models\Profesional;
use Illuminate\Http\Request;

class VinculacionController extends Controller
{
    //
   public function indexVYE()
    {
        //*********************************************************************************************** */
    
        $allende = Profesional::whereHas('puesto', function ($q) {
            $q->where('vigencia', 'ACTIVO')
                ->where('clues_adscripcion_municipio', 'ALLENDE')
                ->whereIn('nomina_pago', ['REG - Regularizado','FOR - Formalizado 1','FO2 - Formalizado 2','FO3 - Formalizado 3','FED - Federal (Unidad 420)','EVE - Eventual','HOM - Homologado','BUR - Burócrata','IB - IMSS-BIENESTAR','UNEME - CECOSAMA','Ramo 12','HON - Honorarios','ISSREEI - Nómina','FAM - UMM - IMSS B.','ASIMILADOS','TAMIZ - FEDERAL','SNSP','U013 - PAGO CDMX']);
        })->count();

        $guerrero = Profesional::whereHas('puesto', function ($q) {
            $q->where('vigencia', 'ACTIVO')
            ->where('clues_adscripcion_municipio', 'GUERRERO')
            ->whereIn('nomina_pago', ['REG - Regularizado','FOR - Formalizado 1','FO2 - Formalizado 2','FO3 - Formalizado 3','FED - Federal (Unidad 420)','EVE - Eventual','HOM - Homologado','BUR - Burócrata','IB - IMSS-BIENESTAR','UNEME - CECOSAMA','Ramo 12','HON - Honorarios','ISSREEI - Nómina','FAM - UMM - IMSS B.','ASIMILADOS','TAMIZ - FEDERAL','SNSP','U013 - PAGO CDMX']);
        })->count();

        $hidalgo = Profesional::whereHas('puesto', function ($q) {
            $q->where('vigencia', 'ACTIVO')
            ->where('clues_adscripcion_municipio', 'HIDALGO')
            ->whereIn('nomina_pago', ['REG - Regularizado','FOR - Formalizado 1','FO2 - Formalizado 2','FO3 - Formalizado 3','FED - Federal (Unidad 420)','EVE - Eventual','HOM - Homologado','BUR - Burócrata','IB - IMSS-BIENESTAR','UNEME - CECOSAMA','Ramo 12','HON - Honorarios','ISSREEI - Nómina','FAM - UMM - IMSS B.','ASIMILADOS','TAMIZ - FEDERAL','SNSP','U013 - PAGO CDMX']);
        })->count();

        $nava = Profesional::whereHas('puesto', function ($q) {
            $q->where('vigencia', 'ACTIVO')
            ->where('clues_adscripcion_municipio', 'NAVA')
            ->whereIn('nomina_pago', ['REG - Regularizado','FOR - Formalizado 1','FO2 - Formalizado 2','FO3 - Formalizado 3','FED - Federal (Unidad 420)','EVE - Eventual','HOM - Homologado','BUR - Burócrata','IB - IMSS-BIENESTAR','UNEME - CECOSAMA','Ramo 12','HON - Honorarios','ISSREEI - Nómina','FAM - UMM - IMSS B.','ASIMILADOS','TAMIZ - FEDERAL','SNSP','U013 - PAGO CDMX']);
        })->count();

        $piedrasNegras = Profesional::whereHas('puesto', function ($q) {
            $q->where('vigencia', 'ACTIVO')
            ->where('clues_adscripcion_municipio', 'PIEDRAS NEGRAS')
            ->whereIn('nomina_pago', ['REG - Regularizado','FOR - Formalizado 1','FO2 - Formalizado 2','FO3 - Formalizado 3','FED - Federal (Unidad 420)','EVE - Eventual','HOM - Homologado','BUR - Burócrata','IB - IMSS-BIENESTAR','UNEME - CECOSAMA','Ramo 12','HON - Honorarios','ISSREEI - Nómina','FAM - UMM - IMSS B.','ASIMILADOS','TAMIZ - FEDERAL','SNSP','U013 - PAGO CDMX']);
        })->count();

        $villaUnion = Profesional::whereHas('puesto', function ($q) {
            $q->where('vigencia', 'ACTIVO')
            ->where('clues_adscripcion_municipio', 'VILLA UNIÓN')
            ->whereIn('nomina_pago', ['REG - Regularizado','FOR - Formalizado 1','FO2 - Formalizado 2','FO3 - Formalizado 3','FED - Federal (Unidad 420)','EVE - Eventual','HOM - Homologado','BUR - Burócrata','IB - IMSS-BIENESTAR','UNEME - CECOSAMA','Ramo 12','HON - Honorarios','ISSREEI - Nómina','FAM - UMM - IMSS B.','ASIMILADOS','TAMIZ - FEDERAL','SNSP','U013 - PAGO CDMX']);
        })->count();

        //*********************************************************************************************** */

        $acuna = Profesional::whereHas('puesto', function ($q) {
            $q->where('vigencia', 'ACTIVO')
            ->where('clues_adscripcion_municipio', 'ACUÑA')
            ->whereIn('nomina_pago', ['REG - Regularizado','FOR - Formalizado 1','FO2 - Formalizado 2','FO3 - Formalizado 3','FED - Federal (Unidad 420)','EVE - Eventual','HOM - Homologado','BUR - Burócrata','IB - IMSS-BIENESTAR','UNEME - CECOSAMA','Ramo 12','HON - Honorarios','ISSREEI - Nómina','FAM - UMM - IMSS B.','ASIMILADOS','TAMIZ - FEDERAL','SNSP','U013 - PAGO CDMX']);
        })->count();

        $jimenez = Profesional::whereHas('puesto', function ($q) {
            $q->where('vigencia', 'ACTIVO')
            ->where('clues_adscripcion_municipio', 'JIMÉNEZ')
            ->whereIn('nomina_pago', ['REG - Regularizado','FOR - Formalizado 1','FO2 - Formalizado 2','FO3 - Formalizado 3','FED - Federal (Unidad 420)','EVE - Eventual','HOM - Homologado','BUR - Burócrata','IB - IMSS-BIENESTAR','UNEME - CECOSAMA','Ramo 12','HON - Honorarios','ISSREEI - Nómina','FAM - UMM - IMSS B.','ASIMILADOS','TAMIZ - FEDERAL','SNSP','U013 - PAGO CDMX']);
        })->count();

        $morelos = Profesional::whereHas('puesto', function ($q) {
            $q->where('vigencia', 'ACTIVO')
            ->where('clues_adscripcion_municipio', 'MORELOS')
            ->whereIn('nomina_pago', ['REG - Regularizado','FOR - Formalizado 1','FO2 - Formalizado 2','FO3 - Formalizado 3','FED - Federal (Unidad 420)','EVE - Eventual','HOM - Homologado','BUR - Burócrata','IB - IMSS-BIENESTAR','UNEME - CECOSAMA','Ramo 12','HON - Honorarios','ISSREEI - Nómina','FAM - UMM - IMSS B.','ASIMILADOS','TAMIZ - FEDERAL','SNSP','U013 - PAGO CDMX']);
        })->count();

        $zaragoza = Profesional::whereHas('puesto', function ($q) {
            $q->where('vigencia', 'ACTIVO')
            ->where('clues_adscripcion_municipio', 'ZARAGOZA')
            ->whereIn('nomina_pago', ['REG - Regularizado','FOR - Formalizado 1','FO2 - Formalizado 2','FO3 - Formalizado 3','FED - Federal (Unidad 420)','EVE - Eventual','HOM - Homologado','BUR - Burócrata','IB - IMSS-BIENESTAR','UNEME - CECOSAMA','Ramo 12','HON - Honorarios','ISSREEI - Nómina','FAM - UMM - IMSS B.','ASIMILADOS','TAMIZ - FEDERAL','SNSP','U013 - PAGO CDMX']);
        })->count();

        //*********************************************************************************************** */

        $juarez = Profesional::whereHas('puesto', function ($q) {
            $q->where('vigencia', 'ACTIVO')
            ->where('clues_adscripcion_municipio', 'JUÁREZ')
            ->whereIn('nomina_pago', ['REG - Regularizado','FOR - Formalizado 1','FO2 - Formalizado 2','FO3 - Formalizado 3','FED - Federal (Unidad 420)','EVE - Eventual','HOM - Homologado','BUR - Burócrata','IB - IMSS-BIENESTAR','UNEME - CECOSAMA','Ramo 12','HON - Honorarios','ISSREEI - Nómina','FAM - UMM - IMSS B.','ASIMILADOS','TAMIZ - FEDERAL','SNSP','U013 - PAGO CDMX']);
        })->count();

        $muzquiz = Profesional::whereHas('puesto', function ($q) {
            $q->where('vigencia', 'ACTIVO')
            ->where('clues_adscripcion_municipio', 'MÚZQUIZ')
            ->whereIn('nomina_pago', ['REG - Regularizado','FOR - Formalizado 1','FO2 - Formalizado 2','FO3 - Formalizado 3','FED - Federal (Unidad 420)','EVE - Eventual','HOM - Homologado','BUR - Burócrata','IB - IMSS-BIENESTAR','UNEME - CECOSAMA','Ramo 12','HON - Honorarios','ISSREEI - Nómina','FAM - UMM - IMSS B.','ASIMILADOS','TAMIZ - FEDERAL','SNSP','U013 - PAGO CDMX']);
        })->count();

        $progreso = Profesional::whereHas('puesto', function ($q) {
            $q->where('vigencia', 'ACTIVO')
            ->where('clues_adscripcion_municipio', 'PROGRESO')
            ->whereIn('nomina_pago', ['REG - Regularizado','FOR - Formalizado 1','FO2 - Formalizado 2','FO3 - Formalizado 3','FED - Federal (Unidad 420)','EVE - Eventual','HOM - Homologado','BUR - Burócrata','IB - IMSS-BIENESTAR','UNEME - CECOSAMA','Ramo 12','HON - Honorarios','ISSREEI - Nómina','FAM - UMM - IMSS B.','ASIMILADOS','TAMIZ - FEDERAL','SNSP','U013 - PAGO CDMX']);
        })->count();

        $sabinas = Profesional::whereHas('puesto', function ($q) {
            $q->where('vigencia', 'ACTIVO')
            ->where('clues_adscripcion_municipio', 'SABINAS')
            ->whereIn('nomina_pago', ['REG - Regularizado','FOR - Formalizado 1','FO2 - Formalizado 2','FO3 - Formalizado 3','FED - Federal (Unidad 420)','EVE - Eventual','HOM - Homologado','BUR - Burócrata','IB - IMSS-BIENESTAR','UNEME - CECOSAMA','Ramo 12','HON - Honorarios','ISSREEI - Nómina','FAM - UMM - IMSS B.','ASIMILADOS','TAMIZ - FEDERAL','SNSP','U013 - PAGO CDMX']);
        })->count();

        $sanJuanDeSabinas = Profesional::whereHas('puesto', function ($q) {
            $q->where('vigencia', 'ACTIVO')
            ->where('clues_adscripcion_municipio', 'SAN JUAN DE SABINAS')
            ->whereIn('nomina_pago', ['REG - Regularizado','FOR - Formalizado 1','FO2 - Formalizado 2','FO3 - Formalizado 3','FED - Federal (Unidad 420)','EVE - Eventual','HOM - Homologado','BUR - Burócrata','IB - IMSS-BIENESTAR','UNEME - CECOSAMA','Ramo 12','HON - Honorarios','ISSREEI - Nómina','FAM - UMM - IMSS B.','ASIMILADOS','TAMIZ - FEDERAL','SNSP','U013 - PAGO CDMX']);
        })->count();

        //*********************************************************************************************** */

        $abasolo = Profesional::whereHas('puesto', function ($q) {
            $q->where('vigencia', 'ACTIVO')
            ->where('clues_adscripcion_municipio', 'ABASOLO')
            ->whereIn('nomina_pago', ['REG - Regularizado','FOR - Formalizado 1','FO2 - Formalizado 2','FO3 - Formalizado 3','FED - Federal (Unidad 420)','EVE - Eventual','HOM - Homologado','BUR - Burócrata','IB - IMSS-BIENESTAR','UNEME - CECOSAMA','Ramo 12','HON - Honorarios','ISSREEI - Nómina','FAM - UMM - IMSS B.','ASIMILADOS','TAMIZ - FEDERAL','SNSP','U013 - PAGO CDMX']);
        })->count();

        $candela = Profesional::whereHas('puesto', function ($q) {
            $q->where('vigencia', 'ACTIVO')
            ->where('clues_adscripcion_municipio', 'CANDELA')
            ->whereIn('nomina_pago', ['REG - Regularizado','FOR - Formalizado 1','FO2 - Formalizado 2','FO3 - Formalizado 3','FED - Federal (Unidad 420)','EVE - Eventual','HOM - Homologado','BUR - Burócrata','IB - IMSS-BIENESTAR','UNEME - CECOSAMA','Ramo 12','HON - Honorarios','ISSREEI - Nómina','FAM - UMM - IMSS B.','ASIMILADOS','TAMIZ - FEDERAL','SNSP','U013 - PAGO CDMX']);
        })->count();

        $castanos = Profesional::whereHas('puesto', function ($q) {
            $q->where('vigencia', 'ACTIVO')
            ->where('clues_adscripcion_municipio', 'CASTAÑOS')
            ->whereIn('nomina_pago', ['REG - Regularizado','FOR - Formalizado 1','FO2 - Formalizado 2','FO3 - Formalizado 3','FED - Federal (Unidad 420)','EVE - Eventual','HOM - Homologado','BUR - Burócrata','IB - IMSS-BIENESTAR','UNEME - CECOSAMA','Ramo 12','HON - Honorarios','ISSREEI - Nómina','FAM - UMM - IMSS B.','ASIMILADOS','TAMIZ - FEDERAL','SNSP','U013 - PAGO CDMX']);
        })->count();

        $escobedo = Profesional::whereHas('puesto', function ($q) {
            $q->where('vigencia', 'ACTIVO')
            ->where('clues_adscripcion_municipio', 'ESCOBEDO')
            ->whereIn('nomina_pago', ['REG - Regularizado','FOR - Formalizado 1','FO2 - Formalizado 2','FO3 - Formalizado 3','FED - Federal (Unidad 420)','EVE - Eventual','HOM - Homologado','BUR - Burócrata','IB - IMSS-BIENESTAR','UNEME - CECOSAMA','Ramo 12','HON - Honorarios','ISSREEI - Nómina','FAM - UMM - IMSS B.','ASIMILADOS','TAMIZ - FEDERAL','SNSP','U013 - PAGO CDMX']);
        })->count();

        $frontera = Profesional::whereHas('puesto', function ($q) {
            $q->where('vigencia', 'ACTIVO')
            ->where('clues_adscripcion_municipio', 'FRONTERA')
            ->whereIn('nomina_pago', ['REG - Regularizado','FOR - Formalizado 1','FO2 - Formalizado 2','FO3 - Formalizado 3','FED - Federal (Unidad 420)','EVE - Eventual','HOM - Homologado','BUR - Burócrata','IB - IMSS-BIENESTAR','UNEME - CECOSAMA','Ramo 12','HON - Honorarios','ISSREEI - Nómina','FAM - UMM - IMSS B.','ASIMILADOS','TAMIZ - FEDERAL','SNSP','U013 - PAGO CDMX']);
        })->count();

        $monclova = Profesional::whereHas('puesto', function ($q) {
            $q->where('vigencia', 'ACTIVO')
            ->where('clues_adscripcion_municipio', 'MONCLOVA')
            ->whereIn('nomina_pago', ['REG - Regularizado','FOR - Formalizado 1','FO2 - Formalizado 2','FO3 - Formalizado 3','FED - Federal (Unidad 420)','EVE - Eventual','HOM - Homologado','BUR - Burócrata','IB - IMSS-BIENESTAR','UNEME - CECOSAMA','Ramo 12','HON - Honorarios','ISSREEI - Nómina','FAM - UMM - IMSS B.','ASIMILADOS','TAMIZ - FEDERAL','SNSP','U013 - PAGO CDMX']);
        })->count();

        $nadadores = Profesional::whereHas('puesto', function ($q) {
            $q->where('vigencia', 'ACTIVO')
            ->where('clues_adscripcion_municipio', 'NADADORES')
            ->whereIn('nomina_pago', ['REG - Regularizado','FOR - Formalizado 1','FO2 - Formalizado 2','FO3 - Formalizado 3','FED - Federal (Unidad 420)','EVE - Eventual','HOM - Homologado','BUR - Burócrata','IB - IMSS-BIENESTAR','UNEME - CECOSAMA','Ramo 12','HON - Honorarios','ISSREEI - Nómina','FAM - UMM - IMSS B.','ASIMILADOS','TAMIZ - FEDERAL','SNSP','U013 - PAGO CDMX']);
        })->count();

        $sanbuena = Profesional::whereHas('puesto', function ($q) {
            $q->where('vigencia', 'ACTIVO')
            ->where('clues_adscripcion_municipio', 'SAN BUENAVENTURA')
            ->whereIn('nomina_pago', ['REG - Regularizado','FOR - Formalizado 1','FO2 - Formalizado 2','FO3 - Formalizado 3','FED - Federal (Unidad 420)','EVE - Eventual','HOM - Homologado','BUR - Burócrata','IB - IMSS-BIENESTAR','UNEME - CECOSAMA','Ramo 12','HON - Honorarios','ISSREEI - Nómina','FAM - UMM - IMSS B.','ASIMILADOS','TAMIZ - FEDERAL','SNSP','U013 - PAGO CDMX']);
        })->count();

        //*********************************************************************************************** */

        $cuatrocienegas = Profesional::whereHas('puesto', function ($q) {
            $q->where('vigencia', 'ACTIVO')
            ->where('clues_adscripcion_municipio', 'CUATRO CIÉNEGAS');
        })->count();

        $lamadrid = Profesional::whereHas('puesto', function ($q) {
            $q->where('vigencia', 'ACTIVO')
            ->where('clues_adscripcion_municipio', 'LAMADRID')
            ->whereIn('nomina_pago', ['REG - Regularizado','FOR - Formalizado 1','FO2 - Formalizado 2','FO3 - Formalizado 3','FED - Federal (Unidad 420)','EVE - Eventual','HOM - Homologado','BUR - Burócrata','IB - IMSS-BIENESTAR','UNEME - CECOSAMA','Ramo 12','HON - Honorarios','ISSREEI - Nómina','FAM - UMM - IMSS B.','ASIMILADOS','TAMIZ - FEDERAL','SNSP','U013 - PAGO CDMX']);
        })->count();

        $ocampo = Profesional::whereHas('puesto', function ($q) {
            $q->where('vigencia', 'ACTIVO')
            ->where('clues_adscripcion_municipio', 'OCAMPO')
            ->whereIn('nomina_pago', ['REG - Regularizado','FOR - Formalizado 1','FO2 - Formalizado 2','FO3 - Formalizado 3','FED - Federal (Unidad 420)','EVE - Eventual','HOM - Homologado','BUR - Burócrata','IB - IMSS-BIENESTAR','UNEME - CECOSAMA','Ramo 12','HON - Honorarios','ISSREEI - Nómina','FAM - UMM - IMSS B.','ASIMILADOS','TAMIZ - FEDERAL','SNSP','U013 - PAGO CDMX']);
        })->count();

        $sacramento = Profesional::whereHas('puesto', function ($q) {
            $q->where('vigencia', 'ACTIVO')
            ->where('clues_adscripcion_municipio', 'SACRAMENTO')
            ->whereIn('nomina_pago', ['REG - Regularizado','FOR - Formalizado 1','FO2 - Formalizado 2','FO3 - Formalizado 3','FED - Federal (Unidad 420)','EVE - Eventual','HOM - Homologado','BUR - Burócrata','IB - IMSS-BIENESTAR','UNEME - CECOSAMA','Ramo 12','HON - Honorarios','ISSREEI - Nómina','FAM - UMM - IMSS B.','ASIMILADOS','TAMIZ - FEDERAL','SNSP','U013 - PAGO CDMX']);
        })->count();

        $sierraMojada = Profesional::whereHas('puesto', function ($q) {
            $q->where('vigencia', 'ACTIVO')
            ->where('clues_adscripcion_municipio', 'SIERRA MOJADA')
            ->whereIn('nomina_pago', ['REG - Regularizado','FOR - Formalizado 1','FO2 - Formalizado 2','FO3 - Formalizado 3','FED - Federal (Unidad 420)','EVE - Eventual','HOM - Homologado','BUR - Burócrata','IB - IMSS-BIENESTAR','UNEME - CECOSAMA','Ramo 12','HON - Honorarios','ISSREEI - Nómina','FAM - UMM - IMSS B.','ASIMILADOS','TAMIZ - FEDERAL','SNSP','U013 - PAGO CDMX']);
        })->count();

        //*********************************************************************************************** */

        $torreon = Profesional::whereHas('puesto', function ($q) {
            $q->where('vigencia', 'ACTIVO')
            ->where('clues_adscripcion_municipio', 'TORREÓN')
            ->whereIn('nomina_pago', ['REG - Regularizado','FOR - Formalizado 1','FO2 - Formalizado 2','FO3 - Formalizado 3','FED - Federal (Unidad 420)','EVE - Eventual','HOM - Homologado','BUR - Burócrata','IB - IMSS-BIENESTAR','UNEME - CECOSAMA','Ramo 12','HON - Honorarios','ISSREEI - Nómina','FAM - UMM - IMSS B.','ASIMILADOS','TAMIZ - FEDERAL','SNSP','U013 - PAGO CDMX']);
        })->count();

        $matamoros = Profesional::whereHas('puesto', function ($q) {
            $q->where('vigencia', 'ACTIVO')
            ->where('clues_adscripcion_municipio', 'MATAMOROS')
            ->whereIn('nomina_pago', ['REG - Regularizado','FOR - Formalizado 1','FO2 - Formalizado 2','FO3 - Formalizado 3','FED - Federal (Unidad 420)','EVE - Eventual','HOM - Homologado','BUR - Burócrata','IB - IMSS-BIENESTAR','UNEME - CECOSAMA','Ramo 12','HON - Honorarios','ISSREEI - Nómina','FAM - UMM - IMSS B.','ASIMILADOS','TAMIZ - FEDERAL','SNSP','U013 - PAGO CDMX']);
        })->count();

        $viesca = Profesional::whereHas('puesto', function ($q) {
            $q->where('vigencia', 'ACTIVO')
            ->where('clues_adscripcion_municipio', 'VIESCA')
            ->whereIn('nomina_pago', ['REG - Regularizado','FOR - Formalizado 1','FO2 - Formalizado 2','FO3 - Formalizado 3','FED - Federal (Unidad 420)','EVE - Eventual','HOM - Homologado','BUR - Burócrata','IB - IMSS-BIENESTAR','UNEME - CECOSAMA','Ramo 12','HON - Honorarios','ISSREEI - Nómina','FAM - UMM - IMSS B.','ASIMILADOS','TAMIZ - FEDERAL','SNSP','U013 - PAGO CDMX']);
        })->count();

        //*********************************************************************************************** */

        $fcoIMadero = Profesional::whereHas('puesto', function ($q) {
            $q->where('vigencia', 'ACTIVO')
            ->where('clues_adscripcion_municipio', 'FRANCISCO I. MADERO')
            ->whereIn('nomina_pago', ['REG - Regularizado','FOR - Formalizado 1','FO2 - Formalizado 2','FO3 - Formalizado 3','FED - Federal (Unidad 420)','EVE - Eventual','HOM - Homologado','BUR - Burócrata','IB - IMSS-BIENESTAR','UNEME - CECOSAMA','Ramo 12','HON - Honorarios','ISSREEI - Nómina','FAM - UMM - IMSS B.','ASIMILADOS','TAMIZ - FEDERAL','SNSP','U013 - PAGO CDMX']);
        })->count();

        $sanPedro = Profesional::whereHas('puesto', function ($q) {
            $q->where('vigencia', 'ACTIVO')
            ->where('clues_adscripcion_municipio', 'SAN PEDRO')
            ->whereIn('nomina_pago', ['REG - Regularizado','FOR - Formalizado 1','FO2 - Formalizado 2','FO3 - Formalizado 3','FED - Federal (Unidad 420)','EVE - Eventual','HOM - Homologado','BUR - Burócrata','IB - IMSS-BIENESTAR','UNEME - CECOSAMA','Ramo 12','HON - Honorarios','ISSREEI - Nómina','FAM - UMM - IMSS B.','ASIMILADOS','TAMIZ - FEDERAL','SNSP','U013 - PAGO CDMX']);
        })->count();

        //*********************************************************************************************** */

        $arteaga = Profesional::whereHas('puesto', function ($q) {
            $q->where('vigencia', 'ACTIVO')
            ->where('clues_adscripcion_municipio', 'ARTEAGA')
            ->whereIn('nomina_pago', ['REG - Regularizado','FOR - Formalizado 1','FO2 - Formalizado 2','FO3 - Formalizado 3','FED - Federal (Unidad 420)','EVE - Eventual','HOM - Homologado','BUR - Burócrata','IB - IMSS-BIENESTAR','UNEME - CECOSAMA','Ramo 12','HON - Honorarios','ISSREEI - Nómina','FAM - UMM - IMSS B.','ASIMILADOS','TAMIZ - FEDERAL','SNSP','U013 - PAGO CDMX']);
        })->count();

        $generalCepeda = Profesional::whereHas('puesto', function ($q) {
            $q->where('vigencia', 'ACTIVO')
            ->where('clues_adscripcion_municipio', 'GENERAL CEPEDA')
            ->whereIn('nomina_pago', ['REG - Regularizado','FOR - Formalizado 1','FO2 - Formalizado 2','FO3 - Formalizado 3','FED - Federal (Unidad 420)','EVE - Eventual','HOM - Homologado','BUR - Burócrata','IB - IMSS-BIENESTAR','UNEME - CECOSAMA','Ramo 12','HON - Honorarios','ISSREEI - Nómina','FAM - UMM - IMSS B.','ASIMILADOS','TAMIZ - FEDERAL','SNSP','U013 - PAGO CDMX']);
        })->count();

        $parras = Profesional::whereHas('puesto', function ($q) {
            $q->where('vigencia', 'ACTIVO')
            ->where('clues_adscripcion_municipio', 'PARRAS')
            ->whereIn('nomina_pago', ['REG - Regularizado','FOR - Formalizado 1','FO2 - Formalizado 2','FO3 - Formalizado 3','FED - Federal (Unidad 420)','EVE - Eventual','HOM - Homologado','BUR - Burócrata','IB - IMSS-BIENESTAR','UNEME - CECOSAMA','Ramo 12','HON - Honorarios','ISSREEI - Nómina','FAM - UMM - IMSS B.','ASIMILADOS','TAMIZ - FEDERAL','SNSP','U013 - PAGO CDMX']);
        })->count();

        $ramosArizpe = Profesional::whereHas('puesto', function ($q) {
            $q->where('vigencia', 'ACTIVO')
            ->where('clues_adscripcion_municipio', 'RAMOS ARIZPE')
            ->whereIn('nomina_pago', ['REG - Regularizado','FOR - Formalizado 1','FO2 - Formalizado 2','FO3 - Formalizado 3','FED - Federal (Unidad 420)','EVE - Eventual','HOM - Homologado','BUR - Burócrata','IB - IMSS-BIENESTAR','UNEME - CECOSAMA','Ramo 12','HON - Honorarios','ISSREEI - Nómina','FAM - UMM - IMSS B.','ASIMILADOS','TAMIZ - FEDERAL','SNSP','U013 - PAGO CDMX']);
        })->count();

        $saltillo = Profesional::whereHas('puesto', function ($q) {
            $q->where('vigencia', 'ACTIVO')
            ->where('clues_adscripcion_municipio', 'SALTILLO')
            ->whereIn('nomina_pago', ['REG - Regularizado','FOR - Formalizado 1','FO2 - Formalizado 2','FO3 - Formalizado 3','FED - Federal (Unidad 420)','EVE - Eventual','HOM - Homologado','BUR - Burócrata','IB - IMSS-BIENESTAR','UNEME - CECOSAMA','Ramo 12','HON - Honorarios','ISSREEI - Nómina','FAM - UMM - IMSS B.','ASIMILADOS','TAMIZ - FEDERAL','SNSP','U013 - PAGO CDMX']);
        })->count();
    
        $municipios = [
            // JURISDICCION 1 PIEDRAS NEGRAS
            'Allende' => ['color' => '#1F3A5F', 'total' => $allende],
            'Guerrero' => ['color' => '#1F3A5F', 'total' => $guerrero],
            'Hidalgo' => ['color' => '#1F3A5F', 'total' => $hidalgo],
            'Nava' => ['color' => '#1F3A5F', 'total' => $nava],
            'Piedras Negras' => ['color' => '#1F3A5F', 'total' => $piedrasNegras],
            'Villa Unión' => ['color' => '#1F3A5F', 'total' => $villaUnion],

            // JURISDICCION 2 ACUÑA
            'Acuña' => ['color' => '#E67E22', 'total' => $acuna],
            'Jiménez' => ['color' => '#E67E22', 'total' => $jimenez],
            'Morelos' => ['color' => '#E67E22', 'total' => $morelos],
            'Zaragoza' => ['color' => '#E67E22', 'total' => $zaragoza],

            // JURISDICCION 3 SABINAS
            'Juárez' => ['color' => '#27AE60', 'total' => $juarez],
            'Múzquiz' => ['color' => '#27AE60  ', 'total' => $muzquiz],
            'Progreso' => ['color' => '#27AE60  ', 'total' => $progreso],
            'Sabinas' => ['color' => '#27AE60  ', 'total' => $sabinas],
            'San Juan de Sabinas' => ['color' => '#27AE60  ', 'total' => $sanJuanDeSabinas],

            // JURISDICCION 4 MONCLOVA
            'Abasolo' => ['color' => '#8E44AD', 'total' => $abasolo],
            'Candela' => ['color' => '#8E44AD', 'total' => $candela],
            'Castaños' => ['color' => '#8E44AD', 'total' => $castanos],
            'Escobedo' => ['color' => '#8E44AD', 'total' => $escobedo],
            'Frontera' => ['color' => '#8E44AD', 'total' => $frontera],
            'Monclova' => ['color' => '#8E44AD', 'total' => $monclova],
            'Nadadores' => ['color' => '#8E44AD', 'total' => $nadadores],
            'San Buenaventura' => ['color' => '#8E44AD', 'total' => $sanbuena],

            // JURISDICCION 5 CUATRO CIENEGAS
            'Cuatro Ciénegas' => ['color' => '#C0392B', 'total' => $cuatrocienegas],
            'Lamadrid' => ['color' => '#C0392B', 'total' => $lamadrid],
            'Ocampo' => ['color' => '#C0392B', 'total' => $ocampo],
            'Sacramento' => ['color' => '#C0392B', 'total' => $sacramento],
            'Sierra Mojada' => ['color' => '#C0392B', 'total' => $sierraMojada],

            // JURISDICCION 6 TORREON
            'Matamoros' => ['color' => '#16A085', 'total' => $matamoros],
            'Torreón' => ['color' => '#16A085', 'total' => $torreon],
            'Viesca' => ['color' => '#16A085', 'total' => $viesca],

            // JURISDICCION 7 FOC. I. MADERO
            'Francisco I. Madero' => ['color' => '#F1C40F', 'total' => $fcoIMadero],
            'San Pedro' => ['color' => '#F1C40F', 'total' => $sanPedro],

            // JURISDICCION 8 SALTILLO
            'Arteaga' => ['color' => '#2C3E50', 'total' => $arteaga],
            'General Cepeda' => ['color' => '#2C3E50', 'total' => $generalCepeda],
            'Parras' => ['color' => '#2C3E50', 'total' => $parras],
            'Ramos Arizpe' => ['color' => '#2C3E50', 'total' => $ramosArizpe],
            'Saltillo' => ['color' => '#2C3E50', 'total' => $saltillo],

        ];

        return view('vinculacion.index', compact('municipios'));
    }
}
