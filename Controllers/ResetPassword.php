<?php
require_once '../Models/User.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = $_POST['token'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirm = $_POST['confirm_password'] ?? '';

    if (empty($token) || empty($password) || empty($confirm)) {
        echo "<script>alert('Todos los campos son obligatorios'); window.location.href='../Public/resetpassword.php?token=$token';</script>";
        exit();
    }

    if ($password !== $confirm) {
        echo "<script>alert('Las contraseñas no coinciden'); window.location.href='../Public/resetpassword.php?token=$token';</script>";
        exit();
    }

    $user = new User();
    $result = $user->resetPassword($token, $password);

    if ($result === true) {
        echo "<script>alert('✅ Contraseña actualizada correctamente'); window.location.href='../Public/Login.php';</script>";
    } else {
        echo "<script>alert('❌ $result'); window.location.href='../Public/resetpassword.php?token=$token';</script>";
    }
}
?>
