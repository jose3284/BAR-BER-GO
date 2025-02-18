<?php
require '../crud_administrador/conexion.php'; // Ajusta la ruta según sea necesario

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['Nombre'];
    $cantidad = $_POST['Cantidad'];
    $precio = $_POST['Precio'];
    $categoria_id = $_POST['categoria']; // Asegurarse de que coincida con el nombre en el formulario

    // Prepara la sentencia para agregar el producto
    $sql = "INSERT INTO producto (Nombre, Cantidad, Precio, Categoria_id, bloqueado) VALUES (?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    
    // `bloqueado` por defecto es 0
    $bloqueado = 0; // Aquí se establece que el producto no está bloqueado por defecto
    $stmt->execute([$nombre, $cantidad, $precio, $categoria_id, $bloqueado]);

    echo "<script>
        alert('Producto agregado correctamente.');
        window.location.href = 'crud_barbero.php'; // Redirigir a la página principal
    </script>";
    exit;
}
?>

