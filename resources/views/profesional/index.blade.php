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

@if(session('updateCredencializacion'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Éxito',
                text: "{{ session('updateCredencializacion') }}",
                icon: 'success',
                confirmButtonText: 'Ok'
            });
        });
    </script>
@endif

@if(session('successHorario'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Éxito',
                text: "{{ session('successHorario') }}",
                icon: 'success',
                confirmButtonText: 'Ok'
            });
        });
    </script>
@endif

@if(session('successUpdateHorario'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Éxito',
                text: "{{ session('successUpdateHorario') }}",
                icon: 'success',
                confirmButtonText: 'Ok'
            });
        });
    </script>
@endif

<!-- NOTIFICACIONES PUESTO -->

@if(session('successHorario'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Éxito',
                text: "{{ session('successHorario') }}",
                icon: 'success',
                confirmButtonText: 'Ok'
            });
        });
    </script>
@endif

@if(session('successUpdatePuesto'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Éxito',
                text: "{{ session('successUpdatePuesto') }}",
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

            @if($profesionalesData->isEmpty())
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
                    <th>CLUES ADSCRIPCIÓN</th>
                    <th>MODULOS</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($profesionalesData as $data)
                    <tr>
                        <td>
                            <a href="{{ route('profesionalShow', $data['profesional']->id) }}" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="DETALLES">
                                <i class="fa fa-info" aria-hidden="true"></i>
                            </a>
                        </td>
                        <td>{{ $data['profesional']->curp }}</td>
                        <td>{{ $data['profesional']->rfc }}</td>
                        <td>{{ $data['profesional']->nombre }} {{ $data['profesional']->apellido_paterno }} {{ $data['profesional']->apellido_materno }}</td>
                        <td>{{ $data['cluesAdscripcionNombre'] ?? 'N/A' }}</td>
                        <td>
                            <!-- ------------------------- -->
                            <!-- ------------------------- -->
                            <!-- MODULO DE DATOS GENERALES -->
                            <!-- ------------------------- -->
                            <!-- ------------------------- -->

                            @if($data['profesional']->mdl_datos_generales == 1)
                                <a href="{{ route('profesionalEdit', $data['profesional']->id) }}" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="DATOS GENERALES">
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

                            @if(optional($data['profesional']->puesto->first())->mdl_puesto == 1)
                                <a href="{{ route('editPuesto', $data['profesional']->id) }}" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="PUESTO">
                                    <i class="fa fa-archive" aria-hidden="true"></i>
                                </a>
                            @else
                                <a href="{{ route('createPuesto', $data['profesional']->id) }}" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="PUESTO">
                                    <i class="fa fa-archive" aria-hidden="true"></i>
                                </a>
                            @endif

                            <!-- --------------------------- -->
                            <!-- --------------------------- -->
                            <!-- MODULO DE CREDENCIALIZACION -->
                            <!-- --------------------------- -->
                            <!-- --------------------------- -->

                            @if(optional($data['profesional']->credencializacion->first())->mdl_credencializacion == 1)
                                <a href="{{ route('editCredencializacion', $data['profesional']->id) }}" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="CREDENCIALIZACIÓN">
                                    <i class="fa fa-camera" aria-hidden="true"></i>
                                </a>
                            @else
                                <a href="{{ route('createCredencializacion', $data['profesional']->id) }}" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="CREDENCIALIZACIÓN">
                                    <i class="fa fa-camera" aria-hidden="true"></i>
                                </a>
                            @endif

                            <!-- --------------------------- -->
                            <!-- --------------------------- -->
                            <!--      MODULO DE HORARIO      -->
                            <!-- --------------------------- -->
                            <!-- --------------------------- -->

                            @if(optional($data['profesional']->horario->first())->mdl_horario == 1)
                                <a href="{{ route('editHorario', $data['profesional']->id) }}" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="HORARIO">
                                    <i class="fa fa-clock" aria-hidden="true"></i>
                                </a>
                            @else
                                <a href="{{ route('createHorario', $data['profesional']->id) }}" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="HORARIO">
                                    <i class="fa fa-clock" aria-hidden="true"></i>
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