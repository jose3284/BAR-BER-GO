<?php
require_once("../Controllers/CitaController.php");
$controller = new CitaController();

if (isset($_GET['id'])) {
    $controller->eliminarCita($_GET['id']);
    header("Location: dashboard.php"); // Cambia según tu flujo
    exit();
}
