<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Profesional</th>
            <th>Catalogo</th>
            <th>Ocupación Anterior</th>
            <th>Ocupación Actual</th>
            <th>Fecha de Modificación</th>
        </tr>
    </thead>
    <tbody>
        @foreach($registros as $r)
            <tr>
                <td>{{ $r->id }}</td>
                <td>{{ $r->profesional->nombre }} {{ $r->profesional->apellido_paterno }} {{ $r->profesional->apellido_materno }}</td>
                <td>{{ $r->catalogo }}</td>
                <td>{{ $r->ocupacion_anterior }}</td>
                <td>{{ $r->ocupacion_actual }}</td>
                <td>{{ $r->created_at }}</td>
            </tr>
        @endforeach
    </tbody>
</table>