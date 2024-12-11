<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
    <link rel="stylesheet" href="../css/inicio1.css"> <!-- Vincula el archivo CSS externo -->
</head>
<body>
    <header class="encabezado">
        <!-- Aquí puedes poner tu logo u otro contenido del encabezado -->
        <img src="../imagenes/bar-ber-go.png" alt="Logo">
    </header>

    <div class="container">
        <h2>Iniciar sesión</h2>

        <!-- Mostrar errores si los hay -->
        <?php
        if (isset($_GET['error'])) {
            echo '<p class="error">' . htmlspecialchars($_GET['error']) . '</p>';
        }
        ?>

        <!-- Formulario de login -->
        <form method="POST" action="login.php">
            <div class="form-group">
                <label for="correo" class="form-label">Correo electrónico:</label>
                <input type="email" name="correo" id="correo" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="contraseña" class="form-label">Contraseña:</label>
                <input type="password" name="contraseña" id="contraseña" class="form-control" required>
            </div>

            <button type="submit" id="start-button">Iniciar sesión</button>
        </form>

        <!-- Enlaces para registrar y olvidar contraseña -->
        <div class="form-links">
            <a href="registro.php" class="btn-link">¿No tienes cuenta? Regístrate aquí</a>
            <br>
            <a href="recuperar_contraseña.php" class="btn-link">¿Olvidaste tu contraseña?</a>
        </div>
    </div>

    <footer class="footer">
        <p>© 2024 BAR_BER_GO.</p>
    </footer>
</body>
</html>



