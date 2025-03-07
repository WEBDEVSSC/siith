@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1><strong>Profesionales</strong> <small>Credencialización</small></h1>
@stop

@section('content')
    
<div class="card">
        <div class="card-header">

            <div class="row">
                <div class="col-md-3">

                    <center>

                        @if($fotoUrl)
                            <img src="{{ $fotoUrl }}" alt="Fotografía del profesional" width="150px" class="img-thumbnail"/>
                        @else
                            <p>No se ha cargado una fotografía.</p>
                        @endif

                    </center>

                </div>
                <div class="col-md-9">

                    <ul>
                        <li><strong>Nombre</strong> : {{ $profesional->nombre }} {{ $profesional->apellido_paterno }} {{ $profesional->apellido_materno }}</li>
                        <li><strong>CURP</strong> : {{ $profesional->curp }}</li>
                    </ul>

                </div>
            </div>

        </div>

        <form action="{{ route('updateCredencializacion' , $credencializacion->id) }}" method="POST" enctype="multipart/form-data">

        @csrf 
        @method('PUT')

        <input type="hidden" name="id_profesional" value="{{ $profesional->id }}">
        <input type="hidden" name="curp" value="{{ $profesional->curp }}">
            
            <div class="card-body">

                <!-- ---------------------------------- -->

                <div class="row">
                    <div class="col-md-12">
                        <p>Fotografía</p>
                        <input type="file" name="foto" class="form-control-file">
                        @error('foto')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- ---------------------------------------------------------------------- --> 
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-success btn-sm btn-info">REGISTRAR FOTOGRAFÍA PARA CREDENCIALIZACIÓN</button>
        </div>

    </form>
</div>

@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop