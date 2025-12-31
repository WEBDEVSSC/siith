@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1><strong>Recontratación</strong></h1>
@stop

@section('content')

<div class="card">
    <div class="card-header">
        <strong>Datos generales del trabajador</strong>
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-md-3 text-center">
                <center>
                    @if($fotoUrl)
                        <img src="{{ $fotoUrl }}" alt="Fotografía del profesional" style="max-width:200px; height:auto;" class="img-thumbnail"/>
                    @else
                        <img src="{{ asset('images/avatar-placeholder.png') }}" alt="Sin foto" style="max-width:200px; height:auto;" class="img-thumbnail"/>
                    @endif
            </div>

            <div class="col-md-9">
                <p><strong>Nombre : </strong> {{ $profesional->nombre }} {{ $profesional->apellido_paterno }} {{ $profesional->apellido_materno }}</p>
                <p><strong>CURP : </strong> {{ $profesional->curp }}</p>
                <p><strong>RFC : </strong> {{ $profesional->rfc }} {{ $profesional->homoclave }}</p>
                <p><strong>STATUS : </strong> {{ $profesional->puesto->vigencia }} - {{ $profesional->puesto->vigencia_motivo }}</p>
            </div>
        </div>
        
    </div>
    <div class="card-footer">
          <a class="btn btn-danger btn-sm" href="{{ route('findRecontratacionProfesional') }}"> BUSCAR OTRO PROFESIONAL</a>
          <a class="btn btn-success btn-sm" href="{{ route('createRecontratacion', $profesional->id) }}"> SELECCIONAR PROFESIONAL</a>
    </div>
</div>

<!-- --------------------------------------------- -->



<!-- --------------------------------------------- -->


@stop

@include('partials.footer')

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop
