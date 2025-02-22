@extends('adminlte::page')

@section('title', 'Dashboard')

@section('plugins.Sweetalert2', true)

@section('content_header')
    <h1><strong>Profesionales</strong> <small>Panel de Control</small></h1>
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

@if(session('successCredencializacion'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Éxito',
                text: "{{ session('successCredencializacion') }}",
                icon: 'success',
                confirmButtonText: 'Ok'
            });
        });
    </script>
@endif

<!-- -->
    
<div class="card">
        <div class="card-header">

        </div>
        <div class="card-body">

            @if($profesionales->isEmpty())
        <div class="alert alert-warning" role="alert">
            No hay registros disponibles.
        </div>
    @else
        <table class="table table-bordered">
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
                @foreach ($profesionales as $profesional)
                    <tr>
                        <td>
                            <a href="{{ route('profesionalShow', $profesional->id) }}" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="DETALLES">
                                <i class="fa fa-info" aria-hidden="true"></i>
                            </a>
                        </td>
                        <td>{{ $profesional->curp }}</td>
                        <td>{{ $profesional->rfc }}</td>
                        <td>{{ $profesional->nombre }} {{ $profesional->apellido_paterno }} {{ $profesional->apellido_materno }}</td>
                        <td>
                            <!-- MODULO DE DATOS GENERALES -->
                            @if($profesional->mdl_datos_generales == 1)
                                <!-- Si mdl_datos_generales es igual a 1, mostrar este contenido -->
                                <a href="{{ route('profesionalEdit', $profesional->id) }}" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="DATOS GENERALES">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                </a>
                            @else
                                <!-- Si mdl_datos_generales no es igual a 1, mostrar otro contenido -->
                                <a href="#!" class="btn btn-danger btn-sm"  data-toggle="tooltip" data-placement="top" title="DATOS GENERALES">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                </a>
                            @endif

                            <!-- MODULO DE PUESTOS -->
                            @if(optional($profesional->puestos->first())->mdl_puesto == 1)
                                <!-- Si mdl_puesto del primer puesto es 1, mostrar botón azul -->
                                <a href="{{ route('createPuesto', $profesional->id) }}" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="PUESTO">
                                    <i class="fa fa-archive" aria-hidden="true"></i>
                                </a>
                            @else
                                <!-- Si no es 1 o si no hay puestos, mostrar botón rojo -->
                                <a href="{{ route('createPuesto', $profesional->id) }}" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="PUESTO">
                                    <i class="fa fa-archive" aria-hidden="true"></i>
                                </a>
                            @endif

                            <!-- MODULO DE CREDENCIALIZACION -->
                            @if(optional($profesional->credencializaciones->first())->mdl_credencializacion == 1)
                                <!-- Si mdl_puesto del primer puesto es 1, mostrar botón azul -->
                                <a href="{{ route('createCredencializacion', $profesional->id) }}" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="CREDENCIALIZACIÓN">
                                    <i class="fa fa-camera" aria-hidden="true"></i>
                                </a>
                            @else
                                <!-- Si no es 1 o si no hay puestos, mostrar botón rojo -->
                                <a href="{{ route('createCredencializacion', $profesional->id) }}" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="CREDENCIALIZACIÓN">
                                    <i class="fa fa-camera" aria-hidden="true"></i>
                                </a>
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
@stop