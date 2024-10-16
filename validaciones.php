<?php
    include('conexion.php'); // Asegúrate de tener tu conexión a la base de datos aquí

    // Verifica qué tipo de validación se está solicitando
    if (isset($_POST['action'])) {
        if ($_POST['action'] === 'validarCorreo') {
            validarCorreo($conexion);
        }
        // Puedes agregar más validaciones en el futuro aquí, como validar nombre de usuario, etc.
    }

    // Verifica qué tipo de validación se está solicitando
    if (isset($_POST['action'])) {
        if ($_POST['action'] === 'validarNumeroIdentificacion') {
            validarNumeroIdentificacion($conexion);
        }
        // Puedes agregar más validaciones en el futuro aquí, como validar nombre de usuario, etc.
    }

    // Verifica qué tipo de validación se está solicitando
    if (isset($_POST['action'])) {
        if ($_POST['action'] === 'validarUsuario') {
            validarUsuario($conexion);
        }
        // Puedes agregar más validaciones en el futuro aquí, como validar nombre de usuario, etc.
    }

    // Función para validar si el correo existe en la base de datos
    function validarCorreo($conexion) {
        if (isset($_POST['correo'])) {
            $correo = trim($_POST['correo']);

            // Prepara la consulta para verificar si el correo existe
            $stmt = $conexion->prepare("SELECT COUNT(*) AS count FROM maestro_usuario WHERE correo = ?");
            $stmt->bind_param("s", $correo);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();

            // Retorna un JSON con el resultado
            if ($row['count'] > 0) {
                echo json_encode(['exists' => true]);
            } else {
                echo json_encode(['exists' => false]);
            }

            $stmt->close();
            $conexion->close();
        }
    }

    // Función para validar si la identificacion existe en la base de datos
    function validarNumeroIdentificacion($conexion) {
        if (isset($_POST['numeroIdentificacion'])) {
            $numeroIdentificacion = trim($_POST['numeroIdentificacion']);

            // Prepara la consulta para verificar si la identificacion existe
            $stmt = $conexion->prepare("SELECT COUNT(*) AS count FROM maestro_usuario WHERE identificacion = ?");
            $stmt->bind_param("s", $numeroIdentificacion);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();

            // Retorna un JSON con el resultado
            if ($row['count'] > 0) {
                echo json_encode(['exists' => true]);
            } else {
                echo json_encode(['exists' => false]);
            }

            $stmt->close();
            $conexion->close();
        }
    }

    // Función para validar si el usuario existe en la base de datos
    function validarUsuario($conexion) {
        if (isset($_POST['usuario'])) {
            $usuario = trim($_POST['usuario']);

            // Prepara la consulta para verificar si el usuario existe en ambas tablas
            $sql = "SELECT 
            (SELECT COUNT(*) FROM maestro_usuario WHERE usuario = ?) +
            (SELECT COUNT(*) FROM usuarios WHERE usuario = ?) AS total_count";
            $stmt = $conexion->prepare($sql);
            $stmt->bind_param("ss", $usuario, $usuario);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();

            // Retorna un JSON con el resultado
            if ($row['total_count'] > 0) {
                echo json_encode(['exists' => true]);
            } else {
                echo json_encode(['exists' => false]);
            }

            $stmt->close();
            $conexion->close();
        }
    }

?>
