@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1><strong>Vigencias</strong></h1>
@stop

@section('content')
    
<div class="card">
        <div class="card-header">

            <strong>Vencimiento de Bajas Temporales</strong>

        </div>

        <div class="card-body">

            <form action="{{ route('createBajasTemporales') }}" method="POST">

            @csrf

                <div class="row">

                    <div class="col-md-3">
                        <p><strong>Fecha de Inicio</strong></p>
                        <input type="date" class="form-control" name="fecha_inicio" value="{{ old('fecha_inicio') }}">
                    </div>

                        <div class="col-md-3">
                        <p><strong>Fecha de Término</strong></p>
                        <input type="date" class="form-control" name="fecha_termino" value="{{ old('fecha_termino') }}">
                    </div>

                </div>
            
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-sm btn-info">MOSTRAR REGISTROS</button>

            </form>
        </div>

</div>

{{----------------------------------------------------------------------------------------------}}

<div class="card">
        <div class="card-header">

            <strong>Vencimiento de Comisión</strong>

        </div>

        <div class="card-body">

            <form action="{{ route('createBajasComision') }}" method="POST">

            @csrf

                <div class="row">

                    <div class="col-md-3">
                        <p><strong>Fecha de Inicio</strong></p>
                        <input type="date" class="form-control" name="fecha_inicio" value="{{ old('fecha_inicio') }}">
                    </div>

                        <div class="col-md-3">
                        <p><strong>Fecha de Término</strong></p>
                        <input type="date" class="form-control" name="fecha_termino" value="{{ old('fecha_termino') }}">
                    </div>

                </div>
            
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-sm btn-info">MOSTRAR REGISTROS</button>

            </form>
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