<?php
session_start(); // Inicia la sesión

// Eliminar todas las variables de sesión
session_unset();

// Destruir la sesión
session_destroy();

// Redirigir a la página de inicio con una alerta
header("Location: login_Form.php?mensaje=Sesión cerrada correctamente");
exit();
?>
