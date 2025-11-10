<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte Profesional</title>
    <style>
        body {
            font-family: "Segoe UI", sans-serif;
            font-size: 10px;
            color: #333;
            margin: 5px;
            line-height: 1.4;
        }

        h1, h2, h3, h4 {
            color: #2c3e50;
            margin-bottom: 5px;
            text-align: center;
        }

        h4 {
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        p {
            margin: 3px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5px;
            margin-bottom: 15px;
        }

        th, td {
            padding: 5px 8px;
            border: 0.5px solid #bbb;
            vertical-align: top;
        }

        th {
            background-color: #f2f2f2;
            text-align: left;
            font-weight: bold;
            font-size: 10px;
        }

        td {
            font-size: 10px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header img {
            border-radius: 6px;
            border: 1px solid #ccc;
        }

        .section-title {
            background-color: #ede7f6; /* morado claro */
            padding: 6px;
            font-weight: bold;
            border: 1px solid #b39ddb; /* tono morado medio */
            text-transform: uppercase;
            font-size: 12px;
            margin-top: 20px;
        }

        .page-break {
            page-break-before: always;
        }

        .no-border td {
            border: none;
        }

        .header-cell {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        
    </style>
</head>
<body>
    <!-- ---------------------------------------------- -->
    <!-- ---------------------------------------------- -->
    <!--           MODULO DE DATOS GENERALES            -->
    <!-- ---------------------------------------------- -->
    <!-- ---------------------------------------------- -->

    <table>
        <tr class="header-row">
            <td>
                <h4>SECRETARÍA DE SALUD DE COAHUILA DE ZARAGOZA <br> SUBDIRECCIÓN DE RECURSOS HUMANOS <br> EXPEDIENTE DIGITAL DEL TRABAJADOR</h4>
            </td>
            <td class="centered">
                <img src="{{ $fotoPath }}" alt="Fotografía del profesional" style="max-width:200px; height:auto;" class="img-thumbnail">
            </td>
            
        </tr>
    </table>

    <div class="section-title">DATOS GENERALES</div>

    <table>
        <tr class="header-row">
            <td class="header-cell" style="width: 20%;"><p><strong>NOMBRE COMPLETO</strong></p></td>
            <td class="header-cell" style="width: 10%;"><p><strong>CURP</strong></p></td>
            <td class="header-cell" style="width: 10%;"><p><strong>RFC</strong></p></td>
            <td class="header-cell" style="width: 10%;"><p><strong>SEXO</strong></p></td>
            <td class="header-cell" style="width: 10%;"><p><strong>NACIMIENTO</strong></p></td>
        </tr>
        <tr>
            <td><p>{{ $profesional->nombre }} {{ $profesional->apellido_paterno }} {{ $profesional->apellido_materno }}</p></td>
            <td><p>{{ $profesional->curp }}</p></td>
            <td><p>{{ $profesional->rfc }}-{{ $profesional->homoclave }}</p></td>
            <td><p>
                @if ($profesional->sexo == 'M')
                    MASCULINO
                @else
                    FEMENINO
                @endif
                </p>
            </td>
            <td><p>{{ $profesional->fecha_nacimiento }}</p></td>
        </tr>
    </table>
    <table>
        <tr class="header-row">
            <td class="header-cell" ><p><strong>ENTIDAD DE NACIMIENTO</strong></p></td>
            <td class="header-cell" ><p><strong>MUNICIPIO DE NACIMIENTO</strong></p></td>
            <td class="header-cell" ><p><strong>PAIS</strong></p></td>
            <td class="header-cell" ><p><strong>NACIONALIDAD</strong></p></td>
            <td class="header-cell" ><p><strong>ESTADO CONYUGAL</strong></p></td>
            
        </tr>
        <tr>
            <td><p>{{ $profesional->entidad_nacimiento }}</p></td>
            <td><p>{{ $profesional->municipio_nacimiento }}</p></td>
            <td><p>{{ $profesional->pais_nacimiento }}</p></td>
            <td><p>{{ $profesional->nacionalidad }}</p></td>
            <td><p>{{ $profesional->estado_conyugal }}</p></td>
            
        </tr>
    </table>
    <table>
        <tr class="header-row">
            <td class="header-cell" ><p><strong>TELEFONO DE CASA</strong></p></td>
            <td class="header-cell" ><p><strong>CELULAR</strong></p></td>
            <td class="header-cell" ><p><strong>EMAIL</strong></p></td>
            <td class="header-cell" ><p><strong>PADRE / MADRE FAMILIA</strong></p></td>
        </tr>
        <tr>
            <td><p>{{ $profesional->telefono_casa }}</p></td>
            <td><p>{{ $profesional->celular }}</p></td>
            <td><p>{{ Str::upper($profesional->email) }}</p></td>
            <td><p>{{ $profesional->padre_madre_familia }}</p></td>

        </tr>
    </table>

    <div class="section-title">DATOS DE PUESTO</div>

    <table>
        <tr class="header-row">
            <td style="width: 4%;"><p><strong>FIEL</strong></p></td>
            <td style="width: 5%;"><p><strong>ACTIVIDAD</strong></p></td>
            <td style="width: 5%;"><p><strong>ADICIONAL</strong></p></td>
            <td style="width: 5%;"><p><strong>TIPO DE PERSONAL</strong></p></td>
            <td style="width: 5%;"><p><strong>CODIGO DE PUESTO</strong></p></td>
        </tr>
        <tr>
            <td><p>{{ $profesional->puesto->fiel }} {{ $profesional->puesto->fiel_vigencia }}</p></td>
            <td><p>{{ $profesional->puesto->actividad }}</p></td>
            <td><p>{{ $profesional->puesto->adicional }}</p></td>
            <td><p>{{ $profesional->puesto->tipo_personal }}</p></td>
            <td><p>{{ $profesional->puesto->codigo_puesto }}</p></td>
        </tr>
    </table>

    <table>
        <tr class="header-row">
            <td class="header-cell" style="width: 50%;"><p><strong>CLUES NOMINA</strong></p></td>
            <td class="header-cell" style="width: 50%;"><p><strong>CLUES ADSCRIPCION</strong></p></td>
            
        </tr>
        <tr>
            <td><p>J.{{ $profesional->puesto->clues_nomina_jurisdiccion }} - {{ $profesional->puesto->clues_nomina_municipio }} - {{ $profesional->puesto->clues_nomina }} - {{ $profesional->puesto->clues_nomina_nombre }}</p></td>
            <td><p>J.{{ $profesional->puesto->clues_adscripcion_jurisdiccion }} - {{ $profesional->puesto->clues_adscripcion_municipio }} - {{ $profesional->puesto->clues_adscripcion }} - {{ $profesional->puesto->clues_adscripcion_nombre }}</p></td>
        </tr>
    </table>

    <table>
        <tr class="header-row">
            <td class="header-cell" style="width: 5%;"><p><strong>AREA</strong></p></td>
            <td class="header-cell" style="width: 5%;"><p><strong>OCUPACION</strong></p></td>
        </tr>
        <tr>
            <td><p>{{ $profesional->puesto->area_trabajo }}</p></td>
            <td><p>{{ $profesional->puesto->ocupacion }}</p></td>
        </tr>
    </table>

    <table>
        <tr class="header-row">
            <td class="header-cell" style="width: 10%;"><p><strong>NOMINA</strong></p></td>
            <td class="header-cell" style="width: 5%;"><p><strong>CONTRATO</strong></p></td>
            <td class="header-cell" style="width: 5%;"><p><strong>INGRESO</strong></p></td>
            <td class="header-cell" style="width: 5%;"><p><strong>TIPO DE PLAZA</strong></p></td>
            <td class="header-cell" style="width: 5%;"><p><strong>INSTITUCION</strong></p></td>
            <td class="header-cell" style="width: 5%;"><p><strong>SEG. DE SALUD</strong></p></td>
        </tr>
        <tr>
            <td><p>{{ $profesional->puesto->nomina_pago }}</p></td>
            <td><p>{{ $profesional->puesto->tipo_contrato }}</p></td>
            <td><p>{{ $profesional->puesto->fecha_ingreso }}</p></td>
            <td><p>{{ $profesional->puesto->tipo_plaza }}</p></td>
            <td><p>{{ $profesional->puesto->institucion_puesto }}</p></td>
            <td><p>{{ $profesional->puesto->seguro_salud }}</p></td>
        </tr>
    </table>

    <table>
        <tr class="header-row">
            <td class="header-cell" style="width: 20%;"><p><strong>VIGENCIA</strong></p></td>
            <td class="header-cell" style="width: 80%;"><p><strong>MOTIVO</strong></p></td>
        </tr>
        <tr>

            <td><p>{{ $profesional->puesto->vigencia }}</p></td>
            <td><p>{{ $profesional->puesto->vigencia_motivo }}</p></td>
            
        </tr>
    </table>

    <table>
        <tr class="header-row">
            <td class="header-cell" style="width: 5%;"><p><strong>CATALOGO / CARTERA DE SERVICIOS</strong> : {{ $catalogoLabel  }}</p></td>
        </tr>
        <tr>

            <td><p>{{ $ocupacionLabel }}</p></td>
            
        </tr>
    </table>

    <div class="page-break"></div>

    <div class="section-title">JORNADA LABORAL</div>

    <table>
        <tr class="header-row">
            <td  class="header-cell" style="width: 5%;"><p><strong>TIPO</strong></p></td>
        </tr>
        <tr>
            <td><p>{{ Str::upper($profesional->horario?->jornada) }}</p></td>
        </tr>
    </table>

    <table>
        <tr class="header-row">
            <td class="header-cell"  style="width: 5%;"><p><strong></strong></p></td>
            <td class="header-cell"  style="width: 5%;"><p><strong>ENTRADA</strong></p></td>
            <td class="header-cell"  style="width: 5%;"><p><strong>SALIDA</strong></p></td>
        </tr>
        <tr>
            <td><p>LUNES</p></td>
            <td><p>{{ $profesional->horario?->entrada_lunes }}</p></td>
            <td><p>{{ $profesional->horario?->salida_lunes }}</p></td>
        </tr>
        <tr>
            <td><p>MARTES</p></td>
            <td><p>{{ $profesional->horario?->entrada_martes }}</p></td>
            <td><p>{{ $profesional->horario?->salida_martes }}</p></td>
        </tr>
        <tr>
            <td><p>MIERCOLES</p></td>
            <td><p>{{ $profesional->horario?->entrada_miercoles }}</p></td>
            <td><p>{{ $profesional->horario?->salida_miercoles }}</p></td>
        </tr>
        <tr>
            <td><p>JUEVES</p></td>
            <td><p>{{ $profesional->horario?->entrada_jueves }}</p></td>
            <td><p>{{ $profesional->horario?->salida_jueves }}</p></td>
        </tr>
        <tr>
            <td><p>VIERNES</p></td>
            <td><p>{{ $profesional->horario?->entrada_viernes }}</p></td>
            <td><p>{{ $profesional->horario?->salida_viernes }}</p></td>
        </tr>
        <tr>
            <td><p>SABADO</p></td>
            <td><p>{{ $profesional->horario?->entrada_sabado }}</p></td>
            <td><p>{{ $profesional->horario?->salida_sabado }}</p></td>
        </tr>
        <tr>
            <td><p>DOMINGO</p></td>
            <td><p>{{ $profesional->horario?->entrada_domingo }}</p></td>
            <td><p>{{ $profesional->horario?->salida_domingo }}</p></td>
        </tr>
        <tr>
            <td><p>FESTIVOS</p></td>
            <td><p>{{ $profesional->horario?->entrada_festivo }}</p></td>
            <td><p>{{ $profesional->horario?->salida_festivo }}</p></td>
        </tr>
    </table>

    <div class="section-title">GRADO ACADEMICO</div>

    <table>
        <tr class="header-row">
            <td class="header-cell" style="width: 20%;"><p><strong>NIVEL</strong></p></td>
            <td style="width: 40%;"><p><strong>TITULO</strong></p></td>
            <td style="width: 40%;"><p><strong>INSTITUCION EDUCATIVA</strong></p></td>
        </tr>
        <tr>
            <td><p>{{ $profesional->gradoAcademico?->grado_academico_uno }}</p></td>
            <td><p>{{ $profesional->gradoAcademico?->titulo_uno }}</p></td>
            <td><p>{{ $profesional->gradoAcademico?->institucion_educativa_uno }}</p></td>
        </tr>
    </table>

    <table>
        <tr class="header-row">
            <td class="header-cell" style="width: 30%;"><p><strong>CEDULA</strong></p></td>
            <td style="width: 70%;"><p><strong>OBSERVACIONES</strong></p></td>
        </tr>
        <tr>
            <td><p>{{ $profesional->gradoAcademico?->cedula_uno }} - {{$profesional->gradoAcademico?->numero_cedula_uno }}</p></td>
            <td><p>{{ $profesional->gradoAcademico?->observaciones_uno }}</p></td>
        </tr>
    </table>

    <table>
        <tr class="header-row">
            <td class="header-cell" style="width: 20%;"><p><strong>NIVEL</strong></p></td>
            <td style="width: 40%;"><p><strong>TITULO</strong></p></td>
            <td style="width: 40%;"><p><strong>INSTITUCION EDUCATIVA</strong></p></td>
        </tr>
        <tr>
            <td><p>{{ $profesional->gradoAcademico?->grado_academico_dos }}</p></td>
            <td><p>{{ $profesional->gradoAcademico?->titulo_dos }}</p></td>
            <td><p>{{ $profesional->gradoAcademico?->institucion_educativa_dos }}</p></td>
        </tr>
    </table>

    <table>
        <tr class="header-row">
            <td class="header-cell" style="width: 30%;"><p><strong>CEDULA</strong></p></td>
            <td style="width: 70%;"><p><strong>OBSERVACIONES</strong></p></td>
        </tr>
        <tr>
            <td><p>{{ $profesional->gradoAcademico?->cedula_dos }} - {{$profesional->gradoAcademico?->numero_cedula_dos }}</p></td>
            <td><p>{{ $profesional->gradoAcademico?->observaciones_dos }}</p></td>
        </tr>
    </table>

    <table>
        <tr class="header-row">
            <td class="header-cell" style="width: 20%;"><p><strong>NIVEL</strong></p></td>
            <td style="width: 40%;"><p><strong>TITULO</strong></p></td>
            <td style="width: 40%;"><p><strong>INSTITUCION EDUCATIVA</strong></p></td>
        </tr>
        <tr>
            <td><p>{{ $profesional->gradoAcademico?->grado_academico_tres }}</p></td>
            <td><p>{{ $profesional->gradoAcademico?->titulo_tres }}</p></td>
            <td><p>{{ $profesional->gradoAcademico?->institucion_educativa_tres }}</p></td>
        </tr>
    </table>

    <table>
        <tr class="header-row">
            <td class="header-cell" style="width: 30%;"><p><strong>CEDULA</strong></p></td>
            <td style="width: 70%;"><p><strong>OBSERVACIONES</strong></p></td>
        </tr>
        <tr>
            <td><p>{{ $profesional->gradoAcademico?->cedula_tres }} - {{$profesional->gradoAcademico?->numero_cedula_tres }}</p></td>
            <td><p>{{ $profesional->gradoAcademico?->observaciones_tres }}</p></td>
        </tr>
    </table>

    <table>
        <tr class="header-row">
            <td class="header-cell" style="width: 20%;"><p><strong>NIVEL</strong></p></td>
            <td style="width: 40%;"><p><strong>TITULO</strong></p></td>
            <td style="width: 40%;"><p><strong>INSTITUCION EDUCATIVA</strong></p></td>
        </tr>
        <tr>
            <td><p>{{ $profesional->gradoAcademico?->grado_academico_cuatro }}</p></td>
            <td><p>{{ $profesional->gradoAcademico?->titulo_cuatro }}</p></td>
            <td><p>{{ $profesional->gradoAcademico?->institucion_educativa_cuatro }}</p></td>
        </tr>
    </table>

    <table>
        <tr class="header-row">
            <td class="header-cell" style="width: 30%;"><p><strong>CEDULA</strong></p></td>
            <td style="width: 70%;"><p><strong>OBSERVACIONES</strong></p></td>
        </tr>
        <tr>
            <td><p>{{ $profesional->gradoAcademico?->cedula_cuatro }} - {{$profesional->gradoAcademico?->numero_cedula_cuatro }}</p></td>
            <td><p>{{ $profesional->gradoAcademico?->observaciones_cuatro }}</p></td>
        </tr>
    </table>

</body>
</html>
