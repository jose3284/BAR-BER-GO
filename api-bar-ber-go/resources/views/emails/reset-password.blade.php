<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Recuperación de Contraseña</title>
</head>
<body>
    <h1>Recuperación de contraseña</h1>
    <p>Hola {{ $correo }},</p>
    <p>Recibiste este correo porque solicitaste restablecer tu contraseña.</p>
    <p>Tu token de recuperación es: <strong>{{ $token }}</strong></p>
    <p>Si no solicitaste esto, ignora este mensaje.</p>
</body>
</html>
