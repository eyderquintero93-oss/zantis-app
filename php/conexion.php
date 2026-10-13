<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "zantis_db";
$port = 3306;

try {
    $conexion = new mysqli($host, $user, $pass, $db, $port);
    $conexion->set_charset("utf8");
} catch (Exception $e) {
    // Permite que la interfaz cargue aunque no haya conexión activa a MySQL
    $conexion = null;
}
?>