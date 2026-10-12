<?php
session_start();
require_once 'conexion.php';

// Verificar que sea una empresa la que intenta publicar
if (!isset($_SESSION['usuario_id']) || $_SESSION['rol'] !== 'empresa') {
    echo "<script>
            alert('Acceso no autorizado.');
            window.location.href = '../html/dashboard.php';
          </script>";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_empresa = $_SESSION['usuario_id'];
    $titulo = trim($_POST['titulo']);
    $descripcion = trim($_POST['descripcion']);
    $salario = $_POST['salario'];
    $ubicacion = trim($_POST['ubicacion']);

    $stmt = $conexion->prepare("INSERT INTO vacantes (id_empresa, titulo, descripcion, salario, ubicacion) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issds", $id_empresa, $titulo, $descripcion, $salario, $ubicacion);

    if ($stmt->execute()) {
        echo "<script>
                alert('¡Vacante publicada con éxito!');
                window.location.href = '../html/dashboard.php';
              </script>";
    } else {
        echo "<script>
                alert('Error al publicar la vacante.');
                window.history.back();
              </script>";
    }

    $stmt->close();
    $conexion->close();
}
?>