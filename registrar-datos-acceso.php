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

            // Preparar la consulta SQL para evitar inyecciones SQL
            $sql = "SELECT COUNT(*) FROM usuarios WHERE usuario = ?";
            $stmt = $conexion->prepare($sql);
            $stmt->bind_param("s", $usuario);
            $stmt->execute();
            $stmt->bind_result($count);
            $stmt->fetch();
            $stmt->close();

            if ($count > 0) {
                $message = "El usuario ya existe. Por favor, elige otro nombre de usuario.";
            } else {
                $passwordNew = md5($password);
                $fechaActual = (new DateTime())->format('d/m/Y');
                $sqlMaestroUsuario = 
                "INSERT INTO maestro_usuario (id_tipo_identificacion, identificacion, primer_nombre, segundo_nombre, primer_apellido, segundo_apellido, usuario, password, activo, celular, correo, fecha_registro, id_tipo_usuario) VALUES ('$tipoIdentificacion', '$numeroIdentificacion', '$primerNombre', '$segundoNombre', '$primerApellido', '$segundoApellido', '$usuario', '$passwordNew', 1, '$telefono', '$correo', '$fechaActual', 1)";

                $sqlConsulta = "SELECT id FROM maestro_usuario where identificacion = ?";
                $stmt = $conexion->prepare($sqlConsulta);
                $stmt->bind_param('s', $usuario); // 's' para cadena de caracteres
                $stmt->execute();
                $result = $stmt->get_result();
                if ($result->num_rows > 0){
                    $row = $result->fetch_assoc();
                    $idUsuarioExistente = $row['id'];
                    $nombres = $primerNombre .' ' . $segundoNombre
                    $sqlUsuario = "INSERT INTO usuarios (nombres, apellidos, usuario, password, id_tipo, id_estado, id_maestro_usuario) VALUES ('$primerNombre')";
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
<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light bg-primary shadow fixed-top">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand text-white" href="home.php">My Babyshower</a>

  <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item">
        <a class="nav-link text-white" href="quienes-somos.php">Quienes somos</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="contactanos.php">Contáctanos</a>
      </li>
    </ul>
    <div class="form-inline my-2 my-lg-0">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item active">
                <!-- Botón para abrir el modal de inicio de sesión -->
                <a class="nav-link text-white" href="#" data-toggle="modal" data-target="#loginModal">Iniciar sesión</a>
            </li>
            <li class="nav-item border border-white">
                <a class="nav-link mx-2 text-white" href="registrar-datos-personal.php">Registrarse</a>
            </li>
        </ul>
    </div>
  </div>
</nav>

<!-- Modal de inicio de sesión -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="loginModalLabel">Iniciar Sesión</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="login.php" method="post">
          <div class="form-group">
            <label for="inputUsuario">Usuario</label>
            <input type="text" class="form-control" id="inputUsuario" name="inputUsuario" required>
          </div>
          <div class="form-group">
            <label for="inputPassword">Contraseña:</label>
            <input type="password" class="form-control" id="inputPassword" name="inputPassword" required>
          </div>
          <button type="submit" class="btn btn-primary">Iniciar sesión</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Page Content -->
<section class="py-5 mt-5">
  <div class="container">
    <h2 class="fw-light text-center pb-3">Registro de usuario</h2>
    <div class="container mt-2">
        <div class="row justify-content-center">
            <div class="col-md-5 rounded border border-primary bg-white shadow p-3">
            <h5 class="text-center mt-1 mb-5 text-primary"><b>Registrar datos de acceso</b></h5>
            <?php 
                if(!empty($message)){
                    echo '<div class="bg-warning border rounded mb-2"><p class="mx-2 my-1">'.$message.'</p></div>';
                }
            ?>
            <form method="POST" action="registrar-datos-acceso.php">
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
                <div class="d-flex justify-content-center">
                    <input type="submit" class="btn btn-primary" value="Crear cuenta">
                </div>
            </form>
            </div>
        </div>
    </div>
  </div>
</section>

</body>
</html>
