<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Quienes somos</title>
  <!-- Agrega las bibliotecas de Bootstrap -->
  <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="style_articulos.css">
  <link rel="stylesheet" href="style.css">
</head>

<body>

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
    <h2 class="fw-light">¿Quienes somos?</h2>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellendus ab nulla dolorum autem nisi officiis
      blanditiis voluptatem hic, assumenda aspernatur facere ipsam nemo ratione cumque magnam enim fugiat
      reprehenderit expedita.</p>
  </div>
</section>

</body>
</html>
