<?php
session_start();
require_once 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capturamos el documento sin espacios (intentando ambos nombres comunes de input por seguridad: 'num_doc' o 'numero_documento')
    $numero_documento = isset($_POST['num_doc']) ? trim($_POST['num_doc']) : (isset($_POST['numero_documento']) ? trim($_POST['numero_documento']) : '');
    $password = $_POST['password'];

    if (empty($numero_documento) || empty($password)) {
        echo "<script>
                alert('Por favor completa todos los campos.');
                window.history.back();
              </script>";
        exit();
    }

    // Buscar al usuario en la base de datos por número de documento
    $stmt = $conexion->prepare("SELECT id_usuario, nombres, apellidos, rol, password FROM usuarios WHERE numero_documento = ?");
    $stmt->bind_param("s", $numero_documento);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {
        $usuario = $resultado->fetch_assoc();

        // Verificar la contraseña encriptada
        if (password_verify($password, $usuario['password'])) {
            // Guardar los datos en la sesión
            $_SESSION['usuario_id'] = $usuario['id_usuario'];
            $_SESSION['nombre'] = $usuario['nombres'] . ' ' . $usuario['apellidos'];
            $_SESSION['rol'] = $usuario['rol'];

            echo "<script>
                    alert('¡Bienvenido de nuevo, " . $usuario['nombres'] . "!');
                    window.location.href = '../html/dashboard.php';
                  </script>";
            exit();
        } else {
            echo "<script>
                    alert('Contraseña incorrecta.');
                    window.history.back();
                  </script>";
        }
    } else {
        echo "<script>
                alert('No existe una cuenta registrada con este número de documento.');
                window.history.back();
              </script>";
    }

    $stmt->close();
    $conexion->close();
}
?>