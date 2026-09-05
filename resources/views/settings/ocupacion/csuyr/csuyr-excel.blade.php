<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
</head>
<body>
    <table>
        <!-- Encabezado del reporte -->
        <tr>
            <td colspan="8" style="font-size: 14pt; font-weight: bold; text-align: center; color: #2b3e50;">
                CATÁLOGO DE OCUPACIONES / CARTERA DE SERVICIOS
            </td>
        </tr>
        <tr>
            <td colspan="8" style="font-size: 10pt; text-align: center; color: #555555;">
                Centros de Salud Urbano y Rural (CSUyR) - Subdirección de Recursos Humanos
            </td>
        </tr>
        <tr>
            <td colspan="8" style="font-size: 8pt; text-align: right; color: #777777;">
                Fecha de generación: {{ date('d/m/Y H:i') }}
            </td>
        </tr>
        <tr><!-- Fila en blanco de separación --></tr>

        <!-- Tabla de datos -->
        <thead>
            <tr>
                <th style="background-color: #2b3e50; color: #ffffff; font-weight: bold; text-align: center; border: 1px solid #1a252f;">Orden</th>
                <th style="background-color: #2b3e50; color: #ffffff; font-weight: bold; text-align: center; border: 1px solid #1a252f;">ID</th>
                <th style="background-color: #2b3e50; color: #ffffff; font-weight: bold; text-align: center; border: 1px solid #1a252f;">Unidad</th>
                <th style="background-color: #2b3e50; color: #ffffff; font-weight: bold; text-align: center; border: 1px solid #1a252f;">Área</th>
                <th style="background-color: #2b3e50; color: #ffffff; font-weight: bold; text-align: center; border: 1px solid #1a252f;">Subárea</th>
                <th style="background-color: #2b3e50; color: #ffffff; font-weight: bold; text-align: center; border: 1px solid #1a252f;">Ocupación</th>
                <th style="background-color: #2b3e50; color: #ffffff; font-weight: bold; text-align: center; border: 1px solid #1a252f;">S Área Trabajo</th>
                <th style="background-color: #2b3e50; color: #ffffff; font-weight: bold; text-align: center; border: 1px solid #1a252f;">S Ocupación</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($ocupaciones as $index => $ocupacion)
                @php
                    $bgColor = ($index % 2 == 0) ? '#ffffff' : '#f8f9fa';
                @endphp
                <tr>
                    <td style="background-color: {{ $bgColor }}; text-align: center; border: 1px solid #dcdcdc;">{{ (string) $ocupacion->orden ?? '-' }}</td>
                    <td style="background-color: {{ $bgColor }}; text-align: center; border: 1px solid #dcdcdc;">{{ $ocupacion->id ?? '-' }}</td>
                    <td style="background-color: {{ $bgColor }}; border: 1px solid #dcdcdc;">{{ $ocupacion->unidad ?? '-' }}</td>
                    <td style="background-color: {{ $bgColor }}; border: 1px solid #dcdcdc;">{{ $ocupacion->area ?? '-' }}</td>
                    <td style="background-color: {{ $bgColor }}; border: 1px solid #dcdcdc;">{{ $ocupacion->subarea ?? '-' }}</td>
                    <td style="background-color: {{ $bgColor }}; border: 1px solid #dcdcdc;">{{ $ocupacion->ocupacion ?? '-' }}</td>
                    <td style="background-color: {{ $bgColor }}; border: 1px solid #dcdcdc;">{{ $ocupacion->s_area_trabajo ?? '-' }}</td>
                    <td style="background-color: {{ $bgColor }}; border: 1px solid #dcdcdc;">{{ $ocupacion->s_ocupacion ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" style="text-align: center; color: #888888; border: 1px solid #dcdcdc;">
                        No se encontraron registros en el sistema.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>