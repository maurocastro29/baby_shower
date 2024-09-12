<?php
session_start();
if (empty($_SESSION['userBabyShowerActive'])) {
  header('location: login.php');
}
if (!empty($_POST)) {
  include('conexion.php');
  $idArticulo = $_POST['idArticulo'];
  $idUsuario = $_SESSION['idUser'];
  $sql = "UPDATE articulos SET id_usuario = '$idUsuario' WHERE id_articulo = '$idArticulo' AND estado = 1";
  $resultado = mysqli_query($conexion, $sql);
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
      <a href="detalle_articulo.php" class="navbar-brand" style="color: #0069D9;"><b>Mis articulos</b></a>
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
    <p class="text-usuario">Hola <?php echo $_SESSION['nombre']; ?> Bienvenid@. Puedes seleccionar el artículo que desees.</p>
  </div>
  <div class="container">
    <div class="card">
      <div class="card-header bg-primary text-white">
        Lista de articulos
      </div>
      <div class="card-body">
        <?php
          // Conexión a la base de datos
          include('conexion.php');

          // Consulta para obtener los datos de la tabla
          $sql = "SELECT id_articulo, nombre, detalle, imagen, estado, id_usuario FROM articulos WHERE estado = 1";
          $resultado = mysqli_query($conexion, $sql);

          if (mysqli_num_rows($resultado) > 0) {
            // Muestra los datos de la tabla
            echo isset($alert) ? $alert : '';
            echo '<div class="row justify-content-center">';
            while ($fila = mysqli_fetch_assoc($resultado)) {
              if($fila["id_usuario"] == 3 && $fila["id_usuario"] != $_SESSION['idUser']){
                echo  '<form class="shadow m-2 border rounded" action="index.php" method="post">'.
                          '<div class="col-sm-2 col-md-3 text-center">'.
                            '<div class="articulos">'.
                              '<input type="text" name="idArticulo" id="idArticulo" value="'.($fila["id_articulo"]) .'" hidden>'.
                              '<img src="./admin//imagenes/'.($fila["imagen"]).'" class="img-articulo rounded">'.
                              '<div style="padding-left: 5px; padding-right: 5px;">'.
                                '<h5 class="card-title mt-3">'.$fila["nombre"].'</h5>'.
                                '<p>'.$fila["detalle"].'</p>'.
                              '</div>'.
                              '<input type="submit" class="btn btn-primary" value="Agregar"></input>'.
                            '</div>'.
                          '</div>'.
                        '</form>';
              }else if( $fila["id_usuario"] == $_SESSION['idUser']){
                echo '<form class="shadow m-2 border rounded" action="index.php" method="post">'.
                          '<div class="col-sm-2 col-md-3 text-center">'.
                            '<div class="articulos2">'.
                              '<input type="text" name="idArticulo" id="idArticulo" value="'.($fila["id_articulo"]) .'" hidden>'.
                              '<img src="./admin//imagenes/'.($fila["imagen"]).'" class="img-articulo rounded">'.
                              '<div style="padding-left: 5px; padding-right: 5px;">'.
                                '<h5 class="card-title mt-3">'.$fila["nombre"].'</h5>'.
                                '<p>'.$fila["detalle"].'</p>'.
                              '</div>'.
                              '<input type="button" class="btn btn-warning" value="Mi articulo"></input>'.
                            '</div>'.
                          '</div>'.
                        '</form>';
              }else{
                echo  '<form class="shadow m-2 border rounded" action="index.php" method="post">'.
                          '<div class="col-sm-2 col-md-3 text-center">'.
                            '<div class="articulos2">'.
                              '<input type="text" name="idArticulo" id="idArticulo" value="'.($fila["id_articulo"]) .'" hidden>'.
                              '<img src="./admin//imagenes/'.($fila["imagen"]).'" class="img-articulo rounded">'.
                              '<div style="padding-left: 5px; padding-right: 5px;">'.
                                '<h5 class="card-title mt-3">'.$fila["nombre"].'</h5>'.
                                '<p>'.$fila["detalle"].'</p>'.
                              '</div>'.
                              '<input type="button" class="btn btn-danger" value="Articulo elegido"></input>'.
                            '</div>'.
                          '</div>'.
                        '</form>';
              }
              
            }
          } else {
            echo '<div class="text-center">Todos los artículos han sido seleccionados</div>';
          }
        ?>
      </div>
    </div>
    </div>
  </div>
  <footer class="py-3 bg-light mt-5 inferior borde-superior">
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