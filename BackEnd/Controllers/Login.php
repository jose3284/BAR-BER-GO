<?php
session_start();

require_once '../Models/Database.php';
require_once '../Models/User.php';

// Establecer conexión con la base de datos usando la clase DataBase
$pdo = DataBase::connection();  // Usamos el método estático 'connection' de DataBase
$userModel = new User($pdo);

// Verificar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];  // Puede ser correo o nombre de usuario
    $password = $_POST['password'];

    // Validar el login
    $loggedInUser = $userModel->validateLogin($username, $password);

    if ($loggedInUser) {
        // Guardar los datos del usuario en la sesión
        $_SESSION['user'] = $loggedInUser;
        header("Location: Dashboard.php");  // Redirige al dashboard
    } else {
        echo "Error: Usuario o contraseña incorrectos.";
    }
}
?>
