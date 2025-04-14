<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte Profesional</title>
    <style>
        body { font-family: Arial, sans-serif; }
        h1 { color: #333; }
        p { font-size: 10px; }

        table {
            margin: 0px; /* Agrega margen alrededor de la tabla */
            border-collapse: collapse; /* Para que los bordes no se dupliquen */
            width: 100%; /* Ajusta el ancho de la tabla */
        }
        
        td, th {
            padding: 1px; /* Menos espaciado interno para hacer las filas más delgadas */
            /*border: 0.5px solid #000000; /* Bordes para mejor visibilidad */
            text-align: center; /* Alineación del texto */
            vertical-align: middle; /* Alineación vertical del texto en la parte superior */
        }

        .centered {
            text-align: center; /* Centra el contenido de las celdas */
        }

        .header-row {
            background-color: #f2f2f2; /* Color de fondo para la fila del encabezado */
        }

        .img-thumbnail {
            border-radius: 8px; /* Redondear bordes de la imagen */
        }

        .page-break {
            page-break-before: always; /* Fuerza el salto de página antes del elemento */
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
        <tr>
            <td>
                <h3>Secretaría de Salud del Estado de Coahuila de Zaragoza</h3>
                <h3>Subdirección de Recursos Humanos</h3>
                <h4>Expediente Digital del Trabajador</h4>
            </td>
            <td class="centered">
                @if($fotoBase64)
                    <img src="{{ $fotoBase64 }}" alt="Fotografía del profesional" width="150" class="img-thumbnail"/>
                @else
                    <p>No se ha cargado una fotografía.</p>
                @endif
            </td>
        </tr>
    </table>

    <h5><strong>DATOS GENERALES</strong></h5>

    <table>
        <tr class="header-row">
            <td style="width: 10%;"><p><strong>NOMBRE COMPLETO</strong></p></td>
            <td style="width: 5%;"><p><strong>CURP</strong></p></td>
            <td style="width: 5%;"><p><strong>RFC</strong></p></td>
            <td style="width: 5%;"><p><strong>SEXO</strong></p></td>
            <td style="width: 5%;"><p><strong>FECHA DE NACIMIENTO</strong></p></td>
        </tr>
        <tr>
            <td><p>{{ $profesional->nombre }} {{ $profesional->apellido_paterno }} {{ $profesional->apellido_materno }}</p></td>
            <td><p>{{ $profesional->curp }}</p></td>
            <td><p>{{ $profesional->rfc }}-{{ $profesional->homoclave }}</p></td>
            <td><p>{{ $profesional->sexo }}</p></td>
            <td><p>{{ $profesional->fecha_nacimiento }}</p></td>
        </tr>
    </table>
    <table>
        <tr class="header-row">
            <td><p><strong>ENTIDAD DE NACIMIENTO</strong></p></td>
            <td><p><strong>MUNICIPIO DE NACIMIENTO</strong></p></td>
            <td><p><strong>PAIS</strong></p></td>
            <td><p><strong>NACIONALIDAD</strong></p></td>
            <td><p><strong>ESTADO CONYUGAL</strong></p></td>
            
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
            <td><p><strong>TELEFONO DE CASA</strong></p></td>
            <td><p><strong>CELULAR</strong></p></td>
            <td><p><strong>EMAIL</strong></p></td>
        </tr>
        <tr>
            <td><p>{{ $profesional->telefono_casa }}</p></td>
            <td><p>{{ $profesional->celular }}</p></td>
            <td><p>{{ $profesional->email }}</p></td>
        </tr>
    </table>

    <h5><strong>DATOS DE PUESTO</strong></h5>

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
            <td style="width: 15%;"><p><strong>CLUES NOMINA</strong></p></td>
            <td style="width: 15%;"><p><strong>CLUES ADSCRIPCION</strong></p></td>
        </tr>
        <tr>
            <td><p>{{ $profesional->puesto->clues_nomina }} {{ $profesional->puesto->clues_nomina_nombre }}</p></td>
            <td><p>{{ $profesional->puesto->clues_adscripcion }} {{ $profesional->puesto->clues_adscripcion_nombre }}</p></td>
        </tr>
    </table>

    <table>
        <tr class="header-row">
            <td style="width: 5%;"><p><strong>MUNICIPIO</strong></p></td>
            <td style="width: 5%;"><p><strong>JURISDICCION</strong></p></td>
            <td style="width: 5%;"><p><strong>MUNICIPIO</strong></p></td>
            <td style="width: 5%;"><p><strong>JURISDICCION</strong></p></td>
        </tr>
        <tr>
            <td><p>{{ $profesional->puesto->clues_nomina_municipio }}</p></td>
            <td><p>{{ $profesional->puesto->clues_nomina_jurisdiccion }}</p></td>
            <td><p>{{ $profesional->puesto->clues_adscripcion_municipio }}</p></td>
            <td><p>{{ $profesional->puesto->clues_adscripcion_jurisdiccion }}</p></td>
        </tr>
    </table>

    <table>
        <tr class="header-row">
            <td style="width: 5%;"><p><strong>AREA</strong></p></td>
            <td style="width: 5%;"><p><strong>OCUPACION</strong></p></td>
            <td style="width: 5%;"><p><strong>NOMINA</strong></p></td>
            <td style="width: 5%;"><p><strong>TIPO DE CONTRATO</strong></p></td>
            <td style="width: 5%;"><p><strong>FECHA DE INGRESO</strong></p></td>
        </tr>
        <tr>
            <td><p>{{ $profesional->puesto->area_trabajo }}</p></td>
            <td><p>{{ $profesional->puesto->ocupacion }}</p></td>
            <td><p>{{ $profesional->puesto->nomina_pago }}</p></td>
            <td><p>{{ $profesional->puesto->tipo_contrato }}</p></td>
            <td><p>{{ $profesional->puesto->fecha_ingreso }}</p></td>
        </tr>
    </table>

    <table>
        <tr class="header-row">
            <td style="width: 5%;"><p><strong>TIPO DE PLAZA</strong></p></td>
            <td style="width: 5%;"><p><strong>INSTITUCION</strong></p></td>
            <td style="width: 5%;"><p><strong>VIGENCIA</strong></p></td>
            <td style="width: 5%;"><p><strong>TEMPORALIDAD</strong></p></td>
            <td style="width: 5%;"><p><strong>LICENCIA DE MATERNIDAD</strong></p></td>
            <td style="width: 5%;"><p><strong>SEGURO DE SALUD</strong></p></td>
        </tr>
        <tr>
            <td><p>{{ $profesional->puesto->tipo_plaza }}</p></td>
            <td><p>{{ $profesional->puesto->institucion_puesto }}</p></td>
            <td><p>{{ $profesional->puesto->vigencia }} - {{ $profesional->puesto->vigencia_motivo }}</p></td>
            <td><p>{{ $profesional->puesto->temporalidad }}</p></td>
            <td><p>{{ $profesional->puesto->licencia_maternidad }}</p></td>
            <td><p>{{ $profesional->puesto->seguro_salud }}</p></td>
        </tr>
    </table>

    <div class="page-break"></div>

    <h5><strong>JORNADA LABORAL</strong></h5>

    <table>
        <tr class="header-row">
            <td style="width: 5%;"><p><strong>TIPO</strong></p></td>
        </tr>
        <tr>
            <td><p>{{ $profesional->horario?->jornada }}</p></td>
        </tr>
    </table>

    <table>
        <tr class="header-row">
            <td style="width: 5%;"><p><strong></strong></p></td>
            <td style="width: 5%;"><p><strong>ENTRADA</strong></p></td>
            <td style="width: 5%;"><p><strong>SALIDA</strong></p></td>
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

</body>
</html>
