<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Usuario</title>
    <link rel="stylesheet" href="../css/inicio1.css">
</head>
<body>
    <header class="encabezado">
        <!-- Aquí puedes poner tu logo u otro contenido del encabezado -->
        <img src="../imagenes/bar-ber-go.png" alt="Logo">
    </header>

    <div class="container">
        <h2>Registro de Usuario</h2>

        <!-- Mostrar errores si los hay -->
        <?php
        if (isset($_GET['error'])) {
            echo '<p class="error">' . htmlspecialchars($_GET['error']) . '</p>';
        }

        if (isset($_GET['success'])) {
            echo "<script>
                    alert('" . htmlspecialchars($_GET['success']) . "');
                  </script>";
        }
        ?>

        <!-- Formulario de registro -->
        <form method="POST" action="registro_procesar.php">
            <div class="form-group">
                <label for="Nombre" class="form-label">Nombre:</label>
                <input type="text" name="Nombre" id="Nombre" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="P_apellido" class="form-label">Primer Apellido:</label>
                <input type="text" name="P_apellido" id="P_apellido" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="S_apellido" class="form-label">Segundo Apellido:</label>
                <input type="text" name="S_apellido" id="S_apellido" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="Correo" class="form-label">Correo:</label>
                <input type="email" name="Correo" id="Correo" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="Contraseña" class="form-label">Contraseña:</label>
                <input type="password" name="Contraseña" id="Contraseña" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="Confirmar_contraseña" class="form-label">Confirmar Contraseña:</label>
                <input type="password" name="Confirmar_contraseña" id="Confirmar_contraseña" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="tipo_cita" class="form-label">Tipo de Cita:</label>
                <select name="tipo_cita" id="tipo_cita" class="form-control">
                    <option value="0">Seleccionar</option>
                    <option value="1">Cita tipo 1</option>
                    <option value="2">Cita tipo 2</option>
                </select>
            </div>

            <button type="submit" id="start-button">Registrar</button>
        </form>
    </div>

    <footer class="footer">
        <p>© 2024 BAR_BER_GO.</p>
    </footer>
</body>
</html>

