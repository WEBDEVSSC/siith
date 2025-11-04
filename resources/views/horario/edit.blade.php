@extends('adminlte::page')

@section('title', 'Horario')

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
        </div>

        <form action="{{ route('updateHorario', $horario->id) }}" method="POST">

        @csrf 

        @method('PUT')

        <input type="hidden" name="id_profesional" value="{{ $profesional->id }}">
            
            <div class="card-body">

                <!-- ---------------------------------- -->

                <div class="row mt-3">

                    <div class="col-md-4">
                        <p><strong>Jornada</strong></p>
                        <select name="jornada" id="jornada" class="form-control">
                            <option value="">-- Selecciona una opción --</option>
                            @foreach ($jornadas as $jornada)
                                <option value="{{ $jornada->id }}" 
                                    {{ (old('jornada', $horario->id_jornada) == $jornada->id) ? 'selected' : '' }}>
                                    {{ $jornada->jornada }}
                                </option>
                            @endforeach
                        </select>
                        
                        @error('jornada')
                            <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <p><strong>Entrada</strong></p>
                        <input type="time" class="form-control" name="horario_entrada" id="horario_entrada" value="{{ old('horario_entrada') }}">
                        @error('horario_entrada')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <p><strong>Salida</strong></p>
                        <input type="time" class="form-control" name="horario_salida" id="horario_salida" value="{{ old('horario_salida') }}">
                        @error('horario_salida')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                {{--------------------------------------------------------------------------------------------------------------------------------------}}
                {{-- CAMPOS OCULTOS PARA EL ROLADOR --}}
                {{--------------------------------------------------------------------------------------------------------------------------------------}}

                <div id="campos-rolador" class="row mt-3" style="display: none;">

                
                <div class="col-md-12">
                    
                    
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
                                    <input type="time" class="form-control" name="entrada_lunes" id="entrada_lunes" value="{{ old('entrada_lunes', $horario->entrada_lunes ? date('H:i', strtotime($horario->entrada_lunes)) : '') }}">
                                    @error('entrada_lunes')
                                    <br><div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </td>
                               
                                <td>
                                    <input type="time" class="form-control" name="salida_lunes" id="salida_lunes" value="{{ old('salida_lunes', $horario->salida_lunes ? date('H:i', strtotime($horario->salida_lunes)) : '') }}">
                                    @error('salida_lunes')
                                    <br><div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </td>
                            </tr>
                            <tr>
                                <td>Martes</td>
                                <td>
                                    <input type="time" class="form-control" name="entrada_martes" id="entrada_martes" value="{{ old('entrada_martes', $horario->entrada_martes ? date('H:i', strtotime($horario->entrada_martes)) : '') }}">
                                    @error('entrada_martes')
                                    <br><div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </td>
                                <td>
                                    <input type="time" class="form-control" name="salida_martes" id="salida_martes" value="{{ old('salida_martes', $horario->salida_martes ? date('H:i', strtotime($horario->salida_martes)) : '') }}">
                                    @error('salida_martes')
                                    <br><div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </td>
                            </tr>
                            <tr>
                                <td>Miercoles</td>
                                <td>
                                    <input type="time" class="form-control" name="entrada_miercoles" id="entrada_miercoles" value="{{ old('entrada_miercoles', $horario->entrada_miercoles ? date('H:i', strtotime($horario->entrada_miercoles)) : '') }}">
                                    @error('entrada_miercoles')
                                    <br><div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </td>
                                <td>
                                    <input type="time" class="form-control" name="salida_miercoles" id="salida_miercoles" value="{{ old('salida_miercoles', $horario->salida_miercoles ? date('H:i', strtotime($horario->salida_miercoles)) : '') }}">
                                    @error('salida_miercoles')
                                    <br><div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </td>
                            </tr>
                            <tr>
                                <td>Jueves</td>
                                <td>
                                    <input type="time" class="form-control" name="entrada_jueves" id="entrada_jueves" value="{{ old('entrada_jueves', $horario->entrada_jueves ? date('H:i', strtotime($horario->entrada_jueves)) : '') }}">
                                    @error('entrada_jueves')
                                    <br><div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </td>
                                <td>
                                    <input type="time" class="form-control" name="salida_jueves" id="salida_jueves" value="{{ old('salida_jueves', $horario->salida_jueves ? date('H:i', strtotime($horario->salida_jueves)) : '') }}">
                                    @error('salida_jueves')
                                    <br><div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </td>
                            </tr>
                            <tr>
                                <td>Viernes</td>
                                <td>
                                    <input type="time" class="form-control" name="entrada_viernes" id="entrada_viernes" value="{{ old('entrada_viernes', $horario->entrada_viernes ? date('H:i', strtotime($horario->entrada_viernes)) : '') }}">
                                    @error('entrada_viernes')
                                    <br><div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </td>
                                <td>
                                    <input type="time" class="form-control" name="salida_viernes" id="salida_viernes" value="{{ old('salida_viernes', $horario->salida_viernes ? date('H:i', strtotime($horario->salida_viernes)) : '') }}">
                                    @error('salida_viernes')
                                    <br><div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </td>
                            </tr>
                            <tr>
                                <td>Sabado</td>
                                <td>
                                    <input type="time" class="form-control" name="entrada_sabado" id="entrada_sabado" value="{{ old('entrada_sabado', $horario->entrada_sabado ? date('H:i', strtotime($horario->entrada_sabado)) : '') }}">
                                    @error('entrada_sabado')
                                    <br><div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </td>
                                <td>
                                    <input type="time" class="form-control" name="salida_sabado" id="salida_sabado" value="{{ old('salida_sabado', $horario->salida_sabado ? date('H:i', strtotime($horario->salida_sabado)) : '') }}">
                                    @error('salida_sabado')
                                    <br><div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </td>
                            </tr>
                            <tr>
                                <td>Domingo</td>
                                <td>
                                    <input type="time" class="form-control" name="entrada_domingo" id="entrada_domingo" value="{{ old('entrada_domingo', $horario->entrada_domingo ? date('H:i', strtotime($horario->entrada_domingo)) : '') }}">
                                    @error('entrada_domingo')
                                    <br><div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </td>
                                <td>
                                    <input type="time" class="form-control" name="salida_domingo" id="salida_domingo" value="{{ old('salida_domingo', $horario->salida_domingo ? date('H:i', strtotime($horario->salida_domingo)) : '') }}">
                                    @error('salida_domingo')
                                    <br><div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </td>
                            </tr>
                            <tr>
                                <td>Festivos</td>
                                <td>
                                    <input type="time" class="form-control" name="entrada_festivo" id="entrada_festivo" value="{{ old('entrada_festivo', $horario->entrada_festivo ? date('H:i', strtotime($horario->entrada_festivo)) : '') }}">
                                    @error('entrada_festivo')
                                    <br><div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </td>
                                <td>
                                    <input type="time" class="form-control" name="salida_festivo" id="salida_festivo" value="{{ old('salida_festivo', $horario->salida_festivo ? date('H:i', strtotime($horario->salida_festivo)) : '') }}">
                                    @error('salida_festivo')
                                    <br><div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    
                    
                </div>

                </div>

        <!-- ---------------------------------------------------------------------- --> 
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-success btn-sm btn-info">ACTUALIZAR DATOS DE HORARIO</button>
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

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const selectJornada = document.getElementById('jornada');
            const camposRolador = document.getElementById('campos-rolador');

            // Función para mostrar u ocultar
            function toggleCamposRolador() {
                const textoSeleccionado = selectJornada.options[selectJornada.selectedIndex].text;
                if (textoSeleccionado.toLowerCase().includes('rolador')) {
                    camposRolador.style.display = 'flex';
                } else {
                    camposRolador.style.display = 'none';
                }
            }

            // Escuchar el cambio
            selectJornada.addEventListener('change', toggleCamposRolador);

            // Verificar si ya está seleccionado al cargar la página
            toggleCamposRolador();
        });
    </script>
@stop