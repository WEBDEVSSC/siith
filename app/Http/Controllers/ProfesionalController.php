<?php

namespace App\Http\Controllers;

use App\Exports\ProfesionalExport;
use App\Mail\FelicitacionCumpleanos;
use App\Models\Clue;
use App\Models\Entidad;
use App\Models\EstadoConyugal;
use App\Models\Municipio;
use App\Models\Profesional;
use App\Models\ProfesionalOcupacionAlmacen;
use App\Models\ProfesionalOcupacionCeam;
use App\Models\ProfesionalOcupacionCentroSalud;
use App\Models\ProfesionalOcupacionCesame;
use App\Models\ProfesionalOcupacionCetsLesp;
use App\Models\ProfesionalOcupacionCors;
use App\Models\ProfesionalOcupacionCriCree;
use App\Models\ProfesionalOcupacionHospital;
use App\Models\ProfesionalOcupacionHospitalNino;
use App\Models\ProfesionalOcupacionOficinaCentral;
use App\Models\ProfesionalOcupacionOfJurisdiccional;
use App\Models\ProfesionalOcupacionPsiParras;
use App\Models\ProfesionalOcupacionSamuCrum;
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
            return redirect()->back()->with('error', 'USUARIO REGISTRADO');
        } 
        else 
        {
            // Si no se encuentra el registro, redirigimos al formulario de creación de datos
            return redirect()->route('datosGenerales', [
                'curp' => $request->curp
            ]);
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
            'telefono_casa' => 'required|size:10',
            'celular' => 'required|size:10',
            'email' => 'required|email',
            
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
        $profesional->mdl_datos_generales = 1;

        // Guardar el nuevo profesional
        $profesional->save();

        // Retornar o redirigir a donde lo necesites, por ejemplo:
        //return redirect()->route('profesionalIndex')->with('success', 'Registro realizado correctamente.');

        return redirect()->route('profesionalShow', ['id' => $profesional->id])
                 ->with('success', 'Registro realizado correctamente.');
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
        elseif(Gate::allows('ofCentral'))
        {            
            $profesionales = Profesional::with(['puesto', 'credencializacion', 'horario', 'sueldo', 'gradoAcademico', 'areaMedica'])
                ->whereRelation('puesto', 'clues_adscripcion', 'CLSSA002093')
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
            'telefono_casa' => 'required|size:10',
            'celular' => 'required|size:10',
            'email' => 'required|email',
            
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
        ]);

        // Redireccionar con un mensaje de éxito
        return redirect()->route('profesionalIndex')->with('success', 'Registro actualizado correctamente.');

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

        // Cargamos los datos del MODULO DE OCUPACION
        
        $ocupacion = null;

        $tipo = $profesional->puesto->clues_adscripcion_tipo ?? null;

        // CENTROS DE SALUD URBANOS Y RURALES (1)
        if ($tipo == 1) 
        {
            $ocupacion = ProfesionalOcupacionCentroSalud::where('id_profesional', $id)->first();
        } 
        // HOSPITALES (2)
        elseif ($tipo == 2) 
        {
            $ocupacion = ProfesionalOcupacionHospital::where('id_profesional', $id)->first();
        } 
        // OFICINA JURISDICCIONAL (3)
        elseif ($tipo == 3) 
        {
            $ocupacion = ProfesionalOcupacionOfJurisdiccional::where('id_profesional', $id)->first();
        } 
        // CRI CREE (4)
        elseif ($tipo == 4) 
        {
            $ocupacion = ProfesionalOcupacionCriCree::where('id_profesional', $id)->first();
        }
        // SAMU CRUM (5)
        elseif ($tipo == 5) 
        {
            $ocupacion = ProfesionalOcupacionSamuCrum::where('id_profesional', $id)->first();
        }
        // OFICINA CENTRAL (6)
        elseif ($tipo == 6) 
        {
            $ocupacion = ProfesionalOcupacionOficinaCentral::where('id_profesional', $id)->first();
        }
        // ALMACEN (7)
        elseif ($tipo == 7) 
        {
            $ocupacion = ProfesionalOcupacionAlmacen::where('id_profesional', $id)->first();
        }
        // CETS LESP (8)
        elseif ($tipo == 8) 
        {
            $ocupacion = ProfesionalOcupacionCetsLesp::where('id_profesional', $id)->first();
        }
        // CORS (9)
        elseif ($tipo == 9) 
        {
            $ocupacion = ProfesionalOcupacionCors::where('id_profesional', $id)->first();
        }
        // CESAME (11)
        elseif ($tipo == 11) 
        {
            $ocupacion = ProfesionalOcupacionCesame::where('id_profesional', $id)->first();
        }
        // CESAME (12)
        elseif ($tipo == 12) 
        {
            $ocupacion = ProfesionalOcupacionPsiParras::where('id_profesional', $id)->first();
        }
        // CEAM (13)
        elseif ($tipo == 13) 
        {
            $ocupacion = ProfesionalOcupacionCeam::where('id_profesional', $id)->first();
        }
        // CESAME (14)
        elseif ($tipo == 14) 
        {
            $ocupacion = ProfesionalOcupacionHospitalNino::where('id_profesional', $id)->first();
        }

        // Cargamos los datos del MODULO CREDENCIALIZACION
        $credencializacion = $profesional->credencializacion;
        $fotografia = $credencializacion ? $credencializacion->fotografia : null;

        // Generamos la URL de la fotografía
        $fotoUrl = $fotografia ? url('/foto/' . basename($fotografia)) : null;

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

        $cveGradoUno = $gradoAcademico ? $gradoAcademico->cve_grado_uno : null;
        $gradoAcademicoUno = $gradoAcademico ? $gradoAcademico->grado_academico_uno : null;
        $tituloUno = $gradoAcademico ? $gradoAcademico->titulo_uno : null;
        $institucionEducativaUno = $gradoAcademico ? $gradoAcademico->institucion_educativa_uno : null;
        $cedulaUno = $gradoAcademico ? $gradoAcademico->cedula_uno : null;
        $numeroCedulaUno = $gradoAcademico ? $gradoAcademico->numero_cedula_uno : null;
        $regNacProfUno = $gradoAcademico ? $gradoAcademico->reg_nac_prof_uno : null;

        $cveGradoDos = $gradoAcademico ? $gradoAcademico->cve_grado_dos : null;
        $gradoAcademicoDos = $gradoAcademico ? $gradoAcademico->grado_academico_dos : null;
        $tituloDos = $gradoAcademico ? $gradoAcademico->titulo_dos : null;
        $institucionEducativaDos = $gradoAcademico ? $gradoAcademico->institucion_educativa_dos : null;
        $cedulaDos = $gradoAcademico ? $gradoAcademico->cedula_dos : null;
        $numeroCedulaDos = $gradoAcademico ? $gradoAcademico->numero_cedula_dos : null;
        $regNacProfDos = $gradoAcademico ? $gradoAcademico->reg_nac_prof_dos : null;

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

        // Cargamos los datos para el modulo de CAMBIOI DE UNIDAD
        $cambiosDeUnidad = $profesional->cambiosDeUnidad()->orderBy('created_at', 'desc')->get();

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

            'cambiosDeUnidad'
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

    public function enviarTelegram()
    {
        $token = '7718774587:AAF67jTIaVpjUEOBoO6DDqGTMEfsGvfX08k';
        $chat_id = '13673422';
        $mensaje = 'Mensaje de prueba ignorando SSL 🛠️';

        $response = Http::withOptions([
            'verify' => false, // <--- desactiva verificación SSL
        ])->post("https://api.telegram.org/bot{$token}/sendMessage", [
            'chat_id' => $chat_id,
            'text' => $mensaje,
        ]);

        dd($response->json());
    }

    public function enviarSaludoTelegram()
    {
        $token = '7718774587:AAF67jTIaVpjUEOBoO6DDqGTMEfsGvfX08k'; // reemplaza con tu token real

        $usuarios = Profesional::whereNotNull('chat_id')->get();

        foreach ($usuarios as $persona) {
            $mensaje = "Hola {$persona->nombre} {$persona->apellido_paterno} {$persona->apellido_materno} , Te recordamos que tienes nominas pendientes para firmar";

            Http::withOptions([
                'verify' => false, // solo en desarrollo
            ])->post("https://api.telegram.org/bot{$token}/sendMessage", [
                'chat_id' => $persona->chat_id,
                'text' => $mensaje,
            ]);
        }

        return response()->json([
            'status' => 'Mensajes enviados',
            'total' => $usuarios->count()
        ]);
    }

    public function enviarMensajes()
    {
        $output = [];
        $retorno = 0;

        exec("python C:/wamp64/www/siith/python/whatsapp.py 2>&1", $rawOutput, $retorno);

        // Convertir a UTF-8 forzadamente
        foreach ($rawOutput as $line) {
            $output[] = mb_convert_encoding($line, 'UTF-8', 'auto');
        }

        if ($retorno === 0) {
        return response()->json([
            'mensaje' => 'Mensajes enviados',
            'salida' => $output
        ], 200, [], JSON_UNESCAPED_UNICODE);
        } else {
            return response()->json([
                'error' => 'Error al ejecutar Python',
                'salida' => $output
            ], 500, [], JSON_UNESCAPED_UNICODE);
        }
    }
}