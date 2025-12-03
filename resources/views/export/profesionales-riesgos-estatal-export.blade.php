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
                <th><strong>No</strong></th>
                <th><strong>CURP</strong></th>
                <th><strong>RFC</strong></th>
                <th><strong>HOMOCLAVE</strong></th>
                <th><strong>NOMBRE</strong></th>
                <th><strong>APELLIDO PATERNO</strong></th>
                <th><strong>APELLIDO MATERNO</strong></th>

                <th><strong>CLUES ADSCRIPCION</strong></th>
                <th><strong>CLUES MUNICIPIO</strong></th>
                <th><strong>CLUES JURISDICCION</strong></th>
                
                <th><strong>OCUPACION</strong></th>
                <th><strong>CODIGO DE PUESTO</strong></th>

                <th><strong>GRADO ACADEMICO</strong></th>
                <th><strong>TITULO</strong></th>
                <th><strong>INSTITUCION EDUCATIVA</strong></th>
                <th><strong>CEDULA</strong></th>

                <th><strong>GRADO ACADEMICO</strong></th>
                <th><strong>TITULO</strong></th>
                <th><strong>INSTITUCION EDUCATIVA</strong></th>
                <th><strong>CEDULA</strong></th>

                <th><strong>GRADO ACADEMICO</strong></th>
                <th><strong>TITULO</strong></th>
                <th><strong>INSTITUCION EDUCATIVA</strong></th>
                <th><strong>CEDULA</strong></th>

                <th><strong>GRADO ACADEMICO</strong></th>
                <th><strong>TITULO</strong></th>
                <th><strong>INSTITUCION EDUCATIVA</strong></th>
                <th><strong>CEDULA</strong></th>

                <th><strong>CARTERA / CATALOGO</strong></th>

                <th><strong>UNIDAD</strong></th>
                <th><strong>AREA</strong></th>
                <th><strong>SUBAREA SERVICIO</strong></th>
                <th><strong>SUBAREA</strong></th>
                <th><strong>JEFATURA PROGRAMA</strong></th>
                <th><strong>JEFATURA</strong></th>
                <th><strong>DEPARTAMENTO</strong></th>
                <th><strong>PROGRAMA</strong></th>
                <th><strong>COMPONENTEO</strong></th>
                <th><strong>SERVICIO</strong></th>
                <th><strong>OCUPACION</strong></th>
                <th><strong>PUESTO</strong></th>

                <th><strong>UNIDAD</strong></th>
                <th><strong>AREA</strong></th>
                <th><strong>SUBAREA SERVICIO</strong></th>
                <th><strong>SUBAREA</strong></th>
                <th><strong>JEFATURA PROGRAMA</strong></th>
                <th><strong>JEFATURA</strong></th>
                <th><strong>DEPARTAMENTO</strong></th>
                <th><strong>PROGRAMA</strong></th>
                <th><strong>COMPONENTEO</strong></th>
                <th><strong>SERVICIO</strong></th>
                <th><strong>OCUPACION</strong></th>
                <th><strong>PUESTO</strong></th>

            </tr>
        </thead>
        <tbody>
            @foreach($profesionales as $profesional)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $profesional->curp ?? '' }}</td>
                    <td>{{ $profesional->rfc ?? '' }}</td>
                    <td>&nbsp;{{ $profesional->homoclave ?? '' }}</td>
                    <td>{{ $profesional->nombre ?? '' }}</td>
                    <td>{{ $profesional->apellido_paterno ?? '' }}</td>
                    <td>{{ $profesional->apellido_materno ?? '' }}</td>
                   
                    {{-- ----------------------------------------------------------------------------------------------------------------- --}} 
           
                    <td>{{ $profesional->puesto?->clues_adscripcion ?? '' }} - {{$profesional->puesto?->clues_adscripcion_nombre}}</td>
                    <td>{{ $profesional->puesto?->clues_adscripcion_municipio ?? '' }}</td>
                    <td>{{ $profesional->puesto?->clues_adscripcion_jurisdiccion ?? '' }}</td>
                    
                    <td>{{ $profesional->puesto?->ocupacion ?? '' }}</td>
                    <td>{{ $profesional->puesto?->codigo ?? '' }} - {{ $profesional->puesto?->codigo_puesto ?? '' }}</td>

                    {{-- ----------------------------------------------------------------------------------------------------------------- --}}

                    <td>{{ $profesional->gradoAcademico->cve_grado_uno ?? '' }} - {{ $profesional->gradoAcademico->grado_academico_uno ?? '' }}</td>
                    <td>{{ $profesional->gradoAcademico->titulo_uno ?? '' }}</td>
                    <td>{{ $profesional->gradoAcademico->institucion_educativa_uno ?? '' }}</td>
                    <td>{{ $profesional->gradoAcademico->cedula_uno ?? '' }} - {{ $profesional->gradoAcademico->numero_cedula_uno ?? '' }}</td>

                    <td>{{ $profesional->gradoAcademico->cve_grado_dos ?? '' }} - {{ $profesional->gradoAcademico->grado_academico_dos ?? '' }}</td>
                    <td>{{ $profesional->gradoAcademico->titulo_dos ?? '' }}</td>
                    <td>{{ $profesional->gradoAcademico->institucion_educativa_dos ?? '' }}</td>
                    <td>{{ $profesional->gradoAcademico->cedula_dos ?? '' }} - {{ $profesional->gradoAcademico->numero_cedula_dos ?? '' }}</td>

                    <td>{{ $profesional->gradoAcademico->cve_grado_tres ?? '' }} - {{ $profesional->gradoAcademico->grado_academico_tres ?? '' }}</td>
                    <td>{{ $profesional->gradoAcademico->titulo_tres ?? '' }}</td>
                    <td>{{ $profesional->gradoAcademico->institucion_educativa_tres ?? '' }}</td>
                    <td>{{ $profesional->gradoAcademico->cedula_tres ?? '' }} - {{ $profesional->gradoAcademico->numero_cedula_tres ?? '' }}</td>

                    <td>{{ $profesional->gradoAcademico->cve_grado_cuatro ?? '' }} - {{ $profesional->gradoAcademico->grado_academico_cuatro ?? '' }}</td>
                    <td>{{ $profesional->gradoAcademico->titulo_cuatro ?? '' }}</td>
                    <td>{{ $profesional->gradoAcademico->institucion_educativa_cuatro ?? '' }}</td>
                    <td>{{ $profesional->gradoAcademico->cedula_cuatro ?? '' }} - {{ $profesional->gradoAcademico->numero_cedula_cuatro ?? '' }}</td>

                    {{-- ----------------------------------------------------------------------------------------------------------------- --}}

                    {{-- ----------------------------------------------------------------------------------------------------------------- --}}
                    {{-- CATALOGO DE OCUPACIONES --}}
                    {{-- ----------------------------------------------------------------------------------------------------------------- --}}

                    @switch($profesional->puesto->clues_adscripcion_tipo)
                        {{-- CENTROS DE SALUD URBANOS Y RURALES --}}
                        @case(1)
                            <td>CENTROS DE SALUD URBANOS Y RURALES</td>
                            <td>{{ $profesional->ocupacionCentroSalud->unidad_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCentroSalud->area_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCentroSalud->subarea_servicio_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCentroSalud->subarea_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCentroSalud->jefatura_programa_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCentroSalud->jefatura_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCentroSalud->departamento_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCentroSalud->programa_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCentroSalud->componente_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCentroSalud->servicio_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCentroSalud->ocupacion_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCentroSalud->puesto_uno ?? '' }}</td>

                            <td>{{ $profesional->ocupacionCentroSalud->unidad_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCentroSalud->area_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCentroSalud->subarea_servicio_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCentroSalud->subarea_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCentroSalud->jefatura_programa_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCentroSalud->jefatura_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCentroSalud->departamento_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCentroSalud->programa_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCentroSalud->componente_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCentroSalud->servicio_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCentroSalud->ocupacion_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCentroSalud->puesto_dos ?? '' }}</td>
                        @break

                        {{-- HOSPITALES --}}
                        @case(2)
                            <td>HOSPITALES</td>
                            <td>{{ $profesional->ocupacionHospital->unidad_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionHospital->area_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionHospital->subarea_servicio_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionHospital->subarea_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionHospital->jefatura_programa_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionHospital->jefatura_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionHospital->departamento_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionHospital->programa_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionHospital->componente_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionHospital->servicio_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionHospital->ocupacion_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionHospital->puesto_uno ?? '' }}</td>

                            <td>{{ $profesional->ocupacionHospital->unidad_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionHospital->area_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionHospital->subarea_servicio_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionHospital->subarea_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionHospital->jefatura_programa_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionHospital->jefatura_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionHospital->departamento_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionHospital->programa_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionHospital->componente_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionHospital->servicio_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionHospital->ocupacion_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionHospital->puesto_dos ?? '' }}</td>
                        @break

                        {{-- OFICINA JURISDICCIONAL --}}
                        @case(3)
                            <td>OFICINA JURISDICCIONAL</td>
                            <td>{{ $profesional->ocupacionOfJurisidccion->unidad_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionOfJurisidccion->area_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionOfJurisidccion->subarea_servicio_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionOfJurisidccion->subarea_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionOfJurisidccion->jefatura_programa_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionOfJurisidccion->jefatura_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionOfJurisidccion->departamento_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionOfJurisidccion->programa_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionOfJurisidccion->componente_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionOfJurisidccion->servicio_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionOfJurisidccion->ocupacion_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionOfJurisidccion->puesto_uno ?? '' }}</td>

                            <td>{{ $profesional->ocupacionOfJurisidccion->unidad_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionOfJurisidccion->area_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionOfJurisidccion->subarea_servicio_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionOfJurisidccion->subarea_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionOfJurisidccion->jefatura_programa_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionOfJurisidccion->jefatura_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionOfJurisidccion->departamento_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionOfJurisidccion->programa_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionOfJurisidccion->componente_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionOfJurisidccion->servicio_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionOfJurisidccion->ocupacion_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionOfJurisidccion->puesto_dos ?? '' }}</td>
                        @break

                        {{-- CRI CREE --}}
                        @case(4)
                            <td>CRI CREE</td>
                            <td>{{ $profesional->ocupacionCriCree->unidad_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCriCree->area_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCriCree->subarea_servicio_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCriCree->subarea_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCriCree->jefatura_programa_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCriCree->jefatura_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCriCree->departamento_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCriCree->programa_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCriCree->componente_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCriCree->servicio_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCriCree->ocupacion_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCriCree->puesto_uno ?? '' }}</td>

                            <td>{{ $profesional->ocupacionCriCree->unidad_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCriCree->area_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCriCree->subarea_servicio_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCriCree->subarea_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCriCree->jefatura_programa_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCriCree->jefatura_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCriCree->departamento_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCriCree->programa_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCriCree->componente_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCriCree->servicio_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCriCree->ocupacion_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCriCree->puesto_dos ?? '' }}</td>
                        @break

                        {{-- SAMU CRUM --}}
                        @case(5)
                            <td>SAMU CRUM</td>
                            <td>{{ $profesional->ocupacionSamuCrum->unidad_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionSamuCrum->area_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionSamuCrum->subarea_servicio_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionSamuCrum->subarea_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionSamuCrum->jefatura_programa_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionSamuCrum->jefatura_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionSamuCrum->departamento_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionSamuCrum->programa_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionSamuCrum->componente_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionSamuCrum->servicio_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionSamuCrum->ocupacion_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionSamuCrum->puesto_uno ?? '' }}</td>

                            <td>{{ $profesional->ocupacionSamuCrum->unidad_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionSamuCrum->area_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionSamuCrum->subarea_servicio_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionSamuCrum->subarea_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionSamuCrum->jefatura_programa_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionSamuCrum->jefatura_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionSamuCrum->departamento_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionSamuCrum->programa_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionSamuCrum->componente_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionSamuCrum->servicio_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionSamuCrum->ocupacion_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionSamuCrum->puesto_dos ?? '' }}</td>
                        @break

                        {{-- OFICINA CENTRAL --}}
                        @case(6)
                            <td>OFICINA CENTRAL</td>
                            <td>{{ $profesional->ocupacionOficinaCentral->unidad_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionOficinaCentral->area_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionOficinaCentral->subarea_servicio_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionOficinaCentral->subarea_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionOficinaCentral->jefatura_programa_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionOficinaCentral->jefatura_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionOficinaCentral->departamento_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionOficinaCentral->programa_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionOficinaCentral->componente_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionOficinaCentral->servicio_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionOficinaCentral->ocupacion_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionOficinaCentral->puesto_uno ?? '' }}</td>

                            <td>{{ $profesional->ocupacionOficinaCentral->unidad_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionOficinaCentral->area_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionOficinaCentral->subarea_servicio_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionOficinaCentral->subarea_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionOficinaCentral->jefatura_programa_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionOficinaCentral->jefatura_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionOficinaCentral->departamento_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionOficinaCentral->programa_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionOficinaCentral->componente_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionOficinaCentral->servicio_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionOficinaCentral->ocupacion_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionOficinaCentral->puesto_dos ?? '' }}</td>
                        @break

                        {{-- ALMACEN --}}
                        @case(7)
                            <td>ALMACEN</td>
                            <td>{{ $profesional->ocupacionAlmacen->unidad_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionAlmacen->area_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionAlmacen->subarea_servicio_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionAlmacen->subarea_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionAlmacen->jefatura_programa_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionAlmacen->jefatura_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionAlmacen->departamento_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionAlmacen->programa_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionAlmacen->componente_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionAlmacen->servicio_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionAlmacen->ocupacion_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionAlmacen->puesto_uno ?? '' }}</td>

                            <td>{{ $profesional->ocupacionAlmacen->unidad_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionAlmacen->area_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionAlmacen->subarea_servicio_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionAlmacen->subarea_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionAlmacen->jefatura_programa_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionAlmacen->jefatura_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionAlmacen->departamento_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionAlmacen->programa_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionAlmacen->componente_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionAlmacen->servicio_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionAlmacen->ocupacion_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionAlmacen->puesto_dos ?? '' }}</td>
                        @break

                        {{-- LESP CETS --}}
                        @case(8)
                            <td>LESP CETS</td>
                            <td>{{ $profesional->ocupacionCetsLesp->unidad_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCetsLesp->area_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCetsLesp->subarea_servicio_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCetsLesp->subarea_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCetsLesp->jefatura_programa_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCetsLesp->jefatura_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCetsLesp->departamento_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCetsLesp->programa_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCetsLesp->componente_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCetsLesp->servicio_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCetsLesp->ocupacion_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCetsLesp->puesto_uno ?? '' }}</td>

                            <td>{{ $profesional->ocupacionCetsLesp->unidad_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCetsLesp->area_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCetsLesp->subarea_servicio_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCetsLesp->subarea_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCetsLesp->jefatura_programa_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCetsLesp->jefatura_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCetsLesp->departamento_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCetsLesp->programa_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCetsLesp->componente_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCetsLesp->servicio_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCetsLesp->ocupacion_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCetsLesp->puesto_dos ?? '' }}</td>
                        @break

                        {{-- ONCOLOGICO --}}
                        @case(9)
                            <td>ONCOLOGICO</td>
                            <td>{{ $profesional->ocupacionCors->unidad_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCors->area_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCors->subarea_servicio_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCors->subarea_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCors->jefatura_programa_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCors->jefatura_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCors->departamento_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCors->programa_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCors->componente_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCors->servicio_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCors->ocupacion_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCors->puesto_uno ?? '' }}</td>

                            <td>{{ $profesional->ocupacionCors->unidad_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCors->area_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCors->subarea_servicio_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCors->subarea_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCors->jefatura_programa_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCors->jefatura_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCors->departamento_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCors->programa_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCors->componente_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCors->servicio_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCors->ocupacion_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCors->puesto_dos ?? '' }}</td>
                        @break

                        {{-- HOSPITAL DEL NIÑO --}}
                        @case(10)
                            <td>I.S.S.R.E.E.I.</td>
                            <td>{{ $profesional->ocupacionIssreei->unidad_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionIssreei->area_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionIssreei->subarea_servicio_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionIssreei->subarea_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionIssreei->jefatura_programa_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionIssreei->jefatura_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionIssreei->departamento_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionIssreei->programa_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionIssreei->componente_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionIssreei->servicio_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionIssreei->ocupacion_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionIssreei->puesto_uno ?? '' }}</td>

                            <td>{{ $profesional->ocupacionIssreei->unidad_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionIssreei->area_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionIssreei->subarea_servicio_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionIssreei->subarea_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionIssreei->jefatura_programa_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionIssreei->jefatura_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionIssreei->departamento_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionIssreei->programa_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionIssreei->componente_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionIssreei->servicio_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionIssreei->ocupacion_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionIssreei->puesto_dos ?? '' }}</td>
                        @break

                        {{-- CESAME --}}
                        @case(11)
                            <td>CESAME</td>
                            <td>{{ $profesional->ocupacionCesame->unidad_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCesame->area_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCesame->subarea_servicio_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCesame->subarea_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCesame->jefatura_programa_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCesame->jefatura_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCesame->departamento_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCesame->programa_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCesame->componente_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCesame->servicio_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCesame->ocupacion_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCesame->puesto_uno ?? '' }}</td>

                            <td>{{ $profesional->ocupacionCesame->unidad_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCesame->area_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCesame->subarea_servicio_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCesame->subarea_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCesame->jefatura_programa_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCesame->jefatura_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCesame->departamento_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCesame->programa_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCesame->componente_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCesame->servicio_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCesame->ocupacion_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCesame->puesto_dos ?? '' }}</td>
                        @break

                        {{-- PSI PARRAS --}}
                        @case(12)
                            <td>PSI PARRAS</td>
                            <td>{{ $profesional->ocupacionPsiParras->unidad_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionPsiParras->area_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionPsiParras->subarea_servicio_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionPsiParras->subarea_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionPsiParras->jefatura_programa_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionPsiParras->jefatura_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionPsiParras->departamento_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionPsiParras->programa_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionPsiParras->componente_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionPsiParras->servicio_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionPsiParras->ocupacion_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionPsiParras->puesto_uno ?? '' }}</td>

                            <td>{{ $profesional->ocupacionPsiParras->unidad_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionPsiParras->area_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionPsiParras->subarea_servicio_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionPsiParras->subarea_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionPsiParras->jefatura_programa_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionPsiParras->jefatura_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionPsiParras->departamento_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionPsiParras->programa_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionPsiParras->componente_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionPsiParras->servicio_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionPsiParras->ocupacion_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionPsiParras->puesto_dos ?? '' }}</td>
                        @break

                         {{-- CEAM --}}
                        @case(13)
                            <td>CEAM</td>
                            <td>{{ $profesional->ocupacionCeam->unidad_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCeam->area_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCeam->subarea_servicio_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCeam->subarea_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCeam->jefatura_programa_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCeam->jefatura_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCeam->departamento_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCeam->programa_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCeam->componente_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCeam->servicio_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCeam->ocupacion_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCeam->puesto_uno ?? '' }}</td>

                            <td>{{ $profesional->ocupacionCeam->unidad_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCeam->area_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCeam->subarea_servicio_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCeam->subarea_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCeam->jefatura_programa_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCeam->jefatura_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCeam->departamento_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCeam->programa_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCeam->componente_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCeam->servicio_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCeam->ocupacion_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionCeam->puesto_dos ?? '' }}</td>
                        @break

                        {{-- HOSPITAL DEL NIÑO --}}
                        @case(14)
                            <td>HOSPITAL DEL NIÑO</td>
                            <td>{{ $profesional->ocupacionHospitalNino->unidad_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionHospitalNino->area_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionHospitalNino->subarea_servicio_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionHospitalNino->subarea_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionHospitalNino->jefatura_programa_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionHospitalNino->jefatura_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionHospitalNino->departamento_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionHospitalNino->programa_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionHospitalNino->componente_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionHospitalNino->servicio_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionHospitalNino->ocupacion_uno ?? '' }}</td>
                            <td>{{ $profesional->ocupacionHospitalNino->puesto_uno ?? '' }}</td>

                            <td>{{ $profesional->ocupacionHospitalNino->unidad_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionHospitalNino->area_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionHospitalNino->subarea_servicio_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionHospitalNino->subarea_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionHospitalNino->jefatura_programa_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionHospitalNino->jefatura_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionHospitalNino->departamento_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionHospitalNino->programa_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionHospitalNino->componente_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionHospitalNino->servicio_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionHospitalNino->ocupacion_dos ?? '' }}</td>
                            <td>{{ $profesional->ocupacionHospitalNino->puesto_dos ?? '' }}</td>
                        @break

                        @default
                            <td colspan="24">Sin información disponible</td>
                    @endswitch


                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
