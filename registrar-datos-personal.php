
<?php 
session_start();

// Verificar que primerNombre no esté vacío
if (isset($_POST['primerNombre'])) {
    // Asignar valores a la sesión
    $_SESSION["primer-nombre"] = trim($_POST["primerNombre"]);
    $_SESSION["segundo-nombre"] = trim($_POST["segundoNombre"] ?? ''); // Asignar un valor por defecto si no está presente
    $_SESSION["primer-apellido"] = trim($_POST["primerApellido"]);
    $_SESSION["segundo-apellido"] = trim($_POST["segundoApellido"] ?? '');
    $_SESSION["tipo-Identificacion"] = trim($_POST["tipoIdentificacion"]);
    $_SESSION["identificacion"] = trim($_POST["numeroIdentificacion"]);
    $_SESSION["telefono"] = trim($_POST["telefono"]);
    $_SESSION["correo"] = trim($_POST["correo"]);
    $_SESSION["crear-usuario"] = true;
    $message = "";
    // Validar campos obligatorios
    if (empty($_SESSION["tipo-Identificacion"])) {
        $message = "Debe asignar un tipo de documento";
    } elseif (empty($_SESSION["primer-nombre"]) || empty($_SESSION["primer-apellido"]) || empty($_SESSION["identificacion"]) || empty($_SESSION["correo"])) {
        $message = "Existen campos por rellenar. Por favor valide la información y vuelva a intentarlo";
    } elseif (!filter_var($_SESSION["correo"], FILTER_VALIDATE_EMAIL)) {
        $message = "El correo electrónico no es válido.";
    } 
    if(empty($message)){
        header("Location: registrar-datos-acceso.php");
        exit(); // Asegura que el script se detenga después de la redirección
    }
}else{
    $message = "";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Datos personales</title>
  <!-- Agrega las bibliotecas de Bootstrap -->
  <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="style_articulos.css">
  <link rel="stylesheet" href="style.css">
</head>

<body class="bg-light ">

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
            <div class="col-md-8 rounded border border-primary bg-white shadow p-3">
            <h5 class="text-center mt-1 mb-5 text-primary"><b>Registro de datos personales</b></h5>
            <?php 
                if(!empty($message)){
                    echo '<div class="bg-warning border rounded mb-2"><p class="mx-2 my-1">'.$message.'</p></div>';
                }
            ?>
            <form method="POST">
                <p class="text-secondary text-samll">Ingrese los siguientes datos</p>
                <div class="form-row">
                    
                    <div class="form-group col-md-6">
                        <input type="text" class="form-control" id="primerNombre" name="primerNombre" placeholder="Primer nombre" required>
                    </div>
                    <div class="form-group col-md-6">
                        <input type="text" class="form-control" id="segundoNombre" name="segundoNombre" placeholder="Segundo nombre">
                    </div>
                    <div class="form-group col-md-6">
                        <input type="text" class="form-control" id="primerApellido" name="primerApellido" placeholder="Primer apellido" required>
                    </div>
                    <div class="form-group col-md-6">
                        <input type="text" class="form-control" id="segundoApellido" name="segundoApellido" placeholder="Segundo apellido">
                    </div>
                    <div class="form-group col-md-6">
                        <select class="form-control" id="tipoIdentificacion" name="tipoIdentificacion" required>
                            <option value="">Tipo identificación</option>
                            <option value="1">Cedula de ciudadania</option>
                            <option value="2">Tarjeta identidad</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <input type="text" class="form-control" id="numeroIdentificacion" name="numeroIdentificacion" placeholder="Número identificación" required>
                    </div>
                    <div class="form-group col-md-6">
                        <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Telefono">
                    </div>
                    <div class="form-group col-md-6">
                        <input type="text" class="form-control" id="correo" name="correo" placeholder="Correo" required>
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <input class="btn btn-primary pe-5 ps-5" type="submit" value="Siguiente">
                </div>
            </form>
            </div>
        </div>
        </div>
  </div>
</section>

</body>
</html>
