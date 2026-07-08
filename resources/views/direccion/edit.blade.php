@extends('adminlte::page')

@section('title', 'Dashboard')

@section('plugins.Select2', true)

@section('content_header')
    <h1><strong>Documentos de Domicilio e Identificación Personal</strong></h1>
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

        <form action="{{ route('updateDireccion', $direccion->id) }}" method="POST">

        @csrf 

        @method('PUT')
            
            <div class="card-body">

                <!-- ---------------------------------- -->

                <div class="row mt-3">   
                    
                    <div class="col-md-3">
                        <p><strong>Calle</strong></p>
                        <input type="text" name="calle" class="form-control" value="{{ old('calle', $direccion->calle) }}">

                        @error('calle')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <p><strong>No. Interior</strong></p>
                        <input type="text" name="numero_interior" class="form-control" value="{{ old('numero_interior', $direccion->numero_interior) }}">

                        @error('numero_interior')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <p><strong>No. Exterior</strong></p>
                        <input type="text" name="numero_exterior" class="form-control" value="{{ old('numero_exterior', $direccion->numero_exterior) }}">

                        @error('numero_exterior')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <p><strong>Código Postal y Colonia</strong></p>
                        
                        <select id="codigo_postal" name="codigo_postal" class="form-control select2">
                            <option value="">-- Seleccione una opción --</option>

                            @foreach ($codigosPostales as $cp)
                                <option value="{{ $cp->id }}"
                                    {{ old('codigo_postal', $direccion->id_codigo_postal) == $cp->id ? 'selected' : '' }}>
                                    {{ $cp->codigo_postal }} - {{ $cp->colonia }}
                                </option>
                            @endforeach
                        </select>            
                        @error('codigo_postal')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

        <!-- ---------------------------------------------------------------------- --> 

        <!-- ---------------------------------------------------------------------- --> 
                @if (Auth::user()->role == 'admin')

                    <div class="row mt-3">
                        <div class="col-md-3">
                            <p><strong>Clave de Elector</strong></p>
                            <input type="text" name="clave_elector" class="form-control" value="{{ old('clave_elector', $direccion->clave_elector) }}">

                            @error('clave_elector')
                            <br><div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <p><strong>Sección</strong></p>
                            <input type="text" name="seccion" class="form-control" value="{{ old('seccion', $direccion->seccion) }}">

                            @error('seccion')
                            <br><div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <p><strong>Vigencia</strong></p>
                            <input type="text" name="vigencia" class="form-control" value="{{ old('vigencia', $direccion->vigencia) }}">

                            @error('vigencia')
                            <br><div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                @endif

        <!-- ---------------------------------------------------------------------- --> 
        {{--
        <div class="row mt-3">

            <div class="col-md-3">
                <div class="form-group">
                    <label for="ine"><strong>INE</strong></label>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input @error('ine') is-invalid @enderror" id="ine" name="ine" accept=".pdf">

                        <label class="custom-file-label" for="ine">
                            Seleccione un archivo...
                        </label>
                    </div>

                    <small class="form-text text-muted">
                        Formatos permitidos: PDF.
                    </small>

                    @error('ine')
                        <span class="invalid-feedback d-block">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label for="comprobante_domicilio"><strong>COMPROBANTE DE DOMICILIO</strong></label>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input @error('comprobante_domicilio') is-invalid @enderror" id="comprobante_domicilio" name="comprobante_domicilio" accept=".pdf">

                        <label class="custom-file-label" for="comprobante_domicilio">
                            Seleccione un archivo...
                        </label>
                    </div>

                    <small class="form-text text-muted">
                        Formatos permitidos: PDF.
                    </small>

                    @error('comprobante_domicilio')
                        <span class="invalid-feedback d-block">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
            </div>

        </div>--}}

        
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-success btn-sm btn-info">REGISTRAR DATOS</button>
        </div>

    </form>
</div>

@stop

@include('partials.footer')

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
    <style>
        /* Asegura que Select2 tenga el mismo alto y bordes redondeados */
        .select2-container--default .select2-selection--single {
            height: calc(2.25rem + 2px) !important; /* Ajuste de altura */
            border-radius: 0.25rem !important; /* Bordes redondeados */
            border: 1px solid #ced4da !important; /* Color del borde */
        }
        
        /* Alineación del texto */
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: calc(2.25rem - 2px) !important;
            padding-left: 0.75rem !important;
        }
        
        /* Ajuste del ícono desplegable */
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: calc(2.25rem + 2px) !important;
        }
    </style>
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>

    <script>
    document.getElementById('ine').addEventListener('change', function () {
        let nombre = this.files[0] ? this.files[0].name : 'Seleccione un archivo...';
        this.nextElementSibling.innerHTML = nombre;
    });
    </script>

    <script>
    document.getElementById('comprobante_domicilio').addEventListener('change', function () {
        let nombre = this.files[0] ? this.files[0].name : 'Seleccione un archivo...';
        this.nextElementSibling.innerHTML = nombre;
    });
    </script>

    <script>
        $(document).ready(function() {
            $('#codigo_postal').select2({
                placeholder: "-- Selecciona una opción --",
                allowClear: true
            });
        });
    </script>
@stop