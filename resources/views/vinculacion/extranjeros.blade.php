@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
     <h1><strong>Vinculación y Gestión</strong></h1>
@stop

@section('content')

    {{----}}

    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Nómina</th>
                        <th>Jurisdicción</th>
                        <th>Nacionalidad</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($profesionales as $index => $profesional)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                {{ $profesional->nombre }}
                                {{ $profesional->apellido_paterno }}
                                {{ $profesional->apellido_materno }}
                            </td>
                            <td>{{ $profesional->email }}</td>
                            <td>{{ $profesional->puesto->nomina_pago ?? '-' }}</td>
                            <td>{{ $profesional->puesto->clues_adscripcion_jurisdiccion ?? '-' }}</td>
                            <td>{{ $profesional->nacionalidad ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No hay registros</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>

    {{----}}    

@stop

@include('partials.footer')

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop