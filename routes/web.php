<?php

use App\Http\Controllers\AvisoController;
use App\Http\Controllers\CatalogoCentroDeSaludUrbanoYRuralController;
use App\Http\Controllers\CatalogoCluesController;
use App\Http\Controllers\CatalogoCodigosPuestoController;
use App\Http\Controllers\CatalogoNominaDePagoController;
use App\Http\Controllers\CatalogoOcupacionAlmacenController;
use App\Http\Controllers\CatalogoOcupacionCeamController;
use App\Http\Controllers\CatalogoOcupacionCentroDeSaludUrbanoYRuralController;
use App\Http\Controllers\CatalogoOcupacionCesameController;
use App\Http\Controllers\CatalogoOcupacionCetsLespController;
use App\Http\Controllers\CatalogoOcupacionCorsController;
use App\Http\Controllers\CatalogoOcupacionCriCreeController;
use App\Http\Controllers\CatalogoOcupacionEnsenanzaController;
use App\Http\Controllers\CatalogoOcupacionHospitalController;
use App\Http\Controllers\CatalogoOcupacionHospitalNinoController;
use App\Http\Controllers\CatalogoOcupacionIssreeiController;
use App\Http\Controllers\CatalogoOcupacionOficinaCentralController;
use App\Http\Controllers\CatalogoOcupacionOfJurisdiccionalController;
use App\Http\Controllers\CatalogoOcupacionPsiParrasController;
use App\Http\Controllers\CatalogoOcupacionSamuCrumController;
use App\Http\Controllers\CatalogosController;
use App\Http\Controllers\GitHubController;
use App\Http\Controllers\ProfesionalAreaMedicaController;
use App\Http\Controllers\ProfesionalCambioDeUnidadController;
use App\Http\Controllers\ProfesionalCambioTipoNominaController;
use App\Http\Controllers\ProfesionalCertificacionController;
use App\Http\Controllers\ProfesionalController;
use App\Http\Controllers\ProfesionalCredencializacionController;
use App\Http\Controllers\ProfesionalEmergenciaController;
use App\Http\Controllers\ProfesionalFirmaNominaController;
use App\Http\Controllers\ProfesionalGradoAcademicoController;
use App\Http\Controllers\ProfesionalHorarioController;
use App\Http\Controllers\ProfesionalNormatividadController;
use App\Http\Controllers\ProfesionalOcupacionController;
use App\Http\Controllers\ProfesionalPaseDeSalidaController;
use App\Http\Controllers\ProfesionalPuestoController;
use App\Http\Controllers\ProfesionalReporteController;
use App\Http\Controllers\ProfesionalRolController;
use App\Http\Controllers\ProfesionalSueldoController;
use App\Http\Controllers\ProfesionalVigenciaController;
use App\Http\Controllers\SystemSettingsController;
use App\Http\Controllers\UsuarioController;
use App\Models\ProfesionalOcupacionEnsenanza;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*Route::get('/', function () {
    return view('welcome');
});*/



Route::get('/pase-de-salida',[ProfesionalPaseDeSalidaController::class,'paseDeSalidaIndex'])->name('paseDeSalidaIndex');

Route::get('/pase-de-salida-create',[ProfesionalPaseDeSalidaController::class,'paseDeSalidaCreate'])->name('paseDeSalidaCreate');

Route::post('/pase-de-salida-store',[ProfesionalPaseDeSalidaController::class,'paseDeSalidaStore'])->name('paseDeSalidaStore');

//Route::get('admin/profesionales/firmaNomina/firmaIndex', [ProfesionalFirmaNominaController::class, 'firmaIndex'])->name('firmaIndex');

Route::get('/', function () {
    return redirect()->route('login');
});

/*******************************************************************************************
 * 
 * 
 * BLOQUEAMOS RUTAS DE ADMINLTE3 AUTH
 * 
 * 
 ******************************************************************************************/

Auth::routes([
    'register' => false, // Desactiva el registro de nuevos usuarios
    'reset' => false, // Desactiva la recuperación de contraseña
    'verify' => false,   // Desactiva la verificación de email
]);

/*******************************************************************************************
 * 
 * 
 * PROTEGEMOS TODAS LAS RUTAS
 * 
 * 
 ******************************************************************************************/

Route::middleware(['auth'])->group(function () 
{
    
    /*******************************************************************************************
     * 
     * 
     * PASES DE SALIDA
     * 
     * 
     ******************************************************************************************/

    Route::get('admin/profesionales/paseDeSalida/autorizarIndex',[ProfesionalPaseDeSalidaController::class,'autorizarIndex'])->name('autorizarIndex');

    Route::post('admin/profesionales/paseDeSalida/paseAutorizado/{id}',[ProfesionalPaseDeSalidaController::class,'paseAutorizado'])->name('paseAutorizado');

    Route::post('admin/profesionales/paseDeSalida/paseCancelado/{id}',[ProfesionalPaseDeSalidaController::class,'paseCancelado'])->name('paseCancelado');

    /*******************************************************************************************
     * 
     * 
     * CODIGOS QR PARA BUSCAR CURP
     * 
     * 
     ******************************************************************************************/
    
    Route::post('/procesar-qr', [ProfesionalController::class, 'procesar']);

    Route::post('/guardar-qr', [ProfesionalController::class, 'guardar'])->name('guardar.qr');


    
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    
    /**
     * 
     * 
     * PROFESIONALES MODULO
     * 
     * 
     */

    // Ruta para mostrar el formulario para buscar por CURP
    Route::get('admin/profesionales/buscarCurp', [ProfesionalController::class,'buscarCurp'])->name('buscarCurp');

    // Ruta para mostrar los registros
    Route::post('admin/profesionales/mostrarCurp', [ProfesionalController::class,'mostrarCurp'])->name('mostrarCurp');

    // Ruta para mostrar el formulario de datos generales
    Route::get('admin/profesionales/datosGenerales/{curp}', [ProfesionalController::class, 'datosGenerales'])->name('datosGenerales');

    // Ruta para guardar los datos generales
    Route::post('admin/profesionales/datosGeneralesStore',[ProfesionalController::class, 'datosGeneralesStore'])->name('datosGeneralesStore');

    // Ruta para ver los registros
    Route::get('admin/profesionales/profesionalIndex',[ProfesionalController::class, 'profesionalIndex'])->name('profesionalIndex');

    // Ruta para mostrar los registros en baja temporal
    Route::get('admin/profesionales/profesionalesBajasTemporalesIndex',[ProfesionalController::class, 'profesionalesBajasTemporalesIndex'])->name('profesionalesBajasTemporalesIndex');

    // Ruta para mostrar los registros en baja definitiva
    Route::get('admin/profesionales/profesionalesBajasDefinitivasIndex',[ProfesionalController::class, 'profesionalesBajasDefinitivasIndex'])->name('profesionalesBajasDefinitivasIndex');

    // Ruta para mostrar el formulario de edicion
    Route::get('admin/profesionales/profesionalEdit/{id}', [ProfesionalController::class, 'profesionalEdit'])->name('profesionalEdit');

    // Ruta para actualizar el registro
    Route::put('admin/profesionales/profesionalUpdate/{id}', [ProfesionalController::class, 'profesionalUpdate'])->name('profesionalUpdate');

    // Ruta para mostrar el perfil del trabajador
    Route::get('admin/profesionales/profesionalShow/{id}', [ProfesionalController::class, 'profesionalShow'])->name('profesionalShow');

    // Ruta para generar el PDF
    Route::get('admin/profesionales/profesionalPDF/{id}', [ProfesionalController::class, 'profesionalPDF'])->name('profesionalPDF');

    // Ruta para el formlario de OCUPACION
    Route::get('admin/profesionales/profesionalOcupacionCreate/{id}',[ProfesionalController::class,'profesionalOcupacionCreate'])->name('profesionalOcupacionCreate');

    // Ruta para mostrar los formularios de buscador
    Route::get('admin/profesionales/profesionalBuscadorForm',[ProfesionalController::class,'profesionalBuscadorForm'])->name('profesionalBuscadorForm');

    // Buscador por CURP
    Route::get('admin/profesionales/profesionalBuscadorCurp',[ProfesionalController::class,'profesionalBuscadorCurp'])->name('profesionalBuscadorCurp');

    // Registros incompletos
    Route::get('admin/profesionales/profesionalIncompletosIndex',[ProfesionalController::class,'profesionalIncompletosIndex'])->name('profesionalIncompletosIndex');

    // Ruta para mostrar el formulario de registro para Ensenanza
    Route::get('admin/profesionales/datosGeneralesEnsenanza/{curp}', [ProfesionalController::class, 'datosGeneralesEnsenanza'])->name('datosGeneralesEnsenanza');

     // Ruta para guardar los datos generales para ensenanza
    Route::post('admin/profesionales/datosGeneralesStoreEnsenanza',[ProfesionalController::class, 'datosGeneralesStoreEnsenanza'])->name('datosGeneralesStoreEnsenanza');

    // Ruta para editar los datos de registro de Enseñanza

    Route::get('admin/profesionales/editDatosGeneralesEnsenanza/{id}',[ProfesionalController::class,'editDatosGeneralesEnsenanza'])->name('editDatosGeneralesEnsenanza');

    Route::put('admin/profesionales/updateDatosGeneralesEnsenanza/{id}',[ProfesionalController::class,'updateDatosGeneralesEnsenanza'])->name('updateDatosGeneralesEnsenanza');

    /**
     * 
     * 
     * MI JURISDICCION
     * 
     * 
     */

     Route::get('admin/profesionales/miJurisdiccion', [ProfesionalController::class, 'miJurisdiccion'])->name('miJurisdiccion');

     Route::get('admin/profesionales/miJurisdiccionBajaTemporal', [ProfesionalController::class, 'miJurisdiccionBajaTemporal'])->name('miJurisdiccionBajaTemporal');

     Route::get('admin/profesionales/miJurisdiccionBajaDefinitiva', [ProfesionalController::class, 'miJurisdiccionBajaDefinitiva'])->name('miJurisdiccionBajaDefinitiva');

    /**
     * 
     * 
     * PUESTO MODULO
     * 
     * 
     */

    //Ruta para mostrar el formulario de creacion
    Route::get('admin/profesionales/puesto/createPuesto/{id}',[ProfesionalPuestoController::class,'createPuesto'])->name('createPuesto');

    // Ruta para almacenar los datos
    Route::post('admin/profesionales/puesto/storePuesto',[ProfesionalPuestoController::class,'storePuesto'])->name('storePuesto');

    // Ruta para mostrar el formulario de edicicon
    Route::get('admin/profesionales/puesto/editPuesto/{id}', [ProfesionalPuestoController::class, 'editPuesto'])->name('editPuesto');

    // Ruta para editar los datos
    Route::put('admin/profesionales/puesto/updatePuesto/{id}', [ProfesionalPuestoController::class, 'updatePuesto'])->name('updatePuesto');

    // Ruta dinamica para mostrar los motivos de vigencia
    Route::get('/vigencias-motivos/{vigencia}', [ProfesionalPuestoController::class, 'getMotivos']);

    /**
     * 
     * 
     * CREDENCIALIZACION MODULO
     * 
     * 
     */

    // Ruta para mostrar el formulario
    Route::get('admin/profesionales/credencializacion/createCredencializacion/{id}',[ProfesionalCredencializacionController::class,'createCredencializacion'])->name('createCredencializacion');

    // Ruta para guardar los datos
    Route::post('admin/profesionales/credencializacion/storeCredencializacion', [ProfesionalCredencializacionController::class,'storeCredencializacion'])->name('storeCredencializacion');

    // Ruta para mostrar el form de editar la fotografia
    Route::get('admin/profesionales/credencializacion/editCredencializacion/{id}', [ProfesionalCredencializacionController::class, 'editCredencializacion'])->name('editCredencializacion');

    // Ruta para actualizar el registro
    Route::put('admin/profesionales/credencializacion/updateCredencializacion/{id}', [ProfesionalCredencializacionController::class, 'updateCredencializacion'])->name('updateCredencializacion');

    // Ruta para descargar la imagen
    Route::get('/credencializacion/descargar/{id}', [ProfesionalCredencializacionController::class, 'descargarFoto'])->name('credencializacion.descargar');

    /**
     * 
     * 
     * HORARIO MODULO
     * 
     * 
     */
    Route::get('admin/profesionales/horario/createHorario/{id}',[ProfesionalHorarioController::class,'createHorario'])->name('createHorario');

    Route::post('admin/profesionales/horario/storeHorario', [ProfesionalHorarioController::class, 'storeHorario'])->name('storeHorario');

    Route::get('admin/profesionales/horario/editHorario/{id}', [ProfesionalHorarioController::class,'editHorario'])->name('editHorario');

    Route::put('admin/profesionales/horario/updateHorario/{id}', [ProfesionalHorarioController::class, 'updateHorario'])->name('updateHorario');

    /**
     * 
     * 
     * SUELDO MODULO
     * 
     * 
     */

    Route::get('admin/profesionales/sueldo/createSueldo/{id}', [ProfesionalSueldoController::class,'createSueldo'])->name('createSueldo');

    Route::post('admin/profesionales/sueldo/storeSueldo', [ProfesionalSueldoController::class,'storeSueldo'])->name('storeSueldo');

    Route::get('admin/profesionales/sueldo/editSueldo/{id}', [ProfesionalSueldoController::class, 'editSueldo'])->name('editSueldo');

    Route::put('admin/profesionales/sueldo/updateSueldo/{id}', [ProfesionalSueldoController::class, 'updateSueldo'])->name('updateSueldo');

    
    /**
     * 
     * 
     * GRADO ACADEMICO MODULO
     * 
     * 
     */

     Route::get('admin/profesionales/gradoAcademico/createGrado/{id}', [ProfesionalGradoAcademicoController::class,'createGrado'])->name('createGrado');

     Route::post('admin/profesionales/gradoAcademico/storeGrado', [ProfesionalGradoAcademicoController::class,'storeGrado'])->name('storeGrado');
 
     Route::get('admin/profesionales/gradoAcademico/editGrado/{id}', [ProfesionalGradoAcademicoController::class, 'editGrado'])->name('editGrado');
 
     Route::put('admin/profesionales/gradoAcademico/updateGrado/{id}', [ProfesionalGradoAcademicoController::class, 'updateGrado'])->name('updateGrado');

    // Ruta dinamica para mostrar
    Route::get('/titulos/{cve}', [ProfesionalGradoAcademicoController::class, 'getTitulos']);

    /**
     * 
     * 
     * AREA MEDICA MODULO
     * 
     * 
     */

     Route::get('admin/profesionales/area-medica/createAreaMedica/{id}', [ProfesionalAreaMedicaController::class,'createAreaMedica'])->name('createAreaMedica');

     Route::post('admin/profesionales/area-medica/storeAreaMedica', [ProfesionalAreaMedicaController::class,'storeAreaMedica'])->name('storeAreaMedica');
 
     Route::get('admin/profesionales/area-medica/editAreaMedica/{id}', [ProfesionalAreaMedicaController::class, 'editAreaMedica'])->name('editAreaMedica');
 
     Route::put('admin/profesionales/area-medica/updateAreaMedica/{id}', [ProfesionalAreaMedicaController::class, 'updateAreaMedica'])->name('updateAreaMedica');

     Route::get('/get-carreras/{id}', [ProfesionalAreaMedicaController::class, 'getCarreras']);

     /**
     * 
     * 
     * CERTIFICACIONES MODULO
     * 
     * 
     */

     Route::get('admin/profesionales/certificaciones/createCertificacion/{id}', [ProfesionalCertificacionController::class,'createCertificacion'])->name('createCertificacion');

     Route::post('admin/profesionales/certificaciones/storeCertificacion', [ProfesionalCertificacionController::class,'storeCertificacion'])->name('storeCertificacion');
 
     Route::get('admin/profesionales/certificaciones/editCertificacion/{id}', [ProfesionalCertificacionController::class, 'editCertificacion'])->name('editCertificacion');
 
     Route::put('admin/profesionales/certificaciones/updateCertificacion/{id}', [ProfesionalCertificacionController::class, 'updateCertificacion'])->name('updateCertificacion');

    /**
    * 
    *
    * MODULO DE REPORTES
    *
    *
    */

    Route::get('admin/profesionales/reportes/reporteIndex',[ProfesionalReporteController::class,'reporteIndex'])->name('reporteIndex');

    Route::get('admin/profesionales/reportes/descargarCarpetaFotografias', [ProfesionalReporteController::class,'descargarCarpetaFotografias'])->name('descargarCarpetaFotografias');

    Route::get('/contratos-por-nomina/{nomina}', [ProfesionalCambioTipoNominaController::class, 'getContratosPorNomina']);

     /**
     * 
     * 
     * EMERGENCIAS MODULO
     * 
     * 
     */

     Route::get('admin/profesionales/emergencias/createEmergencia/{id}', [ProfesionalEmergenciaController::class,'createEmergencia'])->name('createEmergencia');

     Route::post('admin/profesionales/emergencias/storeEmergencia', [ProfesionalEmergenciaController::class,'storeEmergencia'])->name('storeEmergencia');
 
     Route::get('admin/profesionales/emergencias/editEmergencia/{id}', [ProfesionalEmergenciaController::class, 'editEmergencia'])->name('editEmergencia');
 
     Route::put('admin/profesionales/emergencias/updateEmergencia/{id}', [ProfesionalEmergenciaController::class, 'updateEmergencia'])->name('updateEmergencia');

     Route::get('admin/profesionales/emergencias/emergenciaPDF/{id}', [ProfesionalEmergenciaController::class, 'emergenciaPDF'])->name('emergenciaPDF');

     Route::get('/entidades', [ProfesionalEmergenciaController::class, 'entidades'])->name('entidades');

     Route::get('/municipios/{entidad}', [ProfesionalEmergenciaController::class, 'municipios'])->name('municipios');

     

     /**
     * 
     * 
     * VIGENCIAS MODULO
     * 
     * 
     */

     Route::get('admin/profesionales/vigencias/createVigencia/{id}', [ProfesionalVigenciaController::class,'createVigencia'])->name('createVigencia');

     Route::post('admin/profesionales/vigencias/storeVigencia', [ProfesionalVigenciaController::class,'storeVigencia'])->name('storeVigencia');
 
     Route::get('admin/profesionales/vigencias/editVigencia/{id}', [ProfesionalVigenciaController::class, 'editVigencia'])->name('editVigencia');
 
     Route::put('admin/profesionales/vigencias/updateVigencia/{id}', [ProfesionalVigenciaController::class, 'updateVigencia'])->name('updateVigencia');

     

          /**
     * 
     * 
     * CAMBIO DE TIPO DE NOMINA MODULO
     * 
     * 
     */

     Route::get('admin/profesionales/cambioTipoNomina/createCambioTipoNomina/{id}', [ProfesionalCambioTipoNominaController::class,'createCambioTipoNomina'])->name('createCambioTipoNomina');

     Route::post('admin/profesionales/cambioTipoNomina/storeCambioTipoNomina', [ProfesionalCambioTipoNominaController::class,'storeCambioTipoNomina'])->name('storeCambioTipoNomina');
 
     Route::get('admin/profesionales/cambioTipoNomina/editCambioTipoNomina/{id}', [ProfesionalCambioTipoNominaController::class, 'editCambioTipoNomina'])->name('editCambioTipoNomina');
 
     Route::put('admin/profesionales/cambioTipoNomina/updateCambioTipoNomina/{id}', [ProfesionalCambioTipoNominaController::class, 'updateCambioTipoNomina'])->name('updateCambioTipoNomina');

    /**
     * 
     * 
     * CAMBIO DE UNIDAD
     * 
     * 
     */

     Route::get('admin/profesionales/cambioDeUnidad/findProfesional', [ProfesionalCambioDeUnidadController::class,'findProfesional'])->name('findProfesional');

     Route::post('admin/profesionales/cambioDeUnidad/showProfesional', [ProfesionalCambioDeUnidadController::class, 'showProfesional'])->name('showProfesional');

     Route::get('admin/profesionales/cambioDeUnidad/createCambioDeUnidad/{id}', [ProfesionalCambioDeUnidadController::class, 'createCambioDeUnidad'])->name('createCambioDeUnidad');

     Route::post('admin/profesionales/cambioDeUnidad/storeCambioDeUnidad', [ProfesionalCambioDeUnidadController::class, 'storeCambioDeUnidad'])->name('storeCambioDeUnidad');

     Route::put('admin/profesionales/cambioDeUnidad/cambioDeUnidadForzoso', [ProfesionalCambioDeUnidadController::class, 'cambioDeUnidadForzoso'])->name('cambioDeUnidadForzoso');

     // Ruta para cargar el documento de respaldo despues de hacer el registro
     
     Route::get('admin/profesionales/cambioDeUnidad/documentoRespaldoCreate/{id}', [ProfesionalCambioDeUnidadController::class,'documentoRespaldoCreate'])->name('documentoRespaldoCreate');

     Route::put('admin/profesionales/cambioDeUnidad/documentoRespaldoStore/{id}', [ProfesionalCambioDeUnidadController::class,'documentoRespaldoStore'])->name('documentoRespaldoStore');

     Route::get('/descargar-documento/{id}', [ProfesionalCambioDeUnidadController::class, 'descargar'])->name('descargar.documento');

     Route::get('/reg-nac-prof-uno/{id}', [ProfesionalGradoAcademicoController::class, 'regNacProfUno'])->name('regNacProfUno');

     Route::get('/reg-nac-prof-dos/{id}', [ProfesionalGradoAcademicoController::class, 'regNacProfDos'])->name('regNacProfDos');

     Route::get('/reg-nac-prof-tres/{id}', [ProfesionalGradoAcademicoController::class, 'regNacProfTres'])->name('regNacProfTres');

     Route::get('/reg-nac-prof-cuatro/{id}', [ProfesionalGradoAcademicoController::class, 'regNacProfCuatro'])->name('regNacProfCuatro');

     /**
     * 
     * 
     * CATALOGO DE OCUPACIONES MODULO
     * 
     * 
     */

     /** RUTAS PARA EL CATALOGO 1 - CENTROS DE SALUD URBANOS Y RURALES */

     Route::get('admin/profesionales/ocupaciones/createCentrosDeSalud/{id}', [ProfesionalOcupacionController::class, 'createCentrosDeSalud'])->name('createCentrosDeSalud');

     Route::post('admin/profesionales/ocupaciones/storeCentrosDeSalud', [ProfesionalOcupacionController::class, 'storeCentrosDeSalud'])->name('storeCentrosDeSalud');

     Route::get('admin/profesionales/ocupaciones/editCentrosDeSalud/{id}', [ProfesionalOcupacionController::class, 'editCentrosDeSalud'])->name('editCentrosDeSalud');

     Route::put('admin/profesionales/ocupaciones/updateCentrosDeSalud/{id}', [ProfesionalOcupacionController::class, 'updateCentrosDeSalud'])->name('updateCentrosDeSalud');

     /**RUTAS PARA EL CATALOGO 2 - HOSPITALES */

     Route::get('admin/profesionales/ocupaciones/createHospital/{id}', [ProfesionalOcupacionController::class, 'createHospital'])->name('createHospital');

     Route::post('admin/profesionales/ocupaciones/storeHospital', [ProfesionalOcupacionController::class, 'storeHospital'])->name('storeHospital');

     Route::get('admin/profesionales/ocupaciones/editHospital/{id}', [ProfesionalOcupacionController::class, 'editHospital'])->name('editHospital');

     Route::put('admin/profesionales/ocupaciones/updateHospital/{id}', [ProfesionalOcupacionController::class, 'updateHospital'])->name('updateHospital');

      /**RUTAS PARA EL CATALOGO 3 - OFICINAS JURISDICCIONALES */

      Route::get('admin/profesionales/ocupaciones/createOfJurisdiccional/{id}', [ProfesionalOcupacionController::class, 'createOfJurisdiccional'])->name('createOfJurisdiccional');

      Route::post('admin/profesionales/ocupaciones/storeOfJurisdiccional', [ProfesionalOcupacionController::class, 'storeOfJurisdiccional'])->name('storeOfJurisdiccional');
 
      Route::get('admin/profesionales/ocupaciones/editOfJurisdiccional/{id}', [ProfesionalOcupacionController::class, 'editOfJurisdiccional'])->name('editOfJurisdiccional');
 
      Route::put('admin/profesionales/ocupaciones/updateOfJurisdiccional/{id}', [ProfesionalOcupacionController::class, 'updateOfJurisdiccional'])->name('updateOfJurisdiccional');

      /**RUTAS PARA EL CATALOGO 4 - CRI CREE */

      Route::get('admin/profesionales/ocupaciones/createCriCree/{id}', [ProfesionalOcupacionController::class, 'createCriCree'])->name('createCriCree');

      Route::post('admin/profesionales/ocupaciones/storeCriCree', [ProfesionalOcupacionController::class, 'storeCriCree'])->name('storeCriCree');
 
      Route::get('admin/profesionales/ocupaciones/editCriCree/{id}', [ProfesionalOcupacionController::class, 'editCriCree'])->name('editCriCree');
 
      Route::put('admin/profesionales/ocupaciones/updateCriCree/{id}', [ProfesionalOcupacionController::class, 'updateCriCree'])->name('updateCriCree');

      /**RUTAS PARA EL CATALOGO 5 - SAMU CRUM */

      Route::get('admin/profesionales/ocupaciones/createSamuCrum/{id}', [ProfesionalOcupacionController::class, 'createSamuCrum'])->name('createSamuCrum');

      Route::post('admin/profesionales/ocupaciones/storeSamuCrum', [ProfesionalOcupacionController::class, 'storeSamuCrum'])->name('storeSamuCrum');
 
      Route::get('admin/profesionales/ocupaciones/editSamuCrum/{id}', [ProfesionalOcupacionController::class, 'editSamuCrum'])->name('editSamuCrum');
 
      Route::put('admin/profesionales/ocupaciones/updateSamuCrum/{id}', [ProfesionalOcupacionController::class, 'updateSamuCrum'])->name('updateSamuCrum');

      /**RUTAS PARA EL CATALOGO 6 - OFICINA CENTRAL */

      Route::get('admin/profesionales/ocupaciones/createOficinaCentral/{id}', [ProfesionalOcupacionController::class, 'createOficinaCentral'])->name('createOficinaCentral');

      Route::post('admin/profesionales/ocupaciones/storeOficinaCentral', [ProfesionalOcupacionController::class, 'storeOficinaCentral'])->name('storeOficinaCentral');
 
      Route::get('admin/profesionales/ocupaciones/editOficinaCentral/{id}', [ProfesionalOcupacionController::class, 'editOficinaCentral'])->name('editOficinaCentral');
 
      Route::put('admin/profesionales/ocupaciones/updateOficinaCentral/{id}', [ProfesionalOcupacionController::class, 'updateOficinaCentral'])->name('updateOficinaCentral');

      /**RUTAS PARA EL CATALOGO 7 - ALMACEN */

      Route::get('admin/profesionales/ocupaciones/createAlmacen/{id}', [ProfesionalOcupacionController::class, 'createAlmacen'])->name('createAlmacen');

      Route::post('admin/profesionales/ocupaciones/storeAlmacen', [ProfesionalOcupacionController::class, 'storeAlmacen'])->name('storeAlmacen');
 
      Route::get('admin/profesionales/ocupaciones/editAlmacen/{id}', [ProfesionalOcupacionController::class, 'editAlmacen'])->name('editAlmacen');
 
      Route::put('admin/profesionales/ocupaciones/updateAlmacen/{id}', [ProfesionalOcupacionController::class, 'updateAlmacen'])->name('updateAlmacen');

      //Route::delete('admin/profesionales/ocupaciones/destroyAlmacen/{id}', [ProfesionalOcupacionController::class, 'destroyAlmacen'])->name('destroyAlmacen');

      /**RUTAS PARA EL CATALOGO 8 - CETS LESP */

      Route::get('admin/profesionales/ocupaciones/createCetsLesp/{id}', [ProfesionalOcupacionController::class, 'createCetsLesp'])->name('createCetsLesp');

      Route::post('admin/profesionales/ocupaciones/storeCetsLesp', [ProfesionalOcupacionController::class, 'storeCetsLesp'])->name('storeCetsLesp');
 
      Route::get('admin/profesionales/ocupaciones/editCetsLesp/{id}', [ProfesionalOcupacionController::class, 'editCetsLesp'])->name('editCetsLesp');
 
      Route::put('admin/profesionales/ocupaciones/updateCetsLesp/{id}', [ProfesionalOcupacionController::class, 'updateCetsLesp'])->name('updateCetsLesp');

      /**RUTAS PARA EL CATALOGO 9 - CENTRO ONCOLOGICO DE LA REGION SURESTE */

      Route::get('admin/profesionales/ocupaciones/createCors/{id}', [ProfesionalOcupacionController::class, 'createCors'])->name('createCors');

      Route::post('admin/profesionales/ocupaciones/storeCors', [ProfesionalOcupacionController::class, 'storeCors'])->name('storeCors');
 
      Route::get('admin/profesionales/ocupaciones/editCors/{id}', [ProfesionalOcupacionController::class, 'editCors'])->name('editCors');
 
      Route::put('admin/profesionales/ocupaciones/updateCors/{id}', [ProfesionalOcupacionController::class, 'updateCors'])->name('updateCors');

      /**RUTAS PARA EL CATALOGO 10 - I.S.S.R.E.E.I. */

      Route::get('admin/profesionales/ocupaciones/createIssreei/{id}', [ProfesionalOcupacionController::class, 'createIssreei'])->name('createIssreei');

      Route::post('admin/profesionales/ocupaciones/storeIssreei', [ProfesionalOcupacionController::class, 'storeIssreei'])->name('storeIssreei');
 
      Route::get('admin/profesionales/ocupaciones/editIssreei/{id}', [ProfesionalOcupacionController::class, 'editIssreei'])->name('editIssreei');
 
      Route::put('admin/profesionales/ocupaciones/updateIssreei/{id}', [ProfesionalOcupacionController::class, 'updateIssreei'])->name('updateIssreei');

      /**RUTAS PARA EL CATALOGO 11 - CESAME */

      Route::get('admin/profesionales/ocupaciones/createCesame/{id}', [ProfesionalOcupacionController::class, 'createCesame'])->name('createCesame');

      Route::post('admin/profesionales/ocupaciones/storeCesame', [ProfesionalOcupacionController::class, 'storeCesame'])->name('storeCesame');
 
      Route::get('admin/profesionales/ocupaciones/editCesame/{id}', [ProfesionalOcupacionController::class, 'editCesame'])->name('editCesame');
 
      Route::put('admin/profesionales/ocupaciones/updateCesame/{id}', [ProfesionalOcupacionController::class, 'updateCesame'])->name('updateCesame');

      /**RUTAS PARA EL CATALOGO 12 - PSI PARRAS */

      Route::get('admin/profesionales/ocupaciones/createPsiParras/{id}', [ProfesionalOcupacionController::class, 'createPsiParras'])->name('createPsiParras');

      Route::post('admin/profesionales/ocupaciones/storePsiParras', [ProfesionalOcupacionController::class, 'storePsiParras'])->name('storePsiParras');
 
      Route::get('admin/profesionales/ocupaciones/editPsiParras/{id}', [ProfesionalOcupacionController::class, 'editPsiParras'])->name('editPsiParras');
 
      Route::put('admin/profesionales/ocupaciones/updatePsiParras/{id}', [ProfesionalOcupacionController::class, 'updatePsiParras'])->name('updatePsiParras');

      /**RUTAS PARA EL CATALOGO 13 - CEAM */

      Route::get('admin/profesionales/ocupaciones/createCeam/{id}', [ProfesionalOcupacionController::class, 'createCeam'])->name('createCeam');

      Route::post('admin/profesionales/ocupaciones/storeCeam', [ProfesionalOcupacionController::class, 'storeCeam'])->name('storeCeam');
 
      Route::get('admin/profesionales/ocupaciones/editCeam/{id}', [ProfesionalOcupacionController::class, 'editCeam'])->name('editCeam');
 
      Route::put('admin/profesionales/ocupaciones/updateCeam/{id}', [ProfesionalOcupacionController::class, 'updateCeam'])->name('updateCeam');

      /**RUTAS PARA EL CATALOGO 14 - HOSPITAL DEL NIÑO */

      Route::get('admin/profesionales/ocupaciones/createHospitalNino/{id}', [ProfesionalOcupacionController::class, 'createHospitalNino'])->name('createHospitalNino');

      Route::post('admin/profesionales/ocupaciones/storeHospitalNino', [ProfesionalOcupacionController::class, 'storeHospitalNino'])->name('storeHospitalNino');
 
      Route::get('admin/profesionales/ocupaciones/editHospitalNino/{id}', [ProfesionalOcupacionController::class, 'editHospitalNino'])->name('editHospitalNino');
 
      Route::put('admin/profesionales/ocupaciones/updateHospitalNino/{id}', [ProfesionalOcupacionController::class, 'updateHospitalNino'])->name('updateHospitalNino');

      /**RUTAS PARA EL CATALOGO 15 - PASANTES MEDICOS Y ENFERMERIA */

      Route::get('admin/profesionales/ocupaciones/createEnsenanza/{id}', [ProfesionalOcupacionController::class, 'createEnsenanza'])->name('createEnsenanza');

      Route::post('admin/profesionales/ocupaciones/storeEnsenanza', [ProfesionalOcupacionController::class, 'storeEnsenanza'])->name('storeEnsenanza');
 
      Route::get('admin/profesionales/ocupaciones/editEnsenanza/{id}', [ProfesionalOcupacionController::class, 'editEnsenanza'])->name('editEnsenanza');
 
      Route::put('admin/profesionales/ocupaciones/updateEnsenanza/{id}', [ProfesionalOcupacionController::class, 'updateEnsenanza'])->name('updateEnsenanza');

    /**
     * 
     * 
     * MODULO DE REPORTES
     * 
     * 
     */
    
     // Ruta para el reporte de Excel
    Route::get('admin/profesionales/reportes/reporteExcel', [ProfesionalController::class, 'export'])->name('profesionalExport');

    Route::get('admin/profesionales/reportes/reporteExcelBajaTemporal', [ProfesionalController::class, 'exportBajasTemporales'])->name('reporteExcelBajaTemporal');

    Route::get('admin/profesionales/reportes/reporteExcelBajaDefinitiva', [ProfesionalController::class, 'exportBajasDefinitivas'])->name('reporteExcelBajaDefinitiva');

    Route::get('admin/profesionales/reportes/reporteMexicoExcel', [ProfesionalController::class, 'reporteMexicoExcel'])->name('reporteMexicoExcel');

    Route::get('admin/profesionales/reportes/reporteRiesgosEstatal', [ProfesionalController::class, 'reporteRiesgosEstatal'])->name('reporteRiesgosEstatal');

    // Ruta para el envio de correos
    Route::get('admin/profesionales/cumpleanos',[ProfesionalController::class,'enviarFelicitaciones'])->name('enviarFelicitaciones');

    /**
     * 
     * 
     * MODULOS ADMINISRATIVOS
     * USUARIOS
     * 
     * 
     */

     Route::get('admin/usuarios/indexUsuario', [UsuarioController::class,'indexUsuario'])->name('indexUsuario');

     Route::get('admin/usuarios/showUsuario/{id}', [UsuarioController::class,'showUsuario'])->name('showUsuario');

     Route::get('admin/usuarios/createUsuario', [UsuarioController::class,'createUsuario'])->name('createUsuario');

     Route::post('admin/usuarios/storeUsuario', [UsuarioController::class,'storeUsuario'])->name('storeUsuario');

     Route::get('admin/usuarios/editUsuario/{id}', [UsuarioController::class,'editUsuario'])->name('editUsuario');

     Route::put('admin/usuarios/updateUsuario/{id}', [UsuarioController::class,'updateUsuario'])->name('updateUsuario');

     Route::delete('admin/usuarios/deleteUsuario/{id}', [UsuarioController::class, 'deleteUsuario'])->name('deleteUsuario');

     /**
     * 
     * 
     * MODULOS ADMINISRATIVOS
     * CLUES PANEL DE CONTROL
     * 
     * 
     */

     Route::get('admin/clues/indexClues', [CatalogoCluesController::class,'indexClues'])->name('indexClues');

     Route::get('admin/clues/showClues/{id}', [CatalogoCluesController::class,'showClues'])->name('showClues');

     Route::get('admin/clues/createClues', [CatalogoCluesController::class,'createClues'])->name('createClues');

     Route::post('admin/clues/storeClues', [CatalogoCluesController::class,'storeClues'])->name('storeClues');

     Route::get('admin/clues/editClues/{id}', [CatalogoCluesController::class,'editClues'])->name('editClues');

     Route::put('admin/clues/updateClues/{id}', [CatalogoCluesController::class,'updateClues'])->name('updateClues');

     Route::delete('admin/clues/deleteClues/{id}', [CatalogoCluesController::class, 'deleteClues'])->name('deleteClues');

     /**
     * 
     * 
     * MODULOS ADMINISRATIVOS
     * CODIGOS DE NOMINA PANEL DE CONTROL
     * 
     * 
     */

     Route::get('admin/clues/indexCodigos', [CatalogoCodigosPuestoController::class,'indexCodigos'])->name('indexCodigos');

     Route::get('admin/clues/showCodigos/{id}', [CatalogoCodigosPuestoController::class,'showCodigos'])->name('showCodigos');

     Route::get('admin/clues/createCodigos', [CatalogoCodigosPuestoController::class,'createCodigos'])->name('createCodigos');

     Route::post('admin/clues/storeCodigos', [CatalogoCodigosPuestoController::class,'storeCodigos'])->name('storeCodigos');

     Route::get('admin/clues/editCodigos/{id}', [CatalogoCodigosPuestoController::class,'editCodigos'])->name('editCodigos');

     Route::put('admin/clues/updateCodigos/{id}', [CatalogoCodigosPuestoController::class,'updateCodigos'])->name('updateCodigos');

     Route::delete('admin/clues/deleteCodigos/{id}', [CatalogoCodigosPuestoController::class, 'deleteCodigos'])->name('deleteCodigos');

     /**
     * 
     * 
     * MODULOS ADMINISRATIVOS
     * ROLES Y PERMISOS
     * 
     * 
     */

     Route::get('admin/usuarios/roles/indexRol', [ProfesionalRolController::class,'indexRol'])->name('indexRol');

     Route::get('admin/usuarios/roles/showRol/{id}', [ProfesionalRolController::class,'showRol'])->name('showRol');

     Route::get('admin/usuarios/roles/createRol', [ProfesionalRolController::class,'createRol'])->name('createRol');

     Route::post('admin/usuarios/roles/storeRol', [ProfesionalRolController::class,'storeRol'])->name('storeRol');

     Route::get('admin/usuarios/roles/editRol/{id}', [ProfesionalRolController::class,'editRol'])->name('editRol');

     Route::put('admin/usuarios/roles/updateRol/{id}', [ProfesionalRolController::class,'updateRol'])->name('updateRol');

     Route::delete('admin/usuarios/roles/deleteRol/{id}', [ProfesionalRolController::class, 'deleteRol'])->name('deleteRol');

     /**
     * 
     * 
     * NOMINAS DE PAGO
     * 
     * 
     */

     Route::get('admin/settings/nomina-pago/nominaPagoIndex', [CatalogoNominaDePagoController::class,'nominaPagoIndex'])->name('nominaPagoIndex');

     Route::get('admin/settings/nomina-pago/nominaPagoShow/{id}', [CatalogoNominaDePagoController::class,'nominaPagoShow'])->name('nominaPagoShow');

     Route::get('admin/settings/nomina-pago/nominaPagoCreate', [CatalogoNominaDePagoController::class,'nominaPagoCreate'])->name('nominaPagoCreate');

     Route::post('admin/settings/nomina-pago/nominaPagoStore', [CatalogoNominaDePagoController::class,'nominaPagoStore'])->name('nominaPagoStore');

     Route::get('admin/settings/nomina-pago/nominaPagoEdit/{id}', [CatalogoNominaDePagoController::class,'nominaPagoEdit'])->name('nominaPagoEdit');

     Route::put('admin/settings/nomina-pago/nominaPagoUpdate/{id}', [CatalogoNominaDePagoController::class,'nominaPagoUpdate'])->name('nominaPagoUpdate');

     Route::delete('admin/settings/nomina-pago/nominaPagoDelete/{id}', [CatalogoNominaDePagoController::class, 'nominaPagoDelete'])->name('nominaPagoDelete');

     Route::get('admin/settings/nomina-pago/tipoDeContratoCreate/{id}', [CatalogoNominaDePagoController::class,'tipoDeContratoCreate'])->name('tipoDeContratoCreate');

     Route::post('admin/settings/nomina-pago/tipoDeContratoStore', [CatalogoNominaDePagoController::class,'tipoDeContratoStore'])->name('tipoDeContratoStore');

     Route::delete('admin/settings/nomina-pago/tipoDeContratoDelete/{id}', [CatalogoNominaDePagoController::class, 'tipoDeContratoDelete'])->name('tipoDeContratoDelete');




    /**
     * 
     * 
     * NORMATIVIDAD
     * 
     * 
     */

     Route::get('admin/normatividad/indexNormatividad', [ProfesionalNormatividadController::class,'indexNormatividad'])->name('indexNormatividad');

     Route::post('admin/normatividad/createBajasTemporales', [ProfesionalNormatividadController::class,'createBajasTemporales'])->name('createBajasTemporales');

     Route::post('admin/normatividad/createBajasComision', [ProfesionalNormatividadController::class,'createBajasComision'])->name('createBajasComision');

      /**
     * 
     * 
     * AVISOS
     * 
     * 
     */

    Route::get('admin/avisis/declaracion-patrimonial', [AvisoController::class,'declaracionPatrimonial'])->name('declaracionPatrimonial');
    /**
     * 
     * 
     * 1 - OCUPACIONES CENTROS DE SALUD URBANOS Y RURALES
     * 
     * 
     */
     Route::get('admin/settings/ocupacion/csuyr/index', [CatalogoOcupacionCentroDeSaludUrbanoYRuralController::class, 'ocupacionCsuyrIndex'])->name('ocupacionCsuyrIndex'); 

     Route::get('admin/settings/ocupacion/csuyr/create', [CatalogoOcupacionCentroDeSaludUrbanoYRuralController::class, 'ocupacionCsuyrCreate'])->name('ocupacionCsuyrCreate');  

     Route::post('admin/settings/ocupacion/csuyr/store', [CatalogoOcupacionCentroDeSaludUrbanoYRuralController::class, 'ocupacionCsuyrStore'])->name('ocupacionCsuyrStore'); 

     Route::get('admin/settings/ocupacion/csuyr/edit/{id}', [CatalogoOcupacionCentroDeSaludUrbanoYRuralController::class, 'ocupacionCsuyrEdit'])->name('ocupacionCsuyrEdit');  

     Route::put('admin/settings/ocupacion/csuyr/update/{id}', [CatalogoOcupacionCentroDeSaludUrbanoYRuralController::class, 'ocupacionCsuyrUpdate'])->name('ocupacionCsuyrUpdate');
     
     Route::delete('admin/settings/ocupacion/csuyr/delete/{id}', [CatalogoOcupacionCentroDeSaludUrbanoYRuralController::class, 'ocupacionCsuyrDestroy'])->name('ocupacionCsuyrDestroy');

     /**
     * 
     * 
     * 2 - OCUPACIONES HOSPITALES
     * 
     * 
     */
    Route::get('admin/settings/ocupacion/hospital/index', [CatalogoOcupacionHospitalController::class, 'ocupacionHospitalIndex'])->name('ocupacionHospitalIndex'); 

    Route::get('admin/settings/ocupacion/hospital/create', [CatalogoOcupacionHospitalController::class, 'ocupacionHospitalCreate'])->name('ocupacionHospitalCreate');  

    Route::post('admin/settings/ocupacion/hospital/store', [CatalogoOcupacionHospitalController::class, 'ocupacionHospitalStore'])->name('ocupacionHospitalStore'); 

    Route::get('admin/settings/ocupacion/hospital/edit/{id}', [CatalogoOcupacionHospitalController::class, 'ocupacionHospitalEdit'])->name('ocupacionHospitalEdit');  

    Route::put('admin/settings/ocupacion/hospital/update/{id}', [CatalogoOcupacionHospitalController::class, 'ocupacionHospitalUpdate'])->name('ocupacionHospitalUpdate');

    Route::delete('admin/settings/ocupacion/hospital/delete/{id}', [CatalogoOcupacionHospitalController::class, 'ocupacionHospitalDestroy'])->name('ocupacionHospitalDestroy');

     /**
     * 
     * 
     * 3 - OCUPACIONES OFICINAS JURISDICCIONALES
     * 
     * 
     */
    Route::get('admin/settings/ocupacion/ofJurisdiccional/index', [CatalogoOcupacionOfJurisdiccionalController::class, 'ocupacionOfJurisdiccionalIndex'])->name('ocupacionOfJurisdiccionalIndex'); 

    Route::get('admin/settings/ocupacion/ofJurisdiccional/create', [CatalogoOcupacionOfJurisdiccionalController::class, 'ocupacionOfJurisdiccionalCreate'])->name('ocupacionOfJurisdiccionalCreate');  

    Route::post('admin/settings/ocupacion/ofJurisdiccional/store', [CatalogoOcupacionOfJurisdiccionalController::class, 'ocupacionOfJurisdiccionalStore'])->name('ocupacionOfJurisdiccionalStore'); 

    Route::get('admin/settings/ocupacion/ofJurisdiccional/edit/{id}', [CatalogoOcupacionOfJurisdiccionalController::class, 'ocupacionOfJurisdiccionalEdit'])->name('ocupacionOfJurisdiccionalEdit');  

    Route::put('admin/settings/ocupacion/ofJurisdiccional/update/{id}', [CatalogoOcupacionOfJurisdiccionalController::class, 'ocupacionOfJurisdiccionalUpdate'])->name('ocupacionOfJurisdiccionalUpdate');

    Route::delete('admin/settings/ocupacion/ofJurisdiccional/delete/{id}', [CatalogoOcupacionOfJurisdiccionalController::class, 'ocupacionOfJurisdiccionalDestroy'])->name('ocupacionOfJurisdiccionalDestroy');

    /**
     * 
     * 
     * 4 OCUPACIONES CRI CREE
     * 
     * 
     */

    Route::get('admin/settings/ocupacion/CriCree/index', [CatalogoOcupacionCriCreeController::class, 'ocupacionCriCreeIndex'])->name('ocupacionCriCreeIndex'); 

    Route::get('admin/settings/ocupacion/CriCree/create', [CatalogoOcupacionCriCreeController::class, 'ocupacionCriCreeCreate'])->name('ocupacionCriCreeCreate');  

    Route::post('admin/settings/ocupacion/CriCree/store', [CatalogoOcupacionCriCreeController::class, 'ocupacionCriCreeStore'])->name('ocupacionCriCreeStore'); 

    Route::get('admin/settings/ocupacion/CriCree/edit/{id}', [CatalogoOcupacionCriCreeController::class, 'ocupacionCriCreeEdit'])->name('ocupacionCriCreeEdit');  

    Route::put('admin/settings/ocupacion/CriCree/update/{id}', [CatalogoOcupacionCriCreeController::class, 'ocupacionCriCreeUpdate'])->name('ocupacionCriCreeUpdate');

    Route::delete('admin/settings/ocupacion/CriCree/delete/{id}', [CatalogoOcupacionCriCreeController::class, 'ocupacionCriCreeDestroy'])->name('ocupacionCriCreeDestroy');

    /**
     * 
     * 
     * 5 OCUPACIONES SAMU CRUM
     * 
     * 
     */
    
     Route::get('admin/settings/ocupacion/samuCrum/index', [CatalogoOcupacionSamuCrumController::class, 'ocupacionSamuCrumIndex'])->name('ocupacionSamuCrumIndex'); 

     Route::get('admin/settings/ocupacion/samuCrum/create', [CatalogoOcupacionSamuCrumController::class, 'ocupacionSamuCrumCreate'])->name('ocupacionSamuCrumCreate');  
 
     Route::post('admin/settings/ocupacion/samuCrum/store', [CatalogoOcupacionSamuCrumController::class, 'ocupacionSamuCrumStore'])->name('ocupacionSamuCrumStore'); 
 
     Route::get('admin/settings/ocupacion/samuCrum/edit/{id}', [CatalogoOcupacionSamuCrumController::class, 'ocupacionSamuCrumEdit'])->name('ocupacionSamuCrumEdit');  
 
     Route::put('admin/settings/ocupacion/samuCrum/update/{id}', [CatalogoOcupacionSamuCrumController::class, 'ocupacionSamuCrumUpdate'])->name('ocupacionSamuCrumUpdate');
 
     Route::delete('admin/settings/ocupacion/samuCrum/delete/{id}', [CatalogoOcupacionSamuCrumController::class, 'ocupacionSamuCrumDestroy'])->name('ocupacionSamuCrumDestroy');

     /**
     * 
     * 
     * 6 OCUPACIONES OFICINA CENTRAL
     * 
     * 
     */
    
     Route::get('admin/settings/ocupacion/oficinaCentral/index', [CatalogoOcupacionOficinaCentralController::class, 'ocupacionOficinaCentralIndex'])->name('ocupacionOficinaCentralIndex'); 

     Route::get('admin/settings/ocupacion/oficinaCentral/create', [CatalogoOcupacionOficinaCentralController::class, 'ocupacionOficinaCentralCreate'])->name('ocupacionOficinaCentralCreate');  
 
     Route::post('admin/settings/ocupacion/oficinaCentral/store', [CatalogoOcupacionOficinaCentralController::class, 'ocupacionOficinaCentralStore'])->name('ocupacionOficinaCentralStore'); 
 
     Route::get('admin/settings/ocupacion/oficinaCentral/edit/{id}', [CatalogoOcupacionOficinaCentralController::class, 'ocupacionOficinaCentralEdit'])->name('ocupacionOficinaCentralEdit');  
 
     Route::put('admin/settings/ocupacion/oficinaCentral/update/{id}', [CatalogoOcupacionOficinaCentralController::class, 'ocupacionOficinaCentralUpdate'])->name('ocupacionOficinaCentralUpdate');

     Route::delete('admin/settings/ocupacion/oficinaCentral/delete/{id}', [CatalogoOcupacionOficinaCentralController::class, 'ocupacionOficinaCentralDestroy'])->name('ocupacionOficinaCentralDestroy');

     /**
     * 
     * 
     * 7 ALMACEN
     * 
     * 
     */
    
     Route::get('admin/settings/ocupacion/almacen/index', [CatalogoOcupacionAlmacenController::class, 'ocupacionAlmacenIndex'])->name('ocupacionAlmacenIndex'); 

     Route::get('admin/settings/ocupacion/almacen/create', [CatalogoOcupacionAlmacenController::class, 'ocupacionAlmacenCreate'])->name('ocupacionAlmacenCreate');  
 
     Route::post('admin/settings/ocupacion/almacen/store', [CatalogoOcupacionAlmacenController::class, 'ocupacionAlmacenStore'])->name('ocupacionAlmacenStore'); 
 
     Route::get('admin/settings/ocupacion/almacen/edit/{id}', [CatalogoOcupacionAlmacenController::class, 'ocupacionAlmacenEdit'])->name('ocupacionAlmacenEdit');  
 
     Route::put('admin/settings/ocupacion/almacen/update/{id}', [CatalogoOcupacionAlmacenController::class, 'ocupacionAlmacenUpdate'])->name('ocupacionAlmacenUpdate');

     Route::delete('admin/settings/ocupacion/almacen/delete/{id}', [CatalogoOcupacionAlmacenController::class, 'ocupacionAlmacenDestroy'])->name('ocupacionAlmacenDestroy');

     /**
     * 
     * 
     * 8 CETS LESP
     * 
     * 
     */
    
     Route::get('admin/settings/ocupacion/cetsLesp/index', [CatalogoOcupacionCetsLespController::class, 'ocupacionCetsLespIndex'])->name('ocupacionCetsLespIndex'); 

     Route::get('admin/settings/ocupacion/cetsLesp/create', [CatalogoOcupacionCetsLespController::class, 'ocupacionCetsLespCreate'])->name('ocupacionCetsLespCreate');  
 
     Route::post('admin/settings/ocupacion/cetsLesp/store', [CatalogoOcupacionCetsLespController::class, 'ocupacionCetsLespStore'])->name('ocupacionCetsLespStore'); 
 
     Route::get('admin/settings/ocupacion/cetsLesp/edit/{id}', [CatalogoOcupacionCetsLespController::class, 'ocupacionCetsLespEdit'])->name('ocupacionCetsLespEdit');  
 
     Route::put('admin/settings/ocupacion/cetsLesp/update/{id}', [CatalogoOcupacionCetsLespController::class, 'ocupacionCetsLespUpdate'])->name('ocupacionCetsLespUpdate');

     Route::delete('admin/settings/ocupacion/cetsLesp/delete/{id}', [CatalogoOcupacionCetsLespController::class, 'ocupacionCetsLespDestroy'])->name('ocupacionCetsLespDestroy');

     /**
     * 
     * 
     * 9 CORS
     * 
     * 
     */
    
     Route::get('admin/settings/ocupacion/cors/index', [CatalogoOcupacionCorsController::class, 'ocupacionCorsIndex'])->name('ocupacionCorsIndex'); 

     Route::get('admin/settings/ocupacion/cors/create', [CatalogoOcupacionCorsController::class, 'ocupacionCorsCreate'])->name('ocupacionCorsCreate');  
 
     Route::post('admin/settings/ocupacion/cors/store', [CatalogoOcupacionCorsController::class, 'ocupacionCorsStore'])->name('ocupacionCorsStore'); 
 
     Route::get('admin/settings/ocupacion/cors/edit/{id}', [CatalogoOcupacionCorsController::class, 'ocupacionCorsEdit'])->name('ocupacionCorsEdit');  
 
     Route::put('admin/settings/ocupacion/cors/update/{id}', [CatalogoOcupacionCorsController::class, 'ocupacionCorsUpdate'])->name('ocupacionCorsUpdate');

     Route::delete('admin/settings/ocupacion/cors/delete/{id}', [CatalogoOcupacionCorsController::class, 'ocupacionCorsDestroy'])->name('ocupacionCorsDestroy');

      /**
     * 
     * 
     * 10 ISSREEI
     * 
     * 
     */

     Route::get('admin/settings/ocupacion/issreei/index', [CatalogoOcupacionIssreeiController::class, 'ocupacionIssreeiIndex'])->name('ocupacionIssreeiIndex'); 

     Route::get('admin/settings/ocupacion/issreei/create', [CatalogoOcupacionIssreeiController::class, 'ocupacionIssreeiCreate'])->name('ocupacionIssreeiCreate');  
 
     Route::post('admin/settings/ocupacion/issreei/store', [CatalogoOcupacionIssreeiController::class, 'ocupacionIssreeiStore'])->name('ocupacionIssreeiStore'); 
 
     Route::get('admin/settings/ocupacion/issreei/edit/{id}', [CatalogoOcupacionIssreeiController::class, 'ocupacionIssreeiEdit'])->name('ocupacionIssreeiEdit');  
 
     Route::put('admin/settings/ocupacion/issreei/update/{id}', [CatalogoOcupacionIssreeiController::class, 'ocupacionIssreeiUpdate'])->name('ocupacionIssreeiUpdate');

     Route::delete('admin/settings/ocupacion/issreei/delete/{id}', [CatalogoOcupacionIssreeiController::class, 'ocupacionIssreeiDestroy'])->name('ocupacionIssreeiDestroy');

     /**
     * 
     * 
     * 11 CESAME
     * 
     * 
     */
    
     Route::get('admin/settings/ocupacion/cesame/index', [CatalogoOcupacionCesameController::class, 'ocupacionCesameIndex'])->name('ocupacionCesameIndex'); 

     Route::get('admin/settings/ocupacion/cesame/create', [CatalogoOcupacionCesameController::class, 'ocupacionCesameCreate'])->name('ocupacionCesameCreate');  
 
     Route::post('admin/settings/ocupacion/cesame/store', [CatalogoOcupacionCesameController::class, 'ocupacionCesameStore'])->name('ocupacionCesameStore'); 
 
     Route::get('admin/settings/ocupacion/cesame/edit/{id}', [CatalogoOcupacionCesameController::class, 'ocupacionCesameEdit'])->name('ocupacionCesameEdit');  
 
     Route::put('admin/settings/ocupacion/cesame/update/{id}', [CatalogoOcupacionCesameController::class, 'ocupacionCesameUpdate'])->name('ocupacionCesameUpdate');

     Route::delete('admin/settings/ocupacion/cesame/delete/{id}', [CatalogoOcupacionCesameController::class, 'ocupacionCesameDestroy'])->name('ocupacionCesameDestroy');

     /**
     * 
     * 
     * 12 PSI PARRAS
     * 
     * 
     */
    
     Route::get('admin/settings/ocupacion/psiParras/index', [CatalogoOcupacionPsiParrasController::class, 'ocupacionPsiParrasIndex'])->name('ocupacionPsiParrasIndex'); 

     Route::get('admin/settings/ocupacion/psiParras/create', [CatalogoOcupacionPsiParrasController::class, 'ocupacionPsiParrasCreate'])->name('ocupacionPsiParrasCreate');  
 
     Route::post('admin/settings/ocupacion/psiParras/store', [CatalogoOcupacionPsiParrasController::class, 'ocupacionPsiParrasStore'])->name('ocupacionPsiParrasStore'); 
 
     Route::get('admin/settings/ocupacion/psiParras/edit/{id}', [CatalogoOcupacionPsiParrasController::class, 'ocupacionPsiParrasEdit'])->name('ocupacionPsiParrasEdit');  
 
     Route::put('admin/settings/ocupacion/psiParras/update/{id}', [CatalogoOcupacionPsiParrasController::class, 'ocupacionPsiParrasUpdate'])->name('ocupacionPsiParrasUpdate');

     Route::delete('admin/settings/ocupacion/psiParras/delete/{id}', [CatalogoOcupacionPsiParrasController::class, 'ocupacionPsiParrasDestroy'])->name('ocupacionPsiParrasDestroy');

     /**
     * 
     * 
     * 13 CEAM
     * 
     * .
     * 
     */
    
     Route::get('admin/settings/ocupacion/ceam/index', [CatalogoOcupacionCeamController::class, 'ocupacionCeamIndex'])->name('ocupacionCeamIndex'); 

     Route::get('admin/settings/ocupacion/ceam/create', [CatalogoOcupacionCeamController::class, 'ocupacionCeamCreate'])->name('ocupacionCeamCreate');  
 
     Route::post('admin/settings/ocupacion/ceam/store', [CatalogoOcupacionCeamController::class, 'ocupacionCeamStore'])->name('ocupacionCeamStore'); 
 
     Route::get('admin/settings/ocupacion/ceam/edit/{id}', [CatalogoOcupacionCeamController::class, 'ocupacionCeamEdit'])->name('ocupacionCeamEdit');  
 
     Route::put('admin/settings/ocupacion/ceam/update/{id}', [CatalogoOcupacionCeamController::class, 'ocupacionCeamUpdate'])->name('ocupacionCeamUpdate');

     Route::delete('admin/settings/ocupacion/ceam/delete/{id}', [CatalogoOcupacionCeamController::class, 'ocupacionCeamDestroy'])->name('ocupacionCeamDestroy');

     /**
     * 
     * 
     * 14 HOSPITAL DEL NIÑO
     * 
     * 
     */
    
     Route::get('admin/settings/ocupacion/hospitalNino/index', [CatalogoOcupacionHospitalNinoController::class, 'ocupacionHospitalNinoIndex'])->name('ocupacionHospitalNinoIndex'); 

     Route::get('admin/settings/ocupacion/hospitalNino/create', [CatalogoOcupacionHospitalNinoController::class, 'ocupacionHospitalNinoCreate'])->name('ocupacionHospitalNinoCreate');  
 
     Route::post('admin/settings/ocupacion/hospitalNino/store', [CatalogoOcupacionHospitalNinoController::class, 'ocupacionHospitalNinoStore'])->name('ocupacionHospitalNinoStore'); 
 
     Route::get('admin/settings/ocupacion/hospitalNino/edit/{id}', [CatalogoOcupacionHospitalNinoController::class, 'ocupacionHospitalNinoEdit'])->name('ocupacionHospitalNinoEdit');  
 
     Route::put('admin/settings/ocupacion/hospitalNino/update/{id}', [CatalogoOcupacionHospitalNinoController::class, 'ocupacionHospitalNinoUpdate'])->name('ocupacionHospitalNinoUpdate');

     Route::delete('admin/settings/ocupacion/hospitalNino/delete/{id}', [CatalogoOcupacionHospitalNinoController::class, 'ocupacionHospitalNinoDestroy'])->name('ocupacionHospitalNinoDestroy');

     /**
     * 
     * 
     * 15 PASANTES Y RESIDENTES MEDICOS
     * 
     * 
     */
    
     Route::get('admin/settings/ocupacion/ensenanza/index', [CatalogoOcupacionEnsenanzaController::class, 'ocupacionEnsenanzaIndex'])->name('ocupacionEnsenanzaIndex'); 

     Route::get('admin/settings/ocupacion/ensenanza/create', [CatalogoOcupacionEnsenanzaController::class, 'ocupacionEnsenanzaCreate'])->name('ocupacionEnsenanzaCreate');  
 
     Route::post('admin/settings/ocupacion/ensenanza/store', [CatalogoOcupacionEnsenanzaController::class, 'ocupacionEnsenanzaStore'])->name('ocupacionEnsenanzaStore'); 
 
     Route::get('admin/settings/ocupacion/ensenanza/edit/{id}', [CatalogoOcupacionEnsenanzaController::class, 'ocupacionEnsenanzaEdit'])->name('ocupacionEnsenanzaEdit');  
 
     Route::put('admin/settings/ocupacion/ensenanza/update/{id}', [CatalogoOcupacionEnsenanzaController::class, 'ocupacionEnsenanzaUpdate'])->name('ocupacionEnsenanzaUpdate');

     Route::delete('admin/settings/ocupacion/ensenanza/delete/{id}', [CatalogoOcupacionEnsenanzaController::class, 'ocupacionEnsenanzaDestroy'])->name('ocupacionEnsenanzaDestroy');
 
     /**
     * 
     * 
     * CATALOGO DE VIGENCIAS
     * 
     * 
     */
    
     Route::get('admin/settings/vigencias/vigenciasIndex', [CatalogosController::class, 'vigenciasIndex'])->name('vigenciasIndex'); 

     Route::get('admin/settings/vigencias/vigenciasCreate', [CatalogosController::class, 'vigenciasCreate'])->name('vigenciasCreate');  
 
     Route::post('admin/settings/vigencias/vigenciasStore', [CatalogosController::class, 'vigenciasStore'])->name('vigenciasStore'); 
 
     Route::get('admin/settings/vigencias/vigenciasEdit/{id}', [CatalogosController::class, 'vigenciasEdit'])->name('vigenciasEdit');  
 
     Route::put('admin/settings/vigencias/vigenciasUpdate/{id}', [CatalogosController::class, 'vigenciasUpdate'])->name('vigenciasUpdate');

     Route::delete('admin/settings/vigencias/vigenciasDestroy/{id}', [CatalogosController::class, 'vigenciasDestroy'])->name('vigenciasDestroy');

    /**
     * 
     * 
     * SYSTEM SETTINGS
     * 
     * 
     */

    Route::get('admin/settings/settingsShow',[SystemSettingsController::class, 'settingsShow'])->name('settingsShow');

});

