@extends('adminlte::page')

@section('title', 'Profesionales')

@section('content_header')
    <h1><strong>Profesionales</strong> <small>Perfil del Trabajador</small></h1>
@stop

@section('content')

<a href="{{ route('profesionalIndex') }}" class="btn btn-info btn-sm">PANEL DE CONTROL</a>
    

<div class="card mt-3">
    <div class="card-header">
        <strong>DATOS GENERALES</strong>
    </div>
    <div class="card-body">

        <div class="row">
            <div class="col-md-2">
                @if($fotoUrl)
                    <img src="{{ $fotoUrl }}" alt="Fotografía del profesional" width="200" class="img-thumbnail"/>
                @else
                    <p>No se ha cargado una fotografía.</p>
                @endif
            </div>
            <div class="col-md-10">

                <div class="row">
                    <div class="col-md-3">
                        <p><strong>CURP </strong></p>
                        {{ $profesional->curp }}
                    </div>
                    <div class="col-md-3">
                        <p><strong>RFC</strong></p>
                        {{ $profesional->rfc }} - {{ $profesional->homoclave }}
                    </div>
                    <div class="col-md-3">
                        <p><strong>Nombre completo </strong></p>
                        {{ $profesional->nombre }} {{ $profesional->apellido_paterno }} {{ $profesional->apellido_materno }}
                    </div>
                    <div class="col-md-3">
                        <p><strong>Fecha de nacimiento </strong></p>
                        {{ $profesional->fecha_nacimiento }} ( {{ $edad }} Años )
                    </div>
                </div>
        
                <div class="row mt-3">
                    <div class="col-md-3">
                        <p><strong>Sexo</strong></p>
                        {{ $profesional->sexo }}
                    </div>
                    <div class="col-md-3">
                        <p><strong>Nacionalidad</strong></p>
                        {{ $profesional->nacionalidad }}
                    </div>
                    <div class="col-md-3">
                        <p><strong>Nacimiento</strong></p>
                        {{ $profesional->pais_nacimiento }} - {{ $profesional->entidad_nacimiento }} - {{ $profesional->municipio_nacimiento }}
                    </div>
                    <div class="col-md-3">
                        <p><strong>Estado Conyugal</strong></p>
                        {{ $profesional->estado_conyugal }}
                    </div>
                </div>
        
                <div class="row mt-3">
                    <div class="col-md-3">
                        <p><strong>Teléfono de Casa</strong></p>
                        {{ $profesional->telefono_casa }}
                    </div>
                    <div class="col-md-3">
                        <p><strong>Celular</strong></p>
                        {{ $profesional->celular }}
                    </div>
                    <div class="col-md-3">
                        <p><strong>E-mail</strong></p>
                        {{ $profesional->email }}
                    </div>
                </div>

            </div>
        </div>
        

    </div>

    <!-- -- -->

    

    <!-- -- -->
    
    <div class="card-footer">
            
    </div>

</div>

    <!-- -- -->

    <div class="card">
        <div class="card-header"><strong>PUESTO</strong></div>
        <div class="card-body">

            <div class="row">
                <div class="col-md-3">
                    <p><strong>FIEL </strong></p>
                    {{ $fiel }} {{ $fiel_vigencia }}
                </div>
                <div class="col-md-6">
                    <p><strong>Actividad</strong></p>
                    {{ $actividad }}
                </div>
                <div class="col-md-3">
                    <p><strong>Adicional</strong></p>
                    {{ $adicional }}
                </div>
                
            </div>

            <div class="row mt-3">
                <div class="col-md-3">
                    <p><strong>Tipo de personal</strong></p>
                    {{ $tipoPersonal }}
                </div>
                <div class="col-md-3">
                    <p><strong>Código de puesto </strong></p>
                    {{ $codigoPuesto }}
                </div>
                <div class="col-md-6">
                    <p><strong>Actividad</strong></p>
                    {{ $actividad }}
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-3">
                    <p><strong>CLUES Nomina</strong></p>
                    {{ $cluesNomina }} <br> {{ $cluesNominaNombre }}
                </div>
                <div class="col-md-3">
                    <p><strong>Municipio</strong></p>
                    {{ $cluesNominaMunicipio }} <br> JURISDICCIÓN {{ $cluesNominaJurisdiccion }}
                </div>
                <div class="col-md-3">
                    <p><strong>CLUES Adscripción</strong></p>
                    {{ $cluesAdscripcion }} <br> {{ $cluesAdscripcionNombre }}
                </div>
                <div class="col-md-3">
                    <p><strong>Municipio</strong></p>
                    {{ $cluesNominaMunicipio }} <br> JURISDICCIÓN {{ $cluesNominaJurisdiccion }}
                </div>
            </div>

        </div>
        <div class="card-footer"></div>
    </div>

    <!-- -- -->

    <div class="card">
        <div class="card-header">
            <strong>HORARIO</strong>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <p><strong>Jornada</strong></p>
                    {{ $jornada }}
                </div>
                <div class="col-md-9">
                    <table class="table table-striped">
                        <tr>
                            <th><strong>DIA</strong></th>
                            <th><strong>ENTRADA</strong></th>
                            <th><strong>SALIDA</strong></th>
                        </tr>
                        <tr>
                            <th><strong>LUNES</strong></th>
                            <td>{{ $entradaLunes }}</td>
                            <td>{{ $salidaLunes }}</td>
                        </tr>
                        <tr>
                            <th><strong>MARTES</strong></th>
                            <td>{{ $entradaMartes }}</td>
                            <td>{{ $salidaMartes }}</td>
                        </tr>
                        <tr>
                            <th><strong>MIÉRCOLES</strong></th>
                            <td>{{ $entradaMiercoles }}</td>
                            <td>{{ $salidaMiercoles }}</td>
                        </tr>
                        <tr>
                            <th><strong>JUEVES</strong></th>
                            <td>{{ $entradaJueves }}</td>
                            <td>{{ $salidaJueves }}</td>
                        </tr>
                        <tr>
                            <th><strong>VIERNES</strong></th>
                            <td>{{ $entradaViernes }}</td>
                            <td>{{ $salidaViernes }}</td>
                        </tr>
                        <tr>
                            <th><strong>SÁBADO</strong></th>
                            <td>{{ $entradaSabado }}</td>
                            <td>{{ $salidaSabado }}</td>
                        </tr>
                        <tr>
                            <th><strong>DOMINGO</strong></th>
                            <td>{{ $entradaDomingo }}</td>
                            <td>{{ $salidaDomingo }}</td>
                        </tr>
                        <tr>
                            <th><strong>FESTIVO</strong></th>
                            <td>{{ $entradaFestivo }}</td>
                            <td>{{ $salidaFestivo }}</td>
                        </tr>
                        
                    </table>
                </div>
        </div>
        <div class="card-footer">

        </div>
    </div>

@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop