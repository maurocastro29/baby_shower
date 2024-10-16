<?php
session_start();
if (empty($_SESSION['userBabyShowerActive'])) {
    header('location: ../home.php');
}
if ($_SESSION['id_tipo'] != 1) {
    header('location: ../');
}

include('../conexion.php');
$usuarioMaestro = $_SESSION['usuario_maestro'];
// Si el formulario ha sido enviado
if (isset($_POST['submit'])) {
    $articulo = $_POST['articulo'];
    $detalle = $_POST['detalle'];
    $stock = $_POST['stock'];
    $cantidad = 0;

    // Obtener los detalles del archivo cargado
    $nombre_archivo = $_FILES['imagen']['name'];
    $tipo_archivo = $_FILES['imagen']['type'];
    $tamano_archivo = $_FILES['imagen']['size'];
    $tmp_archivo = $_FILES['imagen']['tmp_name'];

    // Ruta donde se guardará el archivo
    $ruta_archivo = $nombre_archivo;

    // Verificar si el archivo es una imagen válida
    $permitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png");
    $tipo_imagen = mime_content_type($tmp_archivo);
    if (in_array($tipo_imagen, $permitidos) && $tamano_archivo < 1000000) {
        // Si el archivo es válido, guardar la información en la base de datos
        $sql = "INSERT INTO articulos (nombre, detalle, cantidad, total, imagen, estado, id_usuario, id_maestro_usuario) VALUES ('$articulo', '$detalle', '$cantidad', '$stock', '$ruta_archivo', 1, 3, '$usuarioMaestro')";
        $result = mysqli_query($conexion, $sql);

        if ($result) {
            // Mover el archivo cargado a la ruta especificada
            $ruta_archivo = "./imagenes/" . $nombre_archivo;
            move_uploaded_file($tmp_archivo, $ruta_archivo);
            $alert = '<div class="alert alert-primary" role="alert">
                    Articulo creado exitosamente
                </div>';
        } else {
            $alert = '<div class="alert alert-danger" role="alert">
                Error al crear articulo
            </div>';
        }
    } else {
        $alert = '<div class="alert alert-danger" role="alert">
                    El archivo seleccionado no es una imagen válida o es demasiado grande.
                </div>';
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
    <title>Crear articulos - BS Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="../admin/css/styles.css" rel="stylesheet" />
    <link rel="icon" type="image/jpg" href="../admin/img/logo.ico">
    <link rel="stylesheet" href="css/estilos.css">
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
                            Crear articulo
                        </div>
                        <div class="card-body">
                            <?php echo isset($alert) ? $alert : ''; ?>
                            <form action="articulos_crear.php" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-sm-6 col-md-6 col-lg-5 mb-3">
                                        <div class="form-floating mb-3 mb-md-0">
                                            <input class="form-control" name="articulo" id="articulo" type="text" placeholder="Ingrese el nombre del articulo" required />
                                            <label for="articulo">Nombre del artículo</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-3 mb-3">
                                        <div class="form-floating mb-3 mb-md-0">
                                            <input class="form-control" name="stock" id="stock" type="number" placeholder="Ingrese la cantidad de darticulos" required />
                                            <label for="stock">Cantidad de articulos</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-4 mb-3">
                                        <div class=" mb-3 mb-md-0">
                                            <label for="imagen">Foto del Artículo</label>
                                            <input class="form-control" name="imagen" id="imagen" type="file" placeholder="Foto del articulo" required />
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-12 mb-3">
                                        <div class="form-floating mb-3 mb-md-0">
                                            <textarea class="form-control" name="detalle" id="detalle" type="text" placeholder="Ingrese el nombre del articulo" required></textarea>
                                            <label for="detalle">Detalle</label>
                                        </div>
                                    </div>
                                    <input class="btn btn-primary" type="submit" name="submit" value="Agregar Artículo">

                                </div>
                            </form>


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