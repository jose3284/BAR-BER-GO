<?php
require '../crud_administrador/conexion.php';

if (!empty($_GET['idProducto'])) {
    $idProducto = $_GET['idProducto'];
    $sql = "SELECT * FROM producto WHERE idProducto = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$idProducto]);
    $producto = $stmt->fetch(PDO::FETCH_ASSOC);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idProducto = $_POST['idProducto'];
    $nombre = $_POST['Nombre'];
    $cantidad = $_POST['Cantidad'];
    $precio = $_POST['Precio'];

    $sql = "UPDATE Producto SET Nombre = ?, Cantidad = ?, Precio = ? WHERE idProducto = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nombre, $cantidad, $precio, $idProducto]);

    echo "<script>
        alert('Los cambios se han guardado correctamente.');
        window.location.href = '../crud_productos.php';
    </script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" 
    crossorigin="anonymous">
</head>
<body>
<div class="container mt-4">
    <h2>Editar Cliente</h2>
    <form method="POST" action="editar_producto.php">
        <input type="hidden" name="idProducto" value="<?php echo $producto['idProducto']; ?>">
        <div class="mb-3">
            <label for="Nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="Nombre" name="Nombre" value="<?php echo $producto['Nombre']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="Cantidad" class="form-label">Cantidad</label>
            <input type="text" class="form-control" id="Cantidad" name="Cantidad" value="<?php echo $producto['Cantidad']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="Precio" class="form-label">Precio</label>
            <input type="text" class="form-control" id="Precio" name="Precio" value="<?php echo $producto['Precio']; ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Guardar cambios</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" 
crossorigin="anonymous"></script>
</body>
</html>