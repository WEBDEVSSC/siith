@extends('adminlte::page')

@section('title', 'Dashboard')

@section('plugins.Sweetalert2', true)

@section('plugins.Datatables', true)

@section('content_header')
    <h1><strong>Ocupaciones / Cartera de Servicios</strong> <small>C.O.R.S.</small></h1>
@stop

@section('content')

<!-- -->
    
    <div class="card">
        <div class="card-header">
            
        </div>
        <form action="{{ route('ocupacionCorsUpdate', $ocupacion->id) }}" method="POST">
        
        @csrf

        @method('PUT')

        <div class="card-body">

            <div class="row">
                <div class="col-md-3">
                    <p>Unidad</p>
                    <input type="text" name="unidad" id="unidad" class="form-control" value="{{ old('unidad', $ocupacion->unidad) }}">
                    @error('unidad')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-3">
                    <p>Area</p>
                    <input type="text" name="area" id="area" class="form-control" value="{{ old('area', $ocupacion->area) }}">
                    @error('area')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-3">
                    <p>Subarea Servicio</p>
                    <input type="text" name="subarea_servicio" id="subarea_servicio" class="form-control" value="{{ old('subarea_servicio', $ocupacion->subarea_servicio) }}">
                    @error('subarea_servicio')
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