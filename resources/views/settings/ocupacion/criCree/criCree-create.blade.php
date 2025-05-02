@extends('adminlte::page')

@section('title', 'Dashboard')

@section('plugins.Sweetalert2', true)

@section('plugins.Datatables', true)

@section('content_header')
    <h1><strong>Profesionales | Ocupaciones</strong> <small>CRI CREE</small></h1>
@stop

@section('content')

<!-- -->
    
    <div class="card">
        <div class="card-header">
            
        </div>
        <form action="{{ route('ocupacionCriCreeStore') }}" method="POST">
        
        @csrf

        <div class="card-body">

            <div class="row">
                <div class="col-md-3">
                    <p>Unidad</p>
                    <input type="text" name="unidad" id="unidad" class="form-control" value="{{ old('unidad') }}">
                    @error('unidad')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-3">
                    <p>Area</p>
                    <input type="text" name="area" id="area" class="form-control" value="{{ old('area') }}">
                    @error('area')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-3">
                    <p>Subarea</p>
                    <input type="text" name="subarea" id="subarea" class="form-control" value="{{ old('subarea') }}">
                    @error('subarea')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-3">
                    <p>Ocupacion</p>
                    <input type="text" name="ocupacion" id="ocupacion" class="form-control" value="{{ old('ocupacion') }}">
                    @error('ocupacion')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-3">
                    <p>Orden</p>
                    <input type="text" name="orden" id="orden" class="form-control" value="{{ old('orden') }}">
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