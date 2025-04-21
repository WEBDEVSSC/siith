@extends('adminlte::page')

@section('title', 'Dashboard')

@section('plugins.Sweetalert2', true)

@section('plugins.Datatables', true)

@section('content_header')
    <h1><strong>Profesionales</strong> <small>Panel de Control</small></h1>
@stop

@section('content')

<!-- -->

@php
    $alerts = [
        'success',
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
        'updateAlmacen'
    ];
@endphp

@foreach ($alerts as $alert)
    @if(session($alert))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Éxito',
                    text: "{{ session($alert) }}",
                    icon: 'success',
                    confirmButtonText: 'Ok'
                });
            });
        </script>
    @endif
@endforeach

<!-- -->
    
<div class="card">
        <div class="card-header">

            <a href="{{ route('profesionalExport') }}" class="btn btn-success"><i class="fa-solid fa-chart-simple"></i> Exportar Profesionales a Excel</a>

        </div>
        <div class="card-body">

        @if($profesionalesData->isEmpty())
            <div class="alert alert-warning" role="alert">
                No hay registros disponibles.
            </div>
        @else
        <table id="profesionalesTable" class="table table-bordered">
            <thead>
                <tr>
                    <th></th>
                    <th>CURP</th>
                    <th>RFC</th>
                    <th>NOMBRE COMPLETO</th>
                    <th>CLUES ADSCRIPCIÓN</th>
                    <th>CATALOGO</th>
                    <th>MODULOS</th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach ($profesionalesData as $data)
                    <tr>
                        <td>
                            <a href="{{ route('profesionalShow', $data['profesional']->id) }}" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="DETALLES">
                                <i class="fa-solid fa-address-card"></i>
                            </a>
                            <a target='_blank' href="{{ route('profesionalPDF', $data['profesional']->id) }}" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="PDF">
                                <i class="fa-solid fa-file-lines"></i>
                            </a>
                        </td>
                        <td>{{ $data['profesional']->curp }}</td>
                        <td>{{ $data['profesional']->rfc }}{{ $data['profesional']->homoclave }}</td>
                        <td>{{ $data['profesional']->nombre }} {{ $data['profesional']->apellido_paterno }} {{ $data['profesional']->apellido_materno }}</td>
                        <td>{{ $data['cluesAdscripcionNombre'] ?? 'N/A' }}</td>
                        <td>{{ $data['profesional']->puesto?->clues_adscripcion_tipo }}</td>
                        <td>

                            <!-- SI EL ROL ES DIFERENTE A DIRECTIVO SE MUESTRAN LOS BOTONES DE EDICION DE LOS MODULOS  -->
                                <!-- PARA EL DIRECTIVO SOLO SE MUESTRA EL BOTON DE VER DETALLES  -->
                                @if(Auth::user()->role != 'directivo')

                                <!-- ------------------------- -->
                                <!-- ------------------------- -->
                                <!-- MODULO DE DATOS GENERALES -->
                                <!-- ------------------------- -->
                                <!-- ------------------------- -->

                                @if($data['profesional']->mdl_datos_generales == 1)
                                    <a href="{{ route('profesionalEdit', $data['profesional']->id) }}" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="DATOS GENERALES">
                                        <i class="fa fa-user" aria-hidden="true"></i>
                                    </a>
                                @else
                                    <a href="#!" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="DATOS GENERALES">
                                        <i class="fa fa-user" aria-hidden="true"></i>
                                    </a>
                                @endif
                                <!-- ------------------------- -->
                                <!-- ------------------------- -->
                                <!--      MODULO DE PUESTOS    -->
                                <!-- ------------------------- -->
                                <!-- ------------------------- -->

                                @if(optional($data['profesional']->puesto)->mdl_puesto == 1)
                                    <a href="{{ route('editPuesto', $data['profesional']->id) }}" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="PUESTO">
                                        <i class="fa fa-archive" aria-hidden="true"></i>
                                    </a>
                                @else
                                    <a href="{{ route('createPuesto', $data['profesional']->id) }}" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="PUESTO">
                                        <i class="fa fa-archive" aria-hidden="true"></i>
                                    </a>
                                @endif

                                <!-- --------------------------- -->
                                <!-- --------------------------- -->
                                <!-- MODULO DE CREDENCIALIZACION -->
                                <!-- --------------------------- -->
                                <!-- --------------------------- -->

                                @if(optional($data['profesional']->credencializacion)->mdl_credencializacion == 1)
                                    <a href="{{ route('editCredencializacion', $data['profesional']->id) }}" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="CREDENCIALIZACIÓN">
                                        <i class="fa fa-camera" aria-hidden="true"></i>
                                    </a>
                                @else
                                    <a href="{{ route('createCredencializacion', $data['profesional']->id) }}" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="CREDENCIALIZACIÓN">
                                        <i class="fa fa-camera" aria-hidden="true"></i>
                                    </a>
                                @endif

                                <!-- --------------------------- -->
                                <!-- --------------------------- -->
                                <!--      MODULO DE HORARIO      -->
                                <!-- --------------------------- -->
                                <!-- --------------------------- -->

                                @if(optional($data['profesional']->horario)->mdl_horario == 1)
                                    <a href="{{ route('editHorario', $data['profesional']->id) }}" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="HORARIO">
                                        <i class="fa fa-clock" aria-hidden="true"></i>
                                    </a>
                                @else
                                    <a href="{{ route('createHorario', $data['profesional']->id) }}" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="HORARIO">
                                        <i class="fa fa-clock" aria-hidden="true"></i>
                                    </a>
                                @endif

                                <!-- --------------------------- -->
                                <!-- --------------------------- -->
                                <!--      MODULO DE SUELDO       -->
                                <!-- --------------------------- -->
                                <!-- --------------------------- -->

                                @if(optional($data['profesional']->sueldo)->mdl_sueldo == 1)
                                <a href="{{ route('editSueldo', $data['profesional']->id) }}" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="SUELDO">
                                    <i class="fa fa-credit-card" aria-hidden="true"></i>
                                </a>
                                @else
                                    <a href="{{ route('createSueldo', $data['profesional']->id) }}" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="SUELDO">
                                        <i class="fa fa-credit-card" aria-hidden="true"></i>
                                    </a>
                                @endif

                                <!-- --------------------------- -->
                                <!-- --------------------------- -->
                                <!--  MODULO DE GRADO ACADEMICO  -->
                                <!-- --------------------------- -->
                                <!-- --------------------------- -->

                                @if(optional($data['profesional']->gradoAcademico)->mdl_grado_academico == 1)
                                <a href="{{ route('editGrado', $data['profesional']->id) }}" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="GRADO ACADEMICO">
                                    <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                                </a>
                                @else
                                    <a href="{{ route('createGrado', $data['profesional']->id) }}" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="GRADO ACADEMICO">
                                        <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                                    </a>
                                @endif

                                <!-- --------------------------- -->
                                <!-- --------------------------- -->
                                <!--    MODULO DE AREA MEDICA    -->
                                <!-- --------------------------- -->
                                <!-- --------------------------- -->

                                @if(optional($data['profesional']->areaMedica)->mdl_area_medica == 1)
                                    <a href="{{ route('editAreaMedica', $data['profesional']->id) }}" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="AREA MEDICA">
                                        <i class="fa fa-stethoscope" aria-hidden="true"></i>
                                    </a>
                                @else
                                    <a href="{{ route('createAreaMedica', $data['profesional']->id) }}" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="AREA MEDICA">
                                        <i class="fa fa-stethoscope" aria-hidden="true"></i>
                                    </a>
                                @endif

                                <!-- --------------------------- -->
                                <!-- --------------------------- -->
                                <!--  MODULO DE CERTIFICACIONES  -->
                                <!-- --------------------------- -->
                                <!-- --------------------------- -->

                                @if(optional($data['profesional']->certificacion)->mdl_certificacion == 1)
                                    <a href="{{ route('editCertificacion', $data['profesional']->id) }}" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="CERTIFICACIONES">
                                        <i class="fa fa-certificate" aria-hidden="true"></i>
                                    </a>
                                @else
                                    <a href="{{ route('createCertificacion', $data['profesional']->id) }}" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="CERTIFICACIONES">
                                        <i class="fa fa-certificate" aria-hidden="true"></i>
                                    </a>
                                @endif

                                <div class="mt-2"></div>

                                <!-- --------------------------------------- -->
                                <!-- --------------------------------------- -->
                                <!--    MODULO DE CATALOGO DE OCUPACIONES    -->
                                <!-- --------------------------------------- -->
                                <!-- --------------------------------------- -->

                                <!-- CATALOGO PARA CENTROS DE SALUD URBANOS Y RURALES (1) -->

                                @if ( $data['profesional']->puesto?->clues_adscripcion_tipo == 1)

                                    @if(optional($data['profesional']->ocupacionCentroSalud)->mdl_status == 1)
                                        <a href="{{ route('editCentrosDeSalud', $data['profesional']->id) }}" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="OCUPACIÓN CENTROS DE SALUD U y R">
                                            <i class="fa-solid fa-hand-holding-medical"></i>
                                        </a>
                                    @else
                                        <a href="{{ route('createCentrosDeSalud', $data['profesional']->id) }}" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="OCUPACIÓN CENTROS DE SALUD U y R">
                                            <i class="fa-solid fa-hand-holding-medical"></i>
                                        </a>
                                    @endif
                                                                                                   
                                @endif

                                <!-- CATALOGO PARA HOSPITALES (2) -->

                                @if ( $data['profesional']->puesto?->clues_adscripcion_tipo == 2)

                                    @if(optional($data['profesional']->ocupacionHospital)->mdl_status == 1)
                                        <a href="{{ route('editHospital', $data['profesional']->id) }}" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="OCUPACIÓN HOSPITALES">
                                            <i class="fa-solid fa-hospital"></i>
                                        </a>
                                    @else
                                        <a href="{{ route('createHospital', $data['profesional']->id) }}" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="OCUPACIÓN HOSPITALES">
                                            <i class="fa-solid fa-hospital"></i>
                                        </a>
                                    @endif
                                                                                                   
                                @endif

                                <!-- CATALOGO PARA OFICINAS JURISDICCIONALES (3) -->

                                @if ( $data['profesional']->puesto?->clues_adscripcion_tipo == 3)

                                    @if(optional($data['profesional']->ocupacionOfJurisidccion)->mdl_status == 1)
                                        <a href="{{ route('editOfJurisdiccional', $data['profesional']->id) }}" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="OF. JURISDICCIONAL">
                                            <i class="fa-solid fa-building-user"></i>
                                        </a>
                                    @else
                                        <a href="{{ route('createOfJurisdiccional', $data['profesional']->id) }}" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="OF. JURISDICCIONAL">
                                            <i class="fa-solid fa-building-user"></i>
                                        </a>
                                    @endif
                                                                                                   
                                @endif

                                <!-- CATALOGO PARA CRI CREE (4) -->

                                @if ( $data['profesional']->puesto?->clues_adscripcion_tipo == 4)

                                    @if(optional($data['profesional']->ocupacionCriCree)->mdl_status == 1)
                                        <a href="{{ route('editCriCree', $data['profesional']->id) }}" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="CRI CREE">
                                            <i class="fa-solid fa-wheelchair"></i>
                                        </a>
                                    @else
                                        <a href="{{ route('createCriCree', $data['profesional']->id) }}" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="CRI CREE">
                                            <i class="fa-solid fa-wheelchair"></i>
                                        </a>
                                    @endif
                                                                                                   
                                @endif

                                <!-- CATALOGO PARA SAMU CRUM (5) -->

                                @if ( $data['profesional']->puesto?->clues_adscripcion_tipo == 5)

                                    @if(optional($data['profesional']->ocupacionSamuCrum)->mdl_status == 1)
                                        <a href="{{ route('editSamuCrum', $data['profesional']->id) }}" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="SAMU CRUM">
                                            <i class="fa-solid fa-truck-medical"></i>
                                        </a>
                                    @else
                                        <a href="{{ route('createSamuCrum', $data['profesional']->id) }}" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="SAMU CRUM">
                                            <i class="fa-solid fa-truck-medical"></i>
                                        </a>
                                    @endif
                                                                                                   
                                @endif

                                <!-- CATALOGO PARA OFICINA CENTRAL (6) -->

                                @if ( $data['profesional']->puesto?->clues_adscripcion_tipo == 6)

                                    @if(optional($data['profesional']->ocupacionOficinaCentral)->mdl_status == 1)
                                        <a href="{{ route('editOficinaCentral', $data['profesional']->id) }}" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="OFICINA CENTRAL">
                                            <i class="fa-solid fa-building-flag"></i>
                                        </a>
                                    @else
                                        <a href="{{ route('createOficinaCentral', $data['profesional']->id) }}" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="OFICINA CENTRAL">
                                            <i class="fa-solid fa-building-flag"></i>
                                        </a>
                                    @endif
                                                                                                   
                                @endif

                                <!-- CATALOGO PARA ALMACEN (7) -->

                                @if ( $data['profesional']->puesto?->clues_adscripcion_tipo == 7)

                                    @if(optional($data['profesional']->ocupacionAlmacen)->mdl_status == 1)
                                        <a href="{{ route('editAlmacen', $data['profesional']->id) }}" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="ALMACEN ESTATAL">
                                            <i class="fa-solid fa-shop-lock"></i>
                                        </a>
                                    @else
                                        <a href="{{ route('createAlmacen', $data['profesional']->id) }}" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="ALMACEN ESTATAL">
                                            <i class="fa-solid fa-shop-lock"></i>
                                        </a>
                                    @endif
                                                                                                   
                                @endif
                                
                                
                            @endif
                            
                        </td>
                    
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

        </div>
        <div class="card-footer">

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
            // Inicializar todos los tooltips de la página
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>

    <script>$(document).ready( function () {
        $(document).ready(function() {
        $('#profesionalesTable').DataTable({
            "language": {
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "Ningún dato disponible en esta tabla",
                "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix":    "",
                "sSearch":         "Buscar:",
                "sUrl":            "",
                "sInfoThousands":  ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Último",
                    "sNext":     "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending":  ": activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": activar para ordenar la columna de manera descendente"
                }
            }
        });
    });
    } );
    </script>
@stop