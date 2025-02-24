<?php
// Incluir la conexión a la base de datos
require '../html/crud_administrador/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recoger los datos del formulario
    $nombre = $_POST['Nombre'];
    $p_apellido = $_POST['P_apellido'];
    $s_apellido = $_POST['S_apellido'];
    $correo = $_POST['Correo'];
    $contraseña = $_POST['Contraseña'];
    $confirmar_contraseña = $_POST['Confirmar_contraseña'];
    $tipo_cita = $_POST['tipo_cita'];  // El tipo de cita (por defecto 0)

    // Verificar si las contraseñas coinciden
    if ($contraseña !== $confirmar_contraseña) {
        header("Location: registro.php?error=Las contraseñas no coinciden.");
        exit();
    }

    // Verificar si el correo ya está registrado
    $sql = "SELECT * FROM cliente WHERE Correo = :correo";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':correo', $correo);
    $stmt->execute();
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario) {
        // Si el correo ya está registrado
        header("Location: registro.php?error=El correo ya está registrado.");
        exit();
    }

    // Hashear la contraseña antes de almacenarla
    $contraseña_hash = password_hash($contraseña, PASSWORD_DEFAULT);

    // Preparar la sentencia SQL para insertar el nuevo usuario
    $sql = "INSERT INTO cliente (Nombre, P_apellido, S_apellido, Correo, Contraseña, Tipo_cita_idTipo_cita, bloqueado) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);

    // Bloqueado por defecto es 0
    $bloqueado = 0;

    // Ejecutar la sentencia con los valores proporcionados
    try {
        $stmt->execute([$nombre, $p_apellido, $s_apellido, $correo, $contraseña_hash, $tipo_cita, $bloqueado]);

        // Redirigir al login con un mensaje de éxito
        header("Location: login_form.php?success=Usuario registrado correctamente. Puedes iniciar sesión.");
        exit();
    } catch (PDOException $e) {
        // Manejo de errores
        echo "Error al insertar el registro: " . $e->getMessage();
        exit();
    }
}
?>



