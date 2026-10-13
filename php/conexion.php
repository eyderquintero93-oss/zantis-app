<?php
// Configuración simulada para evitar bloqueos en la nube
$host = "127.0.0.1";
$user = "root";
$pass = "";
$db   = "zantis_db";
$port = 3306;

// Desactivar temporalmente los errores de mysqli para que la página nunca se quede congelada
mysqli_report(MYSQLI_REPORT_OFF);
$conexion = @new mysqli($host, $user, $pass, $db, $port);

if ($conexion->connect_error) {
    $conexion = null; // Evita bloqueos si no hay base de datos local en Render
}
?>