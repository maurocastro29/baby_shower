<?php
session_start();
if (empty($_SESSION['userActive'])) {
  header('location: login.php');
}

if (!empty($_POST)) {
  include('conexion.php');
  $idArticulo = $_POST['idArticulo'];
  $idUsuario = $_SESSION['idUser'];
  $sql = "UPDATE articulos SET id_usuario = 3 WHERE id_articulo = '$idArticulo'";
  $result = mysqli_query($conexion, $sql);
  if ($result) {
    $alert = '<div class="alert alert-success" role="alert">
                Articulo eliminado
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

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="style_articulos.css">
</head>

<body>

  <nav class="navbar navbar-light bg-light justify-content-between mb-3 borde-inferior">
    <a href="index.php" class="navbar-brand">Lista de articulos</a>
    <div>
      <a class="btn btn-primary btn-cerrar-sesion" href="logout.php">Cerrar sesión</a>
    </div>
  </nav>


  <div class="container">
    <div class="card">
      <div class="card-header">
        Arículos seleccionados
      </div>
      <div class="card-body justify-content-center">
      <?php echo isset($alert) ? $alert : ''; ?>
        <?php
        // Conexión a la base de datos
        include('conexion.php');

        // Consulta para obtener los datos de la tabla
        $idUser = $_SESSION['idUser'];
        $sql = "SELECT * FROM articulos WHERE id_usuario = '$idUser'";
        $resultado = mysqli_query($conexion, $sql);

        if (mysqli_num_rows($resultado) > 0) {
          // Muestra los datos de la tabla
          echo '<div class="row justify-content-center">';

          while ($fila = mysqli_fetch_assoc($resultado)) {
        ?>
            <form action="detalle_articulo.php" method="post">
              <div class="col-sm-2 col-md-3 text-center">
                <div class="articulos">
                  <input type="text" name="idArticulo" id="idArticulo" value="<?php echo ($fila["id_articulo"]) ?>" hidden>
                  <img src="admin/<?php echo ($fila["imagen"]) ?>" class="img-fluid">
                  <h5 class="card-title"><?php echo $fila["nombre"] ?></h5>
                  <p class="card-text"><?php echo $fila["detalle"] ?></p>
                  <input type="submit" class="btn btn-danger" value="Eliminar"></input>
                </div>
              </div>
            </form>
        <?php
          }

          echo '</div>';
        } else {
          echo '<div class="text-center">No ha seleccionado ningún artículo aún</div>';
        }

        ?>
      </div>
    </div>

  </div>
  <footer class="py-4 bg-light mt-auto">
        <div class="container-fluid px-4">
            <div class="d-flex align-items-center justify-content-center small">
                <div class="text-muted">
                    Copyright &copy; <a target="_blank" href="https://www.linkedin.com/in/mauricio-castro-52b38b181/"> Mauricio Castro 2023</a>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>