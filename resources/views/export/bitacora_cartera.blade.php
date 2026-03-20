<table>
    <thead>
        <tr>
            <th style="color:white;"><strong>#</strong></th>
            <th style="color:white;"><strong>TRABAJADOR</strong></th>
            <th style="color:white;"><strong>CURP</strong></th>
            <th style="color:white;"><strong>RFC</strong></th>
            <th style="color:white;"><strong>CATALOGO</strong></th>
            <th style="color:white;"><strong>OCUPACION ANTERIOR</strong></th>
            <th style="color:white;"><strong>OCUPACION ACTUAL</strong></th>
            <th style="color:white;"><strong>CAPTURISTA</strong></th>
            <th style="color:white;"><strong>FECHA DE MODIFICACION</strong></th>
        </tr>
    </thead>
    <tbody>
        @foreach($registros as $r)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $r->profesional->nombre }} {{ $r->profesional->apellido_paterno }} {{ $r->profesional->apellido_materno }}</td>
                <td>{{ $r->profesional->curp }}</td>
                <td>{{ $r->profesional->rfc }}{{ $r->profesional->homoclave }}</td>
                <td>{{ $r->catalogo }}</td>
                <td>{{ $r->ocupacion_anterior }}</td>
                <td>{{ $r->ocupacion_actual }}</td>
                <td>{{ $r->capturista_label }}</td>
                <td>{{ $r->created_at ? $r->created_at->format('d-m-Y H:i') : '' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>