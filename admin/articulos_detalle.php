<?php
session_start();
if (empty($_SESSION['userBabyShowerActive'])) {
    header('location: ../home.php');
}
if ($_SESSION['id_tipo'] != 1) {
    header('location: ../');
}
$usuarioMaestro = $_SESSION['usuario_maestro'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include('../conexion.php');
    if (isset($_REQUEST['quitar']) && isset($_POST['idUsuario'])){
        $idArticulo = $_REQUEST['quitar'];
        $idUsuarioEliminar = $_POST['idUsuario'];

        $sqlConsultarCantidad = "SELECT count(*) AS total FROM articulos_elegidos WHERE id_articulo = '$idArticulo' AND id_usuario = '$idUsuarioEliminar'";
        $result = mysqli_query($conexion, $sqlConsultarCantidad);
        $row = mysqli_fetch_assoc($result);


        // Eliminar artículo elegido
        $sqlEliminar = "DELETE FROM articulos_elegidos WHERE id_articulo = ? AND id_usuario = ?";
        $stmt = $conexion->prepare($sqlEliminar);
        $stmt->bind_param('si', $idArticulo, $idUsuarioEliminar); // Cambia el tipo de datos si es necesario


        if ($stmt->execute()){
            $sqlactualizar = "UPDATE articulos SET cantidad = 0 WHERE id_articulo = '$idArticulo' AND estado = 1";
            $resultado = mysqli_query($conexion, $sqlactualizar);
            if ($resultado) {
            $alert = '<div class="alert alert-success" role="alert">
                        Articulo retirado exitosamente
                        </div>';
            } else {
            $alert = '<div class="alert alert-danger" role="alert">
                        Error al retirar articulo
                        </div>';
            }
        }
    }
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Detalle articulos - BS Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="../admin/css/styles.css" rel="stylesheet" />
    <link rel="icon" type="image/jpg" href="../admin/img/logo.ico">
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" href="css/style_articulos.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../admin/js/jquery-ui/jquery-ui.min.css">
</head>

<body class="sb-nav-fixed">
    <?php include('menus/menu_superior.php'); ?>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <?php include('menus/menu_lateral.php'); ?>
        </div>
        <div id="layoutSidenav_content">
            <div class="container-fluid px-4">
                <div class="btn-add">
                    <div class="btn-add-usuario">
                        <a href="../admin/articulos.php" class="btn btn-danger text-white">Atras</a>
                    </div>
                </div>
            </div>
            <main>
                <div class="container-fluid px-4">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Detalle del articulo
                        </div>
                        <div class="card-body">
                            <?php
                            // Conexión a la base de datos
                            include('../conexion.php');

                            // Consulta para obtener los datos de la tabla
                            $idArticulo = isset($_REQUEST['id']) ? $_REQUEST['id'] : $_REQUEST['quitar'];
                            $sqlArticulo = "SELECT * FROM articulos WHERE id_articulo = '$idArticulo'";
                            $sqUsuarios = "SELECT u.id_usuario, u.nombres, u.apellidos FROM articulos AS a INNER JOIN articulos_elegidos AS ae ON ae.id_articulo = a.id_articulo 
                            INNER JOIN usuarios AS u ON u.id_usuario = ae.id_usuario WHERE a.id_articulo = '$idArticulo' AND a.id_maestro_usuario = '$usuarioMaestro'";
                            $resultadoUsuarios = mysqli_query($conexion, $sqUsuarios);
                            $resultadArticulo = mysqli_query($conexion, $sqlArticulo);

                            if (mysqli_num_rows($resultadArticulo) > 0) {
                            ?>
                                <div class="row justify-content-center">
                                    <?php
                                    $datosArticulo = mysqli_fetch_assoc($resultadArticulo)
                                    ?>
                                        <div class="col-sm-6 col-md-6 col-lg-4">
                                            <div class="articulos">
                                                <img src="imagenes/<?php echo $datosArticulo["imagen"]; ?>" class="img-fluid rounded">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6 col-lg-4">
                                            <div>
                                                <h5 class="card-title">Nombre <br></h5>
                                                <p class="card-text"><?php echo $datosArticulo["nombre"]; ?></p>
                                                <h5 class="">Descripción</h5>
                                                <p ><?php echo $datosArticulo["detalle"]; ?></p>
                                            </div>
                                            
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-4">
                                            <div class="text-center mt-4">
                                                <?php   if (mysqli_num_rows($resultadoUsuarios) > 0) { 
                                                    ?>
                                                    <div class="card shadow bg-success p-2 text-white">
                                                        <h5 class="card-title">Artículo elegido por:</h5><br>
                                                        <?php  while ($fila = mysqli_fetch_assoc($resultadoUsuarios)) { ?>
                                                            <div class="d-flex align-items-center mb-3">
                                                                <form action="articulos_detalle.php?quitar=<?php echo $idArticulo; ?>" method="post" class="me-2">
                                                                    <label class="card-text mb-0"><?php echo $fila["nombres"] . ' ' . $fila["apellidos"]; ?></label>
                                                                    <input type="hidden" name="idUsuario" id="idUsuario" value="<?php echo $fila['id_usuario']; ?>">
                                                                    <button class="btn btn-warning mb-3">Retirar artículo</button>
                                                                </form>
                                                                
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                <?php
                                                        } else { ?>
                                                    <h5 class="card-title btn btn-danger">Este articulo aún no ha sido seleccionado por ningún usuario</h5>
                                                <?php } ?>
                                            </div>
                                        </div>
                                <?php


                                echo '</div>';
                            } else {
                                echo "0 resultados";
                            }

                                ?>

                                </div>
                        </div>
                    </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-center small">
                        <div class="text-muted">
                            Copyright &copy; <a target="_blank" href="https://www.linkedin.com/in/mauricio-castro-52b38b181/"> Mauricio Castro 2024</a></div>
                        <!--    <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>-->
                    </div>
                </div>
        </div>
        </footer>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="../admin/js/scripts.js"></script>
    <script src="../admin/js/funciones.js"></script>
    <script src="../admin/js/sweetalert2.all.min.js"></script>
    <script src="../admin/js/Chart.bundle.min.js"></script>
    <script src="../admin/js/datatables-simple-demo.js"></script>
    <script src="../admin/js/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
    <script src="../admin/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="../admin/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="../admin/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script src="../admin/js/jquery-ui/jquery-ui.min.js"></script>


</body>

</html>