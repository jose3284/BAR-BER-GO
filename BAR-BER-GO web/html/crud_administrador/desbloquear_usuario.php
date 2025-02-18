<?php
require 'conexion.php';

if (!empty($_GET['idCliente'])) {
    $id = $_GET['idCliente'];

    try {
        $stmt = $pdo->prepare('UPDATE cliente SET bloqueado = 0 WHERE idCliente = :id');
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
