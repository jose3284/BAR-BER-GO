<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: ../Public/Login.php");
    exit();
}

$user = $_SESSION['user'];
$rol_id = $user['id_roles'];

// Condicional para rol 1 (admin)
if ($rol_id == 1) {
    $rol = 'admin';
} else {
    // Mapeo de otros roles
    $rolesMap = [
        2 => 'barbero',
        3 => 'vendedor',
        4 => 'cliente',
    ];
    $rol = $rolesMap[$rol_id] ?? 'cliente'; // Valor por defecto si no está mapeado
}

// Rutas de vistas
$header = "../Public/roles/$rol/header.view.php";
$main   = "../Public/roles/$rol/$rol.view.php";
$footer = "../Public/roles/$rol/footer.view.php";

// 👇 Incluye citas si el rol lo necesita (por ejemplo, barbero)
if ($rol === 'barbero') {
    require_once("../Controllers/CitaController.php");
    $controller = new CitaController();
    $citas = $controller->mostrarCitas(); // Esta variable estará disponible en la vista
}

// Mostrar vistas solo si existen
if (file_exists($header) && file_exists($main) && file_exists($footer)) {
    require_once($header);
    require_once($main);   // Aquí la vista recibirá la variable $citas
    require_once($footer);
} else {
    echo "⚠️ No se encontraron las vistas para el rol '$rol'.";
}
