<?php
require_once "../Models/Database.php";


try {
    // Conectar a la base de datos usando el método estático de Database
    $dbh = DataBase::connection(); // Usamos la conexión estática

    // Obtener todas las contraseñas antiguas
    $sql = "SELECT idUsuario, Pass FROM USUARIOS";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Recorrer cada usuario y actualizar su contraseña
    foreach ($usuarios as $usuario) {
        // Verificar si la contraseña ya está en formato `password_hash()`
        if (password_needs_rehash($usuario['Pass'], PASSWORD_BCRYPT)) {
            // Si necesita rehacer el hash, actualizamos la contraseña
            $hashedPassword = password_hash($usuario['Pass'], PASSWORD_BCRYPT);

            $updateSql = "UPDATE USUARIOS SET Pass = :Pass WHERE idUsuario = :idUsuario";
            $updateStmt = $dbh->prepare($updateSql);
            $updateStmt->bindValue(':Pass', $hashedPassword);
            $updateStmt->bindValue(':idUsuario', $usuario['idUsuario']);
            $updateStmt->execute();
        }
    }

    echo "✅ Contraseñas actualizadas correctamente.";
} catch (Exception $e) {
    die("❌ Error al actualizar contraseñas: " . $e->getMessage());
}
?>

