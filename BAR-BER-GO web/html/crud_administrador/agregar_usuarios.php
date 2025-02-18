<?php
require 'conexion.php'; // Ajusta la ruta según sea necesario

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['Nombre'];
    $p_apellido = $_POST['P_apellido'];
    $s_apellido = $_POST['S_apellido'];
    $contraseña = $_POST['Contraseña']; // Corregido de $POST a $_POST
    $correo = $_POST['Correo'];
    $tipo_cita = $_POST['tipo_cita']; // Obtener el tipo de cita (1 o 2)

    // Hashear la contraseña antes de almacenarla
    $contraseña_hash = password_hash($contraseña, PASSWORD_DEFAULT);

    // Prepara la sentencia para agregar el cliente
    $sql = "INSERT INTO cliente (Nombre, P_apellido, S_apellido, Contraseña, Correo, Tipo_cita_idTipo_cita, bloqueado) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    
    // Bloqueado por defecto es 0
    $bloqueado = 0; // Aquí se establece que el usuario no está bloqueado por defecto
    $stmt->execute([$nombre, $p_apellido, $s_apellido, $contraseña_hash, $correo, $tipo_cita, $bloqueado]); // Almacena solo el número

    echo "<script>
        alert('Cliente agregado correctamente.');
        window.location.href = 'crud_barbero.php'; // Redirigir a la página principal
    </script>";
    exit;
}
?>


