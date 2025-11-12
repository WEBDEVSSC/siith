@extends('adminlte::page')

@section('title', 'Dashboard')

@section('plugins.Sweetalert2', true)

@section('plugins.Datatables', true)

@section('content_header')
    <h1><strong>Usuarios</strong> <small>Panel de Control</small></h1>
@stop

@section('content')

<!-- -->

@if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Éxito',
                text: "{{ session('success') }}",
                icon: 'success',
                confirmButtonText: 'Ok'
            });
        });
    </script>
@endif

@if(session('update'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Éxito',
                text: "{{ session('update') }}",
                icon: 'success',
                confirmButtonText: 'Ok'
            });
        });
    </script>
@endif

@if(session('delete'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Éxito',
                text: "{{ session('delete') }}",
                icon: 'success',
                confirmButtonText: 'Ok'
            });
        });
    </script>
@endif

<!-- -->
    
<div class="card">
        <div class="card-header">

            <a href="{{ route('createUsuario') }}" class="btn btn-info btn-sm">NUEVO REGISTRO</a>

        </div>
        <div class="card-body">

            @if($usuarios->isEmpty())
        <div class="alert alert-warning" role="alert">
            No hay registros disponibles.
        </div>
    @else
        <table id="usuariosTable" class="table table-bordered">
            <thead>
                <tr>
                    <th>NOMBRE</th>
                    <th>EMAIL</th>
                    <th>UNIDAD</th>
                    <th>RESPONSABLE</th>
                    <th>ROL</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($usuarios as $usuario)
                    <tr>
                        <td>{{ $usuario->name }}</td>
                        <td>{{ $usuario->email }}</td>
                        <td>{{ $usuario->clues_unidad }} - {{ $usuario->nombre_unidad }}</td>
                        <td>{{ $usuario->responsable }} - {{ $usuario->contacto }}</td>
                        <td>{{ $usuario->rol ? $usuario->rol->label_rol : 'Sin rol' }}</td>

                        <td>

                            <a href="{{ route('showUsuario', $usuario->id) }}" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="DETALLES">
                                <i class="fa fa-info-circle" aria-hidden="true"></i>
                            </a>
                            
                            <a href="{{ route('editUsuario', $usuario->id) }}" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="EDITAR">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                            </a>

                            <form action="{{ route('deleteUsuario', $usuario->id) }}" method="POST" class="d-inline form-eliminar">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="ELIMINAR">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </button>
                            </form>
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
            // Inicializa todos los tooltips de la página
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>



<script>
    document.addEventListener('DOMContentLoaded', function () {
        const forms = document.querySelectorAll('.form-eliminar');
    
        forms.forEach(form => {
            form.addEventListener('submit', function (e) {
                e.preventDefault(); // Detener el envío inmediato
    
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "Esta acción no se puede deshacer.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit(); // Enviar el formulario si el usuario confirma
                    }
                });
            });
        });
    });
    </script>

    <script>$(document).ready( function () {
        $(document).ready(function() {
        $('#usuariosTable').DataTable({
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