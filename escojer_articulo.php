<?php
session_start();
if (empty($_SESSION['userActive'])) {
  header('location: login.php');
}

if(isset($_REQUEST['id'])){
  include('conexion.php');
  $idArticulo = $_REQUEST['id'];
  $idUsuario = $_SESSION['idUser'];
  $sql = "UPDATE articulos SET id_usuario = '$idUsuario' WHERE id_articulo = '$idArticulo'";
  $result = mysqli_query($conexion, $sql);
  if($result){
    header('Location: index.php');
  }else{
    ?>
    <script>alert('Error al escojer articulo')</script>
    <?php
  }
}else{
  header('location: index.php');
}
?>