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

                    <div class="col-md-3">
                        <p>Actividad</p>
                        <select name="actividad" id="actividad" class="form-control">
                            <option value="">-- Selecciona una opcion --</option>
                            @foreach ($actividades as $actividad)
                                <option value="{{ $actividad->actividad }}">{{ $actividad->actividad }}</option>
                            @endforeach
                        </select>
                        @error('actividad')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <p>Adicional</p>
                        <select name="adicional" id="adicional" class="form-control">
                            <option value="">-- Selecciona una opcion --</option>
                            @foreach ($adicionales as $adicional)
                                <option value="{{ $adicional->adicional }}">{{ $adicional->adicional }}</option>
                            @endforeach
                        </select>
                        @error('adicional')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <!-- -->

                <div class="row mt-3">
                    <div class="col-md-3">
                        <p>Tipo de personal</p>
                        <select name="tipo_personal" id="tipo_personal" class="form-control">
                            <option value="">-- Selecciona una opcion --</option>
                            @foreach ($tiposPersonal as $tipoPersonal)
                                <option value="{{ $tipoPersonal->tipo_personal }}">{{ $tipoPersonal->tipo_personal }}</option>
                            @endforeach
                        </select>
                        @error('tipo_personal')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <p>Código de puesto</p>
                        <select name="codigo_puesto" id="codigo_puesto" class="form-control">
                            <option value="">-- Selecciona una opcion --</option>
                            @foreach ($codigosPuesto as $codigoPuesto)
                                <option value="{{ $codigoPuesto->codigo_puesto }}">{{ $codigoPuesto->codigo_puesto }}</option>
                            @endforeach
                        </select>
                        @error('codigo_puesto')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <p>CLUES Nomina</p>
                        <select name="codigo_puesto" id="codigo_puesto" class="form-control">
                            <option value="">-- Selecciona una opcion --</option>
                            @foreach ($clues as $clue)
                                <option value="{{ $clue->id }}">{{ $clue->clave_jurisdiccion }} - {{ $clue->nombre }}</option>
                            @endforeach
                        </select>
                        @error('codigo_puesto')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <p>CLUES Adscripcion</p>
                        <select name="codigo_puesto" id="codigo_puesto" class="form-control">
                            <option value="">-- Selecciona una opcion --</option>
                            @foreach ($clues as $clue)
                                <option value="{{ $clue->id }}">{{ $clue->clave_jurisdiccion }} - {{ $clue->nombre }}</option>
                            @endforeach
                        </select>
                        @error('codigo_puesto')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- -->

                <div class="row mt-3">

                        <div class="col-md-3">
                            <p>Área de trabajo</p>
                            <select name="codigo_puesto" id="codigo_puesto" class="form-control">
                                <option value="">-- Selecciona una opcion --</option>
                                @foreach ($areasTrabajo as $areaTrabajo)
                                    <option value="{{ $areaTrabajo->area_trabajo }}">{{ $areaTrabajo->area_trabajo }}</option>
                                @endforeach
                            </select>
                            @error('codigo_puesto')
                            <br><div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <p>Ocupación</p>
                            <select name="codigo_puesto" id="codigo_puesto" class="form-control">
                                <option value="">-- Selecciona una opcion --</option>
                                @foreach ($ocupaciones as $ocupacion)
                                    <option value="{{ $ocupacion->ocupacion }}">{{ $ocupacion->ocupacion }}</option>
                                @endforeach
                            </select>
                            @error('codigo_puesto')
                            <br><div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <p>Nomina de pago</p>
                            <select name="codigo_puesto" id="codigo_puesto" class="form-control">
                                <option value="">-- Selecciona una opcion --</option>
                                @foreach ($nominasPago as $nominaPago)
                                    <option value="{{ $nominaPago->nomina }}">{{ $nominaPago->nomina }}</option>
                                @endforeach
                            </select>
                            @error('codigo_puesto')
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