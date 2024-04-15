<?php
// Permitir solicitudes desde http://localhost:8100
header("Access-Control-Allow-Origin: *");

// Iniciar la sesión
session_start();

// Destruir todas las variables de sesión
session_unset();

// Destruir la sesión
session_destroy();

// Redirigir al usuario a la página de inicio de sesión
header("Location: login.php");
exit();
?>
