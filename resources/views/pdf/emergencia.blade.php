<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte Profesional</title>
    <style>
        body {
            font-family: "Helvetica", Arial, sans-serif;
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
    </style>
</head>
<body>

    <!-- ENCABEZADO -->
    <div class="header">
        <h4>SECRETARÍA DE SALUD DE COAHUILA DE ZARAGOZA</h4>
        <p><strong>SUBDIRECCIÓN DE RECURSOS HUMANOS</strong></p>
        <p>FORMULARIO DE CONTACTO DE EMERGENCIA</p>
    </div>

    <table class="no-border">
        <tr>
            <td width="70%">
                <p><strong>Nombre:</strong> {{ $profesional->nombre }} {{ $profesional->apellido_paterno }} {{ $profesional->apellido_materno }}</p>
                <p><strong>CURP:</strong> {{ $profesional->curp }}</p>
                <p><strong>Celular:</strong> {{ $profesional->telefono_celular }}</p>
                <p><strong>Correo:</strong> {{ $profesional->email }}</p>
            </td>
            <td class="centered">
                @if($fotoBase64)
                    <img src="{{ $fotoBase64 }}" alt="Fotografía del profesional" width="140"/>
                @else
                    <p>No se ha cargado una fotografía.</p>
                @endif
            </td>
        </tr>
    </table>

    <!-- DATOS MÉDICOS -->
    <div class="section-title">Datos Médicos</div>
    <table>
        <tr><th>Tipo de Sangre</th><td>{{ $profesional->emergencia->tipo_sangre }}</td></tr>
        <tr><th>Alergias</th><td>{{ $profesional->emergencia->tipo_alergia }}</td></tr>
        <tr><th>Descripción</th><td>{{ $profesional->emergencia->alergia_descripcion }}</td></tr>
        <tr><th>Enfermedades Preexistentes</th><td>{{ $profesional->emergencia->enfermedad }}</td></tr>
        <tr><th>Medicamentos</th><td>{{ $profesional->emergencia->medicamentos }}</td></tr>
        <tr><th>Tratamiento Médico Actual</th><td>{{ $profesional->emergencia->tratamiento }}</td></tr>
    </table>

    <!-- MÉDICO DE CABECERA -->
    <div class="section-title">Médico de Cabecera</div>
    <table>
        <tr><th>Nombre</th><td>{{ $profesional->emergencia->medico_nombre }}</td></tr>
        <tr><th>Teléfono</th><td>{{ $profesional->emergencia->medico_telefono }}</td></tr>
    </table>

    <!-- CONTACTOS DE EMERGENCIA -->
    <div class="section-title">Contactos en Caso de Emergencia</div>
    <table>
        <tr><th width="20%">Nombre</th><td>{{ $profesional->emergencia->emergencia_nombre_uno }}</td></tr>
        <tr><th width="20%">Parentesco</th><td>{{ $profesional->emergencia->emergencia_relacion_uno }}</td></tr>
        <tr><th width="20%">Contacto</th><td>{{ $profesional->emergencia->emergencia_telefono_uno_uno }} {{ $profesional->emergencia->emergencia_telefono_dos_uno }} | {{ $profesional->emergencia->emergencia_email_uno }}</td></tr> 
        <tr><th width="20%">Dirección</th><td>{{ $profesional->emergencia->emergencia_calle_uno }} {{ $profesional->emergencia->emergencia_numero_uno }}, C.P. {{ $profesional->emergencia->emergencia_codigo_postal_uno }} {{ $profesional->emergencia->emergencia_colonia_uno }}, {{ $profesional->emergencia->emergencia_municipio_label_uno }}</td></tr> 
    </table>

     <table>
        <tr><th width="20%">Nombre</th><td>{{ $profesional->emergencia->emergencia_nombre_dos }}</td></tr>
        <tr><th width="20%">Parentesco</th><td>{{ $profesional->emergencia->emergencia_relacion_dos }}</td></tr>
        <tr><th width="20%">Contacto</th><td>{{ $profesional->emergencia->emergencia_telefono_uno_dos }} {{ $profesional->emergencia->emergencia_telefono_dos_dos }} | {{ $profesional->emergencia->emergencia_email_dos }}</td></tr> 
        <tr><th width="20%">Dirección</th><td>{{ $profesional->emergencia->emergencia_calle_dos }} {{ $profesional->emergencia->emergencia_numero_dos }}, C.P. {{ $profesional->emergencia->emergencia_codigo_postal_dos }} {{ $profesional->emergencia->emergencia_colonia_dos }}, {{ $profesional->emergencia->emergencia_municipio_label_dos }}</td></tr> 
    </table>

     <table>
        <tr><th width="20%">Nombre</th><td>{{ $profesional->emergencia->emergencia_nombre_tres }}</td></tr>
        <tr><th width="20%">Parentesco</th><td>{{ $profesional->emergencia->emergencia_relacion_tres }}</td></tr>
        <tr><th width="20%">Contacto</th><td>{{ $profesional->emergencia->emergencia_telefono_uno_tres}} {{ $profesional->emergencia->emergencia_telefono_dos_tres }} | {{ $profesional->emergencia->emergencia_email_tres }}</td></tr> 
        <tr><th width="20%">Dirección</th><td>{{ $profesional->emergencia->emergencia_calle_tres }} {{ $profesional->emergencia->emergencia_numero_tres }}, C.P. {{ $profesional->emergencia->emergencia_codigo_postal_tres }} {{ $profesional->emergencia->emergencia_colonia_tres }}, {{ $profesional->emergencia->emergencia_municipio_label_tres }}</td></tr> 
    </table>

    <table style="width: 100%; margin-top: 10px;">
    <tr>
        <!-- Columna izquierda: texto -->
        <td style="width: 65%; vertical-align: top;">
            <p>
                He proporcionado voluntariamente la información de mis contactos y autorizo a mi empleador
                para llamar a cualquier contacto arriba mencionado en caso de una emergencia.
            </p>
            <p>
                *Favor de informar a su(s) contacto(s) que ha sido(n) designado(s) como
                "Contacto(s) de Emergencia".
            </p>

            <p>
                Fecha de impresión : {{ date('d/m/Y') }}
            </p>
        </td>

        <!-- Columna derecha: firma -->
        <td style="width: 35%; text-align: center; vertical-align: bottom;">
            <div style="margin-top: 40px;">
                <p>__________________________________</p>
                <p style="font-size: 11px; margin-top: 3px;">
                    Firma del Trabajador
                </p>
            </div>
        </td>
    </tr>
</table>


    {{-- <div class="page-break"></div> --}}

</body>
</html>
