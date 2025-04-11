<?php
session_start();

// Si no hay sesión, redirige al login
if (!isset($_SESSION['user'])) {
    header("Location: Controllers/Landing.php");
    exit();
}

// Si el usuario está inactivo
if ($_SESSION['user']['userState'] != 0) {
    echo "⚠️ Usuario inactivo. Contacte al administrador.";
    exit();
}

// Enrutador
$controlador = $_GET['c'] ?? 'Dashboard'; // Controlador por defecto
$funcion = $_GET['f'] ?? 'index';         // Método por defecto

$archivoControlador = "Controllers/{$controlador}Controller.php";

// Verifica si el archivo existe
if (file_exists($archivoControlador)) {
    require_once $archivoControlador;

    $nombreClase = $controlador . "Controller";
    if (class_exists($nombreClase)) {
        $controladorInstancia = new $nombreClase();

        if (method_exists($controladorInstancia, $funcion)) {
            $controladorInstancia->$funcion();
        } else {
            echo "Método '$funcion' no encontrado en el controlador '$nombreClase'.";
        }
    } else {
        echo "Controlador '$nombreClase' no encontrado.";
    }
} else {
    echo "Archivo del controlador '$archivoControlador' no encontrado.";
}

