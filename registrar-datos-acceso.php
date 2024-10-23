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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
