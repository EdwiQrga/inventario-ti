<!DOCTYPE html>
<html>
<head>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Reporte de Activos</h1>
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Tipo</th>
                <th>Sucursal</th>
                <th>Serial</th>
                <th>Estado</th>
                <th>Costo</th>
            </tr>
        </thead>
        <tbody>
            @foreach($activos as $activo)
                <tr>
                    <td>{{ $activo->nombre }}</td>
                    <td>{{ $activo->tipo }}</td>
                    <td>{{ $activo->sucursal }}</td>
                    <td>{{ $activo->serial }}</td>
                    <td>{{ $activo->estado }}</td>
                    <td>{{ $activo->costo ? '$' . number_format($activo->costo, 2) : 'N/A' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>