<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Ocupaciones - CSUyR</title>
    <style>
        @page {
            /* Dejamos un margen inferior de 50px exclusivo para el footer */
            margin: 25px 25px 50px 25px;
        }
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 9px;
            color: #333333;
            line-height: 1.3;
        }

        /* Regla fundamental para DomPDF: 
           El footer debe tener posición fija y estar dentro del límite del margen */
        .footer {
            position: fixed;
            bottom: -35px;
            left: 0px;
            right: 0px;
            height: 20px;
            font-size: 9px;
            color: #777777;
            border-top: 1px solid #dddddd;
            padding-top: 4px;
        }

        .header {
            width: 100%;
            margin-bottom: 15px;
            border-bottom: 2px solid #2b3e50;
            padding-bottom: 8px;
        }
        .title {
            font-size: 16px;
            font-weight: bold;
            color: #2b3e50;
            text-align: center;
            text-transform: uppercase;
            margin: 0;
        }
        .subtitle {
            font-size: 10px;
            text-align: center;
            color: #666666;
            margin-top: 3px;
        }
        .table-data {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5px;
        }
        .table-data th {
            background-color: #2b3e50;
            color: #ffffff;
            font-size: 9.5px;
            font-weight: bold;
            text-transform: uppercase;
            padding: 6px 4px;
            border: 1px solid #1a252f;
            text-align: center;
        }
        .table-data td {
            padding: 5px 4px;
            border: 1px solid #cccccc;
            vertical-align: middle;
        }
        .table-data tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        .text-center { text-align: center; }
        .text-left { text-align: left; }

        .page-number:before {
            content: "Página " counter(page);
        }
    </style>
</head>
<body>

    <!-- CLAVE EN DOMPDF: Ubicar los elementos con 'position: fixed' al inicio del <body> -->
    <div class="footer">
        <table style="width: 100%; border: none; padding: 0; margin: 0;">
            <tr>
                <td style="text-align: left; width: 50%; border: none; padding: 0;">
                    Generado el {{ date('d/m/Y H:i') }} | <span class="page-number"></span>
                </td>
                <td style="text-align: right; width: 50%; border: none; padding: 0;">
                    Subdirección de Recursos Humanos | SIITH
                </td>
            </tr>
        </table>
    </div>

    <div class="header">
        <h1 class="title">Catálogo de Ocupaciones / Cartera de Servicios</h1>
        <div class="subtitle">Centros de Salud Urbano y Rural (CSUyR)</div>
    </div>

    <table class="table-data">
        <thead>
            <tr>
                <th>Orden</th>
                <th>ID</th>
                <th>Unidad</th>
                <th>Área</th>
                <th>Subarea</th>
                <th>Ocupación</th>
                <th>S Area Trabajo</th>
                <th>S Ocupación</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($ocupaciones as $ocupacion)
                <tr>
                    <td class="text-center">{{ $ocupacion->orden ?? '-' }}</td>
                    <td class="text-center">{{ $ocupacion->id ?? '-' }}</td>
                    <td class="text-left">{{ $ocupacion->unidad ?? '-' }}</td>
                    <td class="text-left">{{ $ocupacion->area ?? '-' }}</td>
                    <td class="text-left">{{ $ocupacion->subarea ?? '-' }}</td>
                    <td class="text-left">{{ $ocupacion->ocupacion ?? '-' }}</td>
                    <td class="text-left">{{ $ocupacion->s_area_trabajo ?? '-' }}</td>
                    <td class="text-left">{{ $ocupacion->s_ocupacion ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center" style="padding: 15px; color: #888888;">
                        No se encontraron registros registrados en el sistema.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>