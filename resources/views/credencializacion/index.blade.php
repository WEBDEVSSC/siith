@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1><strong>Profesionales</strong> <small>Credencialización</small></h1>
@stop

@section('content')
    
<div class="card">
        <div class="card-header">

            <ul>
                <li><strong>Nombre</strong> : {{ $profesional->nombre }} {{ $profesional->apellido_paterno }} {{ $profesional->apellido_materno }}</li>
                <li><strong>CURP</strong> : {{ $profesional->curp }}</li>
            </ul>

        </div>

        <form action="{{ route('storeCredencializacion') }}" method="POST" enctype="multipart/form-data">

        @csrf 

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