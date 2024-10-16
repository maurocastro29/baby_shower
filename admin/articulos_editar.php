<?php
session_start();
if (empty($_SESSION['userBabyShowerActive'])) {
    header('location: ../home.php');
}
if ($_SESSION['id_tipo'] != 1) {
    header('location: ../');
}
$usuarioMaestro = $_SESSION['usuario_maestro'];
$editar = false;
$alert = '';
// Si el formulario ha sido enviado
if (!empty($_POST)) {
    $editar=true;
    $alert = '';
    if (empty($_POST['articulo']) || empty($_POST['descripcion'])) {
        $alert = '<div class="alert alert-danger" role="alert">
        Verifique los campos que son obligatorios
        </div>';
    } else {
        include('../conexion.php');
        $idArticulo = $_REQUEST['edit'];
        $articulo = $_POST['articulo'];
        $detalle = $_POST['descripcion'];
        $stock = $_POST['stock'];
        // Obtener el nombre de la imagen anterior desde la base de datos
        $sql = "SELECT imagen FROM articulos WHERE id_articulo = '$idArticulo' AND id_maestro_usuario = '$usuarioMaestro'";
        $resultado = mysqli_query($conexion, $sql);
        $fila = mysqli_fetch_assoc($resultado);
        $imagenAnterior = $fila['imagen'];

        if(empty( $_FILES['imagenNueva'])){
            $nombre_archivo = $_FILES['imagenNueva']['name'];
            $tipo_archivo = $_FILES['imagenNueva']['type'];
            $tamano_archivo = $_FILES['imagenNueva']['size'];
            $tmp_archivo = $_FILES['imagenNueva']['tmp_name'];

            $ruta_archivo = $nombre_archivo;
            // Verificar si el archivo es una imagen válida
            $permitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png");
            $tipo_imagen = mime_content_type($tmp_archivo);
            if (in_array($tipo_imagen, $permitidos) && $tamano_archivo < 1000000) {

                
                
                $sql = "UPDATE articulos SET nombre = '$articulo', detalle = '$detalle', total = '$stock', imagen = '$ruta_archivo' WHERE id_articulo = '$idArticulo' AND id_maestro_usuario = '$usuarioMaestro'";
                $result = mysqli_query($conexion, $sql);

                if ($result) {
                    // Mover el archivo cargado a la ruta especificada
                    $ruta_archivo = "./imagenes/" . $nombre_archivo;
                    move_uploaded_file($tmp_archivo, $ruta_archivo);
                    // Eliminar la imagen anterior del directorio si existe
                    if (!empty($imagenAnterior) && file_exists("./imagenes/" . $imagenAnterior)) {
                        unlink("./imagenes/" . $imagenAnterior);
                    }
                    $alert = '<div class="alert alert-primary" role="alert">
                            Articulo editado exitosamente
                        </div>';
                } else {
                    $alert = '<div class="alert alert-danger" role="alert">
                        Error al editar articulo
                    </div>';
                }
            }else{
                $alert = '<div class="alert alert-danger" role="alert">
                            El archivo seleccionado no es una imagen válida o es demasiado grande.
                        </div>';
            }
        }else{
            $sql = "UPDATE articulos SET nombre = '$articulo', detalle = '$detalle', total = '$stock' WHERE id_articulo = '$idArticulo' AND id_maestro_usuario = '$usuarioMaestro'";
            $result = mysqli_query($conexion, $sql);
            if ($result) {
                $alert = '<div class="alert alert-primary" role="alert">
                        Articulo editado exitosamente
                        </div>';
            } else {
                $alert = '<div class="alert alert-danger" role="alert">
                        Error al editar articulo
                    </div>';
            }
        }
        
    }
}
if (empty($_REQUEST['id']) && $editar == false) {
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
    <title>Editar articulos - BS Admin</title>
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
                            Editar articulo
                        </div>
                        <div class="card-body">
                            <?php
                            // Conexión a la base de datos
                            echo $alert;
                            include('../conexion.php');

                            // Consulta para obtener los datos de la tabla
                            if(!empty($_REQUEST['id'])){
                                $idArticulo = $_REQUEST['id'];
                            }
                            if(!empty($_REQUEST['edit'])){
                                $idArticulo = $_REQUEST['edit'];
                            }
                            $sql = "SELECT a.*, u.* FROM articulos AS a INNER JOIN usuarios AS u ON u.id_usuario = a.id_usuario WHERE a.id_articulo = '$idArticulo'  AND a.id_maestro_usuario = '$usuarioMaestro'";
                            $resultado = mysqli_query($conexion, $sql);

                            if (mysqli_num_rows($resultado) > 0) {
                                // Muestra los datos de la tabla
                            ?>
                                <div class="row ">
                                    <?php
                                    $fila = mysqli_fetch_assoc($resultado)
                                    ?>
                                    <div class="col-sm-4 text-center">
                                        <img src="imagenes/<?php echo $fila["imagen"]; ?>" class="img-fluid img-editar rounded border">
                                    </div>
                                    <div class="col-sm-8">
                                        <form action="articulos_editar.php?edit=<?php  echo $fila["id_articulo"]; ?>" method="post"  enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-sm-12 col-md-6">
                                                    <label for="articulo"><b>Nombre del artículo</b></label>
                                                    <div class="">
                                                        <input type="text" value="<?php echo htmlspecialchars(trim($fila["nombre"]));?>" class="form-control" name="articulo" id="articulo" placeholder="Ingrese el nombre del articulo" required/>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6">
                                                    <label for="stock"><b>Cantidad del artículo</b></label>
                                                    <div class="">
                                                        <input type="number" value="<?php echo htmlspecialchars(trim($fila["total"]));?>" class="form-control" name="stock" id="stock" placeholder="Cantidad del artículo" required/>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-6">
                                                    <div class=" mb-3 mb-md-0">
                                                        <label for="imagenNueva"><b>Nueva imagen</b></label>
                                                        <input class="form-control" name="imagenNueva" id="imagenNueva" type="file" placeholder="Foto del articulo"/>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <label for="articulo"><b>Descripción</b></label>
                                                    <div class="">
                                                        <textarea rows="4" col="10" class="form-control" name="descripcion" id="descripcion" type="text" placeholder="Ingrese la descripción del articulo" required><?php echo $fila["detalle"]; ?></textarea>
                                                    </div>
                                                </div>
                                                <button class="btn btn-success mt-3">Enviar</button>
                                            </div>
                                        </form>
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