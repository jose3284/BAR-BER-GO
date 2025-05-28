<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reporte de Citas</title>
    <style>
        body { font-family: sans-serif; }
        h1 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: center; }
    </style>
</head>
<body>
    <h1>Reporte de Citas</h1>
    <p>Fecha de generación: {{ $fecha_generacion }}</p>
    <p>Total de citas: {{ $total_citas }}</p>

    <h3>Citas por fecha</h3>
    <table>
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($citas_por_fecha as $cita)
                <tr>
                    <td>{{ $cita->fecha }}</td>
                    <td>{{ $cita->total }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
