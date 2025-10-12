<h3>LISTA DE TRABAJADORES QUE SE VENCE EL DÍA DE HOY SU PERMISO DE BAJA TEMPORAL</h3>

@if($resultados->isEmpty())
    <p>No se encontraron profesionales con baja temporal hoy.</p>
@else
    <table border="1" cellpadding="8" cellspacing="0" style="border-collapse: collapse; width: 100%;">
        <thead>
            <tr style="background-color: #f2f2f2;">
                <th>Nombre</th>
                <th>CURP</th>
                <th>Tel Casa / Celular</th>
                <th>Unidad</th>
                <th>Fecha Final</th>
                <th>Vigencia</th>
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

<p style="font-size: 0.9em; color: #555;">
    <strong>Este es un correo automático generado por S.I.I.T.H. Por favor, no responder.</strong>
</p>