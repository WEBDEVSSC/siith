@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1><strong>Declaración Patrimonial</strong></h1>
@stop

@section('content')

<div class="card">
    <div class="card-header">Liga: <a href="https://declaranet.sefircoahuila.gob.mx" target="_blank">https://declaranet.sefircoahuila.gob.mx</a></div>
    <div class="card-body">

        <ul>
        <li>Verificar que la página de internet sea la del Estado.</li>
        <li>Personal de NUEVO INGRESO tienen 60 días para PRESENTAR DECLARACION INICIAL.</li>
        <li>En MAYO de CADA AÑO, se debe cumplir con la DECLARACION DE MODIFICACION (relativa al año en curso, en la que se reporta información del 1º enero – 31 diciembre, del año inmediato anterior); a excepción del personal de nuevo ingreso que haya presentado la declaración inicial en el período de enero a abril del mismo año.</li>
        <li>Personal que cause BAJA de esta SECRETARÍA DE SALUD, deberá realizar la DECLARACIÓN de CONCLUSIÓN, dentro de los 60 días siguientes a su baja.</li>
        <li>Personal que cambió de OTRA DEPENDENCIA de GOBIERNO DEL ESTADO a esta SECRETARÍA DE SALUD, elaborar su AVISO DE CAMBIO en la misma página de declaración patrimonial.</li>
        <li>Todo RESIDENTE MEDICO deberá realizar las declaraciones patrimoniales correspondientes.</li>
        </ul>

        <p>Es obligación de todo servidor público presentar en tiempo y forma la Declaración de Situación Patrimonial y de Intereses durante el mes de mayo de cada año ante la Secretaría de Fiscalización y Rendición de Cuentas (SEFIRC), en cumplimiento de los Artículos 32, 33 y 46 de la Ley General de Responsabilidades Administrativas y de conformidad con lo dispuesto en el Artículo 31 Fracción XIII de la Ley Orgánica de la Administración Pública del Estado de Coahuila de Zaragoza.</p>

    </div>
    <div class="card-footer"></div>
    
</div>

@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop