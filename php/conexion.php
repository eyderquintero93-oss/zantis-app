<?php
// Configuración de la base de datos MySQL

// IMPORTANTE: Reemplaza estos valores con los datos reales de tu base de datos remota
$host = "mysql-384b91b5-factra0000.h.aivencloud.com"; // O la dirección host de tu base de datos MySQL en la nube
$user = "avnadmin";                                 // Tu usuario de la base de datos (por ejemplo: avnadmin, root, etc.)
$pass = "TU_CONTRASEÑA_AQUÍ";                        // Escribe aquí la contraseña real de tu base de datos
$db   = "defaultdb";                                // El nombre de tu base de datos
$port = 11111;                                      // El puerto asignado por tu proveedor (ejemplo: 3306 o el de Aiven)

// Crear conexión
$conexion = new mysqli($host, $user, $pass, $db, $port);

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión a la base de datos: " . $conexion->connect_error);
}

// Establecer codificación de caracteres
$conexion->set_charset("utf8");
?>