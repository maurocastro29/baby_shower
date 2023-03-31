<?php
session_start();
if (empty($_SESSION['userActive'])) {
    header('location: login.php');
}
if ($_SESSION['id_tipo'] != 1) {
    header('location: ../');
}

if (empty($_REQUEST['id'])) {
    header('location: articulos.php');
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
    <title>Articulos - SA Admin</title>
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
                            $idArticulo = $_REQUEST['id'];
                            $sql = "SELECT a.*, u.* FROM articulos AS a INNER JOIN usuarios AS u ON u.id_usuario = a.id_usuario WHERE a.id_articulo = '$idArticulo'";
                            $resultado = mysqli_query($conexion, $sql);

                            if (mysqli_num_rows($resultado) > 0) {
                                // Muestra los datos de la tabla
                            ?>
                                <div class="row justify-content-center">
                                    <?php
                                    $fila = mysqli_fetch_assoc($resultado)
                                    ?>
                                    <div class="row justify-content-center">
                                        <div class="col-sm-3 col-md-4">
                                            <div class="articulos">
                                                <img src="<?php echo $fila["imagen"]; ?>" class="img-fluid">
                                                <h5 class="card-title"><?php echo $fila["nombre"]; ?></h5>
                                                <p class="card-text"><?php echo $fila["detalle"]; ?></p>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 col-md-4">
                                            <div class="">
                                                <?php if ($fila["id_usuario"] != 3) { ?>
                                                    <div class=" btn btn-success">
                                                        <h5 class="card-title">Artículo elejido por:</h5><br>
                                                        <p class="card-text"><?php echo $fila["nombres"] . ' ' . $fila["apellidos"]; ?></p>
                                                    </div>

                                                <?php } else { ?>
                                                    <h5 class="card-title btn btn-danger">Este articulo aún no ha sido seleccionado por ningún usuario</h5>
                                                <?php } ?>
                                            </div>
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
                            Copyright &copy; <a target="_blank" href="https://www.linkedin.com/in/mauricio-castro-52b38b181/"> Mauricio Castro 2023</a></div>
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