@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1><strong>Vencimiento de Comisiones</strong></h1>
@stop

@section('content')
    
<div class="card">
        <div class="card-header">

            <p><strong>Entre {{ \Carbon\Carbon::parse($fecha_inicio)->format('d-m-Y') }} y {{ \Carbon\Carbon::parse($fecha_termino)->format('d-m-Y') }}</strong></p>

        </div>

        <div class="card-body">

    @if($bajasComision->count())
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Fotografía</th>
                    <th>Nombre Completo</th>
                    <th>Tipo de Movimiento</th>
                    <th>Unidad Origen</th>
                    <th>Unidad Destino</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Final</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bajasComision as $bajaComision)
                    <tr>
                        <td>
                            @if($bajaComision->credencializacion && $bajaComision->credencializacion->fotografia)
                                <img 
                                    src="{{ asset('storage/credencializacion/thumbs/' . $bajaComision->credencializacion->fotografia) }}" 
                                    alt="Foto {{ $bajaComision->credencializacion->fotografia }}" 
                                    width="80"
                                    class="img-thumbnail"
                                >
                            @else
                                <span class="text-muted">Sin registro</span>
                            @endif
                        </td>
                        <td>{{ $bajaComision->profesional ? $bajaComision->profesional->nombre. ' ' . $bajaComision->profesional->apellido_paterno. ' ' . $bajaComision->profesional->apellido_materno   : 'Sin nombre' }}</td>
                        <td>{{ $bajaComision->tipo_movimiento }}</td>
                        <td>{{ $bajaComision->unidad_origen_nombre }}</td>
                        <td>{{ $bajaComision->unidad_destino_nombre }}</td>
                        <td>{{ \Carbon\Carbon::parse($bajaComision->fecha_inicio)->format('d/m/Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($bajaComision->fecha_final)->format('d/m/Y') }}</td>
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