<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Contacto</title>
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
<?php
  include("header.php");
  include("loginModal.php");
?>

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
    <div class="row justify-content-center">
      <div class="col-lg-7 col-md-9 col-sm-11">
        <h2 class="fw-light text-center">Contáctanos</h2><br>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellendus ab nulla dolorum autem nisi officiis
          blanditiis voluptatem hic, assumenda aspernatur facere ipsam nemo ratione cumque magnam enim fugiat
          reprehenderit expedita.</p>
      </div>
    </div>
  </div>
</section>
<script src="countDown.js"></script>
</body>
</html>
