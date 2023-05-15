<?php
session_start();
if (empty($_SESSION['userBabyShowerActive'])) {
    header('location: ../login.php');
}
if ($_SESSION['id_tipo'] != 1) {
    header('location: ../');
}
if (isset($_REQUEST['id'])) {
    // Conexión a la base de datos
    include('../conexion.php');
    $idArticulo = $_REQUEST['id'];
    $sql = "SELECT id_articulo FROM articulos WHERE estado = 1 and id_articulo = '$idArticulo'";
    $result = mysqli_query($conexion, $sql);
    if ($result) {
        $sql = "UPDATE articulos SET estado = 2 WHERE id_articulo = '$idArticulo'";
        $result = mysqli_query($conexion, $sql);
        if ($result) {
            $alert = '<div class="alert alert-danger" role="alert">
                    Articulo retirado exitosamente
                    </div>';
        } else {
            $alert = '<div class="alert alert-danger" role="alert">
                    Error al retirar articulo
                </div>';
        }
    } else {
        header('location: articulos.php');
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
                        <a href="../admin/articulos_crear.php" class="btn btn-primary text-white"><i class="fas fa-plus"></i></a>
                    </div>
                    <div class="btn-add-usuario">
                        <a href="articulos_eliminados.php" class="btn btn-primary text-white">Eliminados</a>
                    </div>
                </div>
            </div>
            <main>
                <div class="container px-4">
                    <h1 class="mt-4 text-center">Articulos</h1>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Datos de los articulos
                        </div>
                        <div class="card-body justify-content-center">
                            <?php if ($_SESSION['id_tipo'] == 1) {

                            ?>
                                <?php echo isset($alert) ? $alert : ''; ?>
                            <?php } ?>

                            <?php
                            // Conexión a la base de datos
                            include('../conexion.php');

                            // Consulta para obtener los datos de la tabla
                            $sql = "SELECT * FROM articulos WHERE estado = 1";
                            $resultado = mysqli_query($conexion, $sql);

                            if (mysqli_num_rows($resultado) > 0) {
                                // Muestra los datos de la tabla
                            ?>
                                <div class="row justify-content-center">
                                    <?php
                                    while ($fila = mysqli_fetch_assoc($resultado)) {
                                        if ($fila["id_usuario"] != 3) {
                                    ?>
                                            <div class="col-sm-2 col-md-3 text-center">
                                                <div class="articulo-seleccionado">
                                                    <div class="div-iconos">
                                                        <a title="Editar color" href="articulos_editar.php?id=<?php echo $fila["id_articulo"]; ?>">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                                                <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                                            </svg>
                                                        </a>
                                                        <a title="Retirar color" href="articulos.php?id=<?php echo $fila["id_articulo"]; ?>">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-x-lg icono-der" viewBox="0 0 16 16">
                                                                <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z" />
                                                            </svg>
                                                        </a>
                                                    </div>
                                                    <div class="div-img">
                                                        <img src="./imagenes/<?php echo $fila["imagen"]; ?>" class="img-fluid">
                                                    </div>
                                                    <h5 class="card-title"><?php echo $fila["nombre"]; ?></h5>
                                                    <a href="articulos_detalle.php?id=<?php echo $fila['id_articulo']; ?>">Ver mas ...</a>
                                                </div>
                                            </div>
                                        <?php
                                        } else {
                                        ?>
                                            <div class="col-sm-6 col-md-6 col-lg-3 text-center">
                                                <div class="articulo-no-seleccionado">
                                                    <div class="div-iconos">
                                                        <a title="Editar color" href="articulos_editar.php?id=<?php  echo $fila["id_articulo"]; ?>">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                                                <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                                            </svg>
                                                        </a>
                                                        <a title="Retirar color" href="articulos.php?id=<?php echo $fila["id_articulo"]; ?>">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x-lg icono-der" viewBox="0 0 16 16">
                                                                <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z" />
                                                            </svg>
                                                        </a>
                                                    </div>
                                                    <div class="div-img">
                                                        <img src="./imagenes/<?php echo $fila["imagen"]; ?>" class="img-fluid">
                                                    </div>
                                                    <h5 class="card-title"><?php echo $fila["nombre"]; ?></h5>
                                                    <a href="articulos_detalle.php?id=<?php echo $fila['id_articulo']; ?>">Ver mas ...</a>
                                                </div>
                                            </div>
                                <?php
                                        }
                                    }

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