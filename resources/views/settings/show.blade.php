@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1><strong>Catalogos de Sistema</h1>
@stop

@section('content')

    
<div class="card">

    <div class="card-header">
        <strong>Ocupaciones / Cartera de Servicios</strong>
    </div>

    <div class="card-body">

        <div class="row">
            <div class="col-md-2">
                <div class="info-box">
                <span class="info-box-icon bg-info"><i class="fa fa-cog" aria-hidden="true"></i></span>

                <div class="info-box-content">
                    <a href="{{ route('ocupacionCsuyrIndex') }}"><span class="info-box-text">C.S.U.y.R.</span></a>
                </div>
                <!-- /.info-box-content -->
                </div>
            </div>

            <div class="col-md-2">
                <div class="info-box">
                <span class="info-box-icon bg-info"><i class="fa fa-cog" aria-hidden="true"></i></span>

                <div class="info-box-content">
                    <a href="{{ route('ocupacionHospitalIndex') }}"><span class="info-box-text">Hospitales</span></a>
                </div>
                <!-- /.info-box-content -->
                </div>
            </div>

            <div class="col-md-2">
                <div class="info-box">
                <span class="info-box-icon bg-info"><i class="fa fa-cog" aria-hidden="true"></i></span>

                <div class="info-box-content">
                    <a href="{{ route('ocupacionOfJurisdiccionalIndex') }}"><span class="info-box-text">Of. Jurisdiccionales</span></a>
                </div>
                <!-- /.info-box-content -->
                </div>
            </div>

            <div class="col-md-2">
                <div class="info-box">
                <span class="info-box-icon bg-info"><i class="fa fa-cog" aria-hidden="true"></i></span>

                <div class="info-box-content">
                    <a href="{{ route('ocupacionCriCreeIndex') }}"><span class="info-box-text">CRI CREE</span></a>
                </div>
                <!-- /.info-box-content -->
                </div>
            </div>

            <div class="col-md-2">
                <div class="info-box">
                <span class="info-box-icon bg-info"><i class="fa fa-cog" aria-hidden="true"></i></span>

                <div class="info-box-content">
                    <a href="{{ route('ocupacionSamuCrumIndex') }}"><span class="info-box-text">SAMU CRUM</span></a>
                </div>
                <!-- /.info-box-content -->
                </div>
            </div>

            <div class="col-md-2">
                <div class="info-box">
                <span class="info-box-icon bg-info"><i class="fa fa-cog" aria-hidden="true"></i></span>

                <div class="info-box-content">
                    <a href="{{ route('ocupacionOficinaCentralIndex') }}"><span class="info-box-text"><span class="info-box-text">Of. Central</span></a>
                </div>
                <!-- /.info-box-content -->
                </div>
            </div>
        </div>

        <!-- ----------------------------------------------------- -->

        <div class="row">
            <div class="col-md-2">
                <div class="info-box">
                <span class="info-box-icon bg-info"><i class="fa fa-cog" aria-hidden="true"></i></span>

                <div class="info-box-content">
                    <a href="{{ route('ocupacionAlmacenIndex') }}"><span class="info-box-text"><span class="info-box-text"><span class="info-box-text">Almacén</span></a>
                </div>
                <!-- /.info-box-content -->
                </div>
            </div>

            <div class="col-md-2">
                <div class="info-box">
                <span class="info-box-icon bg-info"><i class="fa fa-cog" aria-hidden="true"></i></span>

                <div class="info-box-content">
                    <a href="{{ route('ocupacionCetsLespIndex') }}"><span class="info-box-text"><span class="info-box-text"><span class="info-box-text">LESP CETS</span></a>
                </div>
                <!-- /.info-box-content -->
                </div>
            </div>

            <div class="col-md-2">
                <div class="info-box">
                <span class="info-box-icon bg-info"><i class="fa fa-cog" aria-hidden="true"></i></span>

                <div class="info-box-content">
                    <a href="{{ route('ocupacionCorsIndex') }}"><span class="info-box-text"><span class="info-box-text"><span class="info-box-text">CORS</span></a>
                </div>
                <!-- /.info-box-content -->
                </div>
            </div>

            <div class="col-md-2">
                <div class="info-box">
                <span class="info-box-icon bg-info"><i class="fa fa-cog" aria-hidden="true"></i></span>

                <div class="info-box-content">
                    <a href="{{ route('ocupacionIssreeiIndex') }}"><span class="info-box-text"><span class="info-box-text"><span class="info-box-text">ISSREEI</span></a>
                </div>
                <!-- /.info-box-content -->
                </div>
            </div>

            <div class="col-md-2">
                <div class="info-box">
                <span class="info-box-icon bg-info"><i class="fa fa-cog" aria-hidden="true"></i></span>

                <div class="info-box-content">
                    <a href="{{ route('ocupacionCesameIndex') }}"><span class="info-box-text"><span class="info-box-text"><span class="info-box-text">CESAME</span></a>
                </div>
                <!-- /.info-box-content -->
                </div>
            </div>

            <div class="col-md-2">
                <div class="info-box">
                <span class="info-box-icon bg-info"><i class="fa fa-cog" aria-hidden="true"></i></span>

                <div class="info-box-content">
                    <a href="{{ route('ocupacionPsiParrasIndex') }}"><span class="info-box-text"><span class="info-box-text"><span class="info-box-text">PSI. Parras</span></a>
                </div>
                <!-- /.info-box-content -->
                </div>
            </div>
        </div>

        <!-- ------------------------------------------------------------- -->

        <div class="row">
            <div class="col-md-2">
                <div class="info-box">
                <span class="info-box-icon bg-info"><i class="fa fa-cog" aria-hidden="true"></i></span>

                <div class="info-box-content">
                    <a href="{{ route('ocupacionCeamIndex') }}"><span class="info-box-text"><span class="info-box-text"><span class="info-box-text">CEAM</span></a>
                </div>
                <!-- /.info-box-content -->
                </div>
            </div>

            <div class="col-md-2">
                <div class="info-box">
                <span class="info-box-icon bg-info"><i class="fa fa-cog" aria-hidden="true"></i></span>

                <div class="info-box-content">
                    <a href="{{ route('ocupacionHospitalNinoIndex') }}"><span class="info-box-text"><span class="info-box-text"><span class="info-box-text">Hosp. del Niño</span></a>
                </div>
                <!-- /.info-box-content -->
                </div>
            </div>

            <div class="col-md-2">
                <div class="info-box">
                <span class="info-box-icon bg-info"><i class="fa fa-cog" aria-hidden="true"></i></span>

                <div class="info-box-content">
                    <a href="{{ route('ocupacionEnsenanzaIndex') }}"><span class="info-box-text"><span class="info-box-text"><span class="info-box-text">Pas. Enseñanza</span></a>
                </div>
                <!-- /.info-box-content -->
                </div>
            </div>

            <div class="col-md-2">
                <div class="info-box">
                <span class="info-box-icon bg-info"><i class="fa fa-cog" aria-hidden="true"></i></span>

                <div class="info-box-content">
                    <a href="{{ route('ocupacionCecosamaIndex') }}"><span class="info-box-text"><span class="info-box-text"><span class="info-box-text">CECOSAMA</span></a>
                </div>
                <!-- /.info-box-content -->
                </div>
            </div>

        </div>

        <!-- ---------------------------------------------------- -->

    </div>
        
</div>


<div class="card">
    <div class="card-header">
    </div>
    <div class="card-body">

        <div class="row">
            <div class="col-md-2">
                <div class="info-box">
                <span class="info-box-icon bg-info"><i class="fa fa-cog" aria-hidden="true"></i></span>

                <div class="info-box-content">
                    <a href="{{ route('vigenciasIndex') }}"><span class="info-box-text"><span class="info-box-text"><span class="info-box-text">Vigencias - Motivos</span></a>
                </div>
                <!-- /.info-box-content -->
                </div>
            </div>

            <div class="col-md-2">
                <div class="info-box">
                <span class="info-box-icon bg-info"><i class="fa fa-cog" aria-hidden="true"></i></span>

                <div class="info-box-content">
                    <a href="{{ route('nominaPagoIndex') }}"><span class="info-box-text"><span class="info-box-text"><span class="info-box-text">Nóminas de Pago y Contratos</span></a>
                </div>
                <!-- /.info-box-content -->
                </div>
            </div>

            <div class="col-md-2">
                <div class="info-box">
                <span class="info-box-icon bg-info"><i class="fa fa-cog" aria-hidden="true"></i></span>

                <div class="info-box-content">
                    <a href="{{ route('indexRol') }}"><span class="info-box-text"><span class="info-box-text"><span class="info-box-text">Roles</span></a>
                </div>
                <!-- /.info-box-content -->
                </div>
            </div>

            <div class="col-md-2">
                <div class="info-box">
                <span class="info-box-icon bg-info"><i class="fa fa-cog" aria-hidden="true"></i></span>

                <div class="info-box-content">
                    <a href="{{ route('indexUsuario') }}"><span class="info-box-text"><span class="info-box-text"><span class="info-box-text">Usuarios</span></a>
                </div>
                <!-- /.info-box-content -->
                </div>
            </div>

            <div class="col-md-2">
                <div class="info-box">
                <span class="info-box-icon bg-info"><i class="fa fa-cog" aria-hidden="true"></i></span>

                <div class="info-box-content">
                    <a href="{{ route('indexClues') }}"><span class="info-box-text"><span class="info-box-text"><span class="info-box-text">CLUES</span></a>
                </div>
                <!-- /.info-box-content -->
                </div>
            </div>

            <div class="col-md-2">
                <div class="info-box">
                <span class="info-box-icon bg-info"><i class="fa fa-cog" aria-hidden="true"></i></span>

                <div class="info-box-content">
                    <a href="{{ route('indexCodigos') }}"><span class="info-box-text"><span class="info-box-text"><span class="info-box-text">Códigos Nómina</span></a>
                </div>
                <!-- /.info-box-content -->
                </div>
            </div>
        </div>

    </div>
</div>

<div class="card">
    <div class="card-header"></div>
    <div class="card-body">

        <div class="row">

            <div class="col-md-2">
                <div class="info-box">
                <span class="info-box-icon bg-info"><i class="fa fa-cog" aria-hidden="true"></i></span>

                <div class="info-box-content">
                    <a href="{{ route('sesionesActivas') }}"><span class="info-box-text"><span class="info-box-text"><span class="info-box-text">Sesiones Activas</span></a>
                </div>
                <!-- /.info-box-content -->
                </div>
            </div>

            <div class="col-md-2">
                <div class="info-box">
                <span class="info-box-icon bg-info"><i class="fa fa-cog" aria-hidden="true"></i></span>

                <div class="info-box-content">
                    <a href="{{ route('sesionesBitacora') }}"><span class="info-box-text"><span class="info-box-text"><span class="info-box-text">Bitacora Sesiones</span></a>
                </div>
                <!-- /.info-box-content -->
                </div>
            </div>

        </div>

    </div>
    <div class="card-footer"></div>
</div>

@stop

@include('partials.footer')

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop