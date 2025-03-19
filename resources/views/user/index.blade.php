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


<!-- -->
    
<div class="card">
        <div class="card-header">

            <a href="{{ route('createUsuario') }}" class="btn btn-info btn-sm">Nuevo registro</a>

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
                    <th></th>
                    <th>NOMBRE</th>
                    <th>EMAIL</th>
                    <th>UNIDAD</th>
                    <th>ROL</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($usuarios as $usuario)
                    <tr>
                        <td>
                            <a href="{{ route('profesionalShow', $usuario->id) }}" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="DETALLES">
                                <i class="fa fa-info" aria-hidden="true"></i>
                            </a>
                        </td>
                        <td>{{ $usuario->name }}</td>
                        <td>{{ $usuario->email }}</td>
                        <td>{{ $usuario->clues_unidad }} - {{ $usuario->nombre_unidad }}</td>
                        <td>{{ $usuario->role }}</td>

                        <td></td>
                        
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
    $(document).ready(function() {
        // Inicializa DataTables
        $('#usuariosTable').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json" // Traducción al español
            }
        });

        // Inicializar todos los tooltips de la página
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
@stop