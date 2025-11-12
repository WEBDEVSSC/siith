@extends('adminlte::page')

@section('title', 'Dashboard')

@section('plugins.Sweetalert2', true)

@section('plugins.Datatables', true)

@section('content_header')
    <h1><strong>Buscador</strong> <small></small></h1>
@stop

@section('content')

<!-- -->

<!-- -->
    
<div class="card">
        <div class="card-header">

        </div>
        <div class="card-body">

            <table id="profesionalesTable" class="table table-bordered">
                <thead>
                    <tr>
                        <th></th>
                        <th>CURP</th>
                        <th>RFC</th>
                        <th>NOMBRE COMPLETO</th>
                        <th>CLUES ADSCRIPCIÓN</th>
                        <th>NÓMINA DE PAGO</th>
                        <th>VIGENCIA</th>
                        <th>OCUPACIÓN</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($profesionales as $profesional)
                        <tr>
                            <td>
                                @if (Auth::user()->role === 'credencializacion')

                                    <a href="{{ route('credencializacion.descargar', $profesional->credencializacion->id) }}" 
                                    class="btn btn-info btn-sm" target="_blank">
                                    Descargar fotografía original
                                    </a>

                                @else

                                    <a href="{{ route('profesionalShow', $profesional->id) }}" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="DETALLES">
                                        <i class="fa-solid fa-address-card"></i>
                                    </a>

                                @endif
                            </td>
                            
                            
                                
                            

                            {{-- ----------------------------------------------------- --}}
                            {{-- MOSTRAMOS LOS BOTONES DE SHOW Y PDF SOLO AL ADMIN     --}}
                            {{-- ----------------------------------------------------- --}}

                            {{-- ----------------------------------------------------- --}}
                            {{-- MOSTRAMOS LA FOTOGRAFIA SOLO AL ROL CREDENCIALIZACION --}}
                            {{-- ----------------------------------------------------- --}}

                            <td>{{ $profesional->curp }}</td>
                            <td>{{ $profesional->rfc }}{{ $profesional->homoclave }}</td>
                            <td>{{ $profesional->nombre }} {{ $profesional->apellido_paterno }} {{ $profesional->apellido_materno }}</td>
                            <td>
                                J.{{ $profesional->puesto->clues_adscripcion_jurisdiccion ?? '-' }} - 
                                {{ $profesional->puesto->clues_adscripcion ?? '-' }} 
                                {{ $profesional->puesto->clues_adscripcion_nombre ?? '-' }}
                            </td>
                            <td>{{ $profesional->puesto->nomina_pago ?? '-' }}</td>
                            <td>{{ $profesional->puesto->vigencia ?? '-' }}</td>
                            <td>
                            {{-- CENTROS DE SALUD RURALES Y URBANOS --}}
                            @if ($profesional->puesto?->clues_adscripcion_tipo == 1)
                                
                                    {{ $profesional->ocupacionCentroSalud?->unidad_uno }}
                                    - {{ $profesional->ocupacionCentroSalud?->area_uno }}
                                    - {{ $profesional->ocupacionCentroSalud?->subarea_uno }}
                                    - {{ $profesional->ocupacionCentroSalud?->ocupacion_uno }}
                                

                            {{-- HOSPITALES --}}
                            @elseif ($profesional->puesto?->clues_adscripcion_tipo == 2)
                                
                                    {{ $profesional->ocupacionHospital?->unidad_uno }}
                                    - {{ $profesional->ocupacionHospital?->area_uno }}
                                    - {{ $profesional->ocupacionHospital?->subarea_uno }}
                                    - {{ $profesional->ocupacionHospital?->puesto_uno }}
                                

                            {{-- OFICINA JURISDICCIONAL --}}
                            @elseif ($profesional->puesto?->clues_adscripcion_tipo == 3)
                                
                                    {{ $profesional->ocupacionOfJurisidccion?->unidad_uno }}
                                    - {{ $profesional->ocupacionOfJurisidccion?->area_uno }}
                                    - {{ $profesional->ocupacionOfJurisidccion?->subarea_uno }}
                                    - {{ $profesional->ocupacionOfJurisidccion?->servicio_uno }}
                                    - {{ $profesional->ocupacionOfJurisidccion?->ocupacion_uno }}
                                
                            
                            {{-- CRI CREE --}}
                            @elseif ($profesional->puesto?->clues_adscripcion_tipo == 4)
                                
                                    {{ $profesional->ocupacionCriCree?->unidad_uno }}
                                    - {{ $profesional->ocupacionCriCree?->area_uno }}
                                    - {{ $profesional->ocupacionCriCree?->subarea_uno }}
                                    - {{ $profesional->ocupacionCriCree?->ocupacion_uno }}
                                

                            {{-- CRI CREE --}}
                            @elseif ($profesional->puesto?->clues_adscripcion_tipo == 5)
                                
                                    {{ $profesional->ocupacionSamuCrum?->unidad_uno }}
                                    - {{ $profesional->ocupacionSamuCrum?->area_uno }}
                                    - {{ $profesional->ocupacionSamuCrum?->subarea_uno }}
                                    - {{ $profesional->ocupacionSamuCrum?->componente_uno }}
                                    - {{ $profesional->ocupacionSamuCrum?->ocupacion_uno }}
                                
                            
                            {{-- OFICINA CENTRAL --}}
                            @elseif ($profesional->puesto?->clues_adscripcion_tipo == 6)
                               
                                    {{ $profesional->ocupacionOficinaCentral?->area_uno }}
                                    - {{ $profesional->ocupacionOficinaCentral?->subarea_uno }}
                                    - {{ $profesional->ocupacionOficinaCentral?->programa_uno }}
                                    - {{ $profesional->ocupacionOficinaCentral?->componente_uno }}
                                    - {{ $profesional->ocupacionOficinaCentral?->ocupacion_uno }}
                                
                            
                            {{-- ALMACEN --}}
                            @elseif ($profesional->puesto?->clues_adscripcion_tipo == 7)
                                
                                    {{ $profesional->ocupacionAlmacen?->area_uno }}
                                    - {{ $profesional->ocupacionAlmacen?->subarea_uno }}
                                    - {{ $profesional->ocupacionAlmacen?->jefatura_uno }}
                                    - {{ $profesional->ocupacionAlmacen?->departamento_uno }}
                                    - {{ $profesional->ocupacionAlmacen?->ocupacion_uno }}
                                

                            {{-- CETS LESP--}}
                            @elseif ($profesional->puesto?->clues_adscripcion_tipo == 8)
                                
                                    {{ $profesional->ocupacionCetsLesp?->area_uno }}
                                    - {{ $profesional->ocupacionCetsLesp?->subarea_uno }}
                                    - {{ $profesional->ocupacionCetsLesp?->jefatura_programa_uno }}
                                    - {{ $profesional->ocupacionCetsLesp?->componente_uno }}
                                    - {{ $profesional->ocupacionCetsLesp?->ocupacion_uno }}
                                

                            {{-- CORS --}}
                            @elseif ($profesional->puesto?->clues_adscripcion_tipo == 9)
                                
                                    {{ $profesional->ocupacionCors?->unidad_uno }}
                                    - {{ $profesional->ocupacionCors?->area_uno }}
                                    - {{ $profesional->ocupacionCors?->subarea_servicio_uno }}
                                    - {{ $profesional->ocupacionCors?->componente_uno }}
                                    - {{ $profesional->ocupacionCors?->ocupacion_uno }}
                               

                            {{-- ISSREEI --}}
                            @elseif ($profesional->puesto?->clues_adscripcion_tipo == 10)
                                
                                    {{ $profesional->ocupacionIssreei?->unidad_uno }}
                                    - {{ $profesional->ocupacionIssreei?->area_uno }}
                                    - {{ $profesional->ocupacionIssreei?->subarea_uno }}
                                    - {{ $profesional->ocupacionIssreei?->ocupacion_uno }}
                                

                            {{-- CESAME --}}
                            @elseif ($profesional->puesto?->clues_adscripcion_tipo == 11)
                                
                                    {{ $profesional->ocupacionCesame?->unidad_uno }}
                                    - {{ $profesional->ocupacionCesame?->area_uno }}
                                    - {{ $profesional->ocupacionCesame?->subarea_servicio_uno }}
                                    - {{ $profesional->ocupacionCesame?->componente_uno }}
                                    - {{ $profesional->ocupacionCesame?->ocupacion_uno }}
                                

                            {{-- PSI PARRAS --}}
                            @elseif ($profesional->puesto?->clues_adscripcion_tipo == 12)
                                
                                    {{ $profesional->ocupacionPsiParras?->unidad_uno }}
                                    - {{ $profesional->ocupacionPsiParras?->area_uno }}
                                    - {{ $profesional->ocupacionPsiParras?->subarea_servicio_uno }}
                                    - {{ $profesional->ocupacionPsiParras?->componente_uno }}
                                    - {{ $profesional->ocupacionPsiParras?->ocupacion_uno }}
                                
                            
                            {{-- CEAM --}}
                            @elseif ($profesional->puesto?->clues_adscripcion_tipo == 13)
                                
                                    {{ $profesional->ocupacionCeam?->unidad_uno }}
                                    - {{ $profesional->ocupacionCeam?->area_uno }}
                                    - {{ $profesional->ocupacionCeam?->subarea_servicio_uno }}
                                    - {{ $profesional->ocupacionCeam?->componente_uno }}
                                    - {{ $profesional->ocupacionCeam?->ocupacion_uno }}
                                

                            {{-- HOSPITAL DEL NIÑO --}}
                            @elseif ($profesional->puesto?->clues_adscripcion_tipo == 14)
                                
                                    {{ $profesional->ocupacionHospitalNino?->unidad_uno }}
                                    - {{ $profesional->ocupacionHospitalNino?->area_uno }}
                                    - {{ $profesional->ocupacionHospitalNino?->subarea_uno }}
                                    - {{ $profesional->ocupacionHospitalNino?->ocupacion_uno }}
                                

                            {{-- HOSPITAL UNIVERSITARIO --}}
                            @elseif ($profesional->puesto?->clues_adscripcion_tipo == 15)
                                
                                    {{ $profesional->ocupacionEnsenanza?->unidad }}
                                    - {{ $profesional->ocupacionEnsenanza?->area }}
                                    - {{ $profesional->ocupacionEnsenanza?->subarea }}
                                    - {{ $profesional->ocupacionEnsenanza?->ocupacion }}
                                
                            @endif
                            
                            </td>
                            
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center">No se encontraron resultados.</td>
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