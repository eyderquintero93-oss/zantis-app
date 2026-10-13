<?php
// Iniciar sesión
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Zantis</title>
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
            min-height: 100vh;
        }
        .sidebar {
            width: 250px;
            background: #1f2937;
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            box-shadow: 4px 0 10px rgba(0,0,0,0.3);
        }
        .sidebar h2 {
            color: #60a5fa;
            margin-bottom: 30px;
            text-align: center;
        }
        .sidebar nav a {
            display: block;
            color: #d1d5db;
            text-decoration: none;
            padding: 12px 16px;
            border-radius: 6px;
            margin-bottom: 8px;
            transition: background 0.2s;
        }
        .sidebar nav a:hover {
            background: #374151;
            color: #ffffff;
        }
        .main-content {
            flex: 1;
            padding: 40px;
            overflow-y: auto;
        }
        .header {
            background: #1f2937;
            padding: 20px 30px;
            border-radius: 12px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        }
        .header h1 {
            font-size: 24px;
            color: #f3f4f6;
        }
        .cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
        }
        .card {
            background: #1f2937;
            padding: 24px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        }
        .card h3 {
            color: #60a5fa;
            margin-bottom: 10px;
            font-size: 18px;
        }
        .card p {
            color: #9ca3af;
            font-size: 14px;
        }
        .btn-logout {
            display: inline-block;
            background: #dc2626;
            color: #white;
            padding: 10px 16px;
            border-radius: 6px;
            text-decoration: none;
            text-align: center;
            font-weight: bold;
            transition: background 0.2s;
        }
        .btn-logout:hover {
            background: #b91c1c;
        }
    </style>
</head>
<body>

    <!-- Menú lateral -->
    <div class="sidebar">
        <div>
            <h2>ZANTIS</h2>
            <nav>
                <a href="dashboard.php">📊 Panel General</a>
                <a href="../html/index.html">🏠 Ir al Inicio Web</a>
            </nav>
        </div>
        <div>
            <a href="login.php" class="btn-logout">Cerrar Sesión</a>
        </div>
    </div>

    <!-- Contenido principal -->
    <div class="main-content">
        <div class="header">
            <h1>Bienvenido al Panel de Control</h1>
            <span style="color: #10b981; font-weight: bold;">● Conectado en la Nube</span>
        </div>

        <div class="cards-grid">
            <div class="card">
                <h3>Empleos Disponibles</h3>
                <p>Gestiona y visualiza las vacantes activas publicadas en la plataforma.</p>
            </div>
            <div class="card">
                <h3>Postulaciones</h3>
                <p>Revisa el estado de los candidatos registrados recientemente.</p>
            </div>
            <div class="card">
                <h3>Configuración</h3>
                <p>Actualiza los datos del sistema y preferencias de usuario.</p>
            </div>
        </div>
    </div>

</body>
</html>