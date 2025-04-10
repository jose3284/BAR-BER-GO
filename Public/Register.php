<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
</head>
<body>
    <h2>Registro de Usuario</h2>
    <form action="../Controllers/RegisterController.php" method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" required>
        <br>

        <label for="p_apellido">Primer Apellido:</label>
        <input type="text" name="p_apellido" required>
        <br>

        <label for="s_apellido">Segundo Apellido:</label>
        <input type="text" name="s_apellido" required>
        <br>

        <label for="correo">Correo:</label>
        <input type="email" name="correo" required>
        <br>

        <label for="password">Contraseña:</label>
        <input type="password" name="password" required>
        <br>

        <label for="id_roles">Rol:</label>
        <select name="id_roles">
            <option value="1">Administrador</option>
            <option value="2">Usuario</option>
        </select>
        <br>

        <button type="submit">Registrarse</button>
    </form>
</body>
</html>
