@extends('adminlte::page')

@section('title', 'Dashboard')

@section('plugins.Sweetalert2', true)

@section('content_header')
    <h1><strong>Profesionales</strong> <small>Firma de Nomina</small></h1>
@stop

@section('content')

@if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: '¡Éxito!',
            text: '{{ session('success') }}',
            confirmButtonText: 'Aceptar'
        });
    </script>
@endif

<div class="alert alert-info" role="alert">

    <ul>
        <li>Nombre : {{$profesionalFirmaNomina->profesional->nombre}} {{$profesionalFirmaNomina->profesional->apellido_paterno}} {{$profesionalFirmaNomina->profesional->apellido_materno}}</li>
        <li>CURP : {{$profesionalFirmaNomina->curp}}</li>
        <li>RFC : {{$profesionalFirmaNomina->profesional->rfc}}{{$profesionalFirmaNomina->profesional->homoclave}}</li>
        <li>Cantidad : ${{$profesionalFirmaNomina->cantidad}}</li>
        <li>Quincena : {{$profesionalFirmaNomina->quincena_numero}} - {{$profesionalFirmaNomina->anio}}</li>
    </ul>
    
</div>
    
<div class="card">
        <div class="card-header">

            <a href="{{ route('firmaIndex') }}" class="btn btn-info btn-sm">PANEL DE CONTROL</a>

        </div>

        
            
            <div class="card-body">

                @if ($profesionalFirmaNomina->status == 1)
                    
                    <img src="{{ asset('storage/' . $profesionalFirmaNomina->firma) }}" alt="Firma del profesional" width="500">


                @else

                    <div class="row mt-4">
                        <div class="col-12">
                            <canvas id="signature-pad" width="800" height="300" style="border: 1px solid #ccc;"></canvas>
                        </div>

                        <div class="col-12 mt-3">
                            <form id="signature-form" method="POST" action="{{ route('firmaStore') }}">
                                @csrf
                                <input type="hidden" name="profesionalFirmaNomina" value="{{ $profesionalFirmaNomina->id }}">
                                <input type="hidden" name="firma" id="firma">
                        </div>
                    </div>

                @endif

                

            </div>
            
            <div class="card-footer">
                @if ($profesionalFirmaNomina->status == 1)

                @else

                    <button type="button" class="btn btn-secondary btn-sm" id="limpiar-firma">Limpiar</button>
                    <button type="button" class="btn btn-primary btn-sm" id="guardar-firma">Guardar Firma</button>

                @endif
                    
                </form>
            </div>

    </form>
</div>

@stop

@include('partials.footer')

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    

    {{-- Script de Signature Pad --}}
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
    <script>
        const canvas = document.getElementById('signature-pad');
        const signaturePad = new SignaturePad(canvas);

        // Botón para limpiar la firma
        document.getElementById('limpiar-firma').addEventListener('click', function () {
            signaturePad.clear();
        });

        // Botón para guardar la firma
        document.getElementById('guardar-firma').addEventListener('click', function () {
            if (signaturePad.isEmpty()) {
                alert("Por favor firma antes de guardar.");
                return;
            }

            const dataURL = signaturePad.toDataURL('image/png');
            document.getElementById('firma').value = dataURL;
            document.getElementById('signature-form').submit();
        });
    </script>

@stop







