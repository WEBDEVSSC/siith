@extends('adminlte::page')

@section('title', 'Dashboard')

@section('plugins.Sweetalert2', true)

@section('plugins.Datatables', true)

@section('content_header')
    <h1><strong>Profesionales | Ocupaciones</strong> <small>CETS LESP</small></h1>
@stop

@section('content')

<!-- -->
    
    <div class="card">
        <div class="card-header">
            
        </div>
        <form action="{{ route('ocupacionCetsLespUpdate', $ocupacion->id) }}" method="POST">
        
        @csrf

        @method('PUT')

        <div class="card-body">

            <div class="row">
                <div class="col-md-3">
                    <p>Area</p>
                    <input type="text" name="area" id="area" class="form-control" value="{{ old('area', $ocupacion->area) }}">
                    @error('area')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-3">
                    <p>Subarea</p>
                    <input type="text" name="subarea" id="subarea" class="form-control" value="{{ old('subarea', $ocupacion->subarea) }}">
                    @error('subarea')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-3">
                    <p>Jefatura Programa</p>
                    <input type="text" name="jefatura_programa" id="jefatura_programa" class="form-control" value="{{ old('jefatura_programa', $ocupacion->jefatura_programa) }}">
                    @error('jefatura_programa')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-3">
                    <p>Componente</p>
                    <input type="text" name="componente" id="componente" class="form-control" value="{{ old('componente', $ocupacion->componente) }}">
                    @error('componente')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-3">
                    <p>Ocupación</p>
                    <input type="text" name="ocupacion" id="ocupacion" class="form-control" value="{{ old('ocupacion', $ocupacion->ocupacion) }}">
                    @error('ocupacion')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-3">
                    <p>Orden</p>
                    <input type="text" name="orden" id="orden" class="form-control" value="{{ old('orden', $ocupacion->orden) }}">
                    @error('orden')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>            

        </div>
        <div class="card-footer">

            <button type="submit" class="btn btn-success btn-sm">REGISTRAR DATOS</button>

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