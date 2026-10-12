<?php
// Datos de conexión asignados por InfinityFree
$host = "sqlxxx.infinityfree.com";        // Reemplaza por tu Host MySQL (Ej: sql200.epizy.com)
$usuario = "if0_XXXXXXXX";                // Reemplaza por tu Usuario de MySQL de InfinityFree
$password = "TU_CONTRASEÑA_DE_HOSTING";   // Reemplaza por la contraseña de tu cuenta de InfinityFree
$base_datos = "if0_XXXXXXXX_zantis_db";   // Reemplaza por el Nombre Completo de tu BD remota

// Crear la conexión con la base de datos MySQL
$conexion = new mysqli($host, $usuario, $password, $base_datos);

// Verificar si hubo algún error en la conexión
if ($conexion->connect_error) {
    die("Error de conexión a la base de datos: " . $conexion->connect_error);
}

// Configurar el conjunto de caracteres a UTF-8 para soportar acentos y la 'ñ'
$conexion->set_charset("utf8");
?>