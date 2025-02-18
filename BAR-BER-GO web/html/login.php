<?php
// Incluir el archivo de conexión
include('../html/crud_administrador/desbloquear_usuario.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $correo = $_POST['correo'];
    $contraseña = $_POST['contraseña'];

    // Verificar si los campos están vacíos
    if (empty($correo) || empty($contraseña)) {
        echo "<script>
                alert('Por favor, completa todos los campos.');
                window.location.href = './login_Form'; // Redirigir a la página de login
              </script>";
    } else {
        // Consulta para verificar las credenciales
        $sql = "SELECT * FROM cliente WHERE Correo = :correo";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':correo', $correo);
        $stmt->execute();
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario) {
            // Verificar la contraseña
            if (password_verify($contraseña, $usuario['Contraseña'])) {
                // Verificar si el usuario está bloqueado
                if ($usuario['bloqueado'] == 0) {
                    session_start();
                    $_SESSION['idCliente'] = $usuario['idCliente'];
                    $_SESSION['nombre'] = $usuario['Nombre'];
                    header("Location: ./barberos.php"); // Redirigir al panel de control
                    exit(); // Detener la ejecución después de la redirección
                } else {
                    echo "<script>
                            alert('Tu cuenta está bloqueada.');
                            window.location.href = './login_Form'; // Redirigir a la página de login
                          </script>";
                }
            } else {
                echo "<script>
                        alert('Contraseña incorrecta.');
                        window.location.href = 'http://localhost/BAR-BER-GO/html/login_form.php'; // Redirigir a la página de login
                      </script>";
            }
        } else {
            echo "<script>
                    alert('Correo no registrado.');
                    window.location.href = 'http://localhost/BAR-BER-GO/html/login_form.php'; // Redirigir a la página de login
                  </script>";
        }
    }
}
?>








