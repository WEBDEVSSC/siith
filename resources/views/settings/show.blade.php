@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1><strong>Catálogos de Sistema</strong></h1>
@stop

@section('content')

    {{-- Ocupaciones / Cartera de Servicios --}}
    <div class="card">
        <div class="card-header">
            <strong>Ocupaciones / Cartera de Servicios</strong>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-2">
                    <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="fas fa-clinic-medical" aria-hidden="true"></i></span>
                        <div class="info-box-content">
                            <a href="{{ route('ocupacionCsuyrIndex') }}"><span class="info-box-text"><strong>C.S.U.y.R.</strong></span></a>
                        </div>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="fas fa-hospital" aria-hidden="true"></i></span>
                        <div class="info-box-content">
                            <a href="{{ route('ocupacionHospitalIndex') }}"><span class="info-box-text"><strong>Hospitales</strong></span></a>
                        </div>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="fas fa-building" aria-hidden="true"></i></span>
                        <div class="info-box-content">
                            <a href="{{ route('ocupacionOfJurisdiccionalIndex') }}"><span class="info-box-text"><strong>Of. Jurisdiccionales</strong></span></a>
                        </div>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="fas fa-wheelchair" aria-hidden="true"></i></span>
                        <div class="info-box-content">
                            <a href="{{ route('ocupacionCriCreeIndex') }}"><span class="info-box-text"><strong>CRI CREE</strong></span></a>
                        </div>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="fas fa-ambulance" aria-hidden="true"></i></span>
                        <div class="info-box-content">
                            <a href="{{ route('ocupacionSamuCrumIndex') }}"><span class="info-box-text"><strong>SAMU CRUM</strong></span></a>
                        </div>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="fas fa-briefcase" aria-hidden="true"></i></span>
                        <div class="info-box-content">
                            <a href="{{ route('ocupacionOficinaCentralIndex') }}"><span class="info-box-text"><strong>Of. Central</strong></span></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-2">
                    <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="fas fa-warehouse" aria-hidden="true"></i></span>
                        <div class="info-box-content">
                            <a href="{{ route('ocupacionAlmacenIndex') }}"><span class="info-box-text"><strong>Almacén</strong></span></a>
                        </div>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="fas fa-vials" aria-hidden="true"></i></span>
                        <div class="info-box-content">
                            <a href="{{ route('ocupacionCetsLespIndex') }}"><span class="info-box-text"><strong>LESP CETS</strong></span></a>
                        </div>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="fas fa-heartbeat" aria-hidden="true"></i></span>
                        <div class="info-box-content">
                            <a href="{{ route('ocupacionCorsIndex') }}"><span class="info-box-text"><strong>CORS</strong></span></a>
                        </div>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="fas fa-child" aria-hidden="true"></i></span>
                        <div class="info-box-content">
                            <a href="{{ route('ocupacionIssreeiIndex') }}"><span class="info-box-text"><strong>ISSREEI</strong></span></a>
                        </div>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="fas fa-brain" aria-hidden="true"></i></span>
                        <div class="info-box-content">
                            <a href="{{ route('ocupacionCesameIndex') }}"><span class="info-box-text"><strong>CESAME</strong></span></a>
                        </div>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="fas fa-user-md" aria-hidden="true"></i></span>
                        <div class="info-box-content">
                            <a href="{{ route('ocupacionPsiParrasIndex') }}"><span class="info-box-text"><strong>PSI. Parras</strong></span></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-2">
                    <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="fas fa-user-clock" aria-hidden="true"></i></span>
                        <div class="info-box-content">
                            <a href="{{ route('ocupacionCeamIndex') }}"><span class="info-box-text"><strong>CEAM</strong></span></a>
                        </div>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="fas fa-baby" aria-hidden="true"></i></span>
                        <div class="info-box-content">
                            <a href="{{ route('ocupacionHospitalNinoIndex') }}"><span class="info-box-text"><strong>Hosp. del Niño</strong></span></a>
                        </div>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="fas fa-chalkboard-teacher" aria-hidden="true"></i></span>
                        <div class="info-box-content">
                            <a href="{{ route('ocupacionEnsenanzaIndex') }}"><span class="info-box-text"><strong>Pas. Enseñanza</strong></span></a>
                        </div>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="fas fa-comments" aria-hidden="true"></i></span>
                        <div class="info-box-content">
                            <a href="{{ route('ocupacionCecosamaIndex') }}"><span class="info-box-text"><strong>CECOSAMA</strong></span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Catálogos Generales --}}
    <div class="card">
        <div class="card-header">
            <strong>Catálogos de Sistema</strong>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-2">
                    <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="fas fa-calendar-check" aria-hidden="true"></i></span>
                        <div class="info-box-content">
                            <a href="{{ route('vigenciasIndex') }}"><span class="info-box-text"><strong>Vigencias - Motivos</strong></span></a>
                        </div>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="fas fa-file-invoice-dollar" aria-hidden="true"></i></span>
                        <div class="info-box-content">
                            <a href="{{ route('nominaPagoIndex') }}"><span class="info-box-text"><strong>Nóminas de Pago y Contratos</strong></span></a>
                        </div>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="fas fa-user-shield" aria-hidden="true"></i></span>
                        <div class="info-box-content">
                            <a href="{{ route('indexRol') }}"><span class="info-box-text"><strong>Roles</strong></span></a>
                        </div>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="fas fa-users" aria-hidden="true"></i></span>
                        <div class="info-box-content">
                            <a href="{{ route('indexUsuario') }}"><span class="info-box-text"><strong>Usuarios</strong></span></a>
                        </div>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="fas fa-hospital-alt" aria-hidden="true"></i></span>
                        <div class="info-box-content">
                            <a href="{{ route('indexClues') }}"><span class="info-box-text"><strong>CLUES</strong></span></a>
                        </div>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="fas fa-barcode" aria-hidden="true"></i></span>
                        <div class="info-box-content">
                            <a href="{{ route('indexCodigos') }}"><span class="info-box-text"><strong>Códigos Nómina</strong></span></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-2">
                    <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="fas fa-university" aria-hidden="true"></i></span>
                        <div class="info-box-content">
                            <a href="{{ route('indexInstitucionEducativa') }}"><span class="info-box-text"><strong>Inst. Educativa</strong></span></a>
                        </div>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="fas fa-graduation-cap" aria-hidden="true"></i></span>
                        <div class="info-box-content">
                            <a href="{{ route('indexTitulo') }}"><span class="info-box-text"><strong>Títulos</strong></span></a>
                        </div>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="fas fa-mail-bulk" aria-hidden="true"></i></span>
                        <div class="info-box-content">
                            <a href="{{ route('indexCodigoPostal') }}"><span class="info-box-text"><strong>Códigos Postales</strong></span></a>
                        </div>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="fas fa-certificate" aria-hidden="true"></i></span>
                        <div class="info-box-content">
                            <a href="{{ route('indexCertificaciones') }}"><span class="info-box-text"><strong>Certificaciones</strong></span></a>
                        </div>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="fas fa-user-tag" aria-hidden="true"></i></span>
                        <div class="info-box-content">
                            <a href="{{ route('indexOcupaciones') }}"><span class="info-box-text"><strong>Ocupaciones</strong></span></a>
                        </div>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="fas fa-layer-group" aria-hidden="true"></i></span>
                        <div class="info-box-content">
                            <a href="{{ route('registrosInactivos') }}"><span class="info-box-text"><strong>Áreas de Trabajo</strong></span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Auditoría y Bitácoras --}}
    <div class="card">
        <div class="card-header">
            <strong>Sesiones y Bitácoras</strong>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-2">
                    <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="fas fa-user-clock" aria-hidden="true"></i></span>
                        <div class="info-box-content">
                            <a href="{{ route('sesionesActivas') }}"><span class="info-box-text"><strong>Sesiones Activas</strong></span></a>
                        </div>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="fas fa-history" aria-hidden="true"></i></span>
                        <div class="info-box-content">
                            <a href="{{ route('sesionesBitacora') }}"><span class="info-box-text"><strong>Bitácora Sesiones</strong></span></a>
                        </div>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="fas fa-list-alt" aria-hidden="true"></i></span>
                        <div class="info-box-content">
                            <a href="{{ route('indexBitacoraOcupacion') }}"><span class="info-box-text"><strong>Bitácora Ocupación</strong></span></a>
                        </div>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="fas fa-trash-alt" aria-hidden="true"></i></span>
                        <div class="info-box-content">
                            <a href="{{ route('registrosInactivos') }}"><span class="info-box-text"><strong>Registros Eliminados</strong></span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer"></div>
    </div>

@stop

@include('partials.footer')

@section('css')
    {{-- Hojas de estilo adicionales --}}
@stop

@section('js')
    <script> console.log("Módulos cargados correctamente."); </script>
@stop