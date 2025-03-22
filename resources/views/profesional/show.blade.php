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
    </div>
        <div class="card-footer">

        </div>
    </div>

    <!-- --------------------------------------------------------------- -->

    <div class="card mt-3">
        <div class="card-header"><strong>SUELDO</strong></div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-2">
                    <p><strong>SUELDO MENSUAL</strong></p>
                    $ {{ $sueldoMensual }}
                </div>
                <div class="col-md-2">
                    <p><strong>COMPENSACIONES</strong></p>
                    $ {{ $compensaciones }}
                </div>
                <div class="col-md-2">
                    <p><strong>PRESTACIONES MANDATO DE LEY</strong></p>
                    $ {{ $prestacionesMandatoLey }}
                </div>
                <div class="col-md-2">
                    <p><strong>PRESTACIONES CGT</strong></p>
                    $ {{ $prestacionesCgt }}
                </div>
                <div class="col-md-2">
                    <p><strong>ESTIMULOS</strong></p>
                    $ {{ $estimulos }}
                </div>
                <div class="col-md-2">
                    <p><strong>TOTAL</strong></p>
                    $ {{ $totalSueldo }}
                </div>
            </div>
        </div>
        <div class="card-footer"></div>
    </div>
</div>

    <!-- --------------------------------------------------------------- -->

    <!-- --------------------------------------------------------------- -->

    <div class="card mt-3">
        <div class="card-header"><strong>GRADO ACADEMICO</strong></div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-2">
                    <p><strong>GRADO ACADEMICO UNO</strong></p>
                    {{ $cveGradoUno }} - {{$gradoAcademicoUno}}
                </div>
                <div class="col-md-4">
                    <p><strong>TITULO</strong></p>
                    {{ $tituloUno }}
                </div>
                <div class="col-md-6">
                    <p><strong>INSTITUCIÓN EDUCATIVA</strong></p>
                    {{ $institucionEducativaUno }}
                </div>
                
            </div>

            <div class="row mt-3">
                <div class="col-md-2">
                    <p><strong>CEDULA</strong></p>
                    {{ $cedulaUno }} - {{ $numeroCedulaUno }}
                </div>
                <div class="col-md-10">
                    <p><strong>REGISTRO NACIONAL DE PROFESIONALES</strong></p>

                    @if($regNacProfUno != "")
                        <a href="javascript:void(0);" class="btn btn-info btn-sm openModal" id="openModal" data-pdf="{{ asset('storage/' . $regNacProfUno) }}">Abrir documento</a>
                    @endif
                    
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-md-2">
                    <p><strong>GRADO ACADEMICO DOS</strong></p>
                    {{ $cveGradoDos }} - {{$gradoAcademicoDos }}
                </div>
                <div class="col-md-4">
                    <p><strong>TITULO</strong></p>
                    {{ $tituloDos }}
                </div>
                <div class="col-md-6">
                    <p><strong>INSTITUCIÓN EDUCATIVA</strong></p>
                    {{ $institucionEducativaDos }}
                </div>
                
            </div>

            <div class="row mt-3">
                <div class="col-md-2">
                    <p><strong>CEDULA</strong></p>
                    {{ $cedulaDos }} - {{ $numeroCedulaDos }}
                </div>
                <div class="col-md-10">
                    <p><strong>REGISTRO NACIONAL DE PROFESIONALES</strong></p>

                    @if($regNacProfDos != "")
                        <a href="javascript:void(0);" class="btn btn-info btn-sm openModal" id="openModal" data-pdf="{{ asset('storage/' . $regNacProfDos) }}">Abrir documento</a>
                    @endif

                </div>
            </div>

        </div>
        <div class="card-footer"></div>
    </div>

    <!-- --------------------------------------------------------------- -->

    <div class="card mt-3">
        <div class="card-header"><strong>PERSONAL EN FORMACIÓN</strong></div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <p><strong>TIPO DE FORMACION</strong></p>
                    {{ $tipoFormacion }}
                </div>
                <div class="col-md-3">
                    <p><strong>CARRERA</strong></p>
                    {{ $carrera }}
                </div>
                <div class="col-md-3">
                    <p><strong>INSTITUCIÓN EDUCATIVA</strong></p>
                    {{ $carrera }}
                </div>
                <div class="col-md-3">
                    <p><strong>AÑO EN CURSO / DURACIÓN</strong></p>
                    {{ $anioCursa }} - {{ $duracionFormacion }}
                </div>
            </div>
        </div>
        <div class="card-footer"></div>
    </div>
    
    
    <!-- --------------------------------------------------------------- -->

    <div class="card mt-3">
        <div class="card-header"><strong>CERTIFICACIONES</strong></div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <p><strong>COLEGIACIÓN</strong></p>
                    {{ $colegiacion }}
                </div>
                <div class="col-md-4">
                    <p><strong>CERTIFICACION</strong></p>
                    {{ $certificacio }}
                </div>
                <div class="col-md-2">
                    <p><strong>IDIOMA</strong></p>
                    {{ $idioma }} - {{ $idiomaNivelDominio }}
                </div>
                <div class="col-md-2">
                    <p><strong>LENGUA INDIGENA</strong></p>
                    {{ $lenguaIndigena }} - {{ $lenguaIndigenaDominio }}
                </div>
            </div>
        </div>
        <div class="card-footer"></div>
    </div>
    
    
    <!-- --------------------------------------------------------------- -->

    <!-- Modal -->
<div class="modal fade" id="pdfModal" tabindex="-1" role="dialog" aria-labelledby="pdfModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="pdfModalLabel">Documento PDF</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!-- Aquí se insertará el iframe con el documento PDF -->
          <iframe id="pdfViewer" width="100%" height="700px" frameborder="0"></iframe>
        </div>
      </div>
    </div>
  </div>

@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>

    <script>
        $(document).ready(function() {
    // Cuando cualquiera de los enlaces con clase 'openModal' sea clickeado
    $('.openModal').click(function() {
        // Obtener la ruta del archivo PDF desde el atributo 'data-pdf'
        var pdfUrl = $(this).data('pdf');
        
        // Establecer la URL del PDF en el iframe
        $('#pdfViewer').attr('src', pdfUrl);
        
        // Mostrar el modal
        $('#pdfModal').modal('show');
    });

    // Limpiar el iframe cuando se cierre el modal
    $('#pdfModal').on('hidden.bs.modal', function () {
        $('#pdfViewer').attr('src', '');  // Limpiar el iframe
    });
});

    </script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JS (si no lo tienes) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
@stop