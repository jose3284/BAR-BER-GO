<?php
session_start();
require_once("../Models/User.php");

class Login {
    public function main() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $user = new User($username, $password);
            $profile = $user->login();

            if ($profile) {
                if ($profile->getUserState() == 0) {
                    // Usuario activo, guardar en sesión y redirigir al Dashboard
                    $_SESSION['user'] = [
                        'Nombre' => $profile->getNombre(),
                        'idUsuario' => $profile->getIdUsuario(),
                        'Correo' => $profile->getCorreo(),
                        'id_roles' => $profile->getId_roles(),
                        'userState' => $profile->getUserState()
                    ];
                    header("Location: ../index.php"); // Ajusta la ruta si tu Dashboard está en otro lado
                    exit();
                } else {
                    // Usuario inactivo
                    echo "<script>
                        alert('⚠️ El usuario está inactivo o bloqueado.');
                        window.location.href = '../Public/login.php';
                    </script>";
                }
            } else {
                // Credenciales incorrectas
                echo "<script>
                    alert('❌ Credenciales incorrectas. Intenta de nuevo.');
                    window.location.href = '../Public/login.php';
                </script>";
            }
        }
    }
}

$controller = new Login();
$controller->main();
