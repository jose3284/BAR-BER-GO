<?php
require_once("../Controllers/CitaController.php");
$controller = new CitaController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $datos = [
        'nombre' => $_POST['nombre'],
        'fecha' => $_POST['fecha'],
        'hora' => $_POST['hora']
    ];
    $controller->actualizarCita($id, $datos);
    header("Location: dashboard.php"); // Cambia si tienes otra ruta
    exit();
}

$cita = $controller->obtenerCitaPorId($_GET['id']);
?>

<h2>Editar cita</h2>
<form method="post">
    <input type="hidden" name="id" value="<?= $cita['id'] ?>">
    <label>Nombre: <input type="text" name="nombre" value="<?= htmlspecialchars($cita['nombre']) ?>"></label><br>
    <label>Fecha: <input type="date" name="fecha" value="<?= htmlspecialchars($cita['fecha']) ?>"></label><br>
    <label>Hora: <input type="time" name="hora" value="<?= htmlspecialchars($cita['hora']) ?>"></label><br>
    <button type="submit">Actualizar</button>
</form>
