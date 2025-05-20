@extends('adminlte::page')

@section('title', 'Dashboard')

@section('plugins.Sweetalert2', true)

@section('plugins.Datatables', true)

@section('content_header')
    <h1><strong>Profesionales</strong> <small>Pendientes de Firma de Nomina</small></h1>
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

            <form action="{{ route('subirLayout') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <label for="archivo">Selecciona un archivo Excel:</label>
                <input type="file" name="archivo" accept=".xlsx, .xls, .csv" required>
                <button type="submit">Importar</button>
            </form>

        </div>
        <div class="card-body">

        @if($profesionalesFirmasNominas->isEmpty())
            <div class="alert alert-warning" role="alert">
                No hay registros disponibles.
            </div>
        @else
        <table id="profesionalesTable" class="table table-bordered">
            <thead>
                <tr>
                    <th>CURP</th>
                    <th>RFC</th>
                    <th>NOMBRE COMPLETO</th>
                    <th>NOTIFICACION</th>
                    <th>QUINCENA</th>
                    <th>CONCEPTO</th>
                    <th></th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach ($profesionalesFirmasNominas as $profesionalFirmaNomina)
                    <tr>
                        <td>{{ $profesionalFirmaNomina->curp }}</td>
                        <td>{{ $profesionalFirmaNomina->profesional->rfc }}{{ $profesionalFirmaNomina->profesional->homoclave }}</td>
                        <td>{{ $profesionalFirmaNomina->profesional->nombre }} {{ $profesionalFirmaNomina->profesional->apellido_paterno }} {{ $profesionalFirmaNomina->profesional->apellido_materno }}</td>
                        <td>{{ $profesionalFirmaNomina->profesional->email }}</td>
                        <td>{{ $profesionalFirmaNomina->quincena_numero }} - {{ $profesionalFirmaNomina->anio }}</td>
                        <td>{{ $profesionalFirmaNomina->concepto }}</td>
                        <td>
                            <a href="{{ route('firmaCreate', $profesionalFirmaNomina->token) }}" class="btn btn-success btn-sm">FIRMAR</a>
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