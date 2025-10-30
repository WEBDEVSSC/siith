@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1><strong>Normatividad</strong></h1>
@stop

@section('content')
    
<div class="card">
        <div class="card-header">

            <p><strong>Bajas Temporales entre {{ \Carbon\Carbon::parse($fecha_inicio)->format('d-m-Y') }} y {{ \Carbon\Carbon::parse($fecha_termino)->format('d-m-Y') }}</strong></p>

        </div>

        <div class="card-body">

    @if($vigencias->count())
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Fotografía</th>
                    <th>Nombre Completo</th>
                    <th>Vigencia</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Final</th>
                </tr>
            </thead>
            <tbody>
                @foreach($vigencias as $vigencia)
                    <tr>
                        <td>
                            @if($vigencia->credencializacion && $vigencia->credencializacion->fotografia)
                                <img 
                                    src="{{ asset('storage/credencializacion/thumbs/' . $vigencia->credencializacion->fotografia) }}" 
                                    alt="Foto {{ $vigencia->credencializacion->fotografia }}" 
                                    width="80"
                                    class="img-thumbnail"
                                >
                            @else
                                <span class="text-muted">Sin registro</span>
                            @endif
                        </td>
                        <td>{{ $vigencia->profesional ? $vigencia->profesional->nombre. ' ' . $vigencia->profesional->apellido_paterno. ' ' . $vigencia->profesional->apellido_materno   : 'Sin nombre' }}</td>
                        <td>{{ $vigencia->vigencia. ' - ' .$vigencia->vigencia_motivo }}</td>
                        <td>{{ \Carbon\Carbon::parse($vigencia->fecha_inicio)->format('d/m/Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($vigencia->fecha_final)->format('d/m/Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="text-muted">No se encontraron registros en el rango de fechas seleccionado.</p>
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
@stop