<h2>Resumen de felicitaciones enviadas</h2>

<p>Fecha: {{ \Carbon\Carbon::now()->format('d-m-Y') }}</p>

@if(count($profesionales) > 0)
    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>Nombre Completo</th>
                <th>Email</th>
                <th>Clues Adscripción</th>
                <th>Nombre Clues Adscripción</th>
            </tr>
        </thead>
        <tbody>
            @foreach($profesionales as $persona)
                <tr>
                    <td>{{ $persona->nombre }} {{ $persona->apellido_paterno }} {{ $persona->apellido_materno }}</td>
                    <td>{{ $persona->email }}</td>
                    <td>{{ $persona->puesto->clues_adscripcion ?? 'N/A' }}</td>
                    <td>{{ $persona->puesto->clues_adscripcion_nombre ?? 'N/A' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p>No se enviaron correos hoy.</p>
@endif