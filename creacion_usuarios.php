<?php
    include('conexion.php');
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    session_start();
    if (isset($_POST['action'])) {
        if ($_POST['action'] === 'crearUsuario') {
            crearusuario($conexion);
        }
    }
    // Función para validar si el correo existe en la base de datos
    function crearUsuario($conexion) {
        if (isset($_SESSION["primer-nombre"])) {
            // Recuperar los datos de la sesión
            $primerNombre = $_SESSION["primer-nombre"] ?? '';
            $segundoNombre = $_SESSION["segundo-nombre"] ?? '';
            $primerApellido = $_SESSION["primer-apellido"] ?? '';
            $segundoApellido = $_SESSION["segundo-apellido"] ?? '';
            $tipoIdentificacion = $_SESSION["tipo-Identificacion"] ?? '';
            $numeroIdentificacion = $_SESSION["identificacion"] ?? '';
            $nombreBebe = $_SESSION["nombre-bebe"] ?? '';
            $sexoBebe = $_SESSION["sexo-bebe"] ?? '';
            $telefono = $_SESSION["telefono"] ?? '';
            $correo = $_SESSION["correo"] ?? '';
            $fechaEvento = $_SESSION["fecha-evento"];
            $horaEvento = $_SESSION["hora-evento"];
            $activo = 1;
            $idTipoUsuario = 1;
            $usuario = $_POST['usuario'];
            $password = $_POST['password'];
            $sql = "SELECT 
            (SELECT COUNT(*) FROM maestro_usuario WHERE usuario = ?) +
            (SELECT COUNT(*) FROM usuarios WHERE usuario = ?) AS total_count";
            $stmt = $conexion->prepare($sql);
            $stmt->bind_param("ss", $usuario, $usuario);
            if (!$stmt->execute()) {
                echo json_encode(['creado' => false, 'error' => 'Error en la ejecución de la consulta: ' . $stmt->error]);
                return; // Termina la función aquí si hay un error
            }
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            if ($row['total_count'] > 0) {
                echo json_encode(['creado' => "este usuario ya ha sido registrado en el sistema"]); //El usuario ya existe. Por favor, elija otro nombre de usuario.
            } else {
                $passwordNew = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
                $fechaActual = (new DateTime())->format('Y-m-d');
                $sqlMaestroUsuario = 
                "INSERT INTO maestro_usuario (id_tipo_identificacion, identificacion, primer_nombre, segundo_nombre, primer_apellido, segundo_apellido, nombre_bebe, sexo_bebe, fecha_evento, hora_evento, usuario, activo, celular, correo, fecha_registro, id_tipo_usuario) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt = $conexion->prepare($sqlMaestroUsuario);
                $stmt->bind_param('ssssssssssssssss', $tipoIdentificacion, $numeroIdentificacion, $primerNombre, $segundoNombre, $primerApellido, $segundoApellido, $nombreBebe, $sexoBebe, $fechaEvento,$horaEvento, $usuario, $activo, $telefono, $correo, $fechaActual, $idTipoUsuario);
                if ($stmt->execute()){
                    $sqlConsulta = "SELECT id FROM maestro_usuario where correo = ?";
                    $stmt = $conexion->prepare($sqlConsulta);
                    $stmt->bind_param('s', $correo); // 's' para cadena de caracteres
                    if (!$stmt->execute()) {
                        echo json_encode(['creado' => false, 'error' => 'Error en la ejecución de la consulta: ' . $stmt->error]);
                        return; // Termina la función aquí si hay un error
                    }
                    $result = $stmt->get_result();
                    if ($result->num_rows > 0){
                        $row = $result->fetch_assoc();
                        $idUsuarioCreado = $row['id'];
                        $nombres = $primerNombre .' ' . $segundoNombre;
                        $apellidos = $primerApellido .' ' . $segundoApellido;
                        // Insertar en usuarios
                        $sqlUsuario = "INSERT INTO usuarios (nombres, apellidos, usuario, password, id_tipo, id_estado, id_maestro_usuario) 
                        VALUES (?, ?, ?, ?, 1, 1, ?)";
                        $stmt = $conexion->prepare($sqlUsuario);
                        $stmt->bind_param('ssssi', $nombres, $apellidos, $usuario, $passwordNew, $idUsuarioCreado);
                        $valorInsercion = $stmt->execute();
                        if($valorInsercion){
                            echo json_encode(['creado' => true]);
                        }else{
                            echo json_encode(['creado' => false, 'error' => 'Error en la ejecución de la consulta: ' . $stmt->error]);
                            return; // Termina la función aquí si hay un error
                        }
                    } else {
                        echo json_encode(['creado' => "Usuario registrado no encontrado"]); //Error: No se pudo encontrar el usuario creado.
                    }
                }else {
                    echo json_encode(['creado' => false, 'error' => 'Error al crear usuario maestro: ' . $stmt->error]);
                    return; // Termina la función aquí si hay un error
                }
            }
            $stmt->close();
            $conexion->close();
        }
    }