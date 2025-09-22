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
                        <th>NOMINA DE PAGO</th>
                        <th>TIPO DE CONTRATO</th>
                        <th>VIGENCIA</th>
                        <th>OCUPACUÓN</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($profesionales as $profesional)
                        <tr>
                            @if ($usuario->role == 'credencializacion')

                            <td>
                                @if($profesional->credencializacion && $profesional->credencializacion->fotografia)
                                    <img src="{{ asset('storage/credencializacion/thumbs/' . $profesional->credencializacion->fotografia) }}" 
                                        alt="Miniatura" width="100"  class="img-thumbnail">
                                @else
                                    <img src="{{ asset('images/avatar-placeholder.png') }}" alt="Sin foto" width="100">
                                @endif
                            </td>
                            
                            @elseif($usuario->role == 'admin')

                            <td>
                                <a href="{{ route('profesionalShow', $profesional->id) }}" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="DETALLES">
                                    <i class="fa-solid fa-address-card"></i>
                                </a>
                                <a target="_blank" href="{{ route('profesionalPDF', $profesional->id) }}" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="PDF">
                                    <i class="fa-solid fa-file-lines"></i>
                                </a>
                            </td>
                            
                            @endif
                            
                            {{-- <td>
                                <a href="{{ route('profesionalShow', $profesional->id) }}" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="DETALLES">
                                    <i class="fa-solid fa-address-card"></i>
                                </a>
                                <a target="_blank" href="{{ route('profesionalPDF', $profesional->id) }}" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="PDF">
                                    <i class="fa-solid fa-file-lines"></i>
                                </a>
                            </td> --}}
                            <td>{{ $profesional->curp }}</td>
                            <td>{{ $profesional->rfc }}{{ $profesional->homoclave }}</td>
                            <td>{{ $profesional->nombre }} {{ $profesional->apellido_paterno }} {{ $profesional->apellido_materno }}</td>
                            <td>
                                J.{{ $profesional->puesto->clues_adscripcion_jurisdiccion ?? '-' }} - 
                                {{ $profesional->puesto->clues_adscripcion ?? '-' }} 
                                {{ $profesional->puesto->clues_adscripcion_nombre ?? '-' }}
                            </td>
                            <td>{{ $profesional->puesto->nomina_pago ?? '-' }}</td>
                            <td>{{ $profesional->puesto->tipo_contrato ?? '-' }}</td>
                            <td>{{ $profesional->puesto->vigencia ?? '-' }}</td>
                            <td>
                                @if($profesional->credencializacion && $profesional->credencializacion->fotografia)
                                    <a href="{{ route('credencializacion.descargar', $profesional->credencializacion->id) }}" 
                                    class="btn btn-info btn-sm" target="_blank">
                                    Descargar fotografía original
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">No se encontraron resultados.</td>
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