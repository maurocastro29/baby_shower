<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Home</title>
  <!-- Agrega las bibliotecas de Bootstrap -->
  <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

  <link rel="stylesheet" href="style_articulos.css">
  <link rel="stylesheet" href="style.css">

</head>

<body>
  <!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light bg-primary shadow fixed-top">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
    <span class="fas fa-bars"></span>
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
<?php
  include("loginModal.php");
?>


<!-- Full Page Image Header with Vertically Centered Content -->
<header class="masthead">
  <div class="container h-100">
    <div class="row h-100 align-items-center">
      <div class="col-12 text-center">
        <h1 class="fw-light">Vertically Centered Masthead Content</h1>
        <p class="lead">A great starter layout for a landing page</p>
      </div>
    </div>
  </div>
</header>

<!-- Page Content -->
<section class="py-5">
  <div class="container">
    <h2 class="fw-light">Page Content</h2>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellendus ab nulla dolorum autem nisi officiis
      blanditiis voluptatem hic, assumenda aspernatur facere ipsam nemo ratione cumque magnam enim fugiat
      reprehenderit expedita.</p>
  </div>
</section>
<script src="countDown.js"></script>

</body>
</html>
