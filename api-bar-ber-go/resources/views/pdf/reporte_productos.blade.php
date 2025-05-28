<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reporte de Productos</title>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: center; }
    </style>
</head>
<body>
    <h1>Reporte de Productos</h1>
    <p>Fecha: {{ $fecha }}</p>
    <p>Total productos: {{ $total }}</p>

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
            @foreach($productos as $producto)
                <tr>
                    <td>{{ $producto->Nombre }}</td>
                    <td>{{ $producto->Cantidad }}</td>
                    <td>${{ $producto->Precio }}</td>
                    <td>{{ $producto->id_categoria }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
