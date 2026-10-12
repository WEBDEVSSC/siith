@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1><strong>Catálogos de Sistema</strong></h1>
@stop

@section('content')

    {{-- Ocupaciones / Cartera de Servicios --}}
    <div class="card card-outline card-info">
        <div class="card-header">
            <strong>Ocupaciones / Cartera de Servicios</strong>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                    <a href="{{ route('ocupacionCsuyrIndex') }}" class="info-box-link">
                        <div class="info-box">
                            <span class="info-box-icon bg-info"><i class="fas fa-clinic-medical" aria-hidden="true"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text"><strong>C.S.U.y.R.</strong></span>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                    <a href="{{ route('ocupacionHospitalIndex') }}" class="info-box-link">
                        <div class="info-box">
                            <span class="info-box-icon bg-info"><i class="fas fa-hospital" aria-hidden="true"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text"><strong>Hospitales</strong></span>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                    <a href="{{ route('ocupacionOfJurisdiccionalIndex') }}" class="info-box-link">
                        <div class="info-box">
                            <span class="info-box-icon bg-info"><i class="fas fa-building" aria-hidden="true"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text"><strong>Of. Jurisdiccionales</strong></span>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                    <a href="{{ route('ocupacionCriCreeIndex') }}" class="info-box-link">
                        <div class="info-box">
                            <span class="info-box-icon bg-info"><i class="fas fa-wheelchair" aria-hidden="true"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text"><strong>CRI CREE</strong></span>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                    <a href="{{ route('ocupacionSamuCrumIndex') }}" class="info-box-link">
                        <div class="info-box">
                            <span class="info-box-icon bg-info"><i class="fas fa-ambulance" aria-hidden="true"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text"><strong>SAMU CRUM</strong></span>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                    <a href="{{ route('ocupacionOficinaCentralIndex') }}" class="info-box-link">
                        <div class="info-box">
                            <span class="info-box-icon bg-info"><i class="fas fa-briefcase" aria-hidden="true"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text"><strong>Of. Central</strong></span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                    <a href="{{ route('ocupacionAlmacenIndex') }}" class="info-box-link">
                        <div class="info-box">
                            <span class="info-box-icon bg-info"><i class="fas fa-warehouse" aria-hidden="true"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text"><strong>Almacén</strong></span>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                    <a href="{{ route('ocupacionCetsLespIndex') }}" class="info-box-link">
                        <div class="info-box">
                            <span class="info-box-icon bg-info"><i class="fas fa-vials" aria-hidden="true"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text"><strong>LESP CETS</strong></span>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                    <a href="{{ route('ocupacionCorsIndex') }}" class="info-box-link">
                        <div class="info-box">
                            <span class="info-box-icon bg-info"><i class="fas fa-heartbeat" aria-hidden="true"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text"><strong>CORS</strong></span>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                    <a href="{{ route('ocupacionIssreeiIndex') }}" class="info-box-link">
                        <div class="info-box">
                            <span class="info-box-icon bg-info"><i class="fas fa-child" aria-hidden="true"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text"><strong>ISSREEI</strong></span>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                    <a href="{{ route('ocupacionCesameIndex') }}" class="info-box-link">
                        <div class="info-box">
                            <span class="info-box-icon bg-info"><i class="fas fa-brain" aria-hidden="true"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text"><strong>CESAME</strong></span>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                    <a href="{{ route('ocupacionPsiParrasIndex') }}" class="info-box-link">
                        <div class="info-box">
                            <span class="info-box-icon bg-info"><i class="fas fa-user-md" aria-hidden="true"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text"><strong>PSI. Parras</strong></span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                    <a href="{{ route('ocupacionCeamIndex') }}" class="info-box-link">
                        <div class="info-box">
                            <span class="info-box-icon bg-info"><i class="fas fa-user-clock" aria-hidden="true"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text"><strong>CEAM</strong></span>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                    <a href="{{ route('ocupacionHospitalNinoIndex') }}" class="info-box-link">
                        <div class="info-box">
                            <span class="info-box-icon bg-info"><i class="fas fa-baby" aria-hidden="true"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text"><strong>Hosp. del Niño</strong></span>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                    <a href="{{ route('ocupacionEnsenanzaIndex') }}" class="info-box-link">
                        <div class="info-box">
                            <span class="info-box-icon bg-info"><i class="fas fa-chalkboard-teacher" aria-hidden="true"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text"><strong>Pas. Enseñanza</strong></span>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                    <a href="{{ route('ocupacionCecosamaIndex') }}" class="info-box-link">
                        <div class="info-box">
                            <span class="info-box-icon bg-info"><i class="fas fa-comments" aria-hidden="true"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text"><strong>CECOSAMA</strong></span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Catálogos Generales --}}
    <div class="card card-outline card-info">
        <div class="card-header">
            <strong>Catálogos de Sistema</strong>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                    <a href="{{ route('vigenciasIndex') }}" class="info-box-link">
                        <div class="info-box">
                            <span class="info-box-icon bg-info"><i class="fas fa-calendar-check" aria-hidden="true"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text"><strong>Vigencias - Motivos</strong></span>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                    <a href="{{ route('nominaPagoIndex') }}" class="info-box-link">
                        <div class="info-box">
                            <span class="info-box-icon bg-info"><i class="fas fa-file-invoice-dollar" aria-hidden="true"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text"><strong>Nóminas de Pago y Contratos</strong></span>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                    <a href="{{ route('indexRol') }}" class="info-box-link">
                        <div class="info-box">
                            <span class="info-box-icon bg-info"><i class="fas fa-user-shield" aria-hidden="true"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text"><strong>Roles</strong></span>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                    <a href="{{ route('indexUsuario') }}" class="info-box-link">
                        <div class="info-box">
                            <span class="info-box-icon bg-info"><i class="fas fa-users" aria-hidden="true"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text"><strong>Usuarios</strong></span>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                    <a href="{{ route('indexClues') }}" class="info-box-link">
                        <div class="info-box">
                            <span class="info-box-icon bg-info"><i class="fas fa-hospital-alt" aria-hidden="true"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text"><strong>CLUES</strong></span>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                    <a href="{{ route('indexCodigos') }}" class="info-box-link">
                        <div class="info-box">
                            <span class="info-box-icon bg-info"><i class="fas fa-barcode" aria-hidden="true"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text"><strong>Códigos Nómina</strong></span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                    <a href="{{ route('indexInstitucionEducativa') }}" class="info-box-link">
                        <div class="info-box">
                            <span class="info-box-icon bg-info"><i class="fas fa-university" aria-hidden="true"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text"><strong>Inst. Educativa</strong></span>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                    <a href="{{ route('indexTitulo') }}" class="info-box-link">
                        <div class="info-box">
                            <span class="info-box-icon bg-info"><i class="fas fa-graduation-cap" aria-hidden="true"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text"><strong>Títulos</strong></span>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                    <a href="{{ route('indexCodigoPostal') }}" class="info-box-link">
                        <div class="info-box">
                            <span class="info-box-icon bg-info"><i class="fas fa-mail-bulk" aria-hidden="true"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text"><strong>Códigos Postales</strong></span>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                    <a href="{{ route('indexCertificaciones') }}" class="info-box-link">
                        <div class="info-box">
                            <span class="info-box-icon bg-info"><i class="fas fa-certificate" aria-hidden="true"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text"><strong>Certificaciones</strong></span>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                    <a href="{{ route('indexOcupaciones') }}" class="info-box-link">
                        <div class="info-box">
                            <span class="info-box-icon bg-info"><i class="fas fa-user-tag" aria-hidden="true"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text"><strong>Ocupaciones</strong></span>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                    <a href="{{ route('indexAreaDeTrabajo') }}" class="info-box-link">
                        <div class="info-box">
                            <span class="info-box-icon bg-info"><i class="fas fa-layer-group" aria-hidden="true"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text"><strong>Áreas de Trabajo</strong></span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Auditoría y Bitácoras --}}
    <div class="card card-outline card-info">
        <div class="card-header">
            <strong>Sesiones y Bitácoras</strong>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                    <a href="{{ route('reporteMexicoExcel') }}" class="info-box-link">
                        <div class="info-box">
                            <span class="info-box-icon bg-info"><i class="fas fa-file-excel" aria-hidden="true"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text"><strong>Reporte México</strong></span>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                    <a href="{{ route('sesionesActivas') }}" class="info-box-link">
                        <div class="info-box">
                            <span class="info-box-icon bg-info"><i class="fas fa-user-clock" aria-hidden="true"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text"><strong>Sesiones Activas</strong></span>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                    <a href="{{ route('sesionesBitacora') }}" class="info-box-link">
                        <div class="info-box">
                            <span class="info-box-icon bg-info"><i class="fas fa-history" aria-hidden="true"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text"><strong>Bitácora Sesiones</strong></span>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                    <a href="{{ route('indexBitacoraOcupacion') }}" class="info-box-link">
                        <div class="info-box">
                            <span class="info-box-icon bg-info"><i class="fas fa-list-alt" aria-hidden="true"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text"><strong>Bitácora Ocupación</strong></span>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                    <a href="{{ route('registrosInactivos') }}" class="info-box-link">
                        <div class="info-box">
                            <span class="info-box-icon bg-info"><i class="fas fa-trash-alt" aria-hidden="true"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text"><strong>Registros Eliminados</strong></span>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                    <a href="{{ route('datosExtraidos') }}" class="info-box-link">
                        <div class="info-box">
                            <span class="info-box-icon bg-info"><i class="fas fa-file-download" aria-hidden="true"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text"><strong>Datos Extraídos</strong></span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="card-footer"></div>
    </div>

@stop

@include('partials.footer')

@section('css')
    <style>
        /* Hace que toda la info-box funcione como enlace y tenga efecto hover */
        .info-box-link {
            text-decoration: none !important;
            color: inherit;
        }

        .info-box {
            transition: all 0.2s ease-in-out;
            cursor: pointer;
            margin-bottom: 1rem;
            min-height: 80px; /* Asegura altura uniforme */
        }

        .info-box-link:hover .info-box {
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        /* Ajustes para que el texto se lea completo sin recortarse */
        .info-box-content {
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 5px 8px !important;
        }

        .info-box-text {
            white-space: normal !important;
            word-break: break-word;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 2; /* Permite hasta 2 líneas */
            -webkit-box-orient: vertical;
            line-height: 1.2;
            font-size: 0.85rem;
            color: #333;
        }
    </style>
@stop

@section('js')
    <script> console.log("Módulos cargados correctamente."); </script>
@stop