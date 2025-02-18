<?php
$host = 'localhost'; // servidor
$db = 'bar-ber-go'; // base de datos
$user = 'root'; // usuario
$pass = ''; // contraseña

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}
?>