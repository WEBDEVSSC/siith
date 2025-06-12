@extends('adminlte::page')

@section('title', 'Dashboard')

@section('plugins.Sweetalert2', true)

@section('plugins.Datatables', true)

@section('content_header')
    <h1><strong>Profesionales</strong> <small>Pases de Salida</small></h1>
@stop

@section('content')

<!-- -->

@php
    $alerts = [
        'paseAutorizado',
        'paseCancelado',
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

        </div>
        <div class="card-body">

        @if($pasesDeSalida->isEmpty())
            <div class="alert alert-warning" role="alert">
                No hay registros disponibles.
            </div>
        @else
        <table id="profesionalesTable" class="table table-bordered">
            <thead>
                <tr>
                    <th>FOLIO</th>
                    <th>TRABAJADOR</th>
                    <th>TIPO</th>
                    <th>TIEMPO AUTORIZADO</th>
                    <th>INICIO</th>
                    <th>FINAL</th>
                    <th>STATUS</th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach ($pasesDeSalida as $paseDeSalida)
                    <tr>
                        <td>{{ $paseDeSalida->folio }}</td>                       
                        <td>{{ $paseDeSalida->nombre }} {{ $paseDeSalida->apellido_paterno }} {{ $paseDeSalida->apellido_materno }}</td>                       
                        <td>{{ $paseDeSalida->tipo }}</td>                       
                        <td>{{ $paseDeSalida->tiempo_autorizado }}</td>                       
                        <td>{{ $paseDeSalida->hora_inicio->format('H:i:s') }}</td>                       
                        <td>{{ $paseDeSalida->hora_final->format('H:i:s') }}</td>
                        <td>
                            @if($paseDeSalida->status == 0)
                                <form action="{{ route('paseAutorizado', $paseDeSalida->id) }}" method="POST" class="form-autorizar" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm btn-block text-white">
                                        <i class="fa-solid fa-check"></i> AUTORIZAR
                                    </button>
                                </form>

                                <br>

                                <form action="{{ route('paseCancelado', $paseDeSalida->id) }}" method="POST" class="form-cancelar" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm btn-block text-white">
                                        <i class="fa-solid fa-xmark"></i> DENEGAR
                                    </button>
                                </form>
                                
                            @elseif($paseDeSalida->status == 1)
                                <button class="btn btn-info btn-sm btn-block" disabled>
                                    <i class="fa-solid fa-circle-check"></i><br>PASE AUTORIZADO
                                </button>
                            @elseif($paseDeSalida->status == 2)
                                <button class="btn btn-warning btn-sm btn-block" disabled>
                                    <i class="fa-solid fa-circle-xmark"></i><br>PASE CANCELADO
                                </button>
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
        document.addEventListener('DOMContentLoaded', function () {
            // Confirmar autorización
            document.querySelectorAll('.form-autorizar').forEach(form => {
                form.addEventListener('submit', function (e) {
                    e.preventDefault();
                    Swal.fire({
                        title: '¿Estás seguro?',
                        text: "Vas a autorizar este pase.",
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#28a745',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Sí, autorizar',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });

            // Confirmar cancelación
            document.querySelectorAll('.form-cancelar').forEach(form => {
                form.addEventListener('submit', function (e) {
                    e.preventDefault();
                    Swal.fire({
                        title: '¿Estás seguro?',
                        text: "Vas a cancelar este pase.",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Sí, cancelar',
                        cancelButtonText: 'Volver'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>

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