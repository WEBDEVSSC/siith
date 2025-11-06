@php
use Carbon\Carbon;
@endphp

<h3>TRABAJADORES CON VENCIMIENTO DE BAJA TEMPORAL EL DÍA ({{ Carbon::tomorrow()->format('d/m/Y') }})</h3>
<h3>UNIDAD: {{$titulo}}</h3>

<p style="font-size: 0.9em; color: #555;">
    <p><strong>Este es un correo automático generado por S.I.I.T.H. (Sistema Integral de Información de Talento Humano).</strong></p>
    <p><strong>Este mensaje es únicamente para fines informativos y actualización de las comisiones, en caso de que así proceda.</strong></p>
</p>

@if($resultados->isEmpty())
    <p>No se encontraron registros</p>
@else
    <table border="1" cellpadding="8" cellspacing="0" style="border-collapse: collapse; width: 100%;">
        <thead>
            <tr style="background-color: #f2f2f2;">
                <th>Nombre</th>
                <th>CURP</th>
                <th>Teléfono (Casa / Celular)</th>
                <th>Unidad</th>
                <th>Fecha de vencimiento</th>
                <th>Motivo</th>
            </tr>
        </thead>
        <tbody>
            @foreach($resultados as $vigencia)
                <tr>
                    <td>{{ $vigencia->profesional->nombre ?? 'Sin nombre' }} {{ $vigencia->profesional->apellido_paterno ?? 'Sin apellido' }} {{ $vigencia->profesional->apellido_materno ?? 'Sin apellido' }}</td>
                    <td>{{ $vigencia->profesional->curp ?? 'Sin curp' }}</td>
                    <td>{{ $vigencia->profesional->telefono_casa ?? '' }}  {{ $vigencia->profesional->celular ?? '' }}</td>
                    <td>J.{{ $vigencia->profesional->puesto->clues_adscripcion_jurisdiccion ?? '' }} - {{ $vigencia->profesional->puesto->clues_adscripcion ?? '' }} | {{ $vigencia->profesional->puesto->clues_adscripcion_nombre ?? '' }}</td>
                    <td>{{ \Carbon\Carbon::parse($vigencia->fecha_final)->format('d/m/Y') }}</td>
                    <td>{{ $vigencia->vigencia ?? 'Sin vigencia' }} - {{ $vigencia->vigencia_motivo ?? 'Sin motivo' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif

