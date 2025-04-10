<?php
session_start();

// Verifica si hay sesión activa
if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
    $state = $user['userState'];

    // Si el estado es 0, usuario activo → redirige al Dashboard
    if ($state == 0) {
        header("Location: Controllers/Dashboard.php");
        exit();
    } else {
        // Usuario inactivo
        echo "⚠️ Usuario inactivo. Contacte al administrador.";
    }
} 
    // No hay sesión → redirigir al login

header("Location: Controllers/Landing.php");
exit();
?>
