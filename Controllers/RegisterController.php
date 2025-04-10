<?php
require_once '../Models/Database.php';
require_once '../Models/User.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $p_apellido = $_POST['p_apellido'];
    $s_apellido = $_POST['s_apellido'];
    $correo = $_POST['correo'];
    $password = $_POST['password'];
    $id_roles = $_POST['id_roles'];
    $userState = 0; // Activo por defecto

    // Crear una nueva instancia de usuario
    $user = new User();
    $user->setNombre($nombre);
    $user->setP_apellido($p_apellido);
    $user->setS_apellido($s_apellido);
    $user->setCorreo($correo);
    $user->setContraseña($password);
    $user->setId_roles($id_roles);
    $user->setUserState($userState);

    // Intentar registrar el usuario
    try {
        $user->createUser();
        echo "✅ Usuario registrado con éxito.";
        header("Location: ../index.php"); // Redirige al login
        exit();
    } catch (Exception $e) {
        echo "❌ Error al registrar usuario: " . $e->getMessage();
    }
}
?>
