<?php
session_start();

if (isset($_SESSION['user'])) {
    header("Location: Controllers/Dashboard.php");  // Redirige al dashboard si ya está logueado
} else {
    header("Location: public/login.php");  // Redirige a la página de login si no está logueado
}
?>
  