@extends('adminlte::page')

@section('title', 'Dashboard')

@section('plugins.Sweetalert2', true)

@section('plugins.Datatables', true)

@section('content_header')
    <h1><strong>PANEL DE CONTROL</strong> <small>REGISTROS INCOMPLETOS</small></h1>
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

        </div>
        <div class="card-body">

        @if($profesionalesIncompletos->isEmpty())
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
                    <th>STATUS</th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach ($profesionalesIncompletos as $profesionalIncompleto)
                    <tr>
                        <td>
                            <a href="{{ route('profesionalShow', $profesionalIncompleto->id) }}" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="DETALLES">
                                <i class="fa-solid fa-address-card"></i>
                            </a>
                            <a target='_blank' href="{{ route('profesionalPDF', $profesionalIncompleto->id) }}" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="PDF">
                                <i class="fa-solid fa-file-lines"></i>
                            </a>
                        </td>
                        <td>{{ $profesionalIncompleto->curp }}</td>
                        <td>{{ $profesionalIncompleto->rfc }}{{ $profesionalIncompleto->homoclave }}</td>
                        <td>{{ $profesionalIncompleto->nombre }} {{ $profesionalIncompleto->apellido_paterno }} {{ $profesionalIncompleto->apellido_materno }}</td>                    
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

        </div>
        <div class="card-footer">
            <a href="{{ route('profesionalIndex') }}">Trabajadores Activos</a>
            <br>
            <a href="{{ route('profesionalesBajasTemporalesIndex') }}">Trabajadores Con Baja Temporal</a>
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