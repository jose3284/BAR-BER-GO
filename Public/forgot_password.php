<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Olvidaste tu contraseña</title>
    <link rel="stylesheet" href="../Assets/css/login/forgotpassword.css">
</head>
<body>
    <div class="container">
        <h2>¿Olvidaste tu contraseña?</h2>

        <?php if (isset($_SESSION['fp_error'])): ?>
            <p class="mensaje"><?php echo $_SESSION['fp_error']; unset($_SESSION['fp_error']); ?></p>
        <?php endif; ?>

        <?php if (isset($_SESSION['fp_success'])): ?>
            <p class="mensaje success"><?php echo $_SESSION['fp_success']; unset($_SESSION['fp_success']); ?></p>
        <?php endif; ?>

        <form method="post" action="../Controllers/ForgotPassword.php">
            <label for="Correo">Correo electrónico:</label>
            <input type="email" name="Correo" id="Correo" required>
            <button type="submit">Enviar enlace de recuperación</button>
        </form>

        <a href="Login.php" class="volver">Volver al Login</a>
    </div>
</body>
</html>

