<?php
session_start();
if (empty($_SESSION['userBabyShowerActive'])) {
  header('location: home.php');
}

if (!empty($_POST)) {
  include('conexion.php');
  $idArticulo = $_POST['idArticulo'];
  $idUsuario = $_SESSION['idUser'];

  $sqlArticuloEliminar = "select id FROM articulos_elegidos WHERE id_articulo = '$idArticulo' AND id_usuario = '$idUsuario' LIMIT 1";
  $resultIdEliminar = mysqli_query($conexion, $sqlArticuloEliminar);
  $rowIdEliminar = mysqli_fetch_assoc($resultIdEliminar);
  $idEliminar = $rowIdEliminar['id'];

  $sqlValidar = "SELECT count(*) AS total FROM articulos_elegidos WHERE id_articulo = '$idArticulo'";
  $result = mysqli_query($conexion, $sqlValidar);
  $row = mysqli_fetch_assoc($result);
  if ($row['total'] > 0){
    $sqlEliminar = "DELETE FROM articulos_elegidos WHERE id = ?";
    $stmt = $conexion->prepare($sqlEliminar);
    $stmt->bind_param('s', $idEliminar);
    if ($stmt->execute()) {
      $sqlConsultarCantidad = "SELECT count(*) AS total FROM articulos_elegidos WHERE id_articulo = '$idArticulo'";
      $result = mysqli_query($conexion, $sqlConsultarCantidad);
      $row = mysqli_fetch_assoc($result);
      if ($row['total'] > 0){
        $nuevoValor = $row['total'];
        $sqlactualizar = "UPDATE articulos SET cantidad = $nuevoValor WHERE id_articulo = '$idArticulo' AND estado = 1";
        $resultado = mysqli_query($conexion, $sqlactualizar);
        if ($resultado) {
          $alert = '<div class="alert alert-success" role="alert">
                      Articulo seleccionado correctamente
                      </div>';
        } else {
          $alert = '<div class="alert alert-danger" role="alert">
                      Error al seleccionar articulo
                      </div>';
        }
      }else{
        $sqlactualizar = "UPDATE articulos SET cantidad = 0 WHERE id_articulo = '$idArticulo' AND estado = 1";
        $resultado = mysqli_query($conexion, $sqlactualizar);
        if ($resultado) {
          $alert = '<div class="alert alert-success" role="alert">
                      Articulo seleccionado correctamente
                      </div>';
        } else {
          $alert = '<div class="alert alert-danger" role="alert">
                      Error al seleccionar articulo
                      </div>';
        }
      }
    }else{
      $alert = '<div class="alert alert-danger" role="alert">
                  Error al eliminar articulo
                  </div>';
    }
    $sqlConsultarCantidad = "SELECT cantidad, total FROM articulos WHERE id_articulo = '$idArticulo'";
    $result = mysqli_query($conexion, $sqlConsultarCantidad);
  }else if ($row['total'] == 1){
    $sqlactualizar = "UPDATE articulos SET cantidad = 0 WHERE id_articulo = '$idArticulo' AND estado = 1";
    $resultado = mysqli_query($conexion, $sqlactualizar);
    if ($resultado) {
      $alert = '<div class="alert alert-success" role="alert">
                  Articulo seleccionado correctamente
                  </div>';
    } else {
      $alert = '<div class="alert alert-danger" role="alert">
                  Error al seleccionar articulo
                  </div>';
    }
  }
}
$usuarioMaestro = $_SESSION['usuario_maestro'];
?>

<!DOCTYPE html>
<html>

<head>
  <title>Lista de artículos</title>
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
        $sql = "SELECT a.*, COUNT(ae.id_articulo) AS elegidos FROM articulos AS a INNER JOIN articulos_elegidos AS ae ON ae.id_articulo = a.id_articulo WHERE ae.id_usuario = '$idUser' AND a.estado = 1 AND a.id_maestro_usuario = '$usuarioMaestro'GROUP BY a.id_articulo";
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
                      '<div>'.$fila["elegidos"].'/'.$fila["total"].'</div></br>'.
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
          Copyright &copy; <a target="_blank" href="https://www.linkedin.com/in/mauricio-castro-52b38b181/"> <b>Mauricio Castro 2024</b></a>
        </div>
      </div>
    </div>
  </footer>
  <script src="countDown.js"></script>
</body>

</html>