@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1><strong>Fotografía</strong></h1>
@stop

@section('content')

<div class="alert alert-info" role="alert">

    <ul>
        <li><strong>Nombre</strong> : {{ $profesional->nombre }} {{ $profesional->apellido_paterno }} {{ $profesional->apellido_materno }}</li>
        <li><strong>CURP</strong> : {{ $profesional->curp }}</li>
    </ul>
    
</div>
    
<div class="card">
        <div class="card-header">
            <a href="{{ route('profesionalShow', $profesional->id) }}" class="btn btn-info btn-sm">PERFIL DEL TRABAJADOR</a>
        </div>
        <div class="card-header">

            <div class="row">
                <div class="col-md-6">

                    <center>

                        @if($fotoUrl)
                            <img src="{{ $fotoUrl }}" alt="Fotografía del profesional" width="150px" class="img-thumbnail"/>
                        @else
                            <p>No se ha cargado una fotografía.</p>
                        @endif

                    </center>

                </div>
                <div class="col-md-6">

                    <div class="alert alert-danger" role="alert">
                    <strong>Nota : </strong> 
                    
                    <ul>
                        <li>El formato de la fotografía debe ser .JPG, .JPEG, .PNG en un tamaño máximo de 2 Mb.</li>
                        <li>En caso de actualización, al subir el nuevo archivo, en automático se elimina la anterior.</li>
                    </ul>

                    </div>

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
            <button type="submit" class="btn btn-success btn-sm btn-info">REGISTRAR FOTOGRAFÍA</button>
        </div>

    </form>
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