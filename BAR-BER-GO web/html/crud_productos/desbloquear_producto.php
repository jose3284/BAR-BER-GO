<?php
require '../crud_administrador/conexion.php';

if (!empty($_GET['idProducto'])) {
    $id = $_GET['idProducto'];

    try {
        $stmt = $pdo->prepare('UPDATE producto SET bloqueado = 0 WHERE idProducto = :id');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        
        if ($stmt->execute()) {
            echo "El cliente ha sido desbloqueado correctamente.";
        } else {
            echo "No se pudo desbloquear el cliente.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "ID de cliente no proporcionado.";
}
?>
