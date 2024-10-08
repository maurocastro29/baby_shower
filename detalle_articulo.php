<?php
session_start();
if (empty($_SESSION['userBabyShowerActive'])) {
  header('location: login.php');
}

if (!empty($_POST)) {
  include('conexion.php');
  $idArticulo = $_POST['idArticulo'];
  $idUsuario = $_SESSION['idUser'];
  $sql = "UPDATE articulos SET id_usuario = 3 WHERE id_articulo = '$idArticulo'";
  $result = mysqli_query($conexion, $sql);
  if ($result) {
    $alert = '<div class="alert alert-primary" role="alert">
                Articulo retirado exitosamente
                </div>';
  } else {
    $alert = '<div class="alert alert-danger" role="alert">
                Error al eliminar articulo
                </div>';
  }
}
?>

<!DOCTYPE html>
<html>

<head>
  <title>Lista de Artículos</title>
  <!-- Agrega las bibliotecas de Bootstrap -->

  <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="style_articulos.css">
</head>

<body>
  <nav class="navbar navbar-light bg-light justify-content-between menu">
    <div class="container">
      <a href="index.php" class="navbar-brand"  style="color: #0069D9;"><b>Lista de articulos</b></a>
      <a class="btn-cerrar-sesion" style="color: #0069D9;" href="logout.php">Cerrar sesión</a>
    </div>
  </nav>
  <div class="titulo bg-light text-center mb-5">
    <div>
      <h1 class="titulo-babyshower">BABY SHOWER</h1>
    </div>
    <div class="nombre-bebe">
      <h3>(Nombre)</h3>
    </div>
    <span class="countdown small"><p style="font-size:16px;" id="clock"></p></span>
  </div>
  <div class="container">
    <p class="text-usuario"><?php echo $_SESSION['nombre']; ?> estos son los articulo que has seleccionado...</p>
  </div>
  <div class="container">
    <div class="card">
      <div class="card-header bg-primary text-white">
        Arículos seleccionados
      </div>
      <div class="card-body justify-content-center">
        <?php echo isset($alert) ? $alert : ''; 
        // Conexión a la base de datos
        include('conexion.php');

        // Consulta para obtener los datos de la tabla
        $idUser = $_SESSION['idUser'];
        $sql = "SELECT * FROM articulos WHERE id_usuario = '$idUser' AND estado = 1";
        $resultado = mysqli_query($conexion, $sql);

        if (mysqli_num_rows($resultado) > 0) {
          // Muestra los datos de la tabla
          echo '<div class="row justify-content-center">';

          while ($fila = mysqli_fetch_assoc($resultado)) {
            echo '<form class="shadow m-2 border rounded" action="detalle_articulo.php" method="post">'.
                  '<div class="col-sm-2 col-md-3 text-center">'.
                    '<div class="articulos">'.
                      '<input type="text" name="idArticulo" id="idArticulo" value="'.($fila["id_articulo"]).'" hidden>'.
                      '<img src="./admin/imagenes/'.($fila["imagen"]).'" class="img-articulo2">'.
                      '<h5 class="card-title mt-3"><'.$fila["nombre"].'</h5>'.
                      '<p class="card-text">'.$fila["detalle"].'</p>'.
                      '<input type="submit" class="btn btn-danger" value="Eliminar"></input>'.
                    '</div>'.
                  '</div>'.
                '</form>';
          }
          echo '</div>';
        } else {
          echo '<div class="text-center">No ha seleccionado ningún artículo aún</div>';
        }
        ?>
      </div>
    </div>
  </div>
  <footer class="py-4 bg-light mt-5 inferior borde-superior">
    <div class="container-fluid px-4">
      <div class="d-flex align-items-center justify-content-center">
        <div class="text-muted">
          Copyright &copy; <a target="_blank" href="https://www.linkedin.com/in/mauricio-castro-52b38b181/"> <b>Mauricio Castro 2023</b></a>
        </div>
      </div>
    </div>
  </footer>
  <script src="countDown.js"></script>
</body>

</html>