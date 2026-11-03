<table>
    <thead>
        <tr>
            <th>ID PROFESIONAL</th>
            <th>FOTOGRAFIA</th>
            <th>CATALOGO DE PUESTO</th>
            <th>CURP</th>
            <th>RFC</th>
            <th>NOMBRE COMPLETO</th>
            <th>FECHA DE NACIMIENTO</th>
            <th>ENTIDAD DE NACIMIENTO</th>
            <th>MUNICIPIO DE NACIMIENTO</th>
            <th>NACIONALIDAD</th>
            <th>CELULAR</th>
            <th>E-MAIL</th>
            <th>ADSCRIPCION FISICA</th>
            <th>NOMINA</th>
            <th>CODIGO DE PUESTO</th>
            <th>DESCRIPCION</th>
            <th>CLAVE ELECTOR</th>
            <th>SECCION</th>
            <th>DISTRITO LOCAL</th>
            <th>DISTRITO FEDERAL</th>
            <th>VIGENCIA</th>
        </tr>
    </thead>
    <tbody>
        @foreach($profesionales as $row)
            <tr>
                <td>{{ $row->id }}</td>
                <td></td>
                <td></td>
                <td>{{ $row->curp ?? '' }}</td>
                <td>{{ $row->rfc ?? '' }}</td>
                <td>{{ $row->nombre ?? '' }} {{ $row->apellido_paterno ?? '' }} {{ $row->apellido_materno ?? '' }}</td>
                <td>{{ $row->fecha_nacimiento ? \Carbon\Carbon::parse($row->fecha_nacimiento)->format('d-m-Y') : '' }}</td>
                <td>{{ $row->entidad_nacimiento ?? '' }}</td>
                <td>{{ $row->municipio_nacimiento ?? '' }}</td>
                <td>{{ $row->nacionalidad ?? '' }}</td>
                <td>{{ $row->celular ?? '' }}</td>
                <td>{{ $row->email ?? '' }}</td>
                <td>{{ $row->puesto->clues_adscripcion_nombre ?? '' }}</td>
                <td>{{ $row->puesto->nomina_pago ?? '' }}</td>
                <td>{{ $row->puesto->codigo ?? '' }}</td>
                <td>{{ $row->puesto->codigo_puesto ?? '' }}</td>
                <td>{{ $row->ine->clave_elector ?? '' }}</td>
                <td>{{ $row->ine->seccion ?? '' }}</td>
                <td>{{ $row->ine->dl ?? '' }}</td>
                <td>{{ $row->ine->df ?? '' }}</td>
                <td>{{ $row->ine->vigencia ?? '' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>