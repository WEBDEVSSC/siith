<table>
    <thead>
        <tr>
            <th>ID PROFESIONAL</th>
            <th>FOTOGRAFIA</th>

            <th><strong>CATALOGO</strong></th>
            <th><strong>UNIDAD</strong></th>
            <th><strong>AREA</strong></th>
            <th><strong>SUBAREA SERVICIO</strong></th>
            <th><strong>SUBAREA</strong></th>
            <th><strong>JEFATURA_PROGRAMA</strong></th>
            <th><strong>JEFATURA</strong></th>
            <th><strong>DEPARTAMENTO</strong></th>
            <th><strong>PROGRAMA</strong></th>
            <th><strong>COMPONENTE</strong></th>
            <th><strong>SERVICIO</strong></th>
            <th><strong>OCUPACION</strong></th>
            <th><strong>PUESTO</strong></th>

            <th>CURP</th>
            <th>RFC</th>
            <th>NOMBRE COMPLETO</th>
            <th>FECHA DE NACIMIENTO</th>
            <th>ENTIDAD DE NACIMIENTO</th>
            <th>MUNICIPIO DE NACIMIENTO</th>
            <th>NACIONALIDAD</th>
            <th>CELULAR</th>
            <th>E-MAIL</th>
            <th>ADSCRIPCION FISICA</th>
            <th>NOMINA</th>
            <th>CODIGO DE PUESTO</th>
            <th>DESCRIPCION</th>
            <th>CLAVE ELECTOR</th>
            <th>SECCION</th>
            <th>DISTRITO LOCAL</th>
            <th>DISTRITO FEDERAL</th>
            <th>VIGENCIA</th>

            <th>EXTRAIDO SECCION</th>
            <th>EXTRAIDO VIGENCIA</th>
        </tr>
    </thead>
    <tbody>
        @foreach($profesionales as $row)
            <tr>
                <td>{{ $row->id }}</td>
                <td></td>
                @switch($row->puesto->clues_adscripcion_tipo ?? null)
                        {{-- CENTROS DE SALUD URBANOS Y RURALES --}}
                        @case(1)
                            <td>CENTROS DE SALUD URBANOS Y RURALES</td>
                            <td>{{ $row->ocupacionCentroSalud->unidad_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionCentroSalud->area_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionCentroSalud->subarea_servicio_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionCentroSalud->subarea_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionCentroSalud->jefatura_programa_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionCentroSalud->jefatura_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionCentroSalud->departamento_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionCentroSalud->programa_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionCentroSalud->componente_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionCentroSalud->servicio_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionCentroSalud->ocupacion_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionCentroSalud->puesto_uno ?? '' }}</td>
                        @break

                        {{-- HOSPITALES --}}
                        @case(2)
                            <td>HOSPITALES</td>
                            <td>{{ $row->ocupacionHospital->unidad_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionHospital->area_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionHospital->subarea_servicio_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionHospital->subarea_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionHospital->jefatura_programa_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionHospital->jefatura_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionHospital->departamento_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionHospital->programa_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionHospital->componente_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionHospital->servicio_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionHospital->ocupacion_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionHospital->puesto_uno ?? '' }}</td>

                        @break

                        {{-- OFICINA JURISDICCIONAL --}}
                        @case(3)
                            <td>OFICINA JURISDICCIONAL</td>
                            <td>{{ $row->ocupacionOfJurisidccion->unidad_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionOfJurisidccion->area_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionOfJurisidccion->subarea_servicio_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionOfJurisidccion->subarea_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionOfJurisidccion->jefatura_programa_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionOfJurisidccion->jefatura_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionOfJurisidccion->departamento_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionOfJurisidccion->programa_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionOfJurisidccion->componente_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionOfJurisidccion->servicio_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionOfJurisidccion->ocupacion_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionOfJurisidccion->puesto_uno ?? '' }}</td>

                        @break

                        {{-- CRI CREE --}}
                        @case(4)
                            <td>CRI CREE</td>
                            <td>{{ $row->ocupacionCriCree->unidad_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionCriCree->area_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionCriCree->subarea_servicio_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionCriCree->subarea_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionCriCree->jefatura_programa_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionCriCree->jefatura_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionCriCree->departamento_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionCriCree->programa_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionCriCree->componente_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionCriCree->servicio_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionCriCree->ocupacion_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionCriCree->puesto_uno ?? '' }}</td>

                        @break

                        {{-- SAMU CRUM --}}
                        @case(5)
                            <td>SAMU CRUM</td>
                            <td>{{ $row->ocupacionSamuCrum->unidad_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionSamuCrum->area_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionSamuCrum->subarea_servicio_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionSamuCrum->subarea_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionSamuCrum->jefatura_programa_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionSamuCrum->jefatura_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionSamuCrum->departamento_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionSamuCrum->programa_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionSamuCrum->componente_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionSamuCrum->servicio_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionSamuCrum->ocupacion_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionSamuCrum->puesto_uno ?? '' }}</td>

                        @break

                        {{-- OFICINA CENTRAL --}}
                        @case(6)
                            <td>OFICINA CENTRAL</td>
                            <td>{{ $row->ocupacionOficinaCentral->unidad_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionOficinaCentral->area_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionOficinaCentral->subarea_servicio_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionOficinaCentral->subarea_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionOficinaCentral->jefatura_programa_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionOficinaCentral->jefatura_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionOficinaCentral->departamento_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionOficinaCentral->programa_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionOficinaCentral->componente_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionOficinaCentral->servicio_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionOficinaCentral->ocupacion_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionOficinaCentral->puesto_uno ?? '' }}</td>

                        @break

                        {{-- ALMACEN --}}
                        @case(7)
                            <td>ALMACEN</td>
                            <td>{{ $row->ocupacionAlmacen->unidad_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionAlmacen->area_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionAlmacen->subarea_servicio_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionAlmacen->subarea_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionAlmacen->jefatura_programa_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionAlmacen->jefatura_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionAlmacen->departamento_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionAlmacen->programa_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionAlmacen->componente_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionAlmacen->servicio_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionAlmacen->ocupacion_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionAlmacen->puesto_uno ?? '' }}</td>

                        @break

                        {{-- LESP CETS --}}
                        @case(8)
                            <td>LESP CETS</td>
                            <td>{{ $row->ocupacionCetsLesp->unidad_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionCetsLesp->area_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionCetsLesp->subarea_servicio_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionCetsLesp->subarea_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionCetsLesp->jefatura_programa_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionCetsLesp->jefatura_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionCetsLesp->departamento_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionCetsLesp->programa_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionCetsLesp->componente_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionCetsLesp->servicio_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionCetsLesp->ocupacion_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionCetsLesp->puesto_uno ?? '' }}</td>

                        @break

                        {{-- ONCOLOGICO --}}
                        @case(9)
                            <td>ONCOLOGICO</td>
                            <td>{{ $row->ocupacionCors->unidad_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionCors->area_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionCors->subarea_servicio_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionCors->subarea_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionCors->jefatura_programa_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionCors->jefatura_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionCors->departamento_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionCors->programa_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionCors->componente_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionCors->servicio_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionCors->ocupacion_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionCors->puesto_uno ?? '' }}</td>

                        @break

                        {{-- I.S.S.R.E.E.I. --}}
                        @case(10)
                            <td>I.S.S.R.E.E.I.</td>
                            <td>{{ $row->ocupacionIssreei->unidad_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionIssreei->area_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionIssreei->subarea_servicio_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionIssreei->subarea_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionIssreei->jefatura_programa_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionIssreei->jefatura_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionIssreei->departamento_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionIssreei->programa_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionIssreei->componente_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionIssreei->servicio_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionIssreei->ocupacion_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionIssreei->puesto_uno ?? '' }}</td>

                        @break

                        {{-- CESAME --}}
                        @case(11)
                            <td>CESAME</td>
                            <td>{{ $row->ocupacionCesame->unidad_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionCesame->area_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionCesame->subarea_servicio_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionCesame->subarea_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionCesame->jefatura_programa_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionCesame->jefatura_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionCesame->departamento_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionCesame->programa_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionCesame->componente_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionCesame->servicio_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionCesame->ocupacion_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionCesame->puesto_uno ?? '' }}</td>

                        @break

                        {{-- PSI PARRAS --}}
                        @case(12)
                            <td>PSI PARRAS</td>
                            <td>{{ $row->ocupacionPsiParras->unidad_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionPsiParras->area_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionPsiParras->subarea_servicio_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionPsiParras->subarea_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionPsiParras->jefatura_programa_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionPsiParras->jefatura_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionPsiParras->departamento_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionPsiParras->programa_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionPsiParras->componente_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionPsiParras->servicio_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionPsiParras->ocupacion_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionPsiParras->puesto_uno ?? '' }}</td>

                        @break

                         {{-- CEAM --}}
                        @case(13)
                            <td>CEAM</td>
                            <td>{{ $row->ocupacionCeam->unidad_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionCeam->area_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionCeam->subarea_servicio_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionCeam->subarea_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionCeam->jefatura_programa_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionCeam->jefatura_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionCeam->departamento_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionCeam->programa_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionCeam->componente_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionCeam->servicio_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionCeam->ocupacion_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionCeam->puesto_uno ?? '' }}</td>

                        @break

                        {{-- HOSPITAL DEL NIÑO --}}
                        @case(14)
                            <td>HOSPITAL DEL NIÑO</td>
                            <td>{{ $row->ocupacionHospitalNino->unidad_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionHospitalNino->area_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionHospitalNino->subarea_servicio_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionHospitalNino->subarea_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionHospitalNino->jefatura_programa_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionHospitalNino->jefatura_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionHospitalNino->departamento_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionHospitalNino->programa_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionHospitalNino->componente_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionHospitalNino->servicio_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionHospitalNino->ocupacion_uno ?? '' }}</td>
                            <td>{{ $row->ocupacionHospitalNino->puesto_uno ?? '' }}</td>

                        @break
                        
                        {{-- PASANTES ENSENANZA --}}
                        @case(15)
                            <td>PASANTES ENSEÑANZA</td>
                            <td>{{ $row->ocupacionEnsenanza->unidad ?? '' }}</td>
                            <td>{{ $row->ocupacionEnsenanza->area ?? '' }}</td>
                            <td></td>
                            <td>{{ $row->ocupacionEnsenanza->subarea ?? '' }}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>{{ $row->ocupacionEnsenanza->ocupacion ?? '' }}</td>
                            
                        @break

                        {{-- CECOSAMA --}}
                        @case(16)
                            <td>CECOSAMA</td>
                            <td>{{ $row->ocupacionCecosama->unidad ?? '' }}</td>
                            <td>{{ $row->ocupacionCecosama->area ?? '' }}</td>
                            <td></td>
                            <td>{{ $row->ocupacionCecosama->subarea ?? '' }}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>{{ $row->ocupacionCecosama->ocupacion ?? '' }}</td>
                            
                        @break

                        @default
                            <td colspan="25"></td>
                    @endswitch
                <td>{{ $row->curp ?? '' }}</td>
                <td>{{ $row->rfc ?? '' }}</td>
                <td>{{ $row->nombre ?? '' }} {{ $row->apellido_paterno ?? '' }} {{ $row->apellido_materno ?? '' }}</td>
                <td>{{ $row->fecha_nacimiento ? \Carbon\Carbon::parse($row->fecha_nacimiento)->format('d-m-Y') : '' }}</td>
                <td>{{ $row->entidad_nacimiento ?? '' }}</td>
                <td>{{ $row->municipio_nacimiento ?? '' }}</td>
                <td>{{ $row->nacionalidad ?? '' }}</td>
                <td>{{ $row->celular ?? '' }}</td>
                <td>{{ $row->email ?? '' }}</td>
                <td>{{ $row->puesto->clues_adscripcion_nombre ?? '' }}</td>
                <td>{{ $row->puesto->nomina_pago ?? '' }}</td>
                <td>{{ $row->puesto->codigo ?? '' }}</td>
                <td>{{ $row->puesto->codigo_puesto ?? '' }}</td>
                <td>{{ $row->ine->clave_elector ?? '' }}</td>
                <td>{{ $row->ine->seccion ?? '' }}</td>
                <td>{{ $row->ine->dl ?? '' }}</td>
                <td>{{ $row->ine->df ?? '' }}</td>
                <td>{{ $row->ine->vigencia ?? '' }}</td>

                <td>{{ $row->extraido->seccion ?? '' }}</td>
                <td>{{ $row->extraido->vigencia ?? '' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>