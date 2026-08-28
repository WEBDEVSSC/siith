@extends('adminlte::page')

@section('title', 'Dashboard')

@section('plugins.Select2', true)

@section('content_header')
    <h1><strong>Documentos de Domicilio e Identificación Personal</strong></h1>
@stop

@section('content')

<div class="alert alert-info" role="alert">
    <ul>
        <li><strong>Nombre</strong> : {{ $profesional->nombre }} {{ $profesional->apellido_paterno }} {{ $profesional->apellido_materno }}</li>
        <li><strong>CURP</strong> : {{ $profesional->curp }}</li>
    </ul>
</div>
    
<div class="card">
    <div class="card-header">
        <a href="{{ route('profesionalShow', $profesional->id) }}" class="btn btn-info btn-sm">PERFIL DEL TRABAJADOR</a>
    </div>

    <form action="{{ route('storeDireccion', $profesional->id) }}" method="POST" enctype="multipart/form-data">
        @csrf 
        @method('POST')
            
        <div class="card-body">

            <div class="row mt-3">   
                <div class="col-md-3">
                    <p><strong>Calle</strong></p>
                    <input type="text" name="calle" class="form-control" value="{{ old('calle') }}">
                    @error('calle')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-3">
                    <p><strong>No. Interior</strong></p>
                    <input type="text" name="numero_interior" class="form-control" value="{{ old('numero_interior') }}">
                    @error('numero_interior')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-3">
                    <p><strong>No. Exterior</strong></p>
                    <input type="text" name="numero_exterior" class="form-control" value="{{ old('numero_exterior') }}">
                    @error('numero_exterior')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-3">
                    <p><strong>Código Postal y Colonia</strong></p>
                    <select id="codigo_postal" name="codigo_postal" class="form-control select2">
                        <option value="">-- Seleccione una opción --</option>
                        @foreach ($codigosPostales as $cp)
                            <option value="{{ $cp->id }}" {{ old('codigo_postal') == $cp->codigo_postal ? 'selected' : '' }}>
                                {{ $cp->codigo_postal }} - {{ $cp->colonia }}
                            </option>
                        @endforeach
                    </select>                
                    @error('codigo_postal')
                        <br><div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            @if (Auth::user()->role == 'admin')
                <div class="row mt-3">
                    <div class="col-md-3">
                        <p><strong>Clave de Elector</strong></p>
                        <input type="text" name="clave_elector" class="form-control" value="{{ old('clave_elector') }}">
                        @error('clave_elector')
                            <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <p><strong>Sección</strong></p>
                        <input type="text" name="seccion" class="form-control" value="{{ old('seccion') }}">
                        @error('seccion')
                            <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <p><strong>Vigencia</strong></p>
                        <input type="text" name="vigencia" class="form-control" value="{{ old('vigencia') }}">
                        @error('vigencia')
                            <br><div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            @endif

            @if(Auth::user()->role == 'admin' || Auth::user()->role == 'almacen')
                <div class="row mt-3">
                    <div class="col-12">
                        <div class="callout callout-info elevation-1">
                            <h5>
                                <i class="fas fa-info-circle text-info mr-1"></i>
                                Recordatorio Normativo
                            </h5>

                            <p class="mb-2">
                                De conformidad con lo establecido en el 
                                <strong>Manual de Organización</strong> y la 
                                <strong>Ley Federal del Trabajo</strong>, es necesario mantener 
                                actualizada la documentación de identificación del personal con una periodicidad de 
                                <strong>cada 2 años</strong>.
                            </p>

                            <h5>
                                <i class="fas fa-info-circle text-info mr-1"></i>
                                Nota
                            </h5>

                            <p class="mb-0">
                                <i class="fas fa-file-pdf text-danger mr-1"></i>
                                El documento deberá presentarse en <strong>formato PDF</strong>, 
                                escaneado a <strong>tamaño real</strong>, con buena calidad de 
                                imagen y <strong>fondo blanco</strong>.
                            </p>

                            <p class="mb-0">
                                <i class="fas fa-cloud-upload-alt text-primary mr-1"></i>
                                Para subir el documento, haga clic en <strong>«Examinar»</strong> para seleccionarlo desde su equipo o <strong>arrástrelo directamente desde el explorador de archivos</strong> hasta el área de carga.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="row mt-3">

                    <!-- COMPROBANTE DE DOMICILIO -->
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="comprobante_domicilio"><strong>COMPROBANTE DE DOMICILIO</strong></label>
                        <input type="file" class="filepond" id="comprobante_domicilio" name="comprobante_domicilio" accept="application/pdf">
                        @error('comprobante_domicilio')
                            <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- INE -->
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="ine"><strong>INE</strong></label>
                        <input type="file" class="filepond" id="ine" name="ine" accept="application/pdf">
                        @error('ine')
                            <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                

                <!-- CURP -->
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="curp"><strong>CURP</strong></label>
                        <input type="file" class="filepond" id="curp" name="curp" accept="application/pdf">
                        @error('curp')
                            <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- CURP -->
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="rfc"><strong>RFC</strong> (Constancia de situación fiscal)</label>
                        <input type="file" class="filepond" id="rfc" name="rfc" accept="application/pdf">
                        @error('rfc')
                            <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            @endif

            

        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-success btn-sm">REGISTRAR DATOS</button>
        </div>
    </form>
</div>

@stop

@include('partials.footer')

@section('css')
    <!-- FilePond CSS -->
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
    <link href="https://unpkg.com/filepond-plugin-pdf-preview/dist/filepond-plugin-pdf-preview.min.css" rel="stylesheet">

    <style>
        .filepond--root {
            height: 180px !important;
        }

        /* Estilo visual cuando un archivo está listo/cargado */
        .filepond--item-panel {
            background-color: #28a745 !important; /* Verde de éxito de AdminLTE */
        }

        /* Select2 Styles */
        .select2-container--default .select2-selection--single {
            height: calc(2.25rem + 2px) !important;
            border-radius: 0.25rem !important;
            border: 1px solid #ced4da !important;
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: calc(2.25rem - 2px) !important;
            padding-left: 0.75rem !important;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: calc(2.25rem + 2px) !important;
        }
    </style>
@stop

@section('js')
    <!-- Plugins de FilePond -->
    <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
    <script src="https://unpkg.com/filepond-plugin-pdf-preview/dist/filepond-plugin-pdf-preview.min.js"></script>
    <script src="https://unpkg.com/filepond/dist/filepond.js"></script>

    <script>
        $(document).ready(function() {
            // Inicialización de Select2
            $('#codigo_postal').select2({
                placeholder: "-- Selecciona una opción --",
                allowClear: true
            });

            // Registrar Plugins (Validación Tipo, Tamaño y PDF Preview)
            FilePond.registerPlugin(
                FilePondPluginFileValidateType,
                FilePondPluginFileValidateSize,
                FilePondPluginPdfPreview
            );

            // Crear instancias de FilePond con configuraciones avanzadas
            const inputElements = document.querySelectorAll('input.filepond');
            
            Array.from(inputElements).forEach(inputElement => {
                FilePond.create(inputElement, {
                    storeAsFile: true,
                    credits: false,
                    
                    // Configuración de tipos y peso
                    acceptedFileTypes: ['application/pdf'],
                    maxFileSize: '5MB',
                    
                    // Etiquetas y mensajes en Español
                    labelIdle: 'Arrastra tu PDF o <span class="filepond--label-action">Examina</span>',
                    labelFileTypeNotAllowed: 'Formato no válido',
                    fileValidateTypeLabelExpectedTypes: 'Solo se permiten archivos PDF',
                    labelMaxFileSizeExceeded: 'El archivo es demasiado grande',
                    labelMaxFileSize: 'El tamaño máximo es {filesize}',
                    labelFileLoading: 'Cargando...',
                    labelFileProcessing: 'Cargando vista previa...',
                    labelFileProcessingComplete: 'Documento listo',
                    labelTapToCancel: 'clic para cancelar',
                    labelTapToRetry: 'clic para reintentar',
                    labelTapToUndo: 'clic para quitar',

                    // Vista previa del PDF
                    allowPdfPreview: true,
                    pdfPreviewHeight: 140,
                    pdfComponentExtraParams: 'toolbar=0&navpanes=0&scrollbar=0'
                });
            });
        });
    </script>
@stop