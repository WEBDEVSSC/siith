@extends('adminlte::page')

@section('title', 'Profesionales')

@section('plugins.Sweetalert2', true)

@section('content_header')
    <h1><strong>Perfil del Trabajador</strong> <small></small></h1>
@stop

@section('content')

<!-- -->

@php
    $alerts = [
        'success',
        'update',
        'successOcupacion',
        'updateOcupacion',
        'successCredencializacion',
        'updateCredencializacion',
        'successHorario',
        'successUpdateHorario',
        'successUpdatePuesto',
        'successSueldo',
        'updateSueldo',
        'successGradoAcademico',
        'updateGradoAcademico',
        'successAreaMedica',
        'updateAreaMedica',
        'successCertificacion',
        'updateCertificacion',
        'successCentrosDeSalud',
        'updateCentrosDeSalud',
        'successHospital',
        'updateHospital',
        'successOfJurisdiccional',
        'updateOfJurisdiccional',
        'successCriCree',
        'updateCriCree',
        'successSamuCrum',
        'updateSamuCrum',
        'successOficinaCentral',
        'updateOficinaCentral',
        'successAlmacen',
        'updateAlmacen',
        'successCambioTipoNomina'
    ];

    $alertMessage = null;
    foreach ($alerts as $alert) {
        if(session($alert)){
            $alertMessage = session($alert);
            break; // mostramos solo la primera alerta encontrada
        }
    }
@endphp

@if($alertMessage)
    <!-- Asegúrate de tener SweetAlert cargado -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Éxito',
                text: @json($alertMessage),
                icon: 'success',
                confirmButtonText: 'Ok'
            });
        });
    </script>
@endif

<!-- -->

@if ($usuario->role=="admin")

ADMINISTRADOR

@elseif ($usuario->role == 'ofJurisdiccional')



@else
    
@endif
    

<div class="card mt-3">
    <div class="card-header">
        <strong><i class="fa fa-user" aria-hidden="true"></i> DATOS GENERALES</strong>        
    </div>
    <div class="card-body">

        <div class="row">
            <div class="col-md-2">
                <center>
                    @if($fotoUrl)
                        <img src="{{ $fotoUrl }}" alt="Fotografía del profesional" style="max-width:200px; height:auto;" class="img-thumbnail"/>
                    @else
                        <img src="{{ asset('images/avatar-placeholder.png') }}" alt="Sin foto" style="max-width:200px; height:auto;" class="img-thumbnail"/>
                    @endif

                    <br>
                    <br>

                    @if($profesional->credencializacion && $profesional->credencializacion->fotografia)
                        <a href="{{ route('credencializacion.descargar', $profesional->credencializacion->id) }}" 
                        class="btn btn-info btn-sm" target="_blank">
                        Descargar fotografía original
                        </a>
                    @endif
                </center>
            </div>
            <div class="col-md-10">

                <div class="row">
                    <div class="col-md-3">
                        <p><strong>CURP </strong></p>
                        {{ $profesional->curp }}
                    </div>
                    <div class="col-md-3">
                        <p><strong>RFC</strong></p>
                        {{ $profesional->rfc }} - {{ $profesional->homoclave }}
                    </div>
                    <div class="col-md-3">
                        <p><strong>Nombre completo </strong></p>
                        {{ $profesional->nombre }} {{ $profesional->apellido_paterno }} {{ $profesional->apellido_materno }}
                    </div>
                    <div class="col-md-3">
                        <p><strong>Fecha de nacimiento </strong></p>
                        {{ \Carbon\Carbon::parse($profesional->fecha_nacimiento)->format('d/m/Y') }} ( {{ $edad }} Años )
                    </div>
                </div>

                <hr>
        
                <div class="row mt-3">
                    <div class="col-md-3">
                        <p><strong>Sexo</strong></p>

                        {{ $profesional->sexo == "M" ? 'MASCULINO' : 'FEMENINO' }}

                    </div>
                    <div class="col-md-3">
                        <p><strong>Nacionalidad</strong></p>
                        {{ $profesional->nacionalidad }}
                    </div>
                    <div class="col-md-3">
                        <p><strong>Nacimiento</strong></p>
                        {{ $profesional->pais_nacimiento }} - {{ $profesional->entidad_nacimiento }} - {{ $profesional->municipio_nacimiento }}
                    </div>
                    <div class="col-md-3">
                        <p><strong>Estado Conyugal</strong></p>
                        {{ $profesional->estado_conyugal }}
                    </div>
                </div>

                <hr>
        
                <div class="row mt-3">
                    <div class="col-md-3">
                        <p><strong>Teléfono de Casa</strong></p>
                        {{ $profesional->telefono_casa }}
                    </div>
                    <div class="col-md-3">
                        <p><strong>Celular</strong></p>
                        {{ $profesional->celular }}
                    </div>
                    <div class="col-md-3">
                        <p><strong>E-mail</strong></p>
                        {{ $profesional->email }}
                    </div>
                    <div class="col-md-3">
                        <p><strong>Padre / Madre de familia</strong></p>
                        {{ $profesional->padre_madre_familia }}
                    </div>
                </div>

            </div>
        </div>
        

    </div>

    <!-- -- -->
    
    <div class="card-footer">

        @if ($profesional->mdl_datos_generales == 1)
            <a href="{{ route('profesionalEdit', $profesional->id) }}" class="btn btn-info btn-sm"> <i class="fa-solid fa-pen"></i> EDITAR DATOS GENERALES</a>
        @elseif ($profesional->mdl_datos_generales == 0)
            <p>El módulo de datos generales está inactivo.</p>
        @endif

        @if ($profesional->credencializacion?->mdl_credencializacion == 1)
            <a href="{{ route('editCredencializacion', $profesional->id) }}" class="btn btn-info btn-sm"><i class="fa-solid fa-pen"></i> EDITAR FOTOGRAFÍA</a>
        @elseif ($profesional->credencializacion?->mdl_credencializacion == 0)
            <a href="{{ route('createCredencializacion', $profesional->id) }}" class="btn btn-info btn-sm"><i class="fa-solid fa-plus"></i> SUBIR FOTOGRAFÍA</a>
        @endif

    </div>

</div>

    <!-- -- -->

    <div class="card">
        <div class="card-header"><strong>OCUPACIÓN</strong> {{ $catalogoLabel }}  </div>
        <div class="card-body">

            <!-- OCUPACION PARA CENTROS DE SALUD URBANOS Y RURALES (1) -->

            @if ($cluesAdscripcionTipo == 1)
                <ul>
                    <li>{{ optional($ocupacion)->unidad_uno }} - {{ optional($ocupacion)->area_uno }} - {{ optional($ocupacion)->subarea_uno }} - {{ optional($ocupacion)->ocupacion_uno }}</li>
                    <li>{{ optional($ocupacion)->unidad_dos }} - {{ optional($ocupacion)->area_dos }} - {{ optional($ocupacion)->subarea_dos }} - {{ optional($ocupacion)->ocupacion_dos }}</li>
                </ul>
            @endif

            <!-- OCUPACION PARA HOSPITALES (2) -->

            @if ($cluesAdscripcionTipo == 2)
                <ul>
                    <li>{{ optional($ocupacion)->unidad_uno }} - {{ optional($ocupacion)->area_uno }} - {{ optional($ocupacion)->subarea_uno }} - {{ optional($ocupacion)->puesto_uno }}</li>
                    <li>{{ optional($ocupacion)->unidad_dos }} - {{ optional($ocupacion)->area_dos }} - {{ optional($ocupacion)->subarea_dos }} - {{ optional($ocupacion)->puesto_dos }}</li>
                </ul>
            @endif

            <!-- OCUPACION PARA OFICINAS JURISDICCIONALES (3) -->

            @if ($cluesAdscripcionTipo == 3)
                <ul>
                    <li>{{ optional($ocupacion)->unidad_uno }} - {{ optional($ocupacion)->area_uno }} - {{ optional($ocupacion)->subarea_uno }} - {{ optional($ocupacion)->servicio_uno }} - {{ optional($ocupacion)->ocupacion_uno }}</li>
                    <li>{{ optional($ocupacion)->unidad_dos }} - {{ optional($ocupacion)->area_dos }} - {{ optional($ocupacion)->subarea_dos }} - {{ optional($ocupacion)->servicio_dos }} - {{ optional($ocupacion)->ocupacion_dos }}</li>
                </ul>
            @endif

            <!-- OCUPACION PARA CRI CREE (4) -->

            @if ($cluesAdscripcionTipo == 4)
                <ul>
                    <li>{{ optional($ocupacion)->unidad_uno }} - {{ optional($ocupacion)->area_uno }} - {{ optional($ocupacion)->subarea_uno }} - {{ optional($ocupacion)->ocupacion_uno }}</li>
                    <li>{{ optional($ocupacion)->unidad_dos }} - {{ optional($ocupacion)->area_dos }} - {{ optional($ocupacion)->subarea_dos }} - {{ optional($ocupacion)->ocupacion_dos }}</li>
                </ul>
            @endif

            <!-- OCUPACION PARA SAMU CRUM (5) -->

            @if ($cluesAdscripcionTipo == 5)
                <ul>
                    <li>{{ optional($ocupacion)->unidad_uno }} - {{ optional($ocupacion)->area_uno }} - {{ optional($ocupacion)->subarea_uno }} - {{ optional($ocupacion)->componente_uno }} - {{ optional($ocupacion)->ocupacion_uno }}</li>
                    <li>{{ optional($ocupacion)->unidad_dos }} - {{ optional($ocupacion)->area_dos }} - {{ optional($ocupacion)->subarea_dos }} - {{ optional($ocupacion)->componente_dos }} - {{ optional($ocupacion)->ocupacion_dos }}</li>
                </ul>
            @endif

            <!-- OCUPACION PARA OFICINA CENTRAL (6) -->

            @if ($cluesAdscripcionTipo == 6)
                <ul>
                    <li>{{ optional($ocupacion)->area_uno }} - {{ optional($ocupacion)->subarea_uno }} - {{ optional($ocupacion)->programa_uno }} - {{ optional($ocupacion)->componente_uno }} - {{ optional($ocupacion)->ocupacion_uno }}</li>
                    <li>{{ optional($ocupacion)->area_dos }} - {{ optional($ocupacion)->subarea_dos }} - {{ optional($ocupacion)->programa_dos }} - {{ optional($ocupacion)->componente_dos }} - {{ optional($ocupacion)->ocupacion_dos }}</li>
                </ul>
            @endif

            <!-- OCUPACION PARA ALMACEN (7) -->

            @if ($cluesAdscripcionTipo == 7)
                <ul>
                    <li>{{ optional($ocupacion)->area_uno }} - {{ optional($ocupacion)->subarea_uno }} - {{ optional($ocupacion)->jefatura_uno }} - {{ optional($ocupacion)->departamento_uno }} - {{ optional($ocupacion)->ocupacion_uno }}</li>
                    <li>{{ optional($ocupacion)->area_dos }} - {{ optional($ocupacion)->subarea_dos }} - {{ optional($ocupacion)->jefatura_dos }} - {{ optional($ocupacion)->departamento_dos }} - {{ optional($ocupacion)->ocupacion_dos }}</li>
                </ul>
            @endif

             <!-- OCUPACION PARA CETS LESP (8) -->

             @if ($cluesAdscripcionTipo == 8)
                <ul>
                    <li>{{ optional($ocupacion)->area_uno }} - {{ optional($ocupacion)->subarea_uno }} - {{ optional($ocupacion)->jefatura_programa_uno }} - {{ optional($ocupacion)->componente_uno }} - {{ optional($ocupacion)->ocupacion_uno }}</li>
                    <li>{{ optional($ocupacion)->area_dos }} - {{ optional($ocupacion)->subarea_dos }} - {{ optional($ocupacion)->jefatura_programa_dos }} - {{ optional($ocupacion)->componente_dos }} - {{ optional($ocupacion)->ocupacion_dos }}</li>
                </ul>
            @endif

            <!-- OCUPACION PARA CORS (9) -->

            @if ($cluesAdscripcionTipo == 9)
                <ul>
                    <li>{{ optional($ocupacion)->unidad_uno }} - {{ optional($ocupacion)->area_uno }} - {{ optional($ocupacion)->subarea_servicio_uno }} - {{ optional($ocupacion)->componente_uno }} - {{ optional($ocupacion)->ocupacion_uno }}</li>
                    <li>{{ optional($ocupacion)->unidad_dos }} - {{ optional($ocupacion)->area_dos }} - {{ optional($ocupacion)->subarea_servicio_dos }} - {{ optional($ocupacion)->componente_dos }} - {{ optional($ocupacion)->ocupacion_dos }}</li>
                </ul>
            @endif

            <!-- OCUPACION PARA CESAME (11) -->

            @if ($cluesAdscripcionTipo == 11)
                <ul>
                    <li>{{ optional($ocupacion)->unidad_uno }} - {{ optional($ocupacion)->area_uno }} - {{ optional($ocupacion)->subarea_servicio_uno }} - {{ optional($ocupacion)->componente_uno }} - {{ optional($ocupacion)->ocupacion_uno }}</li>
                    <li>{{ optional($ocupacion)->unidad_dos }} - {{ optional($ocupacion)->area_dos }} - {{ optional($ocupacion)->subarea_servicio_dos }} - {{ optional($ocupacion)->componente_dos }} - {{ optional($ocupacion)->ocupacion_dos }}</li>
                </ul>
            @endif

            <!-- OCUPACION PARA PSI PARRAS (12) -->

            @if ($cluesAdscripcionTipo == 12)
                <ul>
                    <li>{{ optional($ocupacion)->unidad_uno }} - {{ optional($ocupacion)->area_uno }} - {{ optional($ocupacion)->subarea_servicio_uno }} - {{ optional($ocupacion)->componente_uno }} - {{ optional($ocupacion)->ocupacion_uno }}</li>
                    <li>{{ optional($ocupacion)->unidad_dos }} - {{ optional($ocupacion)->area_dos }} - {{ optional($ocupacion)->subarea_servicio_dos }} - {{ optional($ocupacion)->componente_dos }} - {{ optional($ocupacion)->ocupacion_dos }}</li>
                </ul>
            @endif

            <!-- OCUPACION PARA CEAM (13) -->

            @if ($cluesAdscripcionTipo == 13)
                <ul>
                    <li>{{ optional($ocupacion)->unidad_uno }} - {{ optional($ocupacion)->area_uno }} - {{ optional($ocupacion)->subarea_servicio_uno }} - {{ optional($ocupacion)->componente_uno }} - {{ optional($ocupacion)->ocupacion_uno }}</li>
                    <li>{{ optional($ocupacion)->unidad_dos }} - {{ optional($ocupacion)->area_dos }} - {{ optional($ocupacion)->subarea_servicio_dos }} - {{ optional($ocupacion)->componente_dos }} - {{ optional($ocupacion)->ocupacion_dos }}</li>
                </ul>
            @endif

            <!-- OCUPACION PARA HOSPITAL DEL NINO (14) -->

            @if ($cluesAdscripcionTipo == 14)
                <ul>
                    <li>{{ optional($ocupacion)->unidad_uno }} - {{ optional($ocupacion)->area_uno }} - {{ optional($ocupacion)->subarea_uno }} - {{ optional($ocupacion)->ocupacion_uno }}</li>
                    <li>{{ optional($ocupacion)->unidad_dos }} - {{ optional($ocupacion)->area_dos }} - {{ optional($ocupacion)->subarea_dos }} - {{ optional($ocupacion)->ocupacion_dos }}</li>
                </ul>
            @endif
            
        </div>
        <div class="card-footer">

            @if ($profesional->puesto?->clues_adscripcion_tipo == 1)

                @if ($profesional->ocupacionCentroSalud?->mdl_status == 1)
                    <a href="{{ route('editCentrosDeSalud', $profesional->id) }}" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="OF. JURISDICCIONAL">
                        <i class="fa-solid fa-building-user"></i> EDITAR CATÁLOGO / CARTERA DE SERVICIOS
                    </a>
                @else  
                    <a href="{{ route('createCentrosDeSalud', $profesional->id) }}" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="OF. JURISDICCIONAL">
                        <i class="fa-solid fa-building-user"></i> CARGAR CATÁLOGO / CARTERA DE SERVICIOS
                    </a>
                @endif
                
            @endif

            @if ($profesional->puesto?->clues_adscripcion_tipo == 2)

                @if ($profesional->ocupacionHospital?->mdl_status == 1)
                    <a href="{{ route('editHospital', $profesional->id) }}" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="OF. JURISDICCIONAL">
                        <i class="fa-solid fa-building-user"></i> EDITAR CATÁLOGO / CARTERA DE SERVICIOS
                    </a>
                @else  
                    <a href="{{ route('createHospital', $profesional->id) }}" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="OF. JURISDICCIONAL">
                        <i class="fa-solid fa-building-user"></i> CARGAR CATÁLOGO / CARTERA DE SERVICIOS
                    </a>
                @endif
                
            @endif

            @if ($profesional->puesto?->clues_adscripcion_tipo == 3)

                @if ($profesional->ocupacionOfJurisidccion?->mdl_status == 1)
                    <a href="{{ route('editOfJurisdiccional', $profesional->id) }}" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="OF. JURISDICCIONAL">
                        <i class="fa-solid fa-building-user"></i> EDITAR CATÁLOGO / CARTERA DE SERVICIOS
                    </a>
                @else  
                    <a href="{{ route('createOfJurisdiccional', $profesional->id) }}" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="OF. JURISDICCIONAL">
                        <i class="fa-solid fa-building-user"></i> CARGAR CATÁLOGO / CARTERA DE SERVICIOS
                    </a>
                @endif
                
            @endif

            {{-- FALTA LA 4 --}}

             @if ($profesional->puesto?->clues_adscripcion_tipo == 6)

                @if ($profesional->ocupacionOficinaCentral?->mdl_status == 1)
                    <a href="{{ route('editOficinaCentral', $profesional->id) }}" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="OF. JURISDICCIONAL">
                        <i class="fa-solid fa-building-user"></i> EDITAR CATÁLOGO / CARTERA DE SERVICIOS
                    </a>
                @else  
                    <a href="{{ route('createOficinaCentral', $profesional->id) }}" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="OF. JURISDICCIONAL">
                        <i class="fa-solid fa-building-user"></i> CARGAR CATÁLOGO / CARTERA DE SERVICIOS
                    </a>
                @endif
                
            @endif
            
            <!-- ALMACEN -->
            @if ($profesional->puesto?->clues_adscripcion_tipo == 7)

                @if ($profesional->ocupacionAlmacen?->mdl_status == 1)
                    <a href="{{ route('editAlmacen', $profesional->id) }}" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="ALMACEN">
                        <i class="fa-solid fa-shop-lock"></i> EDITAR CATÁLOGO / CARTERA DE SERVICIOS
                    </a>
                @else  
                    <a href="{{ route('createAlmacen', $profesional->id) }}" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="ALMACENL">
                        <i class="fa-solid fa-shop-lock"></i> CARGAR CATÁLOGO / CARTERA DE SERVICIOS
                    </a>
                @endif
                
            @endif

            <!-- CETS LESP -->
            @if ($profesional->puesto?->clues_adscripcion_tipo == 8)

                @if ($profesional->ocupacionCetsLesp?->mdl_status == 1)
                    <a href="{{ route('editCetsLesp', $profesional->id) }}" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="CETS LESP">
                        <i class="fa-solid fa-droplet"></i> EDITAR CATÁLOGO / CARTERA DE SERVICIOS
                    </a>
                @else  
                    <a href="{{ route('createCetsLesp', $profesional->id) }}" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="CETS LESP">
                        <i class="fa-solid fa-droplet"></i> CARGAR CATÁLOGO / CARTERA DE SERVICIOS
                    </a>
                @endif
                
            @endif

            <!-- CORS -->
            @if ($profesional->puesto?->clues_adscripcion_tipo == 9)

                @if ($profesional->ocupacionCors?->mdl_status == 1)
                    <a href="{{ route('editCors', $profesional->id) }}" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="C.O.R.S.">
                        <i class="fa-solid fa-virus-covid"></i> EDITAR CATÁLOGO / CARTERA DE SERVICIOS
                    </a>
                @else  
                    <a href="{{ route('createCors', $profesional->id) }}" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="C.O.R.S.">
                        <i class="fa-solid fa-virus-covid"></i> CARGAR CATÁLOGO / CARTERA DE SERVICIOS
                    </a>
                @endif
                
            @endif

            <!-- CESAME -->
            @if ($profesional->puesto?->clues_adscripcion_tipo == 11)

                @if ($profesional->ocupacionCesame?->mdl_status == 1)
                    <a href="{{ route('editCesame', $profesional->id) }}" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="C.E.S.A.M.E.">
                        <i class="fa-solid fa-brain"></i> EDITAR CATÁLOGO / CARTERA DE SERVICIOS
                    </a>
                @else  
                    <a href="{{ route('createCesame', $profesional->id) }}" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="C.E.S.A.M.E.">
                        <i class="fa-solid fa-brain"></i> CARGAR CATÁLOGO / CARTERA DE SERVICIOS
                    </a>
                @endif
                
            @endif

            <!-- PSI PARRAS -->
            @if ($profesional->puesto?->clues_adscripcion_tipo == 12)

                @if ($profesional->ocupacionPsiParras?->mdl_status == 1)
                    <a href="{{ route('editPsiParras', $profesional->id) }}" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="PSI PARRAS">
                        <i class="fa-solid fa-brain"></i> EDITAR CATÁLOGO / CARTERA DE SERVICIOS
                    </a>
                @else  
                    <a href="{{ route('createPsiParras', $profesional->id) }}" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="PSI PARRAS">
                        <i class="fa-solid fa-brain"></i> CARGAR CATÁLOGO / CARTERA DE SERVICIOS
                    </a>
                @endif
                
            @endif

            <!-- CEAM -->
            @if ($profesional->puesto?->clues_adscripcion_tipo == 13)

                @if ($profesional->ocupacionCeam?->mdl_status == 1)
                    <a href="{{ route('editCeam', $profesional->id) }}" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="PSI PARRAS">
                        <i class="fa-solid fa-person-walking-with-cane"></i> EDITAR CATÁLOGO / CARTERA DE SERVICIOS
                    </a>
                @else  
                    <a href="{{ route('createCeam', $profesional->id) }}" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="PSI PARRAS">
                        <i class="fa-solid fa-person-walking-with-cane"></i> CARGAR CATÁLOGO / CARTERA DE SERVICIOS
                    </a>
                @endif
                
            @endif

            <!-- HOSPITAL DEL NIÑO -->
            @if ($profesional->puesto?->clues_adscripcion_tipo == 14)

                @if ($profesional->ocupacionHospitalNino?->mdl_status == 1)
                    <a href="{{ route('editHospitalNino', $profesional->id) }}" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="HOSPITAL DEL NIÑO">
                        <i class="fa-solid fa-children"></i> EDITAR CATÁLOGO / CARTERA DE SERVICIOS
                    </a>
                @else  
                    <a href="{{ route('createHospitalNino', $profesional->id) }}" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="HOSPITAL DEL NIÑO">
                        <i class="fa-solid fa-children"></i> CARGAR CATÁLOGO / CARTERA DE SERVICIOS
                    </a>
                @endif
                
            @endif

        </div>
    </div>

    <!-- -- -->

    <div class="card">
        <div class="card-header">
            <i class="fa fa-building" aria-hidden="true"></i> <strong>TIPO DE NÓMINA</strong>
        </div>
        <div class="card-body">

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nómina de Pago</th>
                        <th>Tipo de Contrato</th>
                        <th>Tipo de Plaza</th>
                        <th>Seguro de Salud</th>
                        <th>Código de Puesto</th>
                        <th>Fecha de Inicio</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tiposDeNomina as $tipoDeNomina)
                        <tr>
                            <td>{{ $tipoDeNomina->nomina_pago ?? 'N/A' }}</td>
                            <td>{{ $tipoDeNomina->tipo_contrato ?? 'N/A' }}</td>
                            <td>{{ $tipoDeNomina->tipo_plaza ?? 'N/A' }}</td>
                            <td>{{ $tipoDeNomina->seguro_salud ?? 'N/A' }}</td>
                            <td>{{ $tipoDeNomina->codigo_puesto ?? 'N/A' }} - {{ $tipoDeNomina->codigo_puesto_label ?? 'N/A' }}</td>
                            <td>{{ $tipoDeNomina->fecha_ingreso ? \Carbon\Carbon::parse($tipoDeNomina->fecha_ingreso)->format('d-m-Y') : 'N/A' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No hay registros</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
        <div class="card-footer">

            @if ($profesional->puesto?->mdl_puesto == 1)
                <a href="{{ route('createCambioTipoNomina', $profesional->id) }}" class="btn btn-info btn-sm"><i class="fa-solid fa-pen"></i> EDITAR DATOS</a>
            @elseif ($profesional->puesto?->mdl_puesto == 0)
                <a href="{{ route('createCambioTipoNomina', $profesional->id) }}" class="btn btn-info btn-sm"><i class="fa-solid fa-plus"></i> REGISTRAR DATOS</a>
            @endif
    
        </div>
    </div>
    <!-- -- -->

    <!-- -- -->

    <div class="card">
        <div class="card-header">
            <i class="fa-solid fa-tags"></i> <strong>VIGENCIAS</strong>
        </div>
        <div class="card-body">

            <table class="table table-striped">
            <thead>
                <tr>
                    <th>Status</th>
                    <th>Motivo</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Final</th>
                    <th>Registro</th>
                </tr>
            </thead>
            <tbody>
                @forelse($vigencias as $vigencia)
                <tr>
                    <td>{{ $vigencia->vigencia ?? 'N/A' }}</td>
                    <td>{{ $vigencia->vigencia_motivo ?? 'N/A' }}</td>
                    <td>{{ $vigencia->fecha_inicio ? \Carbon\Carbon::parse($vigencia->fecha_inicio)->format('d-m-Y') : 'N/A' }}</td>
                    <td>{{ ($vigencia->fecha_final && $vigencia->fecha_final != '0000-00-00') 
                    ? \Carbon\Carbon::parse($vigencia->fecha_final)->format('d-m-Y') 
                    : 'N/A' }}</td>
                    {{-- <td>{{ $vigencia->fecha_final ? \Carbon\Carbon::parse($vigencia->fecha_final)->format('d-m-Y') : 'N/A' }}</td> --}}
                    <td>{{ $vigencia->created_at ? \Carbon\Carbon::parse($vigencia->created_at)->format('d-m-Y') : 'N/A' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">No hay registros de vigencias</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        </div>
        <div class="card-footer">
            
            <a href="{{ route('createVigencia', $profesional->id) }}" class="btn btn-info btn-sm"><i class="fa-solid fa-pen"></i> EDITAR DATOS</a>

        </div>
    </div>

    <!-- -- -->

    <div class="card">
        <div class="card-header"><i class="fa fa-archive" aria-hidden="true"></i> <strong>PUESTO</strong></div>
        <div class="card-body">

            <div class="row">
                <div class="col-md-3">
                    <p><strong>FIEL </strong></p>
                    {{ $fiel }} {{ \Carbon\Carbon::parse($fiel_vigencia)->format('d-m-Y') }}
                </div>
                <div class="col-md-3">
                    <p><strong>Actividad</strong></p>
                    {{ $actividad }}
                </div>
                <div class="col-md-3">
                    <p><strong>Adicional</strong></p>
                    {{ $adicional }}
                </div>
                <div class="col-md-3">
                    <p><strong>Tipo de personal</strong></p>
                    {{ $tipoPersonal }}
                </div>
                
            </div>

            <hr>

            <div class="row mt-3">
                
                <div class="col-md-3">
                    <p><strong>Fecha de ingreso a la Institución</strong></p>
                    {{ \Carbon\Carbon::parse($fechaIngreso)->format('d-m-Y') }}
                    {{-- <p><strong>Código de puesto </strong></p>
                    {{ $codigoPuesto }} --}}
                </div>
                <div class="col-md-3">
                    <p><strong>Área de trabajo</strong></p>
                    {{ $areaTrabajo }}
                </div>
                <div class="col-md-3">
                    <p><strong>Ocupación</strong></p>
                    {{ $ocupacionPuesto }}
                </div>
                <div class="col-md-3">
                    <p><strong>Institución puesto</strong></p>
                    {{ $institucionPuesto }}
                    {{-- <p><strong>Nómina de pago</strong></p>
                    {{ $nominaPago }} --}}
                </div>
            </div>

            {{-- <hr>

            
            <div class="row mt-3">
                
                <div class="col-md-3">
                    <p><strong>Tipo de contrato </strong></p>
                    {{ $tipoContrato }} 
                </div>
                <div class="col-md-3">
                     <p><strong>Fecha de ingreso</strong></p>
                    {{ \Carbon\Carbon::parse($fechaIngreso)->format('d/m/Y') }} 
                </div>
                <div class="col-md-3">
                     <p><strong>Tipo plaza</strong></p>
                    {{ $tipoPlaza }} 
                </div>
                <div class="col-md-3">
                    
                </div>
            </div> --}}

            {{-- <hr>

            <div class="row mt-3">
                
                <div class="col-md-3">
                     <p><strong>Vigencia </strong></p>
                    {{ $vigencia }} - {{ $vigenciaMotivo }} 
                </div>
                <div class="col-md-3">
                    
                </div>
                <div class="col-md-3">
                     <p><strong>Temporalidad</strong></p>
                    {{ $temporalidad }} 
                </div>
                <div class="col-md-3">
                     <p><strong>Licencia de maternidad</strong></p>
                    {{ $licenciaMaternidad }} 
                </div>
            </div> --}}

            {{-- <hr>

            <div class="row mt-3">
                
                <div class="col-md-3">
                    <p><strong>Seguro de salud </strong></p>
                    {{ $seguroSalud }}
                </div>
                
            </div> --}}

            <hr>

            <div class="row mt-3">
                <div class="col-md-6">
                    <p><strong>CLUES Nómina</strong></p>
                    {{ $cluesNomina }} - {{ $cluesNominaNombre }} | {{ $cluesNominaMunicipio }} - JURISDICCIÓN {{ $cluesNominaJurisdiccion }}
                </div>
                <div class="col-md-6">
                    <p><strong>CLUES Adscripción</strong></p>
                    {{ $cluesAdscripcion }} - {{ $cluesAdscripcionNombre }} | {{ $cluesAdscripcionMunicipio }} - JURISDICCIÓN {{ $cluesAdscripcionJurisdiccion }}
                </div>
            </div>

        </div>

        
        <div class="card-footer">

            @if ($profesional->puesto?->mdl_puesto == 1)
                <a href="{{ route('editPuesto', $profesional->id) }}" class="btn btn-info btn-sm"><i class="fa-solid fa-pen"></i> EDITAR DATOS</a>
            @elseif ($profesional->puesto?->mdl_puesto == 0)
                <a href="{{ route('editPuesto', $profesional->id) }}" class="btn btn-info btn-sm"><i class="fa-solid fa-plus"></i> REGISTRAR DATOS</a>
            @endif
    
        </div>
    </div>

    {{-- ---------------------------------------------------------------------------------------------- --}}

    <div class="card">
        <div class="card-header">
            <i class="fa fa-clock" aria-hidden="true"></i> <strong>HORARIO</strong>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <p><strong>Jornada</strong></p>
                    {{ $jornada }}
                </div>
                <div class="col-md-9">
                    <table class="table table-striped">
                        <tr>
                            <th><strong>DIA</strong></th>
                            <th><strong>ENTRADA</strong></th>
                            <th><strong>SALIDA</strong></th>
                        </tr>
                        <tr>
                            <th><strong>LUNES</strong></th>
                            <td>{{ $entradaLunes }}</td>
                            <td>{{ $salidaLunes }}</td>
                        </tr>
                        <tr>
                            <th><strong>MARTES</strong></th>
                            <td>{{ $entradaMartes }}</td>
                            <td>{{ $salidaMartes }}</td>
                        </tr>
                        <tr>
                            <th><strong>MIÉRCOLES</strong></th>
                            <td>{{ $entradaMiercoles }}</td>
                            <td>{{ $salidaMiercoles }}</td>
                        </tr>
                        <tr>
                            <th><strong>JUEVES</strong></th>
                            <td>{{ $entradaJueves }}</td>
                            <td>{{ $salidaJueves }}</td>
                        </tr>
                        <tr>
                            <th><strong>VIERNES</strong></th>
                            <td>{{ $entradaViernes }}</td>
                            <td>{{ $salidaViernes }}</td>
                        </tr>
                        <tr>
                            <th><strong>SÁBADO</strong></th>
                            <td>{{ $entradaSabado }}</td>
                            <td>{{ $salidaSabado }}</td>
                        </tr>
                        <tr>
                            <th><strong>DOMINGO</strong></th>
                            <td>{{ $entradaDomingo }}</td>
                            <td>{{ $salidaDomingo }}</td>
                        </tr>
                        <tr>
                            <th><strong>FESTIVO</strong></th>
                            <td>{{ $entradaFestivo }}</td>
                            <td>{{ $salidaFestivo }}</td>
                        </tr>
                        
                    </table>
                </div>
        </div>
    </div>
        <div class="card-footer">

            @if ($profesional->horario && $profesional->horario->mdl_horario == 1)
                <a href="{{ route('editHorario', $profesional->id) }}" class="btn btn-info btn-sm"> EDITAR DATOS</a>
            @else
                <a href="{{ route('createHorario', $profesional->id) }}" class="btn btn-info btn-sm"><i class="fa fa-check" aria-hidden="true"></i> REGISTRAR DATOS</a>
            @endif

        </div>
    </div>

    <!-- --------------------------------------------------------------- -->
    {{--
    <div class="card mt-3">
        <div class="card-header">
            <i class="fa fa-credit-card" aria-hidden="true"></i> <strong>SUELDO</strong></div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-2">
                    <p><strong>SUELDO MENSUAL</strong></p>
                    $ {{ $sueldoMensual }}
                </div>
                <div class="col-md-2">
                    <p><strong>COMPENSACIONES</strong></p>
                    $ {{ $compensaciones }}
                </div>
                <div class="col-md-2">
                    <p><strong>PRESTACIONES MANDATO DE LEY</strong></p>
                    $ {{ $prestacionesMandatoLey }}
                </div>
                <div class="col-md-2">
                    <p><strong>PRESTACIONES CGT</strong></p>
                    $ {{ $prestacionesCgt }}
                </div>
                <div class="col-md-2">
                    <p><strong>ESTIMULOS</strong></p>
                    $ {{ $estimulos }}
                </div>
                <div class="col-md-2">
                    <p><strong>TOTAL</strong></p>
                    $ {{ $totalSueldo }}
                </div>
            </div>
        </div>
        <div class="card-footer">

            @if ($profesional->sueldo?->mdl_sueldo == 1)
                <a href="{{ route('editSueldo', $profesional->id) }}" class="btn btn-info btn-sm"><i class="fa-solid fa-pen"></i> EDITAR DATOS</a>
            @elseif ($profesional->sueldo?->mdl_sueldo == 0)
                <a href="{{ route('createSueldo', $profesional->id) }}" class="btn btn-info btn-sm"><i class="fa-solid fa-plus"></i> REGISTRAR DATOS</a>
            @endif
    
        </div>
    </div> --}}

    <!-- --------------------------------------------------------------- -->

    <!-- --------------------------------------------------------------- -->

    <div class="card mt-3">
        <div class="card-header">
            <i class="fa fa-graduation-cap" aria-hidden="true"></i> <strong>GRADO ACADEMICO</strong>
        </div>
        <div class="card-body">

            <div class="row">
                <div class="col-md-12">
                    <table class="table table-striped table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Grado Académico</th>
                                <th>Titulo</th>
                                <th>Institución Educativa</th>
                                <th>Cedula</th>
                                <th>R.N.P.</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>{{ $cveGradoUno }} - {{$gradoAcademicoUno}}</td>
                                <td>{{ $tituloUno }}</td>
                                <td>{{ $institucionEducativaUno }}</td>
                                <td>{{ $cedulaUno }} - {{ $numeroCedulaUno }}</td>
                                <td>@if ($regNacProfUno)
                                        <a href="{{ route('regNacProfUno', $gradoAcademicoUnoId) }}" target="_blank" class="btn btn-info btn-sm"><i class="fa-solid fa-file-lines"></i> VER DOCUMENTO</a>
                                    @else
                                        
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>{{ $cveGradoDos }} - {{$gradoAcademicoDos}}</td>
                                <td>{{ $tituloDos }}</td>
                                <td>{{ $institucionEducativaDos }}</td>
                                <td>{{ $cedulaDos }} - {{ $numeroCedulaDos }}</td>
                                <td>@if ($regNacProfDos)
                                        <a href="{{ route('regNacProfDos', $gradoAcademicoDosId) }}" target="_blank" class="btn btn-info btn-sm"><i class="fa-solid fa-file-lines"></i> VER DOCUMENTO</a>
                                    @else
                                        
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>{{ $cveGradoTres }} - {{$gradoAcademicoTres}}</td>
                                <td>{{ $tituloTres }}</td>
                                <td>{{ $institucionEducativaTres }}</td>
                                <td>{{ $cedulaTres }} - {{ $numeroCedulaTres }}</td>
                                <td>@if ($regNacProfTres)
                                        <a href="{{ route('regNacProfTres', $gradoAcademicoTresId) }}" target="_blank" class="btn btn-info btn-sm"><i class="fa-solid fa-file-lines"></i> VER DOCUMENTO</a>
                                    @else
                                        
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>{{ $cveGradoCuatro }} - {{$gradoAcademicoCuatro}}</td>
                                <td>{{ $tituloCuatro }}</td>
                                <td>{{ $institucionEducativaCuatro }}</td>
                                <td>{{ $cedulaCuatro }} - {{ $numeroCedulaCuatro }}</td>
                                <td>@if ($regNacProfCuatro)
                                        <a href="{{ route('regNacProfCuatro', $gradoAcademicoCuatroId) }}" target="_blank" class="btn btn-info btn-sm"><i class="fa-solid fa-file-lines"></i> VER DOCUMENTO</a>
                                    @else
                                        
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
        <div class="card-footer">
            @if ($profesional->gradoAcademico?->mdl_grado_academico == 1)
                <a href="{{ route('editGrado', $profesional->id) }}" class="btn btn-info btn-sm"><i class="fa-solid fa-pen"></i> EDITAR DATOS</a>
            @elseif ($profesional->gradoAcademico?->mdl_grado_academico == 0)
                <a href="{{ route('createGrado', $profesional->id) }}" class="btn btn-info btn-sm"><i class="fa-solid fa-plus"></i> REGISTRAR DATOS</a>
            @endif
        </div>
    </div>

    <!-- --------------------------------------------------------------- -->

    <div class="card mt-3">
        <div class="card-header">
            <i class="fa fa-stethoscope" aria-hidden="true"></i><strong>PERSONAL ESTUDIANDO ACTUALMENTE</strong>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <p><strong>TIPO DE FORMACION</strong></p>
                    {{ $tipoFormacion }}
                </div>
                <div class="col-md-3">
                    <p><strong>CARRERA</strong></p>
                    {{ $carrera }}
                </div>
                <div class="col-md-3">
                    <p><strong>INSTITUCIÓN EDUCATIVA</strong></p>
                    {{ $carrera }}
                </div>
                <div class="col-md-3">
                    <p><strong>AÑO EN CURSO / DURACIÓN</strong></p>
                    {{ $anioCursa }} - {{ $duracionFormacion }}
                </div>
            </div>
        </div>
        <div class="card-footer">
            @if ($profesional->areaMedica?->mdl_area_medica == 1)
                <a href="{{ route('editAreaMedica', $profesional->id) }}" class="btn btn-info btn-sm"><i class="fa-solid fa-pen"></i> EDITAR DATOS</a>
            @elseif ($profesional->areaMedica?->mdl_area_medica == 0)
                <a href="{{ route('createAreaMedica', $profesional->id) }}" class="btn btn-info btn-sm"><i class="fa-solid fa-plus"></i> REGISTRAR DATOS</a>
            @endif
        </div>
    </div>
    
    
    <!-- --------------------------------------------------------------- -->

    <div class="card mt-3">
        <div class="card-header"><strong>CERTIFICACIONES</strong></div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <p><strong>COLEGIACIÓN</strong></p>
                    {{ $colegiacion }}
                </div>
                <div class="col-md-4">
                    <p><strong>CERTIFICACION</strong></p>
                    {{ $certificacio }}
                </div>
                <div class="col-md-2">
                    <p><strong>IDIOMA</strong></p>
                    {{ $idioma }} - {{ $idiomaNivelDominio }}
                </div>
                <div class="col-md-2">
                    <p><strong>LENGUA INDIGENA</strong></p>
                    {{ $lenguaIndigena }} - {{ $lenguaIndigenaDominio }}
                </div>
            </div>
        </div>
        <div class="card-footer">
            @if ($profesional->certificacion?->mdl_certificacion == 1)
                <a href="{{ route('editCertificacion', $profesional->id) }}" class="btn btn-info btn-sm"><i class="fa-solid fa-pen"></i> EDITAR DATOS</a>
            @elseif ($profesional->certificacion?->mdl_certificacion == 0)
                <a href="{{ route('createCertificacion', $profesional->id) }}" class="btn btn-info btn-sm"><i class="fa-solid fa-plus"></i> REGISTRAR DATOS</a>
            @endif
        </div>
    </div>
    
    <!-- --------------------------------------------------------------- -->

    
    
    <!-- -- -->

    <div class="card">
        <div class="card-header">
            <strong>MOVIMIENTOS</strong>
        </div>
        <div class="card-body">

            @if ($cambiosDeUnidad->isEmpty())
                <p>No hay cambios registrados.</p>
            @else
                <table class="table">
                    <thead>
                        <tr>
                            <th>FECHA</th>
                            <th>TIPO</th>
                            <th>ORIGEN</th>
                            <th>DESTINO</th>
                            <th>INICIO</th>
                            <th>TERMINO</th>
                            <th>DOC.</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cambiosDeUnidad as $cambio)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($cambio->created_at)->format('d/m/Y') }}</td>
                                <td>{{ $cambio->tipo_movimiento }}</td>
                                <td>J. {{ $cambio->unidad_origen_jurisdiccion }} - {{ $cambio->unidad_origen_clues }} - {{ $cambio->unidad_origen_nombre }}</td>
                                <td>J. {{ $cambio->unidad_destino_jurisdiccion }} - {{ $cambio->unidad_destino_clues }} - {{ $cambio->unidad_destino_nombre }}</td>
                                <td>{{ \Carbon\Carbon::parse($cambio->fecha_inicio)->format('d/m/Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($cambio->fecha_final)->format('d/m/Y') }}</td>
                                <td>
                                    @if ($cambio->documento_respaldo)
                                    <a href="{{ route('descargar.documento', $cambio->id) }}" target="_blank" class="btn btn-info btn-sm"><i class="fa-solid fa-file-lines"></i> VER DOCUMENTO</a>
                                    @else
                                        No disponible
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif

            

        </div>
        <div class="card-footer"></div>
    </div>

    <!-- -- -->

    <!-- --------------------------------------------------------------- -->
    
    <div class="card mt-3">
        <div class="card-header">
            <i class="fa fa-credit-card" aria-hidden="true"></i> <strong>EMERGENCIAS</strong></div>
        <div class="card-body">

            <!-- -->

                <div class="row">
                    <div class="col-md-12">
                        <blockquote class="quote-secondary">
                            <h4>Datos Personales</h4>
                        </blockquote>
                    </div>
                </div>

                <!-- -->
            <div class="row mt-3">
                <div class="col-md-2">
                    <p><strong>TIPO DE SANDRE</strong></p>
                    {{ $emergencias->tipo_sangre ?? ''  }}
                </div>
                <div class="col-md-2">
                    <p><strong>ALERGIAS</strong></p>
                    {{ $emergencias->alergia_descripcion ?? ''  }}
                </div>
                <div class="col-md-2">
                    <p><strong>ENFERMEDAD</strong></p>
                    {{ $emergencias->enfermedad ?? ''  }}
                </div>
                <div class="col-md-2">
                    <p><strong>TRATAMIENTO</strong></p>
                    {{ $emergencias->tratamiento ?? ''  }}
                </div>
                <div class="col-md-2">
                    <p><strong>MEDICAMENTOS</strong></p>
                    {{ $emergencias->medicamentos ?? ''  }}
                </div>
            </div>

            <!-- -------------------------------------------------------- -->

            <!-- -->

                <div class="row">
                    <div class="col-md-12">
                        <blockquote class="quote-secondary">
                            <h4>Medico de Cabecera</h4>
                        </blockquote>
                    </div>
                </div>

                <!-- -->

            <div class="row">
                <div class="col-md-2">
                    <p><strong>NOMBRE</strong></p>
                    {{ $emergencias->medico_nombre ?? ''  }}
                </div>
                <div class="col-md-2">
                    <p><strong>TELEFONO</strong></p>
                    {{ $emergencias->medico_telefono ?? ''  }}
                </div>
            </div>

            <!-- -------------------------------------------------------- -->

            <!-- -->

                <div class="row">
                    <div class="col-md-12">
                        <blockquote class="quote-secondary">
                            <h4>Contacto de Emergencia 1</h4>
                        </blockquote>
                    </div>
                </div>

                <!-- -->
            
            <!-- -------------------------------------------------------- -->

            <div class="row">
                <div class="col-md-2">
                    <p><strong>NOMBRE</strong></p>
                    {{ $emergencias->emergencia_nombre_uno ?? ''  }}
                </div>
                <div class="col-md-2">
                    <p><strong>RELACIÓN</strong></p>
                    {{ $emergencias->emergencia_relacion_uno ?? ''  }}
                </div>
                <div class="col-md-2">
                    <p><strong>TELEFONO</strong></p>
                    {{ $emergencias->emergencia_telefono_uno_uno ?? ''  }} {{ $emergencias->emergencia_telefono_uno_dos ?? ''  }}
                </div>
                <div class="col-md-2">
                    <p><strong>E-MAIL</strong></p>
                    {{ $emergencias->emergencia_email_uno ?? ''  }}
                </div>
            </div>

            <!-- -------------------------------------------------------- -->

            <!-- -------------------------------------------------------- -->

            <div class="row mt-3">
                <div class="col-md-2">
                    <p><strong>DIRECCIÓN</strong></p>
                    {{ $emergencias->emergencia_calle_uno ?? ''  }}
                </div>
                <div class="col-md-2">
                    <p><strong>#</strong></p>
                    {{ $emergencias->emergencia_numero_uno ?? ''  }}
                </div>
                <div class="col-md-2">
                    <p><strong>COLONIA</strong></p>
                    {{ $emergencias->emergencia_colonia_uno ?? ''  }} - CP {{ $emergencias->emergencia_codigo_postal_uno ?? ''  }}
                </div>
                <div class="col-md-2">
                    <p><strong>MUNICIPIO</strong></p>
                    {{ $emergencias->emergencia_municipio_label_uno ?? ''  }}
                </div>
            </div>

            <!-- -------------------------------------------------------- -->

            <!-- -->

                <div class="row">
                    <div class="col-md-12">
                        <blockquote class="quote-secondary">
                            <h4>Contacto de Emergencia 2</h4>
                        </blockquote>
                    </div>
                </div>

                <!-- -->

            <!-- -------------------------------------------------------- -->

            <div class="row">
                <div class="col-md-2">
                    <p><strong>NOMBRE</strong></p>
                    {{ $emergencias->emergencia_nombre_dos ?? ''  }}
                </div>
                <div class="col-md-2">
                    <p><strong>RELACIÓN</strong></p>
                    {{ $emergencias->emergencia_relacion_dos ?? ''  }}
                </div>
                <div class="col-md-2">
                    <p><strong>TELEFONO</strong></p>
                    {{ $emergencias->emergencia_telefono_dos_uno ?? ''  }} {{ $emergencias->emergencia_telefono_dos_dos ?? ''  }}
                </div>
                <div class="col-md-2">
                    <p><strong>E-MAIL</strong></p>
                    {{ $emergencias->emergencia_email_dos ?? ''  }}
                </div>
            </div>

            <!-- -------------------------------------------------------- -->

            <!-- -------------------------------------------------------- -->

            <div class="row mt-3">
                <div class="col-md-2">
                    <p><strong>DIRECCIÓN</strong></p>
                    {{ $emergencias->emergencia_calle_dos ?? ''  }}
                </div>
                <div class="col-md-2">
                    <p><strong>#</strong></p>
                    {{ $emergencias->emergencia_numero_dos ?? ''  }}
                </div>
                <div class="col-md-2">
                    <p><strong>COLONIA</strong></p>
                    {{ $emergencias->emergencia_colonia_dos ?? ''  }} - CP {{ $emergencias->emergencia_codigo_postal_dos ?? ''  }}
                </div>
                <div class="col-md-2">
                    <p><strong>MUNICIPIO</strong></p>
                    {{ $emergencias->emergencia_municipio_label_dos ?? ''  }}
                </div>
            </div>

            <!-- -------------------------------------------------------- -->

            <!-- -->

                <div class="row">
                    <div class="col-md-12">
                        <blockquote class="quote-secondary">
                            <h4>Contacto de Emergencia 3</h4>
                        </blockquote>
                    </div>
                </div>

                <!-- -->

            <!-- -------------------------------------------------------- -->

            <div class="row">
                <div class="col-md-2">
                    <p><strong>NOMBRE</strong></p>
                    {{ $emergencias->emergencia_nombre_tres ?? '' }}
                </div>
                <div class="col-md-2">
                    <p><strong>RELACIÓN</strong></p>
                    {{ $emergencias->emergencia_relacion_tres ?? ''  }}
                </div>
                <div class="col-md-2">
                    <p><strong>TELEFONO</strong></p>
                    {{ $emergencias->emergencia_telefono_tres_uno ?? ''  }} {{ $emergencias->emergencia_telefono_tres_dos ?? ''  }}
                </div>
                <div class="col-md-2">
                    <p><strong>E-MAIL</strong></p>
                    {{ $emergencias->emergencia_email_tres ?? ''  }}
                </div>
            </div>

            <!-- -------------------------------------------------------- -->

            <!-- -------------------------------------------------------- -->

            <div class="row mt-3">
                <div class="col-md-2">
                    <p><strong>DIRECCIÓN</strong></p>
                    {{ $emergencias->emergencia_calle_tres ?? ''  }}
                </div>
                <div class="col-md-2">
                    <p><strong>#</strong></p>
                    {{ $emergencias->emergencia_numero_tres ?? ''  }}
                </div>
                <div class="col-md-2">
                    <p><strong>COLONIA</strong></p>
                    {{ $emergencias->emergencia_colonia_tres ?? ''  }} - CP {{ $emergencias->emergencia_codigo_postal_tres ?? ''  }}
                </div>
                <div class="col-md-2">
                    <p><strong>MUNICIPIO</strong></p>
                    {{ $emergencias->emergencia_municipio_label_tres ?? ''  }}
                </div>
            </div>

            <!-- -------------------------------------------------------- -->

        </div>
        <div class="card-footer">

            @if ($profesional->emergencia?->mdl_emergencia == 1)
                <a href="{{ route('editEmergencia', $profesional->id) }}" class="btn btn-info btn-sm"><i class="fa-solid fa-pen"></i> EDITAR DATOS</a>
            @elseif ($profesional->emergencia?->mdl_emergencia == 0)
                <a href="{{ route('createEmergencia', $profesional->id) }}" class="btn btn-info btn-sm"><i class="fa-solid fa-plus"></i> REGISTRAR DATOS</a>
            @endif
    
        </div>
    </div>

    <!-- --------------------------------------------------------------- -->

    <!-- --------------------------------------------------------------- -->
    {{--
    <div class="card mt-3">
        <div class="card-header"><strong>PASES DE SALIDA</strong></div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Folio</th>
                                <th>Autoriza</th>
                                <th>Tipo</th>
                                <th>Fecha</th>
                                <th>Tiempo autorizado</th>
                                <th>Hora inicio</th>
                                <th>Hora final</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pases as $pase)
                                <tr>
                                    <td>{{ $pase->folio }}</td>
                                    <td>{{ $pase->nombre_autoriza }}</td>
                                    <td>{{ $pase->tipo }}</td>
                                    <td>{{ $pase->fecha->format('d-m-Y') }}</td>
                                    <td>{{ $pase->tiempo_autorizado }}</td>
                                    <td>{{ $pase->hora_inicio->format('H:i') }}</td>
                                    <td>{{ $pase->hora_final->format('H:i') }}</td>
                                    <td>{{ $pase->status == 0 ? 'PENDIENTE' : 'AUTORIZADO' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">No hay pases de salida registrados.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                   
                </div>
            </div>
        </div>
        <div class="card-footer"></div>
    </div>
    --}}
    <!-- --------------------------------------------------------------- -->

    <br>

    <!-- Modal -->
<div class="modal fade" id="pdfModal" tabindex="-1" role="dialog" aria-labelledby="pdfModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="pdfModalLabel">Documento PDF</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!-- Aquí se insertará el iframe con el documento PDF -->
          <iframe id="pdfViewer" width="100%" height="700px" frameborder="0"></iframe>
        </div>
      </div>
    </div>
  </div>

@stop

@include('partials.footer')

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>

    <script>
        $(document).ready(function() {
    // Cuando cualquiera de los enlaces con clase 'openModal' sea clickeado
    $('.openModal').click(function() {
        // Obtener la ruta del archivo PDF desde el atributo 'data-pdf'
        var pdfUrl = $(this).data('pdf');
        
        // Establecer la URL del PDF en el iframe
        $('#pdfViewer').attr('src', pdfUrl);
        
        // Mostrar el modal
        $('#pdfModal').modal('show');
    });

    // Limpiar el iframe cuando se cierre el modal
    $('#pdfModal').on('hidden.bs.modal', function () {
        $('#pdfViewer').attr('src', '');  // Limpiar el iframe
    });
});

    </script>

    <!-- jQuery -->
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
    <!-- Bootstrap JS (si no lo tienes) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

    
@stop