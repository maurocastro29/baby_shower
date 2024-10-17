<?php
session_start(); // Asegúrate de iniciar la sesión

// Redirigir si la sesión de usuario ya está establecida
if (!isset($_SESSION["primer-nombre"])) {
    header("Location:registrar-datos-personal.php");
    exit(); // Asegura que el script se detenga después de la redirección
}

// Generar y almacenar el token CSRF si no existe
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32)); // Genera un token aleatorio de 32 bytes
}

// Recuperar los datos de la sesión
$primerNombre = $_SESSION["primer-nombre"] ?? '';
$segundoNombre = $_SESSION["segundo-nombre"] ?? '';
$primerApellido = $_SESSION["primer-apellido"] ?? '';
$segundoApellido = $_SESSION["segundo-apellido"] ?? '';
$tipoIdentificacion = $_SESSION["tipo-Identificacion"] ?? '';
$numeroIdentificacion = $_SESSION["identificacion"] ?? '';
$telefono = $_SESSION["telefono"] ?? '';
$correo = $_SESSION["correo"] ?? '';

$message = "";
$messageExito = "";

// Procesar el formulario si se ha enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validar el token CSRF
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        $message = "Error: Token CSRF no válido. Intente nuevamente.";
    } else {
        // Validar los campos del formulario
        $usuario = trim($_POST["usuario"]);
        $password = trim($_POST["password"]);
        $confirmPassword = trim($_POST["confirmPassword"]);

        if (empty($usuario)) {
            $message = "El campo de usuario no puede estar vacío.";
        } elseif ($password !== $confirmPassword) {
            $message = "Las contraseñas no coinciden.";
        } else {
            require_once "conexion.php";

            $sql = "SELECT 
            (SELECT COUNT(*) FROM maestro_usuario WHERE usuario = ?) +
            (SELECT COUNT(*) FROM usuarios WHERE usuario = ?) AS total_count";
            $stmt = $conexion->prepare($sql);
            $stmt->bind_param("ss", $usuario, $usuario);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();

            if ($row['total_count'] > 0) {
                $message = "El usuario ya existe. Por favor, elija otro nombre de usuario.";
            } else {
                $passwordNew = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
                $fechaActual = (new DateTime())->format('d/m/Y');
                $sqlMaestroUsuario = 
                "INSERT INTO maestro_usuario (id_tipo_identificacion, identificacion, primer_nombre, segundo_nombre, primer_apellido, segundo_apellido, usuario, password, activo, celular, correo, fecha_registro, id_tipo_usuario) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, 1, ?, ?, ?, 1)";
                $stmt = $conexion->prepare($sqlMaestroUsuario);
                $stmt->bind_param('sssssssssss', $tipoIdentificacion, $numeroIdentificacion, $primerNombre, $segundoNombre, $primerApellido, $segundoApellido, $usuario, $passwordNew, $telefono, $correo, $fechaActual);
                if ($stmt->execute()){
                  $sqlConsulta = "SELECT id FROM maestro_usuario where correo = ?";
                  $stmt = $conexion->prepare($sqlConsulta);
                  $stmt->bind_param('s', $correo); // 's' para cadena de caracteres
                  $stmt->execute();
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
                    $stmt->execute();
                    $result2 = $stmt->get_result();
                    if ($result2->num_rows > 0){
                      $messageExito = "Exito: el nuevo usuario ha sido creado.";
                    }
                  } else {
                    $message = "Error: No se pudo encontrar el usuario creado.";
                  }
                } else {
                  $message = "Error al crear el usuario en maestro_usuario.";
                }
            }
            mysqli_close($conexion);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registrar datos acceso</title>
  <!-- Agrega las bibliotecas de Bootstrap -->
  <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="style_articulos.css">
  <link rel="stylesheet" href="style.css">
</head>

<body class="bg-light">


<!-- Page Content -->
<section class="py-5">
  <div class="container">
    <h2 class="fw-light text-center pb-3">Registro de usuario</h2>
    <div class="container mt-2">
        <div class="row justify-content-center">
            <div class="col-md-5 rounded border bg-white shadow p-3">
            <h5 class="text-center mt-1 mb-5 text-primary"><b>Registrar datos de acceso</b></h5>
            <?php 
                if(!empty($message)){
                    echo '<div class="bg-warning border rounded mb-2"><p class="mx-2 my-1">'.$message.'</p></div>';
                }
                if(!empty($messageExito)){
                  echo '<div class="bg-success border rounded shadow mb-2 text-white"><p class="mx-2 my-1">'.$messageExito.'<a class="btn  mx-2 text-white bold" href="home.php"><b>Iniciar sesión</b></a></p></div>';
              }
            ?>
            <form method="POST" id="formRegistroAcceso">
                <p class="text-secondary text-small">Ingrese los siguientes datos</p>
                <div class="form-row justify-content-center">
                    <div class="form-group col-md-12">
                        <label for="usuario">Usuario</label>
                        <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Ingrese su usuario" required>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="password">Contraseña</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Ingrese su contraseña" required>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="confirmPassword">Confirmar Contraseña</label>
                        <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Confirmar contraseña" required>
                    </div>
                    <!-- Campo oculto para el token CSRF -->
                    <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">
                </div>
                <div class="d-flex my-3 justify-content-center">
                    <a class="btn  mx-2 text-danger" href="home.php">Cancelar</a>
                    <input type="submit" class="btn btn-success mx-2" value="Crear cuenta">
                </div>
            </form>
            </div>
        </div>
    </div>
  </div>
</section>
<script src="js/registrarDatosAcceso.js"></script>
</body>
</html>
