<?php
require_once 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $rol              = $_POST['rol'];
    $tipo_doc         = $_POST['tipo_doc'];
    $num_doc          = trim($_POST['num_doc']);
    $nombres          = trim($_POST['nombres']);
    $apellidos        = trim($_POST['apellidos']);
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $edad             = $_POST['edad'];
    $direccion        = trim($_POST['direccion']);
    $password         = $_POST['password'];
    $info_laboral     = trim($_POST['info_laboral']);

    // Encriptar la contraseña por seguridad
    $password_hashed = password_hash($password, PASSWORD_BCRYPT);

    // Verificar si el documento ya está registrado
    $check_stmt = $conexion->prepare("SELECT id_usuario FROM usuarios WHERE numero_documento = ?");
    $check_stmt->bind_param("s", $num_doc);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();

    if ($check_result->num_rows > 0) {
        echo "<script>
                alert('Error: Ya existe una cuenta registrada con este número de documento.');
                window.history.back();
              </script>";
        $check_stmt->close();
        $conexion->close();
        exit();
    }
    $check_stmt->close();

    // Procesar la foto de perfil si fue subida
    $foto_nombre = NULL;
    if (isset($_FILES['fotos']) && $_FILES['fotos']['error'] === UPLOAD_ERR_OK) {
        $nombre_archivo = time() . '_' . basename($_FILES['fotos']['name']);
        $ruta_destino  = '../uploads/' . $nombre_archivo;

        if (!file_exists('../uploads')) {
            mkdir('../uploads', 0777, true);
        }

        if (move_uploaded_file($_FILES['fotos']['tmp_name'], $ruta_destino)) {
            $foto_nombre = $nombre_archivo;
        }
    }

    // Insertar el nuevo usuario en la base de datos
    $stmt = $conexion->prepare("INSERT INTO usuarios (rol, tipo_documento, numero_documento, nombres, apellidos, fecha_nacimiento, edad, direccion, password, info_laboral, foto_perfil) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssissss", $rol, $tipo_doc, $num_doc, $nombres, $apellidos, $fecha_nacimiento, $edad, $direccion, $password_hashed, $info_laboral, $foto_nombre);

    if ($stmt->execute()) {
        session_start();
        $_SESSION['usuario_id'] = $stmt->insert_id;
        $_SESSION['nombre']     = $nombres . ' ' . $apellidos;
        $_SESSION['rol']        = $rol;

        echo "<script>
                alert('¡Registro exitoso! Bienvenido a Zantis.');
                window.location.href = '../html/dashboard.php';
              </script>";
    } else {
        echo "<script>
                alert('Error al registrar el usuario: " . $stmt->error . "');
                window.history.back();
              </script>";
    }

    $stmt->close();
    $conexion->close();
}
?>