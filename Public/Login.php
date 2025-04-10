
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
    <link rel="stylesheet" href="../Assets/css/login/Login.css"> <!-- Vincula el archivo CSS externo -->
</head>
<body>
    <header class="encabezado">
        <!-- Aquí puedes poner tu logo u otro contenido del encabezado -->
        <img src="../Assets/imagenes/bar-ber-go.png" alt="Logo">
    </header>

    <div class="container">
        <h2>Iniciar sesión</h2>

     
        <!-- Formulario de login -->
        <form action="../Controllers/Login.php" method="POST">

            <div class="form-group">
                <label for="correo" class="form-label">Correo electrónico:</label>
        <input type="text" name="username" required><br><br>

                </div>

            <div class="form-group">
                <label for="contraseña" class="form-label">Contraseña:</label>
        <input type="password" name="password" required><br><br>
            </div>

            <button type="submit">Iniciar sesión</button>
        </form>

        <!-- Enlaces para registrar y olvidar contraseña -->
        <div class="form-links">
            <a href="Register.php" class="btn-link">¿No tienes cuenta? Regístrate aquí</a>
            <br>
            <a href="forgot_password.php" class="btn-link">¿Olvidaste tu contraseña?</a>
        </div>
    </div>

    <footer class="footer">
        <p>© 2024 BAR_BER_GO.</p>
    </footer>
</body>
</html>