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
                        <th>CURP</th>
                        <th>RFC</th>
                        <th>NOMBRE COMPLETO</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($profesionales as $profesional)
                        <tr>
                            <td>{{ $profesional->curp }}</td>
                            <td>{{ $profesional->rfc}} {{ $profesional->homoclave }}</td>
                            <td>{{ $profesional->nombre}} {{ $profesional->apellido_paterno }} {{ $profesional->apellido_materno }}</td>
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