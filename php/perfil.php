<?php
session_start();
require_once 'conexion.php';

if (!isset($_SESSION['usuario_id'])) {
    echo "<script>
            alert('Por favor inicia sesión.');
            window.location.href = '../html/index.html';
          </script>";
    exit();
}

$id_usuario = $_SESSION['usuario_id'];

// Obtener datos actualizados del usuario desde la base de datos
$stmt = $conexion->prepare("SELECT * FROM usuarios WHERE id_usuario = ?");
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$resultado = $stmt->get_result();
$usuario = $resultado->fetch_assoc();
$stmt->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zantis - Mi Perfil</title>
    <link rel="stylesheet" href="../css/index.css">
    <style>
        body {
            background-color: #0d1117;
            color: #c9d1d9;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 40px auto;
            padding: 20px;
        }
        .perfil-box {
            background: #161b22;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.5);
        }
        h2 { color: #fff; border-bottom: 1px solid #30363d; padding-bottom: 10px; }
        .info-group {
            margin-bottom: 20px;
        }
        .info-group label {
            display: block;
            font-weight: bold;
            color: #58a6ff;
            margin-bottom: 5px;
        }
        .info-group p {
            background: #0d1117;
            padding: 12px;
            border: 1px solid #30363d;
            border-radius: 6px;
            color: #fff;
            margin: 0;
        }
        .btn-volver {
            display: inline-block;
            background-color: #2ea44f;
            color: white;
            padding: 10px 20px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: bold;
            margin-top: 20px;
        }
        .btn-volver:hover {
            background-color: #2c974b;
        }
    </style>
</head>
<body>

    <header class="navbar" style="background-color: #161b22; border-bottom: 1px solid #30363d; padding: 15px 30px;">
        <div class="logo">
            <h1 style="color: #2ea44f; margin: 0;">Zantis</h1>
        </div>
        <nav style="display: flex; gap: 20px; align-items: center;">
            <a href="../html/dashboard.php" style="color: #fff; text-decoration: none;">Panel</a>
            <a href="logout.php" style="background-color: #da3633; color: white; padding: 8px 16px; border-radius: 6px; text-decoration: none; font-weight: bold;">Cerrar Sesión</a>
        </nav>
    </header>

    <div class="container">
        <div class="perfil-box">
            <h2>👤 Información de mi Perfil</h2>
            
            <div style="display: flex; gap: 20px; margin-top: 20px;">
                <?php if (!empty($usuario['foto_perfil'])): ?>
                    <div>
                        <img src="../uploads/<?php echo htmlspecialchars($usuario['foto_perfil']); ?>" alt="Foto de perfil" style="width: 120px; height: 120px; border-radius: 50%; object-fit: cover; border: 2px solid #2ea44f;">
                    </div>
                <?php endif; ?>
                
                <div style="flex-grow: 1;">
                    <div class="info-group">
                        <label>Nombre Completo</label>
                        <p><?php echo htmlspecialchars($usuario['nombres'] . ' ' . $usuario['apellidos']); ?></p>
                    </div>

                    <div class="info-group">
                        <label>Rol en la Plataforma</label>
                        <p style="text-transform: uppercase;"><?php echo htmlspecialchars($usuario['rol']); ?></p>
                    </div>
                </div>
            </div>

            <div class="info-group" style="margin-top: 20px;">
                <label>Tipo y Número de Documento</label>
                <p><?php echo htmlspecialchars($usuario['tipo_documento'] . ' - ' . $usuario['numero_documento']); ?></p>
            </div>

            <div class="info-group">
                <label>Edad y Fecha de Nacimiento</label>
                <p><?php echo htmlspecialchars($usuario['edad'] . ' años (Nacimiento: ' . $usuario['fecha_nacimiento'] . ')'); ?></p>
            </div>

            <div class="info-group">
                <label>Dirección</label>
                <p><?php echo htmlspecialchars($usuario['direccion']); ?></p>
            </div>

            <?php if (!empty($usuario['info_laboral'])): ?>
                <div class="info-group">
                    <label>Información / Perfil Laboral</label>
                    <p><?php echo nl2br(htmlspecialchars($usuario['info_laboral'])); ?></p>
                </div>
            <?php endif; ?>

            <a href="../html/dashboard.php" class="btn-volver">← Volver al Panel</a>
        </div>
    </div>

</body>
</html>