<?php
// Configuración de conexión con control de errores para la nube
$host = "localhost"; 
$user = "root"; 
$pass = ""; 
$db   = "zantis_db"; 
$port = 3306;

// Suprimir errores fatales de conexión para que la interfaz web no se bloquee en Render
@$conexion = new mysqli($host, $user, $pass, $db, $port);

// Si la conexión falla (por ser entorno cloud sin BD local), la app sigue funcionando visualmente
if ($conexion->connect_error) {
    $conexion = null; 
} else {
    $conexion->set_charset("utf8");
}
?>