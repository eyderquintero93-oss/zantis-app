<?php
// Incluir la conexión con supresión de errores
require_once 'conexion.php';

$mensaje = "";

// Procesar el formulario cuando se envía por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = isset($_POST['correo']) ? trim($_POST['correo']) : '';$clave  = isset($_POST['clave']) ? trim($_POST['clave']) : '';

    if (!empty($correo) && !empty($clave)) {
        // Verificar si la conexión a la base de datos está disponible
        if (isset($conexion) && $conexion !== null) {$sql = "SELECT * FROM usuarios WHERE correo = ? AND clave = ?";
            if ($stmt = $conexion->prepare($sql)) {
                $stmt->bind_param("ss", $correo, $clave);$stmt->execute();
                $resultado =$stmt->get_result();

                if ($resultado->num_rows > 0) {$mensaje = "<div class='alerta exito'>¡Inicio de sesión exitoso! Bienvenido.</div>";
                } else {
                    $mensaje = "<div class='alerta error'>Correo o contraseña incorrectos.</div>";
                }
                $stmt->close();
            } else {
                $mensaje = "<div class='alerta error'>Error al procesar la consulta en la base de datos.</div>";
            }
        } else {
            // Modo demostración si no hay base de datos remota activa
            $mensaje = "<div class='alerta info'>Modo Demostración: Conexión a la base de datos no disponible.</div>";
        }
    } else {
        $mensaje = "<div class='alerta error'>Por favor completa todos los campos.</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Zantis</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }
        body {
            background: #111827;
            color: #ffffff;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }
        .login-card {
            background: #1f2937;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.4);
            width: 100%;
            max-width: 400px;
        }
        .login-card h2 {
            margin-bottom: 8px;
            color: #60a5fa;
            text-align: center;
        }
        .login-card p {
            margin-bottom: 24px;
            color: #9ca3af;
            font-size: 14px;
            text-align: center;
        }
        .form-group {
            margin-bottom: 16px;
        }
        .form-group label {
            display: block;
            margin-bottom: 6px;
            font-size: 14px;
            color: #d1d5db;
        }
        .form-group input {
            width: 100%;
            padding: 10px 14px;
            border-radius: 6px;
            border: 1px solid #374151;
            background: #111827;
            color: #ffffff;
            font-size: 14px;
        }
        .form-group input:focus {
            outline: none;
            border-color: #60a5fa;
        }
        .btn-submit {
            width: 100%;
            padding: 12px;
            background: #2563eb;
            color: #ffffff;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.2s;
        }
        .btn-submit:hover {
            background: #1d4ed8;
        }