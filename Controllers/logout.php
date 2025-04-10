<?php
session_start();
session_unset();
session_destroy();

// Redirige al Landing al cerrar sesión
header("Location: Landing.php");
exit();
