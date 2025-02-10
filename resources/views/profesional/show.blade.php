@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1><strong>Profesionales</strong> <small>Perfil del Trabajador</small></h1>
@stop

@section('content')
    
<div class="card">
    <div class="card-header">
        <strong>Datos Generales</strong>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-3">
                <p><strong>CURP </strong></p>
                {{ $profesional->curp }}
            </div>
            <div class="col-md-3">
                <p><strong>RFC</strong></p>
                {{ $profesional->rfc }} - {{ $profesional->homoclave }}
            </div>
            <div class="col-md-3">
                <p><strong>Nombre completo </strong></p>
                {{ $profesional->nombre }} {{ $profesional->apellido_paterno }} {{ $profesional->apellido_materno }}
            </div>
            <div class="col-md-3">
                <p><strong>Fecha de nacimiento </strong></p>
                {{ $profesional->fecha_nacimiento }} ( {{ $edad }} Años )
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-3">
                <p><strong>Sexo</strong></p>
                {{ $profesional->sexo }}
            </div>
            <div class="col-md-3">
                <p><strong>Nacionalidad</strong></p>
                {{ $profesional->nacionalidad }}
            </div>
            <div class="col-md-3">
                <p><strong>Nacimiento</strong></p>
                {{ $profesional->pais_nacimiento }} - {{ $profesional->entidad_nacimiento }} - {{ $profesional->municipio_nacimiento }}
            </div>
            <div class="col-md-3">
                <p><strong>Estado Conyugal</strong></p>
                {{ $profesional->estado_conyugal }}
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-3">
                <p><strong>Teléfono de Casa</strong></p>
                {{ $profesional->telefono_casa }}
            </div>
            <div class="col-md-3">
                <p><strong>Celular</strong></p>
                {{ $profesional->celular }}
            </div>
            <div class="col-md-3">
                <p><strong>E-mail</strong></p>
                {{ $profesional->email }}
            </div>
        </div>

    </div>

    <!-- -- -->

    

    <!-- -- -->
    
    <div class="card-footer">
            
    </div>

</div>

    <!-- -- -->

    <div class="card">
        <div class="card-header"><strong>Puesto</strong></div>
        <div class="card-body">

            <div class="row">
                <div class="col-md-3">
                    <p><strong>FIEL </strong></p>
                    {{ $fiel }} {{ $fiel_vigencia }}
                </div>
            </div>

        </div>
        <div class="card-footer"></div>
    </div>

    <!-- -- -->


    @if($fotoUrl)
    <img src="{{ $fotoUrl }}" alt="Fotografía del profesional" width="200" />
@else
    <p>No se ha cargado una fotografía.</p>
@endif

@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop