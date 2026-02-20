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
            'Allende' => ['color' => '#E63946', 'total' => $allende],
            'Guerrero' => ['color' => '#E63946', 'total' => $guerrero],
            'Hidalgo' => ['color' => '#E63946', 'total' => $hidalgo],
            'Nava' => ['color' => '#E63946', 'total' => $nava],
            'Piedras Negras' => ['color' => '#E63946', 'total' => $piedrasNegras],
            'Villa Unión' => ['color' => '#E63946', 'total' => $villaUnion],

            // JURISDICCION 2 ACUÑA
            'Acuña' => ['color' => '#FF9F1C', 'total' => $acuna],
            'Jiménez' => ['color' => '#FF9F1C', 'total' => $jimenez],
            'Morelos' => ['color' => '#FF9F1C', 'total' => $morelos],
            'Zaragoza' => ['color' => '#FF9F1C', 'total' => $zaragoza],

            // JURISDICCION 3 SABINAS
            'Juárez' => ['color' => '#2EC4B6', 'total' => $juarez],
            'Múzquiz' => ['color' => '#2EC4B6  ', 'total' => $muzquiz],
            'Progreso' => ['color' => '#2EC4B6  ', 'total' => $progreso],
            'Sabinas' => ['color' => '#2EC4B6  ', 'total' => $sabinas],
            'San Juan de Sabinas' => ['color' => '#2EC4B6  ', 'total' => $sanJuanDeSabinas],

            // JURISDICCION 4 MONCLOVA
            'Abasolo' => ['color' => '#3A86FF', 'total' => $abasolo],
            'Candela' => ['color' => '#3A86FF', 'total' => $candela],
            'Castaños' => ['color' => '#3A86FF', 'total' => $castanos],
            'Escobedo' => ['color' => '#3A86FF', 'total' => $escobedo],
            'Frontera' => ['color' => '#3A86FF', 'total' => $frontera],
            'Monclova' => ['color' => '#3A86FF', 'total' => $monclova],
            'Nadadores' => ['color' => '#3A86FF', 'total' => $nadadores],
            'San Buenaventura' => ['color' => '#3A86FF', 'total' => $sanbuena],

            // JURISDICCION 5 CUATRO CIENEGAS
            'Cuatro Ciénegas' => ['color' => '#8338EC', 'total' => $cuatrocienegas],
            'Lamadrid' => ['color' => '#8338EC', 'total' => $lamadrid],
            'Ocampo' => ['color' => '#8338EC', 'total' => $ocampo],
            'Sacramento' => ['color' => '#8338EC', 'total' => $sacramento],
            'Sierra Mojada' => ['color' => '#8338EC', 'total' => $sierraMojada],

            // JURISDICCION 6 TORREON
            'Matamoros' => ['color' => '#2B2D42', 'total' => $matamoros],
            'Torreón' => ['color' => '#2B2D42', 'total' => $torreon],
            'Viesca' => ['color' => '#2B2D42', 'total' => $viesca],

            // JURISDICCION 7 FOC. I. MADERO
            'Francisco I. Madero' => ['color' => '#FFD60A', 'total' => $fcoIMadero],
            'San Pedro' => ['color' => '#FFD60A', 'total' => $sanPedro],

            // JURISDICCION 8 SALTILLO
            'Arteaga' => ['color' => '#F72585', 'total' => $arteaga],
            'General Cepeda' => ['color' => '#F72585', 'total' => $generalCepeda],
            'Parras' => ['color' => '#F72585', 'total' => $parras],
            'Ramos Arizpe' => ['color' => '#F72585', 'total' => $ramosArizpe],
            'Saltillo' => ['color' => '#F72585', 'total' => $saltillo],
        ];

        /**
         * 
         * 
         * CONTEO POR JURISDICCIONES DE TRABAJADORES
         * 
         * 
         */

        /*$profesionalesJurisdiccion1 = Profesional::whereRelation('puesto', 'clues_adscripcion_jurisdiccion', '1')
            ->whereRelation('puesto', 'vigencia', 'ACTIVO')
            ->count();*/
        
        $profesionalesJurisdiccion1 = Profesional::whereHas('puesto', function ($q) {
            $q->where('clues_adscripcion_jurisdiccion', '1')
            ->where('vigencia', 'ACTIVO')
            ->whereIn('nomina_pago', ['REG - Regularizado','FOR - Formalizado 1','FO2 - Formalizado 2','FO3 - Formalizado 3','FED - Federal (Unidad 420)','EVE - Eventual','HOM - Homologado','BUR - Burócrata','IB - IMSS-BIENESTAR','UNEME - CECOSAMA','Ramo 12','HON - Honorarios','ISSREEI - Nómina','FAM - UMM - IMSS B.','ASIMILADOS','TAMIZ - FEDERAL','SNSP','U013 - PAGO CDMX']);
            })->count();

        $profesionalesJurisdiccion2 = Profesional::whereHas('puesto', function ($q) {
            $q->where('clues_adscripcion_jurisdiccion', '2')
            ->where('vigencia', 'ACTIVO')
            ->whereIn('nomina_pago', ['REG - Regularizado','FOR - Formalizado 1','FO2 - Formalizado 2','FO3 - Formalizado 3','FED - Federal (Unidad 420)','EVE - Eventual','HOM - Homologado','BUR - Burócrata','IB - IMSS-BIENESTAR','UNEME - CECOSAMA','Ramo 12','HON - Honorarios','ISSREEI - Nómina','FAM - UMM - IMSS B.','ASIMILADOS','TAMIZ - FEDERAL','SNSP','U013 - PAGO CDMX']);
            })->count();

        $profesionalesJurisdiccion3 = Profesional::whereHas('puesto', function ($q) {
            $q->where('clues_adscripcion_jurisdiccion', '3')
            ->where('vigencia', 'ACTIVO')
            ->whereIn('nomina_pago', ['REG - Regularizado','FOR - Formalizado 1','FO2 - Formalizado 2','FO3 - Formalizado 3','FED - Federal (Unidad 420)','EVE - Eventual','HOM - Homologado','BUR - Burócrata','IB - IMSS-BIENESTAR','UNEME - CECOSAMA','Ramo 12','HON - Honorarios','ISSREEI - Nómina','FAM - UMM - IMSS B.','ASIMILADOS','TAMIZ - FEDERAL','SNSP','U013 - PAGO CDMX']);
            })->count();

        $profesionalesJurisdiccion4 = Profesional::whereHas('puesto', function ($q) {
            $q->where('clues_adscripcion_jurisdiccion', '4')
            ->where('vigencia', 'ACTIVO')
            ->whereIn('nomina_pago', ['REG - Regularizado','FOR - Formalizado 1','FO2 - Formalizado 2','FO3 - Formalizado 3','FED - Federal (Unidad 420)','EVE - Eventual','HOM - Homologado','BUR - Burócrata','IB - IMSS-BIENESTAR','UNEME - CECOSAMA','Ramo 12','HON - Honorarios','ISSREEI - Nómina','FAM - UMM - IMSS B.','ASIMILADOS','TAMIZ - FEDERAL','SNSP','U013 - PAGO CDMX']);
            })->count();

        $profesionalesJurisdiccion5 = Profesional::whereHas('puesto', function ($q) {
            $q->where('clues_adscripcion_jurisdiccion', '5')
            ->where('vigencia', 'ACTIVO')
            ->whereIn('nomina_pago', ['REG - Regularizado','FOR - Formalizado 1','FO2 - Formalizado 2','FO3 - Formalizado 3','FED - Federal (Unidad 420)','EVE - Eventual','HOM - Homologado','BUR - Burócrata','IB - IMSS-BIENESTAR','UNEME - CECOSAMA','Ramo 12','HON - Honorarios','ISSREEI - Nómina','FAM - UMM - IMSS B.','ASIMILADOS','TAMIZ - FEDERAL','SNSP','U013 - PAGO CDMX']);
            })->count();

        $profesionalesJurisdiccion6 = Profesional::whereHas('puesto', function ($q) {
            $q->where('clues_adscripcion_jurisdiccion', '6')
            ->where('vigencia', 'ACTIVO')
            ->whereIn('nomina_pago', ['REG - Regularizado','FOR - Formalizado 1','FO2 - Formalizado 2','FO3 - Formalizado 3','FED - Federal (Unidad 420)','EVE - Eventual','HOM - Homologado','BUR - Burócrata','IB - IMSS-BIENESTAR','UNEME - CECOSAMA','Ramo 12','HON - Honorarios','ISSREEI - Nómina','FAM - UMM - IMSS B.','ASIMILADOS','TAMIZ - FEDERAL','SNSP','U013 - PAGO CDMX']);
            })->count();
         
        $profesionalesJurisdiccion7 = Profesional::whereHas('puesto', function ($q) {
            $q->where('clues_adscripcion_jurisdiccion', '7')
            ->where('vigencia', 'ACTIVO')
            ->whereIn('nomina_pago', ['REG - Regularizado','FOR - Formalizado 1','FO2 - Formalizado 2','FO3 - Formalizado 3','FED - Federal (Unidad 420)','EVE - Eventual','HOM - Homologado','BUR - Burócrata','IB - IMSS-BIENESTAR','UNEME - CECOSAMA','Ramo 12','HON - Honorarios','ISSREEI - Nómina','FAM - UMM - IMSS B.','ASIMILADOS','TAMIZ - FEDERAL','SNSP','U013 - PAGO CDMX']);
            })->count();

        $profesionalesJurisdiccion8 = Profesional::whereHas('puesto', function ($q) {
            $q->where('clues_adscripcion_jurisdiccion', '8')
            ->where('vigencia', 'ACTIVO')
            ->whereIn('nomina_pago', ['REG - Regularizado','FOR - Formalizado 1','FO2 - Formalizado 2','FO3 - Formalizado 3','FED - Federal (Unidad 420)','EVE - Eventual','HOM - Homologado','BUR - Burócrata','IB - IMSS-BIENESTAR','UNEME - CECOSAMA','Ramo 12','HON - Honorarios','ISSREEI - Nómina','FAM - UMM - IMSS B.','ASIMILADOS','TAMIZ - FEDERAL','SNSP','U013 - PAGO CDMX']);
            })->count();

        $profesionalesJurisdiccion9 = Profesional::whereHas('puesto', function ($q) {
            $q->where('clues_adscripcion_jurisdiccion', '9')
            ->where('vigencia', 'ACTIVO')
            ->whereIn('nomina_pago', ['REG - Regularizado','FOR - Formalizado 1','FO2 - Formalizado 2','FO3 - Formalizado 3','FED - Federal (Unidad 420)','EVE - Eventual','HOM - Homologado','BUR - Burócrata','IB - IMSS-BIENESTAR','UNEME - CECOSAMA','Ramo 12','HON - Honorarios','ISSREEI - Nómina','FAM - UMM - IMSS B.','ASIMILADOS','TAMIZ - FEDERAL','SNSP','U013 - PAGO CDMX']);
            })->count();

        return view('vinculacion.index', compact(
            'municipios',
            'allende',
            'guerrero',
            'hidalgo',
            'nava',
            'piedrasNegras',
            'villaUnion',
            'acuna',
            'jimenez',
            'morelos',
            'zaragoza',
            'juarez',
            'muzquiz',
            'progreso',
            'sabinas',
            'sanJuanDeSabinas',
            'abasolo',
            'candela',
            'castanos',
            'escobedo',
            'frontera',
            'monclova',
            'nadadores',
            'sanbuena',
            'cuatrocienegas',
            'lamadrid',
            'ocampo',
            'sacramento',
            'sierraMojada',
            'torreon',
            'matamoros',
            'viesca',
            'fcoIMadero',
            'sanPedro',
            'arteaga',
            'generalCepeda',
            'parras',
            'ramosArizpe',
            'saltillo',

            'profesionalesJurisdiccion1',
            'profesionalesJurisdiccion2',
            'profesionalesJurisdiccion3',
            'profesionalesJurisdiccion4',
            'profesionalesJurisdiccion5',
            'profesionalesJurisdiccion6',
            'profesionalesJurisdiccion7',
            'profesionalesJurisdiccion8',
            'profesionalesJurisdiccion9',
            
            ));
    }

    public function jurisdiccionesVYE()
    {
        return view('vinculacion.jurisdicciones');
    }

    public function jurisdiccionesDetallesVYE($id)
    {
        $profesionales = Profesional::whereHas('puesto', function ($q) use ($id){
            $q->where('vigencia', 'ACTIVO')
            ->where('clues_adscripcion_jurisdiccion', $id)
            ->whereIn('nomina_pago', ['REG - Regularizado','FOR - Formalizado 1','FO2 - Formalizado 2','FO3 - Formalizado 3','FED - Federal (Unidad 420)','EVE - Eventual','HOM - Homologado','BUR - Burócrata','IB - IMSS-BIENESTAR','UNEME - CECOSAMA','Ramo 12','HON - Honorarios','ISSREEI - Nómina','FAM - UMM - IMSS B.','ASIMILADOS','TAMIZ - FEDERAL','SNSP','U013 - PAGO CDMX']);
        })->get();
        
        return view('vinculacion.jurisdicciones-detalles', compact('profesionales'));
    }

    public function extranjerosVYE()
    {
        /*$profesionales = Profesional::whereHas('puesto', function ($q){
            $q->where('vigencia', 'ACTIVO')
            ->whereIn('nomina_pago', ['REG - Regularizado','FOR - Formalizado 1','FO2 - Formalizado 2','FO3 - Formalizado 3','FED - Federal (Unidad 420)','EVE - Eventual','HOM - Homologado','BUR - Burócrata','IB - IMSS-BIENESTAR','UNEME - CECOSAMA','Ramo 12','HON - Honorarios','ISSREEI - Nómina','FAM - UMM - IMSS B.','ASIMILADOS','TAMIZ - FEDERAL','SNSP','U013 - PAGO CDMX']);
        })->where('nacionalidad', 'EXTRANJERO')->get();*/

        $profesionales = Profesional::where('nacionalidad', 'EXTRANJERO')
        ->whereHas('puesto', function ($q) {
            $q->where('vigencia', 'ACTIVO')
            ->whereIn('nomina_pago', [
                'REG - Regularizado',
                'FOR - Formalizado 1',
                'FO2 - Formalizado 2',
                'FO3 - Formalizado 3',
                'FED - Federal (Unidad 420)',
                'EVE - Eventual',
                'HOM - Homologado',
                'BUR - Burócrata',
                'IB - IMSS-BIENESTAR',
                'UNEME - CECOSAMA',
                'Ramo 12',
                'HON - Honorarios',
                'ISSREEI - Nómina',
                'FAM - UMM - IMSS B.',
                'ASIMILADOS',
                'TAMIZ - FEDERAL',
                'SNSP',
                'U013 - PAGO CDMX'
            ]);
        })
        ->get();

        return view('vinculacion.extranjeros', compact('profesionales'));
    }
}
