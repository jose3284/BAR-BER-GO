<?php
$token = $_GET['token'] ?? null;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Restablecer Contraseña</title>
    <link rel="stylesheet" href="../Assets/css/login/reset_password.css">
</head>
<body>
    <div class="container">
        <h2>Restablecer tu contraseña</h2>

        <?php if ($token): ?>
            <form action="../Controllers/ResetPassword.php" method="POST">
                <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">

                <label for="password">Nueva contraseña:</label>
                <input type="password" name="password" required>

                <label for="confirm_password">Confirmar contraseña:</label>
                <input type="password" name="confirm_password" required>

                <button type="submit">Cambiar contraseña</button>
            </form>
        <?php else: ?>
            <p class="error">❌ Token inválido.</p>
        <?php endif; ?>
    </div>
</body>
</html>

