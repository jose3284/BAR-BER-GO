<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Reporte de Productos</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        h1, h2 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 30px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .estadisticas { margin-top: 40px; }
    </style>
</head>
<body>

    <h1>Reporte de Productos</h1>

    <h2>Estadísticas</h2>
    <ul class="estadisticas">
        <li><strong>Total Productos:</strong> {{ $estadisticas['total_productos'] }}</li>
        <li><strong>Precio Promedio:</strong> ${{ number_format($estadisticas['precio_promedio'], 2) }}</li>
        <li><strong>Precio Máximo:</strong> ${{ number_format($estadisticas['precio_maximo'], 2) }}</li>
        <li><strong>Precio Mínimo:</strong> ${{ number_format($estadisticas['precio_minimo'], 2) }}</li>
        <li><strong>Stock Total:</strong> {{ $estadisticas['stock_total'] }}</li>
    </ul>

    <h2>Listado de Productos</h2>
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Categoría</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($productos as $producto)
                <tr>
                    <td>{{ $producto->Nombre }}</td>
                    <td>{{ $producto->Cantidad }}</td>
                    <td>${{ number_format($producto->Precio, 2) }}</td>
                    <td>{{ $producto->id_categoria }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
