<?php
// Incluir el archivo de conexión
require '../crud_administrador/conexion.php';

// Verificar si se envió el formulario con el método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir los datos del formulario
    $correo = $_POST['Correo'];
    $contraseña = $_POST['Contraseña'];

    // Consultar la base de datos para obtener el cliente con el correo proporcionado
    $sql = "SELECT * FROM cliente WHERE Correo = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$correo]);

    // Verificar si el cliente existe
    if ($stmt->rowCount() > 0) {
        $cliente = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verificar si la cuenta está bloqueada
        if ($cliente['bloqueado'] == 1) {
            // Redirigir si la cuenta está bloqueada
            header("Location: http://localhost/html/inicio.html?error=bloqueado");
            exit();
        }

        // Verificar si la contraseña es correcta
        if (password_verify($contraseña, $cliente['Contraseña'])) {
            // Redirigir a la página principal para usuarios registrados
            header("Location: http://localhost/html/barbero.html"); // O la página que corresponda
            exit();
        } else {
            // Contraseña incorrecta
            header("Location: http://localhost/html/inicio.html?error=contraseña_incorrecta");
            exit();
        }
    } else {
        // Cliente no encontrado
        header("Location: http://localhost/html/inicio.html?error=correo_no_registrado");
        exit();
    }
}
?>

