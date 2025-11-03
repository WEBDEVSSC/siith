<?php

namespace App\Http\Controllers;

use App\Exports\ProfesionalesMexicoExport;
use App\Exports\ProfesionalExport;
use App\Mail\FelicitacionCumpleanos;
use App\Models\CatOcupacionEnsenanza;
use App\Models\CatOcupacionHospital;
use App\Models\Clue;
use App\Models\CodigoPuesto;
use App\Models\Entidad;
use App\Models\EstadoConyugal;
use App\Models\Municipio;
use App\Models\Profesional;
use App\Models\ProfesionalBitacora;
use App\Models\ProfesionalCambioTipoNomina;
use App\Models\ProfesionalOcupacionAlmacen;
use App\Models\ProfesionalOcupacionCeam;
use App\Models\ProfesionalOcupacionCentroSalud;
use App\Models\ProfesionalOcupacionCesame;
use App\Models\ProfesionalOcupacionCetsLesp;
use App\Models\ProfesionalOcupacionCors;
use App\Models\ProfesionalOcupacionCriCree;
use App\Models\ProfesionalOcupacionEnsenanza;
use App\Models\ProfesionalOcupacionHospital;
use App\Models\ProfesionalOcupacionHospitalNino;
use App\Models\ProfesionalOcupacionIssreei;
use App\Models\ProfesionalOcupacionOficinaCentral;
use App\Models\ProfesionalOcupacionOfJurisdiccional;
use App\Models\ProfesionalOcupacionPsiParras;
use App\Models\ProfesionalOcupacionSamuCrum;
use App\Models\ProfesionalPuesto;
use App\Models\ProfesionalVigencia;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;



class ProfesionalController extends Controller
{
    
    public function guardar(Request $request)
    {
        $data = explode('|', $request->input('qr'));

        // Validar cantidad mínima de campos
        if (count($data) < 10) {
            return response()->json(['success' => false, 'mensaje' => 'Formato de QR no válido']);
        }

        $curp = $data[0];
        $rfc = substr($curp, 0, 10);
        $fechaNacimiento =  $data[6];
        $fechaFormateada = Carbon::createFromFormat('d/m/Y', $fechaNacimiento)->format('Y-m-d');
        $nombre = $data[4];
        $apellidoPaterno = $data[2];
        $apellidoMaterno = $data[3];
        $entidadNacimiento = substr($curp, 11, 2);
        $sexo = substr($curp, 10, 1);  

        // Ajustamos la nacionalidad
        if($entidadNacimiento === 'X')
        {
             $paisNacimiento = 'EXTRANGERO';
             $nacionalidad = 'EXTRANGERA';
        }
        else
        {
             $paisNacimiento = 'MÉXICO';
             $nacionalidad = 'MEXICANA';
        }

        $entidad = Entidad::where('abreviacion',$entidadNacimiento)->first();

        $municipios = Municipio::where('relacion',$entidad->id)->get();

        $estadosConyuales = EstadoConyugal::all();

         return view('profesional.create',compact(
            'curp',
            'rfc',
            'sexo',
            'fechaFormateada',
            'paisNacimiento',
            'entidad',
            'municipios',
            'nacionalidad',
            'estadosConyuales',
            'nombre',
            'apellidoPaterno',
            'apellidoMaterno'
        ));

    }

    /**
     * 
     * 
     * METODO PARA MOSTRAR EL FORMULARIO DE INGRESAR CURP
     * 
     */
    
    public function buscarCurp()
    {
        return view('profesional.buscar-curp');
    }

    /**
     * 
     * 
     * METODO PARA VALIDAR Y BUSCAR LA CURP EN LA BASE DE DATOS
     * 
     */

    public function mostrarCurp(Request $request)
    {
        // Validación para CURP
        $request->validate([
            'curp' => 'required|regex:/^[A-Z]{4}[0-9]{6}[A-Z]{6}[0-9]{2}$/',
            'curp_confirma' => 'required|same:curp|regex:/^[A-Z]{4}[0-9]{6}[A-Z]{6}[0-9]{2}$/',
        ], [
            'curp.required' => 'La CURP es obligatoria.',
            'curp.regex' => 'La CURP debe tener un formato válido.',
            'curp_confirma.required' => 'La confirmación de la CURP es obligatoria.',
            'curp_confirma.same' => 'La confirmación de la CURP no coincide.',
            'curp_confirma.regex' => 'La CURP de confirmación debe tener un formato válido.',
        ]);

        // Buscamos el profesional por CURP
        $profesional = Profesional::where('curp', $request->curp)->first();

        if ($profesional) 
        {
            // Si el registro ya existe, redirigimos con un mensaje de error
            return redirect()->back()->with('error', 'El trabajador ya se encuentra registrado, favor de intentar con otro CURP')->withInput();
        } 
        else 
        {
            $usuario = Auth::user(); // o auth()->user()
    
            // Obtener el rol
            $rol = $usuario->role; // cambia 'rol' por el nombre de tu columna

            // Puedes hacer condicionales según el rol
            if ($rol === 'ensenanza') 
            {
                // hacer algo solo para usuarios con rol "ensenanza"
                return redirect()->route('datosGeneralesEnsenanza', [
                    'curp' => $request->curp
                ]);
            }
            else
            {
                // Si no se encuentra el registro, redirigimos al formulario de creación de datos
                return redirect()->route('datosGenerales', [
                    'curp' => $request->curp
                ]);
            }
            
            
        }
    }

    /**
     * 
     * 
     * METODO PARA MOSTRAR EL FORMULARIO DE DATOS GENERALES CON LOS DATOS DE LA CURP EXTRAIDOS
     * 
     */

    public function datosGenerales($curp)
    {
        // Extraemos los datos de la CURP
        $rfc = substr($curp, 0, 10);
        $fechaNacimiento = substr($curp, 4, 6);
        $sexo = substr($curp, 10, 1);  
        $entidadNacimiento = substr($curp, 11, 2);

         // Formateamos la fecha
         $fechaFormateada = Carbon::createFromFormat('ymd', $fechaNacimiento)->format('Y-m-d');

         // Consultamos la entidad de nacimiento
         $entidad = Entidad::where('abreviacion',$entidadNacimiento)->first();

         // Estados conyugales
         $estadosConyuales = EstadoConyugal::all();

         // Ajustamos la nacionalidad
         if($entidadNacimiento === 'X')
         {
             $paisNacimiento = 'EXTRANGERO';
             $nacionalidad = 'EXTRANGERA';
         }
         else
         {
             $paisNacimiento = 'MÉXICO';
             $nacionalidad = 'MEXICANA';
         }

         // Lista de municipios
         $municipios = Municipio::where('relacion',$entidad->id)->get();

         // Cargamos los datos del usuario que inicio sesion
        $usuario = Auth::user();

        // Condicionamos para que solo se enlisten las unidades que corresponden
        if($usuario->role == 'ofJurisdiccional')
        {
            $cluesAdscripcion = Clue::where('clave_jurisdiccion', $usuario->jurisdiccion_unidad) 
                                    ->whereIn('clave_establecimiento', [1, 3])
                                    ->orderBy('nombre', 'asc')
                                    ->get();
        }
        elseif($usuario->role == 'criCree')
        {
            $cluesAdscripcion = Clue::where('clave_establecimiento', 4)
                                    ->orderBy('nombre', 'asc')
                                    ->get();
        }
        elseif($usuario->role == 'samuCrum')
        {
            $cluesAdscripcion = Clue::where('clave_establecimiento', 5)
                                    ->orderBy('nombre', 'asc')
                                    ->get();
        }
        else
        {
            $cluesAdscripcion = Clue::where('id', $usuario->id_unidad)->get();
        }

         return view('profesional.create',compact(
            'curp',
            'rfc',
            'sexo',
            'fechaFormateada',
            'paisNacimiento',
            'entidad',
            'municipios',
            'nacionalidad',
            'estadosConyuales',
            'cluesAdscripcion'
        ));
    }

    /**
     * 
     * 
     * METODO PARA MOSTRAR EL FORMULARIO DE DATOS GENERALES CON LOS DATOS DE LA CURP EXTRAIDOS
     * 
     */

    public function datosGeneralesEnsenanza($curp)
    {
        // Extraemos los datos de la CURP
        $rfc = substr($curp, 0, 10);
        $fechaNacimiento = substr($curp, 4, 6);
        $sexo = substr($curp, 10, 1);  
        $entidadNacimiento = substr($curp, 11, 2);

         // Formateamos la fecha
         $fechaFormateada = Carbon::createFromFormat('ymd', $fechaNacimiento)->format('Y-m-d');

         // Consultamos la entidad de nacimiento
         $entidad = Entidad::where('abreviacion',$entidadNacimiento)->first();

         // Estados conyugales
         $estadosConyuales = EstadoConyugal::all();

         // Ajustamos la nacionalidad
         if($entidadNacimiento === 'X')
         {
             $paisNacimiento = 'EXTRANGERO';
             $nacionalidad = 'EXTRANGERA';
         }
         else
         {
             $paisNacimiento = 'MÉXICO';
             $nacionalidad = 'MEXICANA';
         }

         // Lista de municipios
         $municipios = Municipio::where('relacion',$entidad->id)->get();

         $ocupaciones = CatOcupacionEnsenanza::all();

         $codigosDePuesto = CodigoPuesto::where('personal_formacion',1)->get();

         return view('profesional.create-ensenanza',compact(
            'curp',
            'rfc',
            'sexo',
            'fechaFormateada',
            'paisNacimiento',
            'entidad',
            'municipios',
            'nacionalidad',
            'estadosConyuales',
            'ocupaciones',
            'codigosDePuesto'
        ));
    }

    /**
     * 
     * 
     * METODO PARA GUARDAR LOS DATOS GENERALES DEL PROFESIONAL
     * 
     */

    public function datosGeneralesStore(Request $request)
    {
        // Validamos los datos
        $validated = $request->validate([
            'curp' => 'required',
            'rfc' => 'required',
            'homoclave' => 'required|size:3',
            'sexo' => 'required',
            'nombre' => 'required',
            'apellido_paterno' => 'required',
            'apellido_materno' => 'required',
            'fechaFormateada' => 'required',
            'paisNacimiento' => 'required',
            'entidadNacimiento' => 'required',
            'municipio_nacimiento' => 'required',
            'nacionalidad' => 'required',
            'estado_conyugal' => 'required',
            'telefono_casa' => 'nullable|size:10',
            'celular' => 'required|size:10',
            'email' => 'required|email',
            'padre_madre_familia' => 'required',
            'clues_adscripcion' => 'required',
            'fecha_inicio' => 'required|date_format:Y-m-d|before_or_equal:today',
        ], [
            'homoclave.required' => 'La homoclave es obligatoria.',
            'homoclave.size' => 'La homoclave debe ser de 3 caracteres.',            
            'nombre.required' => 'El nombre es obligatorio.',            
            'apellido_paterno.required' => 'El apellido paterno es obligatorio.',            
            'apellido_materno.required' => 'El apellido materno es obligatorio.',            
            'municipio_nacimiento.required' => 'El municipio de nacimiento es obligatorio.',            
            'telefono_casa.required' => 'El teléfono de casa es obligatorio.',
            'telefono_casa.size' => 'El teléfono de casa debe tener más de 10 caracteres.',            
            'celular.required' => 'El celular es obligatorio.',
            'celular.size' => 'El celular debe tener más de 10 caracteres.',            
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico debe ser una dirección válida.',
            'estado_conyugal.required' => 'El estado conyugal es obligatorio.',
            'padre_madre_familia.required' => 'El campo Padre / Madre de familia es obligatorio.',
            'clues_adscripcion.required' => 'La CLUES es obligatorio',
            'fecha_inicio.required' => 'La fecha de inicio es obligatoria.',
            'fecha_inicio.before_or_equal' => 'La fecha de inicio no puede ser mayor al día de hoy.',
            'fecha_inicio.date_format' => 'La fecha de vigencia debe tener el formato DD-MM-AAAA.',

        ]);


        // Formateamos el valor de SEXO
        if($request->sexo === "H")
        {
            $sexoNuevo = "M";
        }
        else
        {
            $sexoNuevo = "F";
        }

        // Consultamos el municipio de nacimiento
        $municipio = Municipio::findOrFail($request->municipio_nacimiento);
        
        // Datos del capturista
        $usuario = Auth::user();

        // Ahora que los datos están validados, puedes guardarlos en la base de datos
        $profesional = new Profesional();

        $profesional->curp = $request->curp;
        $profesional->rfc = $request->rfc;
        $profesional->homoclave = $request->homoclave;
        $profesional->nombre = $request->nombre;
        $profesional->apellido_paterno = $request->apellido_paterno;
        $profesional->apellido_materno = $request->apellido_materno;
        $profesional->fecha_nacimiento = $request->fechaFormateada; 
        $profesional->sexo = $sexoNuevo;
        $profesional->pais_nacimiento = $request->paisNacimiento;
        $profesional->entidad_nacimiento = $request->entidadNacimiento;
        $profesional->municipio_nacimiento = $municipio->nombre;
        $profesional->nacionalidad = $request->nacionalidad;
        $profesional->estado_conyugal = $request->estado_conyugal;
        $profesional->telefono_casa = $request->telefono_casa;
        $profesional->celular = $request->celular;
        $profesional->email = $request->email;
        $profesional->padre_madre_familia = $request->padre_madre_familia;
        $profesional->capturado_id = $usuario->id;
        $profesional->capturado_label = $usuario->responsable;
        $profesional->mdl_datos_generales = 1;

        // Guardar el nuevo profesional
        $profesional->save();

        // Guaradmos la bitacora
        $bitacora = new ProfesionalBitacora();

        $bitacora->id_capturista = $usuario->id;
        $bitacora->capturista_label = $usuario->responsable;
        $bitacora->accion = "NUEVO REGISTRO DE PROFESIONAL";
        $bitacora->id_profesional = $profesional->id;

        $bitacora->save();

        // Generamos un el status de vigencia ACTIVO

        $vigencia = new ProfesionalVigencia();

        $vigencia->id_profesional = $profesional->id;
        $vigencia->vigencia = "ACTIVO";
        $vigencia->vigencia_motivo = "ACTIVO";
        $vigencia->fecha_inicio = $request->fecha_inicio;

        $vigencia->save();

        // Generamos el registro en en el modulo de puesto

        $cluesAdscripcion = Clue::where('clues',$request->clues_adscripcion)->firstOrFail();

        $puesto = new ProfesionalPuesto();

        $puesto->id_profesional = $profesional->id;
        $puesto->vigencia = "ACTIVO";
        $puesto->vigencia_motivo = "ACTIVO";
        $puesto->fecha_ingreso = $request->fecha_inicio;

        $puesto->clues_adscripcion = $request->clues_adscripcion;
        $puesto->clues_adscripcion_nombre = $cluesAdscripcion->nombre;
        $puesto->clues_adscripcion_municipio = $cluesAdscripcion->municipio;
        $puesto->clues_adscripcion_jurisdiccion = $cluesAdscripcion->clave_jurisdiccion;
        $puesto->clues_adscripcion_tipo = $cluesAdscripcion->clave_establecimiento;

        $puesto->mdl_puesto = 0;
        

        $puesto->save();

        // Redireccionamos
        return redirect()->route('profesionalShow', ['id' => $profesional->id])
                 ->with('success', 'Registro realizado correctamente.');
    }

    /**
     * 
     * 
     * METODO PARA GUARDAR LOS DATOS GENERALES DEL PROFESIONAL
     * 
     */

    public function datosGeneralesStoreEnsenanza(Request $request)
    {
        // Validamos los datos
        $validated = $request->validate([
            'curp' => 'required',
            'rfc' => 'required',
            'homoclave' => 'required|size:3',
            'sexo' => 'required',
            'nombre' => 'required',
            'apellido_paterno' => 'required',
            'apellido_materno' => 'required',
            'fechaFormateada' => 'required',
            'paisNacimiento' => 'required',
            'entidadNacimiento' => 'required',
            'municipio_nacimiento' => 'required',
            'nacionalidad' => 'required',
            'estado_conyugal' => 'required',
            'telefono_casa' => 'nullable|size:10',
            'celular' => 'required|size:10',
            'email' => 'required|email',
            'padre_madre_familia' => 'required',
            'fecha_inicio' => 'required|date_format:Y-m-d|before_or_equal:today',
            'tipo_nomina' => 'required',
            'ocupacion' => 'required',
            'codigo_puesto' => 'required'
        ], [
            'homoclave.required' => 'La homoclave es obligatoria.',
            'homoclave.size' => 'La homoclave debe ser de 3 caracteres.',            
            'nombre.required' => 'El nombre es obligatorio.',            
            'apellido_paterno.required' => 'El apellido paterno es obligatorio.',            
            'apellido_materno.required' => 'El apellido materno es obligatorio.',            
            'municipio_nacimiento.required' => 'El municipio de nacimiento es obligatorio.',            
            'telefono_casa.required' => 'El teléfono de casa es obligatorio.',
            'telefono_casa.size' => 'El teléfono de casa debe tener más de 10 caracteres.',            
            'celular.required' => 'El celular es obligatorio.',
            'celular.size' => 'El celular debe tener más de 10 caracteres.',            
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico debe ser una dirección válida.',
            'estado_conyugal.required' => 'El estado conyugal es obligatorio.',
            'padre_madre_familia.required' => 'El campo Padre / Madre de familia es obligatorio.',
            'clues_adscripcion.required' => 'La CLUES es obligatorio',
            'fecha_inicio.required' => 'La fecha de inicio es obligatoria.',
            'fecha_inicio.before_or_equal' => 'La fecha de inicio no puede ser mayor al día de hoy.',
            'fecha_inicio.date_format' => 'La fecha de vigencia debe tener el formato DD-MM-AAAA.',
        ]);

        // Formateamos el valor de SEXO
        if($request->sexo === "H")
        {
            $sexoNuevo = "M";
        }
        else
        {
            $sexoNuevo = "F";
        }

        // Consultamos el municipio de nacimiento
        $municipio = Municipio::findOrFail($request->municipio_nacimiento);

        // Consultamos la ocupacion
        $ocupacionEnsenanza = CatOcupacionEnsenanza::findOrFail($request->ocupacion);

        // COnsultamos el codigo de puesto
        $codigoPuesto = CodigoPuesto::findOrFail($request->codigo_puesto);
        
        // Datos del capturista
        $usuario = Auth::user();

        /********************************************************************************************************************************
         * 
         * MODULO DE DATOS GENERALES
         * 
         *******************************************************************************************************************************/

        $profesional = new Profesional();

        $profesional->curp = $request->curp;
        $profesional->rfc = $request->rfc;
        $profesional->homoclave = $request->homoclave;
        $profesional->nombre = $request->nombre;
        $profesional->apellido_paterno = $request->apellido_paterno;
        $profesional->apellido_materno = $request->apellido_materno;
        $profesional->fecha_nacimiento = $request->fechaFormateada; 
        $profesional->sexo = $sexoNuevo;
        $profesional->pais_nacimiento = $request->paisNacimiento;
        $profesional->entidad_nacimiento = $request->entidadNacimiento;
        $profesional->municipio_nacimiento = $municipio->nombre;
        $profesional->nacionalidad = $request->nacionalidad;
        $profesional->estado_conyugal = $request->estado_conyugal;
        $profesional->telefono_casa = $request->telefono_casa;
        $profesional->celular = $request->celular;
        $profesional->email = $request->email;
        $profesional->padre_madre_familia = $request->padre_madre_familia;
        $profesional->capturado_id = $usuario->id;
        $profesional->capturado_label = $usuario->responsable;
        $profesional->mdl_datos_generales = 1;

        // Guardar el nuevo profesional
        $profesional->save();

        /********************************************************************************************************************************
         * 
         * MODULO DE BITACORA
         * 
         *******************************************************************************************************************************/

        $bitacora = new ProfesionalBitacora();

        $bitacora->id_capturista = $usuario->id;
        $bitacora->capturista_label = $usuario->responsable;
        $bitacora->accion = "NUEVO REGISTRO DE PROFESIONAL";
        $bitacora->id_profesional = $profesional->id;

        $bitacora->save();

        /********************************************************************************************************************************
         * 
         * MODULO DE VIGENCIA
         * 
         *******************************************************************************************************************************/

        $vigencia = new ProfesionalVigencia();

        $vigencia->id_profesional = $profesional->id;
        $vigencia->vigencia = "ACTIVO";
        $vigencia->vigencia_motivo = "ACTIVO";
        $vigencia->fecha_inicio = $request->fecha_inicio;

        $vigencia->save();

        
        /********************************************************************************************************************************
         * 
         * MODULO DE PUESTO
         * 
         *******************************************************************************************************************************/

        // CLUES NOMINA ES OFICINA CENTRAL

        $cluesNomina = Clue::where('clues','CLSSA002093')->firstOrFail();

        // Generamos el registro en el modulo de puesto

        $puesto = new ProfesionalPuesto();

        $puesto->id_profesional = $profesional->id;
        $puesto->vigencia = "ACTIVO";
        $puesto->vigencia_motivo = "ACTIVO";
        $puesto->fecha_ingreso = $request->fecha_inicio;

        $puesto->clues_nomina = $cluesNomina->clues;
        $puesto->clues_nomina_nombre = $cluesNomina->nombre;
        $puesto->clues_nomina_municipio = $cluesNomina->municipio;
        $puesto->clues_nomina_jurisdiccion = $cluesNomina->clave_jurisdiccion;

        $puesto->clues_adscripcion = 'CLHUN000015';
        $puesto->clues_adscripcion_nombre = 'HOSPITAL UNIVERSITARIO';
        $puesto->clues_adscripcion_municipio = 'SALTILLO';
        $puesto->clues_adscripcion_jurisdiccion = '9';
        $puesto->clues_adscripcion_tipo = '15';

        // Consultamos el tipo de Nomina
        if($request->tipo_nomina == "6MR")
        {
            $nominaPagoId = 6;
            $nominaPago = "6MR - Médico Residente";
            $nominaTipoContrato = "BECAS";
            $nominaTipoPlaza = "FEDERAL";
            $nominaSeguroSalud = "SI";
            $nominaCodigoPuestoId = $codigoPuesto->id;
            $nominaCodigoPuestoLabel = $codigoPuesto->codigo_puesto;            
            $nominaCodigoPuestoCodigo = $codigoPuesto->codigo;
            $nominaCodigoPuestoFechaDeIngreso = $request->fecha_inicio;
        }
        else
        {   
            $nominaPagoId = 5;
            $nominaPago = "610 - Pasante en Servicio Social";
            $nominaTipoContrato = "BECAS";
            $nominaTipoPlaza = "FEDERAL";
            $nominaSeguroSalud = "SI";
            $nominaCodigoPuestoId = $codigoPuesto->id;
            $nominaCodigoPuestoLabel = $codigoPuesto->codigo_puesto;            
            $nominaCodigoPuestoCodigo = $codigoPuesto->codigo;
            $nominaCodigoPuestoFechaDeIngreso = $request->fecha_inicio;
        }

        $puesto->codigo_puesto_id = $nominaCodigoPuestoId;
        $puesto->codigo_puesto = $nominaCodigoPuestoLabel;

        $puesto->nomina_pago = $nominaPago;
        $puesto->tipo_contrato = $nominaTipoContrato;
        $puesto->tipo_plaza = $nominaTipoPlaza;
        $puesto->seguro_salud = $nominaSeguroSalud;

        $puesto->mdl_puesto = 0;

        $puesto->save();

        /********************************************************************************************************************************
         * 
         * MODULO DE NOMINA
         * 
         *******************************************************************************************************************************/

        $nomina = new ProfesionalCambioTipoNomina();

        $nomina->id_profesional = $profesional->id;
        $nomina->id_nomina_pago = $nominaPagoId;
        $nomina->nomina_pago = $nominaPago;
        $nomina->tipo_contrato = $nominaTipoContrato;
        $nomina->tipo_plaza = $nominaTipoPlaza;
        $nomina->seguro_salud = $nominaSeguroSalud;
        $nomina->codigo_puesto_id = $nominaCodigoPuestoId;
        $nomina->codigo_puesto_label = $nominaCodigoPuestoLabel;
        $nomina->fecha_ingreso = $nominaCodigoPuestoFechaDeIngreso;
        $nomina->codigo_puesto = $nominaCodigoPuestoCodigo;

        $nomina->save();

        /********************************************************************************************************************************
         * 
         * MODULO DE OCUPACION
         * 
         *******************************************************************************************************************************/

        $ocupacion = new ProfesionalOcupacionEnsenanza();

        $ocupacion->id_profesional = $profesional->id;
        $ocupacion->id_catalogo = $request->ocupacion;
        $ocupacion->unidad = $ocupacionEnsenanza->unidad;
        $ocupacion->area = $ocupacionEnsenanza->area;
        $ocupacion->subarea = $ocupacionEnsenanza->subarea;
        $ocupacion->ocupacion = $ocupacionEnsenanza->ocupacion;

        $ocupacion->save();

        /********************************************************************************************************************************
         * 
         * TERMINAMOS Y REDIRIGIMOS
         * 
         *******************************************************************************************************************************/

        // Redireccionamos
        return redirect()->route('profesionalShow', $profesional->id)->with('success', 'Registro realizado correctamente.');
    }

    /**
     * 
     * 
     * METODO PARA MOSTRAR EL PANEL DE CONTROL, SE MUESTRAN LOS REGISTROS SEGUN EL NIVEL DE CADA USUARIO
     * 
     */

    public function profesionalIndex()
    {
        ini_set('memory_limit', '-1');
        
        // Conficionamos a los roles 
        if (Gate::allows('admin'))
        {
            $profesionales = Profesional::with(['puesto', 'credencializacion', 'horario', 'sueldo', 'gradoAcademico', 'areaMedica'])
                ->whereRelation('puesto', 'vigencia', 'ACTIVO')
                ->get();
        }
        elseif(Gate::allows('csuyr'))
        {
            $user = Auth::user();
            
            $profesionales = Profesional::with(['puesto', 'credencializacion', 'horario', 'sueldo', 'gradoAcademico', 'areaMedica'])
                ->whereRelation('puesto', 'clues_adscripcion', $user->clues_unidad)
                ->whereRelation('puesto', 'vigencia', 'ACTIVO')
                ->get();
        }  
        elseif(Gate::allows('hospital'))
        {
            $user = Auth::user();
            
            $profesionales = Profesional::with(['puesto', 'credencializacion', 'horario', 'sueldo', 'gradoAcademico', 'areaMedica'])
                ->whereRelation('puesto', 'clues_adscripcion', $user->clues_unidad)
                ->whereRelation('puesto', 'vigencia', 'ACTIVO')
                ->get();
        }  
        elseif(Gate::allows('ofJurisdiccional'))
        {
            $user = Auth::user();
            $userJurisdiccion = $user->clues_unidad;
            
            $profesionales = Profesional::with(['puesto', 'credencializacion', 'horario', 'sueldo', 'gradoAcademico', 'areaMedica'])
                ->whereRelation('puesto', 'clues_adscripcion', $userJurisdiccion)
                ->whereRelation('puesto', 'vigencia', 'ACTIVO')
                ->get();
        }  
        elseif(Gate::allows('criCree'))
        {   
            $profesionales = Profesional::with(['puesto','credencializacion','horario','sueldo','gradoAcademico','areaMedica'])
            ->whereHas('puesto', function ($query) {
                $query->whereIn('clues_adscripcion', ['CLSSA009989','CLSSA009988','CLSSA009987','CLSSA009986','CLSSA009985'])
                ->where('vigencia', 'ACTIVO');
                })
                ->get();
        }  
        elseif(Gate::allows('samuCrum'))
        {   
            $profesionales = Profesional::with(['puesto','credencializacion','horario','sueldo','gradoAcademico','areaMedica'])
            ->whereHas('puesto', function ($query) {
                $query->whereIn('clues_adscripcion', ['CLSSA009997','CLSSA009996','CLSSA009995','CLSSA009994','CLSSA009993','CLSSA009992','CLSSA009991','CLSSA009990','CLSSA002093-SC'])
                ->where('vigencia', 'ACTIVO');
                })
                ->get();
        }  
        elseif(Gate::allows('ofCentral'))
        {            
            $profesionales = Profesional::with(['puesto', 'credencializacion', 'horario', 'sueldo', 'gradoAcademico', 'areaMedica'])
                ->whereRelation('puesto', 'clues_adscripcion', 'CLSSA002093')
                ->whereRelation('puesto', 'vigencia', 'ACTIVO')
                ->get();
        } 
        elseif(Gate::allows('almacen'))
        {
            $profesionales = Profesional::with(['puesto', 'credencializacion', 'horario', 'sueldo', 'gradoAcademico', 'areaMedica'])
                ->whereRelation('puesto', 'clues_adscripcion', 'CLSSA002064')
                ->whereRelation('puesto', 'vigencia', 'ACTIVO')
                ->get();
        }  
        elseif(Gate::allows('cets'))
        {
            $profesionales = Profesional::with(['puesto', 'credencializacion', 'horario', 'sueldo', 'gradoAcademico', 'areaMedica'])
                ->whereRelation('puesto', 'clues_adscripcion', 'CLSSA002076')
                ->whereRelation('puesto', 'vigencia', 'ACTIVO')
                ->get();
        }  
        elseif(Gate::allows('lesp'))
        {
            $profesionales = Profesional::with(['puesto', 'credencializacion', 'horario', 'sueldo', 'gradoAcademico', 'areaMedica'])
                ->whereRelation('puesto', 'clues_adscripcion', 'CLSSA002052')
                ->whereRelation('puesto', 'vigencia', 'ACTIVO')
                ->get();
        }  
        elseif(Gate::allows('oncologico'))
        {            
            $profesionales = Profesional::with(['puesto', 'credencializacion', 'horario', 'sueldo', 'gradoAcademico', 'areaMedica'])
                ->whereRelation('puesto', 'clues_adscripcion', 'CLSSA002932')
                ->whereRelation('puesto', 'vigencia', 'ACTIVO')
                ->get();
        }  
        elseif(Gate::allows('cesame'))
        {            
            $profesionales = Profesional::with(['puesto', 'credencializacion', 'horario', 'sueldo', 'gradoAcademico', 'areaMedica'])
                ->whereRelation('puesto', 'clues_adscripcion', 'CLSSA001141')
                ->whereRelation('puesto', 'vigencia', 'ACTIVO')
                ->get();
        }  
        elseif(Gate::allows('psiParras'))
        {            
            $profesionales = Profesional::with(['puesto', 'credencializacion', 'horario', 'sueldo', 'gradoAcademico', 'areaMedica'])
                ->whereRelation('puesto', 'clues_adscripcion', 'CLSSA000832')
                ->whereRelation('puesto', 'vigencia', 'ACTIVO')
                ->get();
        }  
        elseif(Gate::allows('hospitalNino'))
        {            
            $profesionales = Profesional::with(['puesto', 'credencializacion', 'horario', 'sueldo', 'gradoAcademico', 'areaMedica'])
                ->whereRelation('puesto', 'clues_adscripcion', 'CLSSA001136')
                ->whereRelation('puesto', 'vigencia', 'ACTIVO')
                ->get();
        }  
        elseif(Gate::allows('ceam'))
        {            
            $profesionales = Profesional::with(['puesto', 'credencializacion', 'horario', 'sueldo', 'gradoAcademico', 'areaMedica'])
                ->whereRelation('puesto', 'clues_adscripcion', 'CLSSA002192')
                ->whereRelation('puesto', 'vigencia', 'ACTIVO')
                ->get();
        }  
        elseif(Gate::allows('issreei'))
        {
            $profesionales = Profesional::with(['puesto', 'credencializacion', 'horario', 'sueldo', 'gradoAcademico', 'areaMedica'])
                ->whereRelation('puesto', 'clues_adscripcion', 'CLSSA002640')
                ->whereRelation('puesto', 'vigencia', 'ACTIVO')
                ->get();
        } 
        elseif(Gate::allows('ensenanza'))
        {
            /*$profesionales = Profesional::with(['puesto', 'credencializacion', 'horario', 'sueldo', 'gradoAcademico', 'areaMedica'])
                ->whereRelation('puesto', 'nomina_pago', ['610 - Pasante en Servicio Social', '6MR - Médico Residente'])
                ->whereRelation('puesto', 'vigencia', 'ACTIVO')
                ->get();*/



                $profesionales = Profesional::with(['puesto', 'credencializacion', 'horario', 'sueldo', 'gradoAcademico', 'areaMedica'])
                    ->whereRelation('puesto', 'vigencia', 'ACTIVO')
                    ->where(function($q) {
                        $q->whereRelation('puesto', 'nomina_pago', '610 - Pasante en Servicio Social')
                        ->orWhereRelation('puesto', 'nomina_pago', '6MR - Médico Residente');
                    })
                    ->get();
        } 
        else
        {
            $profesionales = collect(); // colección vacía para evitar errores
        }

        // Creamos un array para almacenar los datos adicionales
        $profesionalesData = $profesionales->map(function ($profesional) {
            return [
                'profesional' => $profesional,
                'cluesAdscripcionNombre' => optional($profesional->puesto)->clues_adscripcion_nombre,
            ];
        });
        

        // Regresamos la vista con los datos
        return view('profesional.index', compact('profesionalesData'));
    }

     /**
     * 
     * 
     *  METODO PARA MOSTRAR EL PANEL CON BAJAS TEMPORALES Y DEFINITIVAS
     * 
     * 
     */

     public function profesionalIncompletosIndex()
     {
        // Datos del capturista
        $usuario = Auth::user();

        // Consultamos los registros
        $profesionalesIncompletos = Profesional::where('capturado_id',$usuario->id)->get();

        // Regresamos a la vista con el objeto
        return view('profesional.incompletos-index', compact('profesionalesIncompletos'));


     }

    /**
     * 
     * 
     *  METODO PARA MOSTRAR EL PANEL CON BAJAS TEMPORALES Y DEFINITIVAS
     * 
     * 
     */

     public function profesionalesBajasTemporalesIndex()
    {
        ini_set('memory_limit', '-1');
        
        // Conficionamos a los roles 
        if (Gate::allows('admin'))
        {
            $profesionales = Profesional::with([
                'puesto',
                'credencializacion',
                'horario',
                'sueldo',
                'gradoAcademico',
                'areaMedica'
            ])
            ->whereRelation('puesto', 'vigencia', 'BAJA TEMPORAL')
            ->get();
        }
        elseif(Gate::allows('csuyr'))
        {
            $user = Auth::user();
            
            $profesionales = Profesional::with(['puesto', 'credencializacion', 'horario', 'sueldo', 'gradoAcademico', 'areaMedica'])
                ->whereRelation('puesto', 'clues_adscripcion', $user->clues_unidad)
                ->whereRelation('puesto', 'vigencia', 'BAJA TEMPORAL')
                ->get();
        }  
        elseif(Gate::allows('hospital'))
        {
            $user = Auth::user();
            
            $profesionales = Profesional::with(['puesto', 'credencializacion', 'horario', 'sueldo', 'gradoAcademico', 'areaMedica'])
                ->whereRelation('puesto', 'clues_adscripcion', $user->clues_unidad)
                ->whereRelation('puesto', 'vigencia','BAJA TEMPORAL')
                ->get();
        }  
        elseif(Gate::allows('ofJurisdiccional'))
        {
            $user = Auth::user();
            $userJurisdiccion = $user->clues_unidad;
            
            $profesionales = Profesional::with(['puesto', 'credencializacion', 'horario', 'sueldo', 'gradoAcademico', 'areaMedica'])
                ->whereRelation('puesto', 'clues_adscripcion', $userJurisdiccion)
                ->whereRelation('puesto', 'vigencia', 'BAJA TEMPORAL')
                ->get();
        }  
        elseif(Gate::allows('almacen'))
        {
            $profesionales = Profesional::with(['puesto', 'credencializacion', 'horario', 'sueldo', 'gradoAcademico', 'areaMedica'])
                ->whereRelation('puesto', 'clues_adscripcion', 'CLSSA002064')
                ->whereRelation('puesto', 'vigencia', 'BAJA TEMPORAL')
                ->get();
        }  
        elseif(Gate::allows('cets'))
        {
            $profesionales = Profesional::with(['puesto', 'credencializacion', 'horario', 'sueldo', 'gradoAcademico', 'areaMedica'])
                ->whereRelation('puesto', 'clues_adscripcion', 'CLSSA002076')
                ->whereRelation('puesto', 'vigencia', 'BAJA TEMPORAL')
                ->get();
        }  
        elseif(Gate::allows('lesp'))
        {
            $profesionales = Profesional::with(['puesto', 'credencializacion', 'horario', 'sueldo', 'gradoAcademico', 'areaMedica'])
                ->whereRelation('puesto', 'clues_adscripcion', 'CLSSA002052')
                ->whereRelation('puesto', 'vigencia', 'BAJA TEMPORAL')
                ->get();
        }  
        
        elseif(Gate::allows('oncologico'))
        {            
            $profesionales = Profesional::with(['puesto', 'credencializacion', 'horario', 'sueldo', 'gradoAcademico', 'areaMedica'])
                ->whereRelation('puesto', 'clues_adscripcion', 'CLSSA002932')
                ->whereRelation('puesto', 'vigencia', 'BAJA TEMPORAL')
                ->get();
        }  
        elseif(Gate::allows('cesame'))
        {            
            $profesionales = Profesional::with(['puesto', 'credencializacion', 'horario', 'sueldo', 'gradoAcademico', 'areaMedica'])
                ->whereRelation('puesto', 'clues_adscripcion', 'CLSSA001141')
                ->whereRelation('puesto', 'vigencia', 'BAJA TEMPORAL')
                ->get();
        }  
        elseif(Gate::allows('ofCentral'))
        {            
            $profesionales = Profesional::with(['puesto', 'credencializacion', 'horario', 'sueldo', 'gradoAcademico', 'areaMedica'])
                ->whereRelation('puesto', 'clues_adscripcion', 'CLSSA002093')
                ->whereRelation('puesto', 'vigencia', 'BAJA TEMPORAL')
                ->get();
        }  
        elseif(Gate::allows('psiParras'))
        {            
            $profesionales = Profesional::with(['puesto', 'credencializacion', 'horario', 'sueldo', 'gradoAcademico', 'areaMedica'])
                ->whereRelation('puesto', 'clues_adscripcion', 'CLSSA000832')
                ->whereRelation('puesto', 'vigencia','BAJA TEMPORAL')
                ->get();
        }  
        elseif(Gate::allows('hospitalNino'))
        {            
            $profesionales = Profesional::with(['puesto', 'credencializacion', 'horario', 'sueldo', 'gradoAcademico', 'areaMedica'])
                ->whereRelation('puesto', 'clues_adscripcion', 'CLSSA001136')
                ->whereRelation('puesto', 'vigencia','BAJA TEMPORAL')
                ->get();
        }  
        elseif(Gate::allows('ceam'))
        {            
            $profesionales = Profesional::with(['puesto', 'credencializacion', 'horario', 'sueldo', 'gradoAcademico', 'areaMedica'])
                ->whereRelation('puesto', 'clues_adscripcion', 'CLSSA002192')
                ->whereRelation('puesto', 'vigencia','BAJA TEMPORAL')
                ->get();
        }  
        else
        {
            $profesionales = collect(); // colección vacía para evitar errores
        }

        // Creamos un array para almacenar los datos adicionales
        $profesionalesData = $profesionales->map(function ($profesional) {
            return [
                'profesional' => $profesional,
                'cluesAdscripcionNombre' => optional($profesional->puesto)->clues_adscripcion_nombre,
            ];
        });
        

        // Regresamos la vista con los datos
        return view('profesional.bajas-temporales-index', compact('profesionalesData'));
    }

    /**
     * 
     * 
     *  METODO PARA MOSTRAR EL PANEL CON BAJAS TEMPORALES Y DEFINITIVAS
     * 
     * 
     */

     public function profesionalesBajasDefinitivasIndex()
    {
        ini_set('memory_limit', '-1');
        
        // Conficionamos a los roles 
        if (Gate::allows('admin'))
        {
            $profesionales = Profesional::with([
                'puesto',
                'credencializacion',
                'horario',
                'sueldo',
                'gradoAcademico',
                'areaMedica'
            ])
            ->whereRelation('puesto', 'vigencia', 'BAJA DEFINITIVA')
            ->get();
        }
        elseif(Gate::allows('csuyr'))
        {
            $user = Auth::user();
            
            $profesionales = Profesional::with(['puesto', 'credencializacion', 'horario', 'sueldo', 'gradoAcademico', 'areaMedica'])
                ->whereRelation('puesto', 'clues_adscripcion', $user->clues_unidad)
                ->whereRelation('puesto', 'vigencia', 'BAJA DEFINITIVA')
                ->get();
        }  
        elseif(Gate::allows('hospital'))
        {
            $user = Auth::user();
            
            $profesionales = Profesional::with(['puesto', 'credencializacion', 'horario', 'sueldo', 'gradoAcademico', 'areaMedica'])
                ->whereRelation('puesto', 'clues_adscripcion', $user->clues_unidad)
                ->whereRelation('puesto', 'vigencia','BAJA DEFINITIVA')
                ->get();
        }  
        elseif(Gate::allows('ofJurisdiccional'))
        {
            $user = Auth::user();
            $userJurisdiccion = $user->clues_unidad;
            
            $profesionales = Profesional::with(['puesto', 'credencializacion', 'horario', 'sueldo', 'gradoAcademico', 'areaMedica'])
                ->whereRelation('puesto', 'clues_adscripcion', $userJurisdiccion)
                ->whereRelation('puesto', 'vigencia', 'BAJA DEFINITIVA')
                ->get();
        }  
        elseif(Gate::allows('almacen'))
        {
            $profesionales = Profesional::with(['puesto', 'credencializacion', 'horario', 'sueldo', 'gradoAcademico', 'areaMedica'])
                ->whereRelation('puesto', 'clues_adscripcion', 'CLSSA002064')
                ->whereRelation('puesto', 'vigencia', 'BAJA DEFINITIVA')
                ->get();
        }  
        elseif(Gate::allows('cets'))
        {
            $profesionales = Profesional::with(['puesto', 'credencializacion', 'horario', 'sueldo', 'gradoAcademico', 'areaMedica'])
                ->whereRelation('puesto', 'clues_adscripcion', 'CLSSA002076')
                ->whereRelation('puesto', 'vigencia', 'BAJA DEFINITIVA')
                ->get();
        }  
        elseif(Gate::allows('lesp'))
        {
            $profesionales = Profesional::with(['puesto', 'credencializacion', 'horario', 'sueldo', 'gradoAcademico', 'areaMedica'])
                ->whereRelation('puesto', 'clues_adscripcion', 'CLSSA002052')
                ->whereRelation('puesto', 'vigencia', 'BAJA DEFINITIVA')
                ->get();
        }  
        
        elseif(Gate::allows('oncologico'))
        {            
            $profesionales = Profesional::with(['puesto', 'credencializacion', 'horario', 'sueldo', 'gradoAcademico', 'areaMedica'])
                ->whereRelation('puesto', 'clues_adscripcion', 'CLSSA002932')
                ->whereRelation('puesto', 'vigencia', 'BAJA DEFINITIVA')
                ->get();
        }  
        elseif(Gate::allows('cesame'))
        {            
            $profesionales = Profesional::with(['puesto', 'credencializacion', 'horario', 'sueldo', 'gradoAcademico', 'areaMedica'])
                ->whereRelation('puesto', 'clues_adscripcion', 'CLSSA001141')
                ->whereRelation('puesto', 'vigencia', 'BAJA DEFINITIVA')
                ->get();
        }  
        elseif(Gate::allows('ofCentral'))
        {            
            $profesionales = Profesional::with(['puesto', 'credencializacion', 'horario', 'sueldo', 'gradoAcademico', 'areaMedica'])
                ->whereRelation('puesto', 'clues_adscripcion', 'CLSSA002093')
                ->whereRelation('puesto', 'vigencia', 'BAJA DEFINITIVA')
                ->get();
        }  
        elseif(Gate::allows('psiParras'))
        {            
            $profesionales = Profesional::with(['puesto', 'credencializacion', 'horario', 'sueldo', 'gradoAcademico', 'areaMedica'])
                ->whereRelation('puesto', 'clues_adscripcion', 'CLSSA000832')
                ->whereRelation('puesto', 'vigencia','BAJA DEFINITIVA')
                ->get();
        }  
        elseif(Gate::allows('hospitalNino'))
        {            
            $profesionales = Profesional::with(['puesto', 'credencializacion', 'horario', 'sueldo', 'gradoAcademico', 'areaMedica'])
                ->whereRelation('puesto', 'clues_adscripcion', 'CLSSA001136')
                ->whereRelation('puesto', 'vigencia','BAJA DEFINITIVA')
                ->get();
        }  
        elseif(Gate::allows('ceam'))
        {            
            $profesionales = Profesional::with(['puesto', 'credencializacion', 'horario', 'sueldo', 'gradoAcademico', 'areaMedica'])
                ->whereRelation('puesto', 'clues_adscripcion', 'CLSSA002192')
                ->whereRelation('puesto', 'vigencia','BAJA DEFINITIVA')
                ->get();
        }  
        else
        {
            $profesionales = collect(); // colección vacía para evitar errores
        }

        // Creamos un array para almacenar los datos adicionales
        $profesionalesData = $profesionales->map(function ($profesional) {
            return [
                'profesional' => $profesional,
                'cluesAdscripcionNombre' => optional($profesional->puesto)->clues_adscripcion_nombre,
            ];
        });
        

        // Regresamos la vista con los datos
        return view('profesional.bajas-definitivas-index', compact('profesionalesData'));
    }

    /**
     * 
     * 
     * METODO PARA MOSTRAR EL FORMULARIO DE EDICION DE DATOS GENERALES
     * 
     */

    public function profesionalEdit($id)
    {
        // Buscamos el registro por el ID
        $profesional = Profesional::findOrFail($id);

        // Creamos el arreglo para los municipios select

        $municipioRelacion = Municipio::where('nombre',$profesional->municipio_nacimiento)->first();

        $municipios = Municipio::where('relacion',$municipioRelacion->relacion)->get();

        // Creamos el arreglo para los estados conyugales
        $estadosConyuales = EstadoConyugal::all();

        // Regresamos la vista con el arreglo
        return view('profesional.edit', compact('profesional','municipios','estadosConyuales'));
    }

    /**
     * 
     * 
     * METODO PARA ACTUALIZAR LOS DATOS GENERALES DEL PROFESIONAL
     * 
     */

    public function profesionalUpdate(Request $request, $id)
    {
        // Validamos los datos
        $validated = $request->validate([
            'homoclave' => 'required|size:3',
            'nombre' => 'required',
            'apellido_paterno' => 'required',
            'apellido_materno' => 'required',
            'municipio_nacimiento' => 'required',
            'estado_conyugal' => 'required',
            'telefono_casa' => 'nullable|size:10',
            'celular' => 'required|size:10',
            'email' => 'required|email',
            'padre_madre_familia' => 'required',
            
        ], [
            'homoclave.required' => 'La homoclave es obligatoria.',
            'homoclave.size' => 'La homoclave debe ser de 3 caracteres.',            
            'nombre.required' => 'El nombre es obligatorio.',            
            'apellido_paterno.required' => 'El apellido paterno es obligatorio.',            
            'apellido_materno.required' => 'El apellido materno es obligatorio.',            
            'municipio_nacimiento.required' => 'El municipio de nacimiento es obligatorio.',            
            'telefono_casa.required' => 'El teléfono de casa es obligatorio.',
            'telefono_casa.size' => 'El teléfono de casa debe tener más de 10 caracteres.',            
            'celular.required' => 'El celular es obligatorio.',
            'celular.size' => 'El celular debe tener más de 10 caracteres.',            
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico debe ser una dirección válida.',
            'estado_conyugal.required' => 'El estado conyugal es obligatorio.',
            'padre_madre_familia.required' => 'El campo Padre / Madre de familia es obligatorio.',
        ]);

        // Buscamos el registro
        $profesional = Profesional::findOrFail($id);

        // Actualizamos los campos
        $profesional->update([
            'homoclave'=>$request->homoclave,
            'nombre'=>$request->nombre,
            'apellido_paterno'=>$request->apellido_paterno,
            'apellido_materno'=>$request->apellido_materno,
            'municipio_nacimiento' => $request->municipio_nacimiento,
            'estado_conyugal' => $request->estado_conyugal,
            'telefono_casa' => $request->telefono_casa,
            'celular' => $request->celular,
            'email' => $request->email,
            'padre_madre_familia' => $request->padre_madre_familia,
        ]);

        $usuario = Auth::user();

        // Guaradmos la bitacora
        $bitacora = new ProfesionalBitacora();

        $bitacora->id_capturista = $usuario->id;
        $bitacora->capturista_label = $usuario->responsable;
        $bitacora->accion = "ACTUALIZACION DEL MODULO DE DATOS GENERALES";
        $bitacora->id_profesional = $profesional->id;

        $bitacora->save();


        // Redireccionar con un mensaje de éxito
        return redirect()->route('profesionalShow', $profesional->id)->with('success', 'Registro actualizado correctamente.');

    }

    /**
     * 
     * 
     * METODO PARA MOSTRAR LOS DETALLES DE CADA REGISTRO
     * 
     */

    public function profesionalShow($id)
    {
        // Buscamos el registro por el ID
        $profesional = Profesional::findOrFail($id);

        // Calculamos la edad
        $edad = Carbon::parse($profesional->fecha_nacimiento)->age;

        // Cargamos los datos del MODULO PUESTO
        $puesto = $profesional->puesto;

        $fiel = $puesto ? $puesto->fiel : null;
        $fiel_vigencia = $puesto ? $puesto->fiel_vigencia : null;
        $actividad = $puesto ? $puesto->actividad : null;
        $adicional = $puesto ? $puesto->adicional : null;
        $tipoPersonal = $puesto ? $puesto->tipo_personal : null;
        $codigoPuesto = $puesto ? $puesto->codigo_puesto : null;

        $cluesNomina = $puesto ? $puesto->clues_nomina : null;
        $cluesNominaNombre = $puesto ? $puesto->clues_nomina_nombre : null;
        $cluesNominaMunicipio = $puesto ? $puesto->clues_nomina_municipio : null;
        $cluesNominaJurisdiccion = $puesto ? $puesto->clues_nomina_jurisdiccion : null;

        $cluesAdscripcion = $puesto ? $puesto->clues_adscripcion : null;
        $cluesAdscripcionNombre = $puesto ? $puesto->clues_adscripcion_nombre : null;
        $cluesAdscripcionMunicipio = $puesto ? $puesto->clues_adscripcion_municipio : null;
        $cluesAdscripcionJurisdiccion = $puesto ? $puesto->clues_adscripcion_jurisdiccion : null;

        $cluesAdscripcionTipo = $puesto ? $puesto->clues_adscripcion_tipo : null;

        $areaTrabajo = $puesto ? $puesto->area_trabajo : null;
        $ocupacionPuesto = $puesto ? $puesto->ocupacion : null;
        $nominaPago = $puesto ? $puesto->nomina_pago : null;
        $tipoContrato = $puesto ? $puesto->tipo_contrato : null;
        $fechaIngreso = $puesto ? $puesto->fecha_ingreso : null;
        $tipoPlaza = $puesto ? $puesto->tipo_plaza : null;
        $institucionPuesto = $puesto ? $puesto->institucion_puesto : null;
        $vigencia = $puesto ? $puesto->vigencia : null;
        $vigenciaMotivo = $puesto ? $puesto->vigencia_motivo : null;
        $temporalidad = $puesto ? $puesto->temporalidad : null;
        $licenciaMaternidad = $puesto ? $puesto->licencia_maternidad : null;
        $seguroSalud = $puesto ? $puesto->seguro_salud : null;

        // Cargamos los datos del MODULO DE OCUPACION
        
        $ocupacion = null;

        $tipo = $profesional->puesto->clues_adscripcion_tipo ?? null;

        // CENTROS DE SALUD URBANOS Y RURALES (1)
        if ($tipo == 1) 
        {
            $catalogoLabel = "CENTROS DE SALUD URBANOS Y RURALES";
            $ocupacion = ProfesionalOcupacionCentroSalud::where('id_profesional', $id)->first();
        } 
        // HOSPITALES (2)
        elseif ($tipo == 2) 
        {
            $catalogoLabel = "HOSPITALES";
            $ocupacion = ProfesionalOcupacionHospital::where('id_profesional', $id)->first();
        } 
        // OFICINA JURISDICCIONAL (3)
        elseif ($tipo == 3) 
        {
            $catalogoLabel = "OFICINA JURISDICCIONAL";
            $ocupacion = ProfesionalOcupacionOfJurisdiccional::where('id_profesional', $id)->first();
        } 
        // CRI CREE (4)
        elseif ($tipo == 4) 
        {
            $catalogoLabel = "DIF CRI CREE";
            $ocupacion = ProfesionalOcupacionCriCree::where('id_profesional', $id)->first();
        }
        // SAMU CRUM (5)
        elseif ($tipo == 5) 
        {
            $catalogoLabel = "SAMU CRUM";
            $ocupacion = ProfesionalOcupacionSamuCrum::where('id_profesional', $id)->first();
        }
        // OFICINA CENTRAL (6)
        elseif ($tipo == 6) 
        {
            $catalogoLabel = "OFICINA CENTRAL";
            $ocupacion = ProfesionalOcupacionOficinaCentral::where('id_profesional', $id)->first();
        }
        // ALMACEN (7)
        elseif ($tipo == 7) 
        {
            $catalogoLabel = "ALMACEN";
            $ocupacion = ProfesionalOcupacionAlmacen::where('id_profesional', $id)->first();
        }
        // CETS LESP (8)
        elseif ($tipo == 8) 
        {
            $catalogoLabel = "CETS LESP";
            $ocupacion = ProfesionalOcupacionCetsLesp::where('id_profesional', $id)->first();
        }
        // CORS (9)
        elseif ($tipo == 9) 
        {
            $catalogoLabel = "CORS";
            $ocupacion = ProfesionalOcupacionCors::where('id_profesional', $id)->first();
        }
        // ISSREEI (10)
        elseif ($tipo == 10) 
        {
            $catalogoLabel = "ISSREEI";
            $ocupacion = ProfesionalOcupacionIssreei::where('id_profesional', $id)->first();
        }
        // CESAME (11)
        elseif ($tipo == 11) 
        {
            $catalogoLabel = "CESAME";
            $ocupacion = ProfesionalOcupacionCesame::where('id_profesional', $id)->first();
        }
        // PSI PARRAS (12)
        elseif ($tipo == 12) 
        {
            $catalogoLabel = "PSI PARRAS";
            $ocupacion = ProfesionalOcupacionPsiParras::where('id_profesional', $id)->first();
        }
        // CEAM (13)
        elseif ($tipo == 13) 
        {
            $catalogoLabel = "CEAM";
            $ocupacion = ProfesionalOcupacionCeam::where('id_profesional', $id)->first();
        }
        // CESAME (14)
        elseif ($tipo == 14) 
        {
            $catalogoLabel = "HOSPITAL DEL NIÑO";
            $ocupacion = ProfesionalOcupacionHospitalNino::where('id_profesional', $id)->first();
        }
        // PASANTE DE ENSENANZA (15)
        elseif ($tipo == 15) 
        {
            $catalogoLabel = "PASANTES MEDICOS / ENFERMERIA";
            $ocupacion = ProfesionalOcupacionEnsenanza::where('id_profesional', $id)->first();
        }
        else
        {
            $catalogoLabel = "SIN UNIDAD ASIGNADA";
        }

        // Cargamos los datos del MODULO CREDENCIALIZACION
        //$credencializacion = $profesional->credencializacion;
        //$fotografia = $credencializacion ? $credencializacion->fotografia : null;

        // Generamos la URL de la fotografía
        //$fotoUrl = $fotografia ? url('/foto/' . basename($fotografia)) : null;

        // Cargamos los datos del MODULO CREDENCIALIZACION
        $credencializacion = $profesional->credencializacion;
        $fotografia = $credencializacion ? $credencializacion->fotografia : null;

        // Generamos la URL de la fotografía desde storage
        $fotoUrl = $fotografia 
            ? asset('storage/credencializacion/thumbs/' . $fotografia) 
            : null;

        // Cargamos los datos del MODULO DE HORARIO
        $horario = $profesional->horario;
        $jornada = $horario ? $horario->jornada : null;
        
        $entradaLunes = $horario && $horario->entrada_lunes ? Carbon::parse($horario->entrada_lunes)->format('h:i A') : null;
        $salidaLunes = $horario && $horario->salida_lunes ? Carbon::parse($horario->salida_lunes)->format('h:i A') : null;

        $entradaMartes = $horario && $horario->entrada_martes ? Carbon::parse($horario->entrada_martes)->format('h:i A') : null;
        $salidaMartes = $horario && $horario->salida_martes ? Carbon::parse($horario->salida_martes)->format('h:i A') : null;

        $entradaMiercoles = $horario && $horario->entrada_miercoles ? Carbon::parse($horario->entrada_miercoles)->format('h:i A') : null;
        $salidaMiercoles = $horario && $horario->salida_miercoles ? Carbon::parse($horario->salida_miercoles)->format('h:i A') : null;

        $entradaJueves = $horario && $horario->entrada_jueves ? Carbon::parse($horario->entrada_jueves)->format('h:i A') : null;
        $salidaJueves = $horario && $horario->salida_jueves ? Carbon::parse($horario->salida_jueves)->format('h:i A') : null;

        $entradaViernes = $horario && $horario->entrada_viernes ? Carbon::parse($horario->entrada_viernes)->format('h:i A') : null;
        $salidaViernes = $horario && $horario->salida_viernes ? Carbon::parse($horario->salida_viernes)->format('h:i A') : null;

        $entradaSabado = $horario && $horario->entrada_sabado ? Carbon::parse($horario->entrada_sabado)->format('h:i A') : null;
        $salidaSabado = $horario && $horario->salida_sabado ? Carbon::parse($horario->salida_sabado)->format('h:i A') : null;

        $entradaDomingo = $horario && $horario->entrada_domingo ? Carbon::parse($horario->entrada_domingo)->format('h:i A') : null;
        $salidaDomingo = $horario && $horario->salida_domingo ? Carbon::parse($horario->salida_domingo)->format('h:i A') : null;

        $entradaFestivo = $horario && $horario->entrada_festivo ? Carbon::parse($horario->entrada_festivo)->format('h:i A') : null;
        $salidaFestivo = $horario && $horario->salida_festivo ? Carbon::parse($horario->salida_festivo)->format('h:i A') : null;

        // Cargamos los datos del modulo sueldo
        $sueldo = $profesional->sueldo;

        $sueldoMensual = $sueldo ? $sueldo->sueldo_mensual : null;
        $compensaciones = $sueldo ? $sueldo->compensaciones : null;
        $prestacionesMandatoLey = $sueldo ? $sueldo->prestaciones_mandato_ley : null;
        $prestacionesCgt = $sueldo ? $sueldo->prestaciones_cgt : null;
        $estimulos = $sueldo ? $sueldo->estimulos : null;
        $totalSueldo = $sueldo ? $sueldo->total : null;

        // Cargamos los datos del modulo de GRADO ACADEMICO
        $gradoAcademico = $profesional->gradoAcademico;

        $gradoAcademicoUnoId = $gradoAcademico ? $gradoAcademico->id : null;
        $cveGradoUno = $gradoAcademico ? $gradoAcademico->cve_grado_uno : null;
        $gradoAcademicoUno = $gradoAcademico ? $gradoAcademico->grado_academico_uno : null;
        $tituloUno = $gradoAcademico ? $gradoAcademico->titulo_uno : null;
        $institucionEducativaUno = $gradoAcademico ? $gradoAcademico->institucion_educativa_uno : null;
        $cedulaUno = $gradoAcademico ? $gradoAcademico->cedula_uno : null;
        $numeroCedulaUno = $gradoAcademico ? $gradoAcademico->numero_cedula_uno : null;
        $regNacProfUno = $gradoAcademico ? $gradoAcademico->reg_nac_prof_uno : null;

        $gradoAcademicoDosId = $gradoAcademico ? $gradoAcademico->id : null;
        $cveGradoDos = $gradoAcademico ? $gradoAcademico->cve_grado_dos : null;
        $gradoAcademicoDos = $gradoAcademico ? $gradoAcademico->grado_academico_dos : null;
        $tituloDos = $gradoAcademico ? $gradoAcademico->titulo_dos : null;
        $institucionEducativaDos = $gradoAcademico ? $gradoAcademico->institucion_educativa_dos : null;
        $cedulaDos = $gradoAcademico ? $gradoAcademico->cedula_dos : null;
        $numeroCedulaDos = $gradoAcademico ? $gradoAcademico->numero_cedula_dos : null;
        $regNacProfDos = $gradoAcademico ? $gradoAcademico->reg_nac_prof_dos : null;

        $gradoAcademicoTresId = $gradoAcademico ? $gradoAcademico->id : null;
        $cveGradoTres = $gradoAcademico ? $gradoAcademico->cve_grado_tres : null;
        $gradoAcademicoTres = $gradoAcademico ? $gradoAcademico->grado_academico_tres : null;
        $tituloTres = $gradoAcademico ? $gradoAcademico->titulo_tres : null;
        $institucionEducativaTres = $gradoAcademico ? $gradoAcademico->institucion_educativa_tres : null;
        $cedulaTres = $gradoAcademico ? $gradoAcademico->cedula_tres : null;
        $numeroCedulaTres = $gradoAcademico ? $gradoAcademico->numero_cedula_tres : null;
        $regNacProfTres = $gradoAcademico ? $gradoAcademico->reg_nac_prof_tres : null;

        $gradoAcademicoCuatroId = $gradoAcademico ? $gradoAcademico->id : null;
        $cveGradoCuatro = $gradoAcademico ? $gradoAcademico->cve_grado_cuatro : null;
        $gradoAcademicoCuatro = $gradoAcademico ? $gradoAcademico->grado_academico_cuatro : null;
        $tituloCuatro = $gradoAcademico ? $gradoAcademico->titulo_cuatro : null;
        $institucionEducativaCuatro = $gradoAcademico ? $gradoAcademico->institucion_educativa_cuatro : null;
        $cedulaCuatro = $gradoAcademico ? $gradoAcademico->cedula_cuatro : null;
        $numeroCedulaCuatro = $gradoAcademico ? $gradoAcademico->numero_cedula_cuatro : null;
        $regNacProfCuatro = $gradoAcademico ? $gradoAcademico->reg_nac_prof_cuatro : null;

        // Cargamos los datos para el modulo de AREA MEDICA
        $areaMedica = $profesional->areaMedica;

        $tipoFormacion = $areaMedica ? $areaMedica->tipo_formacion_label : null;
        $carrera = $areaMedica ? $areaMedica->carrera_label : null;
        $institucionEducativa = $areaMedica ? $areaMedica->institucion_educativa_label : null;
        $anioCursa = $areaMedica ? $areaMedica->anio_cursa : null;
        $duracionFormacion = $areaMedica ? $areaMedica->duracion_formacion : null;

        // Cargamos los datos para el modulo de CERTIFICACIONES
        $certificacion = $profesional->certificacion;

        $colegiacion = $certificacion ? $certificacion->colegiacion_label : null;
        $certificacio = $certificacion ? $certificacion->certificacion_label : null;
        $idioma = $certificacion ? $certificacion->idioma_label : null;
        $idiomaNivelDominio = $certificacion ? $certificacion->idioma_nivel_de_dominio : null;
        $lenguaIndigena = $certificacion ? $certificacion->lengua_indigena_label : null;
        $lenguaIndigenaDominio = $certificacion ? $certificacion->lengua_nivel_de_dominio : null;

        // Cargar modulo de Emergencias
        $emergencias = $profesional->emergencia;

        // Cargamos los datos para el modulo de CAMBIOI DE UNIDAD
        $cambiosDeUnidad = $profesional->cambiosDeUnidad()->orderBy('created_at', 'desc')->get();

        // Cargamos todos los pases de salida
        $pases = $profesional->pasesDeSalida;

        // Cargamos el historico de vigencias
        $vigencias = $profesional->vigencias()->orderBy('id', 'desc')->get();

        // Cargamos los tipos de nomina
        $tiposDeNomina = $profesional->cambioTipoNomina()->orderBy('id','desc')->get();

        // Cargamos los datos del usuario logeado
        $usuario = Auth::user();

        // Regresamos la vista con el arreglo
        return view('profesional.show', compact(
            'profesional',
            'edad',
            'fiel',
            'fiel_vigencia',
            'actividad',
            'adicional',
            'tipoPersonal',
            'codigoPuesto',
            'cluesNomina',
            'cluesNominaNombre',
            'cluesNominaMunicipio',
            'cluesNominaJurisdiccion',
            'cluesAdscripcion',
            'cluesAdscripcionNombre',
            'cluesAdscripcionMunicipio',
            'cluesAdscripcionJurisdiccion',
            'areaTrabajo',
            'ocupacionPuesto',
            'nominaPago',
            'tipoContrato',
            'fechaIngreso',
            'tipoPlaza',
            'institucionPuesto',
            'vigencia',
            'vigenciaMotivo',
            'temporalidad',
            'licenciaMaternidad',
            'seguroSalud',

            'fotografia',
            'fotoUrl',
            'jornada',
            'entradaLunes',
            'salidaLunes',
            'entradaMartes',
            'salidaMartes',
            'entradaMiercoles',
            'salidaMiercoles',
            'entradaJueves',
            'salidaJueves',
            'entradaViernes',
            'salidaViernes',
            'entradaSabado',
            'salidaSabado',
            'entradaDomingo',
            'salidaDomingo',
            'entradaFestivo',
            'salidaFestivo',
            'sueldoMensual',
            'compensaciones',
            'prestacionesMandatoLey',
            'prestacionesCgt',
            'estimulos',
            'totalSueldo',

            'cveGradoUno',
            'gradoAcademicoUno',
            'tituloUno',
            'institucionEducativaUno',
            'cedulaUno',
            'numeroCedulaUno',
            'regNacProfUno',

            'cveGradoDos',
            'gradoAcademicoDos',
            'tituloDos',
            'institucionEducativaDos',
            'cedulaDos',
            'numeroCedulaDos',
            'regNacProfDos',

            'cveGradoTres',
            'gradoAcademicoTres',
            'tituloTres',
            'institucionEducativaTres',
            'cedulaTres',
            'numeroCedulaTres',
            'regNacProfTres',

            'cveGradoCuatro',
            'gradoAcademicoCuatro',
            'tituloCuatro',
            'institucionEducativaCuatro',
            'cedulaCuatro',
            'numeroCedulaCuatro',
            'regNacProfCuatro',

            'gradoAcademicoUnoId',
            'gradoAcademicoDosId',
            'gradoAcademicoTresId',
            'gradoAcademicoCuatroId',

            'tipoFormacion',
            'carrera',
            'institucionEducativa',
            'anioCursa',
            'duracionFormacion',

            'colegiacion',
            'certificacio',
            'idioma',
            'idiomaNivelDominio',
            'lenguaIndigena',
            'lenguaIndigenaDominio',

            'cluesAdscripcionTipo',
            'ocupacion',

            'cambiosDeUnidad',

            'pases',
            'catalogoLabel',
            
            'usuario',

            'vigencias',

            'tiposDeNomina',

            'emergencias'
        ));
    }

    /**
     * 
     * 
     * METODO PARA EXPORTAR EN EXCEL LOS REGISTOS DE PROFESIONALES
     * 
     */

    public function export()
    {
        
        ini_set('memory_limit', '-1');

        ini_set('max_execution_time', 300); // 300 segundos = 5 minutos
        
        // Exporta los datos usando la clase CluesExport
        return Excel::download(new ProfesionalExport, 'REPORTE.xlsx');
    }

    /**
     * 
     * 
     * METODO PARA EXPORTAR EN EXCEL LOS REGISTOS DE PROFESIONALES PARA EL REPORTE DE MEXICO
     * 
     */

    public function reporteMexicoExcel()
    {
        
        ini_set('memory_limit', '-1');

        ini_set('max_execution_time', 300); // 300 segundos = 5 minutos
        
        // Exporta los datos usando la clase CluesExport
        return Excel::download(new ProfesionalesMexicoExport, 'REPORTE-PROFESIONALES.xlsx');
    }

    /**
     * 
     * 
     * METODO PARA MOSTRAR UN DOCUMENTO EN PDF CON EL ARCHIVO DEL PROFESIONAL
     * 
     */

    public function profesionalPDF($id)
    {
        // Buscar el profesional por ID
        $profesional = Profesional::findOrFail($id);

        // Generamos la variable a base 64
        $fotoBase64 = null;

        // Detectamos si la imagen existe y la codificamos
        if ($profesional->credencializacion && $profesional->credencializacion->fotografia) {
            $rutaImagen = storage_path('app/private/' . $profesional->credencializacion->fotografia);

            if (file_exists($rutaImagen)) {
                // Leer la imagen
                $fotoData = file_get_contents($rutaImagen);

                // Detectar el tipo MIME
                $mimeType = finfo_file(finfo_open(FILEINFO_MIME_TYPE), $rutaImagen);

                // Convertir la imagen a base64
                $fotoBase64 = 'data:' . $mimeType . ';base64,' . base64_encode($fotoData);
            }
        }

        // Pasar los datos a la vista
        $pdf = Pdf::loadView('pdf.profesional', compact('profesional','fotoBase64'));

         // Configurar la orientación de la página a horizontal
        //$pdf->setPaper('a4', 'landscape');  // 'a4' es el tamaño de la página y 'landscape' es la orientación horizontal

        return $pdf->stream('SIITH_'.$profesional->curp.'.pdf'); // Mostrar en el navegador
    }

    public function profesionalOcupacionCreate($id)
    {
        dd($id);
    }

    /**
     * 
     * 
     * METODO PARA ENVIAR FELICITACIONES DE CUMPLEAÑOS A LOS PROFESIONALES
     * 
     */

    public function enviarFelicitaciones()
    {
        $hoy = Carbon::now()->format('m-d');

        $cumpleañeros = Profesional::whereRaw("DATE_FORMAT(fecha_nacimiento, '%m-%d') = ?", [$hoy])->get();

        $enviados = [];

        foreach ($cumpleañeros as $persona) {
            try {
                    if (empty($persona->email) || !filter_var($persona->email, FILTER_VALIDATE_EMAIL)) {
                        throw new \Exception("Correo inválido: " . ($persona->email ?? 'NULL'));
                    }

                    $datos = [
                        'nombre' => $persona->nombre,
                        'apellido_paterno' => $persona->apellido_paterno,
                        'apellido_materno' => $persona->apellido_materno,
                    ];

                    Mail::to($persona->email)->send(new FelicitacionCumpleanos($datos));
                    Log::info("Correo enviado a: " . $persona->email);

                    // Guardamos la persona felicitada
                    $enviados[] = $persona;
                } 
                catch (\Exception $e) 
                {
                    Log::error("Error al enviar correo a {$persona->email}: " . $e->getMessage());
                }
        }

        return $enviados;
    }

    /**
     * 
     * 
     * METODO PARA MOSTRAR EL FORMULARIO DE LAS UNIDADES DE LA JURISDICCION SEGUN CADA USUARIO
     * 
     */
    public function miJurisdiccion()
    {
        // Cargamos los datos del usuario
        $usuario = Auth::user();

        // Cargamos todas las clues de la jurisdiccion
        $clues = Clue::where('clave_jurisdiccion',$usuario->jurisdiccion_unidad)
                ->orderBy('nombre', 'asc')
                ->get();

        // Retornamos la vista con la lista de clues
        return view('mi-jurisdiccion.index', compact('clues'));
    }

    /**
     * 
     * 
     * METODO PARA MOSTRAR LOS REGISTROS DE LA UNIDAD SELECCIONADA POR JURISDICCION
     * 
     */
    public function miJurisdiccionShow(Request $request)
    {
        // Validamos los datos
        $request->validate([
            'clues'=>'required'
        ],[]);

        // Consultamos los datos de la clues
        $clues = Clue::where('clues',$request->clues)->first();

        // Consultamos todos los usuarios con esa clues adscripcion
        $profesionales = Profesional::with(['puesto', 'credencializacion', 'horario', 'sueldo', 'gradoAcademico', 'areaMedica'])
                ->whereRelation('puesto', 'clues_adscripcion', $request->clues)
                ->whereRelation('puesto', 'vigencia', 'ACTIVO')
                ->get();

        // Regresamos a la vista con el arreglo de objetos
        return view('mi-jurisdiccion.show', compact('clues','profesionales'));

    }

    // Muesta la vista con las opciones del buscador
    public function profesionalBuscadorForm()
    {
        // Consultamos todas las clues
        $clues = Clue::orderBy('clave_jurisdiccion')
             ->orderBy('nombre')
             ->get();

        // Llamamos la vista con las clues
        return view('buscador.index', compact('clues'));
    }

    public function profesionalBuscadorCurp(Request $request)
    {
        $usuario = Auth::user();
        
        // Validamos los datos
        $request->validate([
            'curp'=>'required'
        ],[]);

        $busqueda=$request->curp;

        $terminos = explode(' ', strtolower($busqueda));
            
        $profesionales = Profesional::where(function($query) use ($terminos) 
        {  
            foreach ($terminos as $termino) 
            {
                $query->where(function($subquery) use ($termino) {
                    $subquery->whereRaw("LOWER(nombre) LIKE ?", ["%$termino%"])
                            ->orWhereRaw("LOWER(apellido_paterno) LIKE ?", ["%$termino%"])
                            ->orWhereRaw("LOWER(apellido_materno) LIKE ?", ["%$termino%"])
                            ->orWhereRaw("LOWER(curp) LIKE ?", ["%$termino%"]);
                });
            }
        })->get();

        // Si no se encuentra, redirige con mensaje de error
        if (!$profesionales) {
            return back()
                ->with('error', 'No se encontró ningún profesional con ese dato.')
                ->withInput();
        }

        // Si se encuentra, lo enviamos a la vista
        return view('buscador.show', compact('profesionales','usuario'));
    }

    


}