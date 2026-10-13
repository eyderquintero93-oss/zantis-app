<?php
$mensaje = "";

// Procesar el formulario cuando se envía por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = isset($_POST['correo']) ? trim($_POST['correo']) : '';
    $clave  = isset($_POST['clave']) ? trim($_POST['clave']) : '';

    if (!empty($correo) && !empty($clave)) {
        // Simulación de acceso para que la interfaz web funcione sin bloqueos en Render
        $mensaje = "<div class='alerta info'>Modo de demostración activo en la nube.</div>";
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
        .alerta {
            padding: 10px;
            border-radius: 6px;
            font-size: 14px;
            margin-bottom: 16px;
            text-align: center;
        }
        .alerta.error { background: #7f1d1d; color: #fca5a5; }
        .alerta.exito { background: #065f46; color: #6ee7b7; }
        .alerta.info  { background: #1e3a8a; color: #93c5fd; }
        .back-link {
            display: block;
            text-align: center;
            margin-top: 16px;
            color: #9ca3af;
            text-decoration: none;
            font-size: 14px;
        }
        .back-link:hover { color: #ffffff; }
    </style>
</head>
<body>

<div class="login-card">
    <h2>ZANTIS</h2>
    <p>Inicia sesión en tu cuenta</p>

    <?php echo $mensaje; ?>

    <form action="login.php" method="POST">
        <div class="form-group">
            <label for="correo">Correo Electrónico</label>
            <input type="email" id="correo" name="correo" placeholder="ejemplo@correo.com" required>
        </div>

        <div class="form-group">
            <label for="clave">Contraseña</label>
            <input type="password" id="clave" name="clave" placeholder="••••••••" required>
        </div>

        <button type="submit" class="btn-submit">Ingresar</button>
    </form>

    <a href="../html/index.html" class="back-link">← Volver al inicio</a>
</div>

</body>
</html>