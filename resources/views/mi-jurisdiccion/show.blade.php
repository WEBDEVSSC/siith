@extends('adminlte::page')

@section('title', 'Dashboard')

@section('plugins.Datatables', true)

@section('content_header')
    <h1><strong>Profesionales</strong> <small>Mi Jurisdiccion</small></h1>
@stop

@section('content')
    
<div class="card">
        <div class="card-header">

            <p><strong>UNIDAD : </strong>{{ $clues->clues }} - {{ $clues->nombre }}</p>

        </div>
        <div class="card-body">

            <table id="profesionalesTable" class="table table-bordered">
                <thead>
                    <tr>
                        <th></th>
                        <th>CURP</th>
                        <th>RFC</th>
                        <th>NOMBRE COMPLETO</th>
                        <th>MODULOS</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($profesionales as $profesional)
                        <tr>
                            <td>
                                <a href="{{ route('profesionalShow', $profesional->id) }}" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="DETALLES">
                                    <i class="fa-solid fa-address-card"></i>
                                </a>
                                <a target='_blank' href="{{ route('profesionalPDF', $profesional->id) }}" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="PDF">
                                    <i class="fa-solid fa-file-lines"></i>
                                </a>
                            </td>
                            <td>{{ $profesional->curp }}</td>
                            <td>{{ $profesional->rfc}} {{ $profesional->homoclave }}</td>
                            <td>{{ $profesional->nombre}} {{ $profesional->apellido_paterno }} {{ $profesional->apellido_materno }}</td>
                            <td>

                                <!-- ------------------------- -->
                                <!-- ------------------------- -->
                                <!-- MODULO DE DATOS GENERALES -->
                                <!-- ------------------------- -->
                                <!-- ------------------------- -->

                                @if($profesional->mdl_datos_generales == 1)
                                    <a href="{{ route('profesionalEdit', $profesional->id) }}" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="DATOS GENERALES">
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

                                @if(optional($profesional->puesto)->mdl_puesto == 1)
                                    <a href="{{ route('editPuesto', $profesional->id) }}" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="PUESTO">
                                        <i class="fa fa-archive" aria-hidden="true"></i>
                                    </a>
                                @else
                                    <a href="{{ route('createPuesto', $profesional->id) }}" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="PUESTO">
                                        <i class="fa fa-archive" aria-hidden="true"></i>
                                    </a>
                                @endif

                                <!-- --------------------------- -->
                                <!-- --------------------------- -->
                                <!-- MODULO DE CREDENCIALIZACION -->
                                <!-- --------------------------- -->
                                <!-- --------------------------- -->

                                @if(optional($profesional->credencializacion)->mdl_credencializacion == 1)
                                    <a href="{{ route('editCredencializacion', $profesional->id) }}" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="CREDENCIALIZACIÓN">
                                        <i class="fa fa-camera" aria-hidden="true"></i>
                                    </a>
                                @else
                                    <a href="{{ route('createCredencializacion', $profesional->id) }}" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="CREDENCIALIZACIÓN">
                                        <i class="fa fa-camera" aria-hidden="true"></i>
                                    </a>
                                @endif

                                <!-- --------------------------- -->
                                <!-- --------------------------- -->
                                <!--      MODULO DE HORARIO      -->
                                <!-- --------------------------- -->
                                <!-- --------------------------- -->

                                @if(optional($profesional->horario)->mdl_horario == 1)
                                    <a href="{{ route('editHorario', $profesional->id) }}" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="HORARIO">
                                        <i class="fa fa-clock" aria-hidden="true"></i>
                                    </a>
                                @else
                                    <a href="{{ route('createHorario', $profesional->id) }}" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="HORARIO">
                                        <i class="fa fa-clock" aria-hidden="true"></i>
                                    </a>
                                @endif

                                <!-- --------------------------- -->
                                <!-- --------------------------- -->
                                <!--      MODULO DE SUELDO       -->
                                <!-- --------------------------- -->
                                <!-- --------------------------- -->

                                @if(optional($profesional->sueldo)->mdl_sueldo == 1)
                                <a href="{{ route('editSueldo', $profesional->id) }}" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="SUELDO">
                                    <i class="fa fa-credit-card" aria-hidden="true"></i>
                                </a>
                                @else
                                    <a href="{{ route('createSueldo', $profesional->id) }}" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="SUELDO">
                                        <i class="fa fa-credit-card" aria-hidden="true"></i>
                                    </a>
                                @endif

                                <!-- --------------------------- -->
                                <!-- --------------------------- -->
                                <!--  MODULO DE GRADO ACADEMICO  -->
                                <!-- --------------------------- -->
                                <!-- --------------------------- -->

                                @if(optional($profesional->gradoAcademico)->mdl_grado_academico == 1)
                                <a href="{{ route('editGrado', $profesional->id) }}" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="GRADO ACADEMICO">
                                    <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                                </a>
                                @else
                                    <a href="{{ route('createGrado', $profesional->id) }}" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="GRADO ACADEMICO">
                                        <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                                    </a>
                                @endif

                                <!-- --------------------------- -->
                                <!-- --------------------------- -->
                                <!--    MODULO DE AREA MEDICA    -->
                                <!-- --------------------------- -->
                                <!-- --------------------------- -->

                                @if(optional($profesional->areaMedica)->mdl_area_medica == 1)
                                    <a href="{{ route('editAreaMedica', $profesional->id) }}" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="AREA MEDICA">
                                        <i class="fa fa-stethoscope" aria-hidden="true"></i>
                                    </a>
                                @else
                                    <a href="{{ route('createAreaMedica', $profesional->id) }}" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="AREA MEDICA">
                                        <i class="fa fa-stethoscope" aria-hidden="true"></i>
                                    </a>
                                @endif

                                <!-- --------------------------- -->
                                <!-- --------------------------- -->
                                <!--  MODULO DE CERTIFICACIONES  -->
                                <!-- --------------------------- -->
                                <!-- --------------------------- -->

                                @if(optional($profesional->certificacion)->mdl_certificacion == 1)
                                    <a href="{{ route('editCertificacion', $profesional->id) }}" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="CERTIFICACIONES">
                                        <i class="fa fa-certificate" aria-hidden="true"></i>
                                    </a>
                                @else
                                    <a href="{{ route('createCertificacion', $profesional->id) }}" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="CERTIFICACIONES">
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

                                @if ( $profesional->puesto?->clues_adscripcion_tipo == 1)

                                    @if(optional($profesional->ocupacionCentroSalud)->mdl_status == 1)
                                        <a href="{{ route('editCentrosDeSalud', $profesional->id) }}" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="OCUPACIÓN CENTROS DE SALUD U y R">
                                            <i class="fa-solid fa-hand-holding-medical"></i>
                                        </a>
                                    @else
                                        <a href="{{ route('createCentrosDeSalud', $profesional->id) }}" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="OCUPACIÓN CENTROS DE SALUD U y R">
                                            <i class="fa-solid fa-hand-holding-medical"></i>
                                        </a>
                                    @endif
                                                                                                   
                                @endif

                                <!-- CATALOGO PARA HOSPITALES (2) -->

                                @if ( $profesional->puesto?->clues_adscripcion_tipo == 2)

                                    @if(optional($profesional->ocupacionHospital)->mdl_status == 1)
                                        <a href="{{ route('editHospital', $profesional->id) }}" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="OCUPACIÓN HOSPITALES">
                                            <i class="fa-solid fa-hospital"></i>
                                        </a>
                                    @else
                                        <a href="{{ route('createHospital', $profesional->id) }}" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="OCUPACIÓN HOSPITALES">
                                            <i class="fa-solid fa-hospital"></i>
                                        </a>
                                    @endif
                                                                                                   
                                @endif

                                <!-- CATALOGO PARA OFICINAS JURISDICCIONALES (3) -->

                                @if ( $profesional->puesto?->clues_adscripcion_tipo == 3)

                                    @if(optional($profesional->ocupacionOfJurisidccion)->mdl_status == 1)
                                        <a href="{{ route('editOfJurisdiccional', $profesional->id) }}" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="OF. JURISDICCIONAL">
                                            <i class="fa-solid fa-building-user"></i>
                                        </a>
                                    @else
                                        <a href="{{ route('createOfJurisdiccional', $profesional->id) }}" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="OF. JURISDICCIONAL">
                                            <i class="fa-solid fa-building-user"></i>
                                        </a>
                                    @endif
                                                                                                   
                                @endif

                                <!-- CATALOGO PARA CRI CREE (4) -->

                                @if ( $profesional->puesto?->clues_adscripcion_tipo == 4)

                                    @if(optional($profesional->ocupacionCriCree)->mdl_status == 1)
                                        <a href="{{ route('editCriCree', $profesional->id) }}" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="CRI CREE">
                                            <i class="fa-solid fa-wheelchair"></i>
                                        </a>
                                    @else
                                        <a href="{{ route('createCriCree', $profesional->id) }}" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="CRI CREE">
                                            <i class="fa-solid fa-wheelchair"></i>
                                        </a>
                                    @endif
                                                                                                   
                                @endif

                                <!-- CATALOGO PARA SAMU CRUM (5) -->

                                @if ( $profesional->puesto?->clues_adscripcion_tipo == 5)

                                    @if(optional($profesional->ocupacionSamuCrum)->mdl_status == 1)
                                        <a href="{{ route('editSamuCrum', $profesional->id) }}" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="SAMU CRUM">
                                            <i class="fa-solid fa-truck-medical"></i>
                                        </a>
                                    @else
                                        <a href="{{ route('createSamuCrum', $profesional->id) }}" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="SAMU CRUM">
                                            <i class="fa-solid fa-truck-medical"></i>
                                        </a>
                                    @endif
                                                                                                   
                                @endif

                                <!-- CATALOGO PARA OFICINA CENTRAL (6) -->

                                @if ( $profesional->puesto?->clues_adscripcion_tipo == 6)

                                    @if(optional($profesional->ocupacionOficinaCentral)->mdl_status == 1)
                                        <a href="{{ route('editOficinaCentral', $profesional->id) }}" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="OFICINA CENTRAL">
                                            <i class="fa-solid fa-building-flag"></i>
                                        </a>
                                    @else
                                        <a href="{{ route('createOficinaCentral', $profesional->id) }}" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="OFICINA CENTRAL">
                                            <i class="fa-solid fa-building-flag"></i>
                                        </a>
                                    @endif
                                                                                                   
                                @endif

                                <!-- CATALOGO PARA ALMACEN (7) -->

                                @if ( $profesional->puesto?->clues_adscripcion_tipo == 7)

                                    @if(optional($profesional->ocupacionAlmacen)->mdl_status == 1)
                                        <a href="{{ route('editAlmacen', $profesional->id) }}" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="ALMACEN ESTATAL">
                                            <i class="fa-solid fa-shop-lock"></i>
                                        </a>
                                    @else
                                        <a href="{{ route('createAlmacen', $profesional->id) }}" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="ALMACEN ESTATAL">
                                            <i class="fa-solid fa-shop-lock"></i>
                                        </a>
                                    @endif
                                                                                                   
                                @endif


                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8">No se encontraron profesionales para esta CLUES.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            

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

    <script>
        $(document).ready(function () {
            $('#profesionalesTable').DataTable({
                "language": {
                    "sProcessing":     "Procesando...",
                    "sLengthMenu":     "Mostrar _MENU_ registros",
                    "sZeroRecords":    "No se encontraron resultados",
                    "sEmptyTable":     "Ningún dato disponible en esta tabla",
                    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                    "sSearch":         "Buscar:",
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
    </script>
@stop