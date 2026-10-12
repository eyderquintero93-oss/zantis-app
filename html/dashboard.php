<?php
session_start();
require_once '../php/conexion.php';

if (!isset($_SESSION['usuario_id'])) {
    echo "<script>
            alert('Por favor inicia sesión para acceder al panel.');
            window.location.href = 'index.html';
          </script>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zantis - Panel de Control</title>
    <link rel="stylesheet" href="../css/index.css"> 
    <style>
        body {
            background-color: #0d1117;
            color: #c9d1d9;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .dashboard-container {
            max-width: 1100px;
            margin: 40px auto;
            padding: 20px;
        }

        .user-card {
            background: #161b22;
            color: #fff;
            padding: 25px;
            border-radius: 12px;
            margin-bottom: 30px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.5);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .badge-rol {
            background-color: #2ea44f;
            color: white;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            text-transform: uppercase;
            font-weight: bold;
        }

        .section-box {
            background: #161b22;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.3);
            margin-bottom: 25px;
            color: #c9d1d9;
        }

        .form-vacante label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #fff;
        }

        .form-vacante input,
        .form-vacante textarea {
            width: 100%;
            padding: 12px;
            margin: 8px 0 20px 0;
            border: 1px solid #30363d;
            border-radius: 6px;
            background-color: #0d1117;
            color: #fff !important;
            box-sizing: border-box;
        }

        .form-vacante input::placeholder,
        .form-vacante textarea::placeholder {
            color: #8b949e;
        }

        .btn-submit {
            background-color: #2ea44f;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 6px;
            font-weight: bold;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.2s;
        }

        .btn-submit:hover {
            background-color: #2c974b;
        }

        .btn-logout {
            background-color: #da3633;
            color: white;
            padding: 8px 16px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: bold;
        }

        .vacante-card {
            background: #1f2937;
            border-left: 4px solid #2ea44f;
            padding: 20px;
            margin-bottom: 15px;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.3);
        }

        .vacante-card h4 {
            color: #fff;
            margin-top: 0;
            font-size: 1.2rem;
        }

        .btn-postular {
            background-color: #1f6feb;
            color: white;
            border: none;
            padding: 10px 18px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.2s;
        }

        .btn-postular:hover {
            background-color: #388bfd;
        }

        .postulado-item {
            background-color: #0d1117;
            border: 1px solid #30363d;
            border-radius: 6px;
            padding: 12px 18px;
            margin-top: 10px;
        }
    </style>
</head>
<body>

    <header class="navbar" style="background-color: #161b22; border-bottom: 1px solid #30363d; padding: 15px 30px;">
        <div class="logo">
            <h1 style="color: #2ea44f; margin: 0;">Zantis</h1>
        </div>
        <nav style="display: flex; gap: 20px; align-items: center;">
            <a href="index.html" style="color: #fff; text-decoration: none;">Inicio</a>
            <a href="../php/perfil.php" style="color: #58a6ff; text-decoration: none; font-weight: bold;">Mi Perfil</a>
            <a href="ods.html" style="color: #fff; text-decoration: none;">Impacto ODS</a>
            <a href="../php/logout.php" class="btn-logout">Cerrar Sesión</a>
        </nav>
    </header>

    <main class="dashboard-container">
        
        <div class="user-card">
            <div>
                <h2>¡Hola, <?php echo htmlspecialchars($_SESSION['nombre']); ?>!</h2>
                <p>Bienvenido a tu panel de administración en Zantis.</p>
            </div>
            <div>
                <span class="badge-rol"><?php echo htmlspecialchars($_SESSION['rol']); ?></span>
            </div>
        </div>

        <?php if ($_SESSION['rol'] === 'empresa'): ?>
            <!-- Formulario para publicar ofertas -->
            <div class="section-box">
                <h3 style="color: #fff;">🏢 Publicar Nueva Vacante</h3>
                <form action="../php/publicar_vacante.php" method="POST" class="form-vacante">
                    <label for="titulo">Título del Puesto</label>
                    <input type="text" id="titulo" name="titulo" placeholder="Ej. Desarrollador Web Junior" required>

                    <label for="descripcion">Descripción y Requisitos</label>
                    <textarea id="descripcion" name="descripcion" rows="5" placeholder="Detalla las funciones y lo que buscas en el candidato..." required></textarea>

                    <label for="salario">Salario (COP)</label>
                    <input type="number" id="salario" name="salario" placeholder="Ej. 1500000" required>

                    <label for="ubicacion">Ubicación / Modalidad</label>
                    <input type="text" id="ubicacion" name="ubicacion" placeholder="Ej. Medellín / Remoto" required>

                    <button type="submit" class="btn-submit">Publicar Vacante</button>
                </form>
            </div>

            <!-- Sección de Candidatos Postulados -->
            <div class="section-box">
                <h3 style="color: #fff;">👥 Candidatos Postulados a tus Ofertas</h3>
                <p>Aquí puedes consultar qué usuarios han solicitado tus vacantes activas.</p>
                <hr style="border: 1px solid #30363d; margin: 15px 0;">

                <?php
                $id_empresa = $_SESSION['usuario_id'];
                $sql_candidatos = "SELECT p.fecha_postulacion, v.titulo AS vacante_titulo, u.nombres, u.apellidos, u.direccion, u.info_laboral 
                                   FROM postulaciones p
                                   INNER JOIN vacantes v ON p.id_vacante = v.id_vacante
                                   INNER JOIN usuarios u ON p.id_empleado = u.id_usuario
                                   WHERE v.id_empresa = ?
                                   ORDER BY p.fecha_postulacion DESC";

                $stmt_cand = $conexion->prepare($sql_candidatos);
                $stmt_cand->bind_param("i", $id_empresa);
                $stmt_cand->execute();
                $res_cand = $stmt_cand->get_result();

                if ($res_cand->num_rows > 0) {
                    while($cand = $res_cand->fetch_assoc()) {
                        echo "<div class='postulado-item'>";
                        echo "<h4 style='margin: 0 0 5px 0; color: #58a6ff;'>" . htmlspecialchars($cand['nombres'] . " " . $cand['apellidos']) . "</h4>";
                        echo "<p style='margin: 2px 0;'><strong>Vacante:</strong> " . htmlspecialchars($cand['vacante_titulo']) . "</p>";
                        echo "<p style='margin: 2px 0;'><strong>Dirección/Ciudad:</strong> " . htmlspecialchars($cand['direccion']) . "</p>";
                        if(!empty($cand['info_laboral'])) {
                            echo "<p style='margin: 2px 0;'><strong>Información Laboral:</strong> " . htmlspecialchars($cand['info_laboral']) . "</p>";
                        }
                        echo "<p style='margin: 5px 0 0 0; font-size: 0.85rem; color: #8b949e;'>Fecha de postulación: " . $cand['fecha_postulacion'] . "</p>";
                        echo "</div>";
                    }
                } else {
                    echo "<p style='color: #8b949e;'>Aún no hay postulaciones registradas para tus ofertas de empleo.</p>";
                }
                $stmt_cand->close();
                $conexion->close();
                ?>
            </div>

        <?php else: ?>
            <!-- Vista para Empleados -->
            <div class="section-box">
                <h3 style="color: #fff;">💼 Ofertas de Empleo Disponibles</h3>
                <p>Explora las oportunidades laborales registradas en la plataforma y postúlate.</p>
                <hr style="border: 1px solid #30363d; margin: 15px 0;">

                <?php
                $query = "SELECT v.*, u.nombres AS empresa_nombre 
                          FROM vacantes v 
                          INNER JOIN usuarios u ON v.id_empresa = u.id_usuario 
                          ORDER BY v.fecha_creacion DESC";
                $resultado = $conexion->query($query);

                if ($resultado->num_rows > 0) {
                    while($row = $resultado->fetch_assoc()) {
                        echo "<div class='vacante-card'>";
                        echo "<h4>" . htmlspecialchars($row['titulo']) . "</h4>";
                        echo "<p><strong>Empresa:</strong> " . htmlspecialchars($row['empresa_nombre']) . "</p>";
                        echo "<p>" . nl2br(htmlspecialchars($row['descripcion'])) . "</p>";
                        echo "<p><strong>Salario:</strong> $" . number_format($row['salario'], 0, ',', '.') . " COP | <strong>Ubicación:</strong> " . htmlspecialchars($row['ubicacion']) . "</p>";
                        
                        echo "<form action='../php/postular.php' method='POST' style='margin-top: 15px;'>";
                        echo "<input type='hidden' name='id_vacante' value='" . $row['id_vacante'] . "'>";
                        echo "<button type='submit' class='btn-postular'>Postularme a este empleo</button>";
                        echo "</form>";

                        echo "</div>";
                    }
                } else {
                    echo "<p>No hay vacantes disponibles en este momento. ¡Vuelve más tarde!</p>";
                }
                $conexion->close();
                ?>
            </div>
        <?php endif; ?>

    </main>

</body>
</html>