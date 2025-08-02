<?php
session_start();
if (empty($_SESSION['userBabyShowerActive'])) {
    header('location: ../login.php');
}
if ($_SESSION['id_tipo'] != 1) {
    header('location: ../');
}
date_default_timezone_set('America/Bogota');
include_once("../conexion.php");

if (!empty($_POST)) {
    $alert = "";
    if (!empty($_REQUEST['id'])) {
        $id = $_REQUEST['id'];
        $fechaModifica = date('d/m/Y H:i:s');
        $sql  = "UPDATE usuarios SET id_estado=2 WHERE id_usuario = '$id'";
        $query_delete = mysqli_query($conexion, $sql);
        $alert = '<div class="alert alert-primary" role="alert">
                            Usuario eliminado
                        </div>';
    }
}
if (empty($_REQUEST['id'])) {
    header("Location: usuarios.php");
}
$idusuario = $_REQUEST['id'];
//$sql = "SELECT u.*, t.nombre AS tipo_user, e.estado AS tipo_estado FROM usuarios As u INNER JOIN tipos AS t ON t.id_tipo = u.id_tipo INNER JOIN estados AS e ON e.id_estado = u.id_estado WHERE u.id_usuario = '$idusuario'";
$sql = "SELECT u.*, e.estado, tu.tipo " .
    "FROM usuarios AS u " .
    "INNER JOIN estados AS e ON e.id_estado = u.id_estado " .
    "INNER JOIN tipo_usuarios AS tu ON tu.id_tipo = u.id_tipo " .
    "WHERE u.id_usuario = '$idusuario'";
$query = mysqli_query($conexion, $sql);
$result_sql = mysqli_num_rows($query);
if ($result_sql == 0) {
    header("Location: usuarios.php");
} else {
    if ($dato = mysqli_fetch_array($query)) {
        $nombres = $dato['nombres'];
        $apellidos =  $dato['apellidos'];
        $usuario = $dato['usuario'];
        $tipo = $dato['id_tipo'];
        $tipoUser = $dato['tipo'];
        $estado = $dato['id_estado'];
        $tipoEstado = $dato['estado'];
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
    <title>Eliminar usuarios - SA Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="../admin/css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/estilos.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <?php include('menus/menu_superior.php'); ?>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <?php include('menus/menu_lateral.php'); ?>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <div class="row justify-content-center">
                        <div class="col-lg-10">
                            <div class="card shadow-lg border-0 rounded-lg mt-4 mb-3">
                                <div class="card-header bg-dark text-white">
                                    <h3 class="text-center font-weight-light my-4">Eliminar usuario</h3>
                                </div>
                                <div class="card-body">
                                    <form action="" method="post" autocomplete="off">
                                        <!--INICIO-->
                                        <?php echo isset($alert) ? $alert : ''; ?>
                                        <div class="row">
                                            <div class="col-sm-12 col-md-6 col-lg-4 mb-3">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" name="inputFirstName" id="inputFirstName" type="text" placeholder="Ingrese su primer nombre" value="<?php echo $nombres; ?>" readonly />
                                                    <label for="inputFirstName">Nombres</label>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-6 col-lg-4 mb-3">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" name="inputFirstApellido" id="inputFirstApellido" type="text" placeholder="Ingrese su primer apellido" value="<?php echo $apellidos; ?>" readonly />
                                                    <label for="inputFirstApellido">Apellidos</label>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-6 col-lg-4 mb-3">
                                                <?php echo isset($alertUsuario) ? $alertUsuario : ''; ?>
                                                <div class="form-floating">
                                                    <input class="form-control" name="inputUsuario" id="inputUsuario" type="text" placeholder="Ingrese su usuario" value="<?php echo $usuario; ?>" readonly />
                                                    <label for="inputUsuario">Usuario</label>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-6 col-lg-4 mb-3">
                                                <div class="form-floating">
                                                    <div class="form-floating">
                                                        <input class="form-control" name="inputUsuario" id="inputUsuario" type="text" placeholder="Ingrese su usuario" value="<?php echo $tipoUser ?>" readonly />
                                                        <label for="selectTipoUsuario">Tipo de usuario</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-6 col-lg-3 mb-3">
                                                <div class="form-floating">
                                                    <div class="form-floating">
                                                        <input class="form-control" name="inputEstadoUsuario" id="inputEstadoUsuario" type="text" placeholder="Ingrese el estado de su usuario" value="<?php echo $tipoEstado ?>" readonly />
                                                        <label for="selectTipoUsuario">Estado del suario</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--FIN-->
                                        <div class="d-flex align-items-center justify-content-center mt-4 mb-0 btn-reservar">
                                            <button type="submit" class="btn btn-success text-white pb-2 pt-2 pr-2 mx-2">Confirmar</button>
                                            <a href="usuarios.php" class="btn btn-danger">Atras</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
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
    <script src="../admin/js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="../admin/js/datatables-simple-demo.js"></script>
</body>

</html>