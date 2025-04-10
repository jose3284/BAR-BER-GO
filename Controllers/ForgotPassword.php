<?php
session_start();
require_once("../Models/User.php");

class ForgotPassword {
    public function main() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $Correo = $_POST['Correo'] ?? '';

            if (empty($Correo)) {
                $_SESSION['fp_error'] = "❌ Por favor, ingrese su correo electrónico.";
                header("Location: ../Public/forgot_password.php");
                exit();
            }

            // Instancia User (no necesitas pasar password para esto)
            $user = new User('', '');
            $token = $user->requestPasswordReset($Correo);

            if ($token) {
                $_SESSION['fp_success'] = "✅ Se ha enviado un enlace de restablecimiento a su correo.";
            } else {
                $_SESSION['fp_error'] = "❌ No se encontró un usuario con ese correo o hubo un error al enviar el correo.";
            }

            header("Location: ../Public/forgot_password.php");
            exit();
        } else {
            // Vista olvidé contraseña (GET)
            require_once("../Public/forgot_password.php");
        }
    }
}

$controller = new ForgotPassword();
$controller->main();
