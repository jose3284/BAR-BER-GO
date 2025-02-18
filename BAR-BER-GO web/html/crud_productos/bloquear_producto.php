<?php
// Incluir el archivo de conexión
require '../crud_administrador/conexion.php';

// Verificar si se proporcionó un ID de cliente
if (!empty($_GET['idProducto'])) {
    $id = $_GET['idProducto'];

    try {
        // Primero, actualizar los recibos relacionados si es necesario
        // (Opcional: Puedes realizar una acción adicional sobre recibos si es necesario)

        // Preparar y ejecutar la sentencia SQL para bloquear al cliente en lugar de eliminarlo
        $stmt = $pdo->prepare('UPDATE producto SET bloqueado = 1 WHERE idProducto = :id');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        // Ejecutar la sentencia y verificar si se bloqueó el cliente
        if ($stmt->execute() && $stmt->rowCount() > 0) {
            echo "El cliente se ha bloqueado correctamente.";
        } else {
            echo "El cliente no se pudo bloquear o no existe.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "ID de cliente no proporcionado.";
}
?>
