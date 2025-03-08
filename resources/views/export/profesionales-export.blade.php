<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Eventos</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>

</head>
<body>
    <table>
        <thead>
            <tr>
                <th><strong>ID</strong></th>
                <th><strong>CURP</strong></th>
                <th><strong>RFC</strong></th>
                <th><strong>HOMOCLAVE</strong></th>
                <th><strong>NOMBRE</strong></th>
                <th><strong>APELLIDO PATERNO</strong></th>
                <th><strong>APELLIDO MATERNO</strong></th>
                <th><strong>SEXO</strong></th>
                <th><strong>FECHA DE NACIMIENTO</strong></th>
                <th><strong>ENTIDAD DE NACIMIENTO</strong></th>
                <th><strong>MUNICIPIO DE NACIMIENTO</strong></th>
                <th><strong>PAIS DE NACIMIENTO</strong></th>
                <th><strong>NACIONALIDAD</strong></th>
                <th><strong>ESTADO CONYUGAL</strong></th>
                <th><strong>TELEFONO</strong></th>
                <th><strong>CELULAR</strong></th>
                <th><strong>EMAIL</strong></th>
            </tr>
        </thead>
        <tbody>
            @foreach($profesionales as $profesional)
                <tr>
                    <td>{{ $profesional->id }}</td>
                    <td>{{ $profesional->curp }}</td>
                    <td>{{ $profesional->rfc }}</td>
                    <td>{{ $profesional->homoclave }}</td>
                    <td>{{ $profesional->nombre }}</td>
                    <td>{{ $profesional->apellido_paterno }}</td>
                    <td>{{ $profesional->apellido_materno }}</td>
                    <td>{{ $profesional->sexo }}</td>
                    <td>{{ $profesional->fecha_nacimiento }}</td>
                    <td>{{ $profesional->entidad_nacimiento }}</td>
                    <td>{{ $profesional->municipio_nacimiento }}</td>
                    <td>{{ $profesional->pais_nacimiento }}</td>
                    <td>{{ $profesional->nacionalidad }}</td>
                    <td>{{ $profesional->estado_conyugal }}</td>
                    <td>{{ $profesional->telefono_casa }}</td>
                    <td>{{ $profesional->celular }}</td>
                    <td>{{ $profesional->email }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
