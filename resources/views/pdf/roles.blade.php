<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Roles</title>

    <style>
        body {
            font-family: "Segoe UI", sans-serif;
            font-size: 10px;
            color: #333;
            margin: 5px;
            line-height: 1.4;
        }

        h1, h2, h3, h4 {
            color: #2c3e50;
            text-align: center;
            margin-bottom: 10px;
        }

        h4 {
            font-size: 14px;
            text-transform: uppercase;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            padding: 6px 8px;
            border: 0.5px solid #bbb;
            font-size: 10px;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
            text-align: left;
        }

        .section-title {
            background-color: #ede7f6;
            padding: 6px;
            font-weight: bold;
            border: 1px solid #b39ddb;
            text-transform: uppercase;
            font-size: 12px;
            margin-top: 15px;
            margin-bottom: 5px;
        }
    </style>
</head>

<body>

    <h4>SISTEMA DE ROLES DEL USUARIO</h4>

    <div class="section-title">LISTADO DE ROLES</div>

    <table>
        <thead>
            <tr>
                <th style="width: 10%;">ID</th>
                <th style="width: 30%;">ROL</th>
                <th style="width: 60%;">ETIQUETA</th>
            </tr>
        </thead>

        <tbody>
            @foreach($roles as $role)
                <tr>
                    <td>{{ $role->id }}</td>
                    <td>{{ $role->rol }}</td>
                    <td>{{ $role->label_rol }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>