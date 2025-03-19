<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>S.I.I.T.H. Coah</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th><strong>ID</strong></th>
                <th><strong>CURP</strong></th>
                <th><strong>RFC</strong></th>
                <th><strong>HOMOCLAVE</strong></th>
                <th><strong>NOMBRE</strong></th>
                <th><strong>APELLIDO PATERNO</strong></th>
                <th><strong>APELLIDO MATERNO</strong></th>
                <th><strong>SEXO</strong></th>
                <th><strong>FECHA DE NACIMIENTO</strong></th>
                <th><strong>ENTIDAD DE NACIMIENTO</strong></th>
                <th><strong>MUNICIPIO DE NACIMIENTO</strong></th>
                <th><strong>PAIS DE NACIMIENTO</strong></th>
                <th><strong>NACIONALIDAD</strong></th>
                <th><strong>ESTADO CONYUGAL</strong></th>
                <th><strong>TELEFONO</strong></th>
                <th><strong>CELULAR</strong></th>
                <th><strong>EMAIL</strong></th>

                <th><strong>FIEL</strong></th>
                <th><strong>ACTIVIDAD</strong></th>
                <th><strong>ADICIONAL</strong></th>
                <th><strong>TIPO DE PERSONAL</strong></th>
                <th><strong>CODIGO DE PUESTO</strong></th>
                <th><strong>CLUES NOMINA</strong></th>
                <th><strong>CLUES MUNICIPIO</strong></th>
                <th><strong>CLUES JURISDICCION</strong></th>
                <th><strong>CLUES ADSCRIPCION</strong></th>
                <th><strong>CLUES MUNICIPIO</strong></th>
                <th><strong>CLUES JURISDICCION</strong></th>
                <th><strong>AREA DE TRABAJO</strong></th>
                <th><strong>OCUPACION</strong></th>
                <th><strong>NOMINA DE PAGO</strong></th>
                <th><strong>TIPO DE CONTRATO</strong></th>
                <th><strong>FECHA DE INGRESO</strong></th>
                <th><strong>TIPO DE PLAZA</strong></th>
                <th><strong>INSTITUCION PUESTO</strong></th>
                <th><strong>VIGENCIA</strong></th>
                <th><strong>TEMPORALIDAD</strong></th>
                <th><strong>LICENCIA DE MATERNIDAD</strong></th>
                <th><strong>SEGURO DE SALUD</strong></th>

                <th><strong>JORNADA</strong></th>
                <th><strong>LUNES</strong></th>
                <th><strong>MARTES</strong></th>
                <th><strong>MIERCOLES</strong></th>
                <th><strong>JUEVES</strong></th>
                <th><strong>VIERNES</strong></th>
                <th><strong>SABADOS</strong></th>
                <th><strong>DOMINGOS</strong></th>
                <th><strong>FESTIVOS</strong></th>

                <th><strong>FOTOGRAFIA</strong></th>

                <th><strong>SUELDO MENSUAL</strong></th>
                <th><strong>COMPENSACIONES</strong></th>
                <th><strong>PRESTACIONES POR MANDATO DE LEY</strong></th>
                <th><strong>PRESTACIONES CGT</strong></th>
                <th><strong>ESTIMULOS</strong></th>
                <th><strong>TOTAL</strong></th>

                <th><strong>GRADO ACADEMICO</strong></th>
                <th><strong>TITULO</strong></th>
                <th><strong>INSTITUCION EDUCATIVA</strong></th>
                <th><strong>CEDULA</strong></th>
                <th><strong>GRADO ACADEMICO</strong></th>
                <th><strong>TITULO</strong></th>
                <th><strong>INSTITUCION EDUCATIVA</strong></th>
                <th><strong>CEDULA</strong></th>

            </tr>
        </thead>
        <tbody>
            @foreach($profesionales as $profesional)
                <tr>
                    <td>{{ $profesional->id }}</td>
                    <td>{{ $profesional->curp ?? '' }}</td>
                    <td>{{ $profesional->rfc ?? '' }}</td>
                    <td>{{ $profesional->homoclave ?? '' }}</td>
                    <td>{{ $profesional->nombre ?? '' }}</td>
                    <td>{{ $profesional->apellido_paterno ?? '' }}</td>
                    <td>{{ $profesional->apellido_materno ?? '' }}</td>
                    <td>{{ $profesional->sexo ?? '' }}</td>
                    <td>{{ $profesional->fecha_nacimiento ?? ''  }}</td>
                    <td>{{ $profesional->entidad_nacimiento ?? ''  }}</td>
                    <td>{{ $profesional->municipio_nacimiento ?? ''  }}</td>
                    <td>{{ $profesional->pais_nacimiento ?? ''  }}</td>
                    <td>{{ $profesional->nacionalidad ?? ''  }}</td>
                    <td>{{ $profesional->estado_conyugal ?? ''  }}</td>
                    <td>{{ $profesional->telefono_casa ?? ''  }}</td>
                    <td>{{ $profesional->celular ?? ''  }}</td>
                    <td>{{ $profesional->email ?? ''  }}</td>

                    <td>{{ $profesional->puesto->fiel ?? '' }} - {{ $profesional->puesto->fiel_vigencia ?? '' }}</td>
                    <td>{{ $profesional->puesto->actividad ?? '' }}</td>
                    <td>{{ $profesional->puesto->adicional ?? '' }}</td>
                    <td>{{ $profesional->puesto->tipo_personal ?? '' }}</td>
                    <td>{{ $profesional->puesto->codigo_puesto ?? '' }}</td>
                    <td>{{ $profesional->puesto->clues_nomina ?? '' }} - {{$profesional->puesto->clues_nomina_nombre}}</td>
                    <td>{{ $profesional->puesto->clues_nomina_municipio ?? '' }}</td>
                    <td>{{ $profesional->puesto->clues_nomina_jurisdiccion ?? '' }}</td>
                    <td>{{ $profesional->puesto->clues_adscripcion ?? '' }} - {{$profesional->puesto->clues_adscripcion_nombre}}</td>
                    <td>{{ $profesional->puesto->clues_adscripcion_municipio ?? '' }}</td>
                    <td>{{ $profesional->puesto->clues_adscripcion_jurisdiccion ?? '' }}</td>
                    <td>{{ $profesional->puesto->area_trabajo ?? '' }}</td>
                    <td>{{ $profesional->puesto->ocupacion ?? '' }}</td>
                    <td>{{ $profesional->puesto->nomina_pago ?? '' }}</td>
                    <td>{{ $profesional->puesto->tipo_contrato ?? '' }}</td>
                    <td>{{ $profesional->puesto->fecha_ingreso ?? '' }}</td>
                    <td>{{ $profesional->puesto->tipo_plaza ?? '' }}</td>
                    <td>{{ $profesional->puesto->institucion_puesto ?? '' }}</td>
                    <td>{{ $profesional->puesto->vigencia ?? '' }} - {{ $profesional->puesto->vigencia_motivo ?? '' }}</td>
                    <td>{{ $profesional->puesto->temporalidad ?? '' }}</td>
                    <td>{{ $profesional->puesto->licencia_maternidad ?? '' }}</td>
                    <td>{{ $profesional->puesto->seguro_salud ?? '' }}</td>

                    <td>{{ $profesional->horario->jornada ?? '' }}</td>
                    <td>{{ $profesional->horario->entrada_lunes ?? '' }} - {{ $profesional->horario->salida_lunes ?? '' }}</td>
                    <td>{{ $profesional->horario->entrada_martes ?? '' }} - {{ $profesional->horario->salida_martes ?? '' }}</td>
                    <td>{{ $profesional->horario->entrada_miercoles ?? '' }} - {{ $profesional->horario->salida_miercoles ?? '' }}</td>
                    <td>{{ $profesional->horario->entrada_jueves ?? '' }} - {{ $profesional->horario->salida_jueves ?? '' }}</td>
                    <td>{{ $profesional->horario->entrada_viernes ?? '' }} - {{ $profesional->horario->salida_viernes ?? '' }}</td>
                    <td>{{ $profesional->horario->entrada_sabado ?? '' }} - {{ $profesional->horario->salida_sabado ?? '' }}</td>
                    <td>{{ $profesional->horario->entrada_domingo ?? '' }} - {{ $profesional->horario->salida_domingo ?? '' }}</td>
                    <td>{{ $profesional->horario->entrada_festivo ?? '' }} - {{ $profesional->horario->salida_festivo ?? '' }}</td>

                    <td>{{ $profesional->credencializacion->fotografia ?? '' }}</td>

                    <td>{{ $profesional->sueldo->sueldo_mensual ?? '' }}</td>
                    <td>{{ $profesional->sueldo->compensaciones ?? '' }}</td>
                    <td>{{ $profesional->sueldo->prestaciones_mandato_ley ?? '' }}</td>
                    <td>{{ $profesional->sueldo->prestaciones_cgt ?? '' }}</td>
                    <td>{{ $profesional->sueldo->estimulos ?? '' }}</td>
                    <td>{{ $profesional->sueldo->total ?? '' }}</td>

                    <td>{{ $profesional->gradoAcademico->cve_grado_uno ?? '' }} - {{ $profesional->gradoAcademico->grado_academico_uno ?? '' }}</td>
                    <td>{{ $profesional->gradoAcademico->titulo_uno ?? '' }}</td>
                    <td>{{ $profesional->gradoAcademico->institucion_educativa_uno ?? '' }}</td>
                    <td>{{ $profesional->gradoAcademico->cedula_uno ?? '' }} - {{ $profesional->gradoAcademico->numero_cedula_uno ?? '' }}</td>
                    <td>{{ $profesional->gradoAcademico->cve_grado_dos ?? '' }} - {{ $profesional->gradoAcademico->grado_academico_dos ?? '' }}</td>
                    <td>{{ $profesional->gradoAcademico->titulo_dos ?? '' }}</td>
                    <td>{{ $profesional->gradoAcademico->institucion_educativa_dos ?? '' }}</td>
                    <td>{{ $profesional->gradoAcademico->cedula_dos ?? '' }} - {{ $profesional->gradoAcademico->numero_cedula_dos ?? '' }}</td>


                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
