<?php
 session_start();
 if (!isset($_SESSION['user'])) {
     header("Location: Landing.php");  // Si el usuario no está logueado, redirige a la página de inicio
     exit();
 }
 
 echo "Bienvenido, " . $_SESSION['user']['Nombre'] . " " . $_SESSION['user']['P_apellido'] . "!";
 ?>
 
