@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1><strong>Horario</strong></h1>
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
            <a href="{{ route('profesionalIndex') }}" class="btn btn-info btn-sm">PANEL DE CONTROL</a>

        </div>

        <form action="{{ route('storeHorario') }}" method="POST">

        @csrf 

        <input type="hidden" name="id_profesional" value="{{ $profesional->id }}">
            
            <div class="card-body">

                <!-- ---------------------------------- -->

                <div class="row mt-3">
                    

                    <div class="col-md-3">
                        <p>Jornada</p>
                        <select name="jornada" id="jornada" class="form-control">
                            <option value="">-- Selecciona una opción --</option>
                            @foreach ($jornadas as $jornada)
                                <option value="{{ $jornada->jornada }}" {{ old('jornada') == $jornada->jornada ? 'selected' : '' }}>
                                    {{ $jornada->jornada }}
                                </option>
                            @endforeach
                        </select>
                        @error('jornada')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    

                </div>

                <!-- -->

                <div class="row mt-3">
                    
                    
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Día</th>
                                <th>Entrada</th>
                                <th>Salida</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Lunes</td>
                                <td>
                                    <input type="time" class="form-control" name="entrada_lunes" id="entrada_lunes" value="{{ old('entrada_lunes') }}">
                                    @error('entrada_lunes')
                                    <br><div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </td>
                                <td>
                                    <input type="time" class="form-control" name="salida_lunes" id="salida_lunes" value="{{ old('salida_lunes') }}">
                                    @error('salida_lunes')
                                    <br><div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </td>
                            </tr>
                            <tr>
                                <td>Martes</td>
                                <td>
                                    <input type="time" class="form-control" name="entrada_martes" id="entrada_martes" value="{{ old('entrada_martes') }}">
                                    @error('entrada_martes')
                                    <br><div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </td>
                                <td>
                                    <input type="time" class="form-control" name="salida_martes" id="salida_martes" value="{{ old('salida_martes') }}">
                                    @error('salida_martes')
                                    <br><div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </td>
                            </tr>
                            <tr>
                                <td>Miercoles</td>
                                <td>
                                    <input type="time" class="form-control" name="entrada_miercoles" id="entrada_miercoles" value="{{ old('entrada_miercoles') }}">
                                    @error('entrada_miercoles')
                                    <br><div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </td>
                                <td>
                                    <input type="time" class="form-control" name="salida_miercoles" id="salida_miercoles" value="{{ old('salida_miercoles') }}">
                                    @error('salida_miercoles')
                                    <br><div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </td>
                            </tr>
                            <tr>
                                <td>Jueves</td>
                                <td>
                                    <input type="time" class="form-control" name="entrada_jueves" id="entrada_jueves" value="{{ old('entrada_jueves') }}">
                                    @error('entrada_jueves')
                                    <br><div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </td>
                                <td>
                                    <input type="time" class="form-control" name="salida_jueves" id="salida_jueves" value="{{ old('salida_jueves') }}">
                                    @error('salida_jueves')
                                    <br><div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </td>
                            </tr>
                            <tr>
                                <td>Viernes</td>
                                <td>
                                    <input type="time" class="form-control" name="entrada_viernes" id="entrada_viernes" value="{{ old('entrada_viernes') }}">
                                    @error('entrada_viernes')
                                    <br><div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </td>
                                <td>
                                    <input type="time" class="form-control" name="salida_viernes" id="salida_viernes" value="{{ old('salida_viernes') }}">
                                    @error('salida_viernes')
                                    <br><div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </td>
                            </tr>
                            <tr>
                                <td>Sabado</td>
                                <td>
                                    <input type="time" class="form-control" name="entrada_sabado" id="entrada_sabado" value="{{ old('entrada_sabado') }}">
                                    @error('entrada_sabado')
                                    <br><div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </td>
                                <td>
                                    <input type="time" class="form-control" name="salida_sabado" id="salida_sabado" value="{{ old('salida_sabado') }}">
                                    @error('salida_sabado')
                                    <br><div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </td>
                            </tr>
                            <tr>
                                <td>Domingo</td>
                                <td>
                                    <input type="time" class="form-control" name="entrada_domingo" id="entrada_domingo" value="{{ old('entrada_domingo') }}">
                                    @error('entrada_domingo')
                                    <br><div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </td>
                                <td>
                                    <input type="time" class="form-control" name="salida_domingo" id="salida_domingo" value="{{ old('salida_domingo') }}">
                                    @error('salida_domingo')
                                    <br><div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </td>
                            </tr>
                            <tr>
                                <td>Festivos</td>
                                <td>
                                    <input type="time" class="form-control" name="entrada_festivo" id="entrada_festivo" value="{{ old('entrada_festivo') }}">
                                    @error('entrada_festivo')
                                    <br><div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </td>
                                <td>
                                    <input type="time" class="form-control" name="salida_festivo" id="salida_festivo" value="{{ old('salida_festivo') }}">
                                    @error('salida_festivo')
                                    <br><div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    
                    
                </div>

                <!-- -->

        <!-- ---------------------------------------------------------------------- --> 
            



        <!-- ---------------------------------------------------------------------- --> 



        <!-- ---------------------------------------------------------------------- --> 


        


        <!-- ---------------------------------------------------------------------- --> 
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-success btn-sm btn-info">REGISTRAR DATOS DE HORARIO</button>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@stop