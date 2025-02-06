@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1><strong>Profesionales</strong> <small>Puesto</small></h1>
@stop

@section('content')
    
<div class="card">
        <div class="card-header">

            <ul>
                <li><strong>Nombre</strong> : {{ $profesional->nombre }} {{ $profesional->apellido_paterno }} {{ $profesional->apellido_materno }}</li>
                <li><strong>CURP</strong> : {{ $profesional->curp }}</li>
            </ul>

        </div>

        <form action="{{ route('storePuesto') }}" method="POST">

        @csrf 

        <input type="hidden" name="id_profesional" value="{{ $profesional->id }}">
            
            <div class="card-body">

                <!-- ---------------------------------- -->

                <div class="row mt-3">
                    <div class="col-md-3">
                        <p>Fiel</p>
                        <select name="fiel" id="fiel" class="form-control">
                            <option value="">-- Seleccione una opción --</option>
                            <option value="SI" {{ old('fiel') == 'SI' ? 'selected' : '' }}>SI</option>
                            <option value="NO" {{ old('fiel') == 'NO' ? 'selected' : '' }}>NO</option>
                        </select>

                        @error('fiel')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <p>Vigencia</p>
                        <input type="date" name="fiel_vigencia" id='fiel_vigencia' class="form-control" value="{{ old('fiel_vigencia') }}">

                        @error('fiel_vigencia')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- ---------------------------------------------------------------------- -->                
        
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-success btn-sm btn-info">REGISTRAR DATOS DE PUESTO</button>
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