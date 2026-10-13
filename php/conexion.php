<?php
// Configuración de la base de datos MySQL

// Reemplaza los valores entre comillas con las credenciales reales de tu base de datos remota:
$host = "DATOS_DE_TU_HOST";          // Ejemplo: mysql-384b91b5-factra0000.h.aivencloud.com o el host de tu BD
$user = "DATOS_DE_TU_USUARIO";       // Ejemplo: avnadmin, root, o tu usuario de BD
$pass = "DATOS_DE_TU_CONTRASEÑA";    // La contraseña de tu base de datos
$db   = "NOMBRE_DE_TU_BASE_DATOS";   // Ejemplo: zantis_db o defaultdb
$port = 3306;                         // Puerto MySQL (3306 por defecto, o el asignado por tu proveedor)

// Creación de la conexión utilizando la extensión mysqli
$conexion = new mysqli($host, $user, $pass, $db, $port);

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión a la base de datos: " . $conexion->connect_error);
}

// Establecer conjunto de caracteres a utf8 para evitar problemas de tildes y caracteres especiales
$conexion->set_charset("utf8");
?>