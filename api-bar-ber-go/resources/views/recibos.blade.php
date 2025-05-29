<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Reporte de Estadísticas de Recibos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            color: #333;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #444;
        }

        table {
            width: 60%;
            margin: 20px auto;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ccc;
        }

        th {
            background-color: #f7f7f7;
        }

        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>
<body>
    <h1>Reporte de Estadísticas de Recibos</h1>

    <table>
        <tr>
            <th>Estadística</th>
            <th>Valor</th>
        </tr>
        <tr>
            <td>Total de Recibos</td>
            <td>{{ $estadisticas['total_recibos'] }}</td>
        </tr>
        <tr>
            <td>Monto Total</td>
            <td>${{ number_format($estadisticas['monto_total'], 2) }}</td>
        </tr>
        <tr>
            <td>Monto Promedio</td>
            <td>${{ number_format($estadisticas['monto_promedio'], 2) }}</td>
        </tr>
        <tr>
            <td>Monto Máximo</td>
            <td>${{ number_format($estadisticas['monto_maximo'], 2) }}</td>
        </tr>
        <tr>
            <td>Monto Mínimo</td>
            <td>${{ number_format($estadisticas['monto_minimo'], 2) }}</td>
        </tr>
    </table>

    <div class="footer">
        Generado por el sistema de gestión de recibos - {{ date('d/m/Y H:i') }}
    </div>
</body>
</html>
