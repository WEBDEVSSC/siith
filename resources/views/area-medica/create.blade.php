@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1><strong>Profesionales</strong> <small>Area Médica</small></h1>
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

            <a href="{{ route('profesionalIndex') }}" class="btn btn-info btn-sm">PANEL DE CONTROL</a>

        </div>

        <form action="{{ route('storeSueldo') }}" method="POST">

        @csrf 

        <input type="hidden" name="id_profesional" value="{{ $profesional->id }}">
            
            <div class="card-body">

                <!-- ---------------------------------- -->

                <div class="row mt-3">      

                    <div class="col-md-3">
                        <p>Tipo de formación Area médica-enfermeria-profesional</p>
                        
                        <select name="tipo_formacion" id="tipo_formacion" class="form-control">
                            <option value="" disabled selected>Selecciona un tipo de formación</option>
                            @foreach ($tiposFormacion as $tipo)
                                <option value="{{ $tipo->cve }}" {{ old('tipo_formacion') == $tipo->cve ? 'selected' : '' }}>
                                    {{ $tipo->tipo }}
                                </option>
                            @endforeach
                        </select>
                    
                        @error('sueldo_mensual')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <p>Carrera</p>
                        <select name="carrera" id="carrera" class="form-control">
                            <option value="" disabled selected>-- Seleccione una opción --</option>
                            @foreach ($carreras as $carrera)
                                <option value="{{ $carrera->cve }}" {{ old('tipo_formacion') == $carrera->cve ? 'selected' : '' }}>
                                    {{ $carrera->carrera }}
                                </option>
                            @endforeach
                        </select>
                        @error('carrera')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <p>Institución Educativa Formadora</p>
                        <input type="text" name="prestaciones_mandato_ley" id="prestaciones_mandato_ley" class="form-control"  pattern="^\d+(\.\d{1,2})?$" inputmode="decimal" value="{{ old('prestaciones_mandato_ley') }}">                     
                        @error('prestaciones_mandato_ley')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <p>Año que cursa</p>
                        <input type="text" name="prestaciones_cgt" id="prestaciones_cgt" class="form-control"  pattern="^\d+(\.\d{1,2})?$" inputmode="decimal" value="{{ old('prestaciones_cgt') }}">                 
                        @error('prestaciones_cgt')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>                   

                </div>

                <!-- -->

                <div class="row mt-3">
                    
                    <div class="col-md-3">
                        <p>Duración de Años de Formación</p>
                        <input type="text" name="estimulos" id="estimulos" class="form-control"  pattern="^\d+(\.\d{1,2})?$" inputmode="decimal" value="{{ old('estimulos') }}">                     
                        @error('estimulos')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>  
                    
                </div>

        <!-- ---------------------------------------------------------------------- --> 
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-success btn-sm btn-info">REGISTRAR DATOS DE SUELDO</button>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@stop