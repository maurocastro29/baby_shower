<?php
session_start();
if (empty($_SESSION['userActive'])) {
    header('location: .phplogin.php');
}
if ($_SESSION['id_tipo'] != 1) {
    header('location: ../');
}
date_default_timezone_set('America/Bogota');
include_once("../conexion.php");

$idusuario = $_SESSION['idUser'];
$sql = "SELECT u.*, t.tipo, e.estado FROM usuarios As u INNER JOIN tipo_usuarios AS t ON t.id_tipo = u.id_tipo INNER JOIN estados AS e ON e.id_estado = u.id_estado WHERE u.id_usuario = '$idusuario'";
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
        $nombreCompleto = $nombres . " " . $apellidos;
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
    <title>Perfil usuarios - SA Admin</title>
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
                                    <h3 class="text-center font-weight-light my-4">Datos de usuario</h3>
                                </div>
                                <div class="card-body">
                                    <form action="" method="post" autocomplete="off">
                                        <?php echo isset($alert) ? $alert : ''; ?>
                                        <!--INICIO-->
                                        <div class="row">
                                            <div class="col-sm-12 col-md-6 col-lg-4 mb-3">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" name="inputNombreCompleto" id="inputNombreCompleto" type="text" placeholder="Ingrese su primer nombre" value="<?php echo $nombres; ?>" readonly />
                                                    <label for="inputNombreCompleto">Nombres</label>
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
                                            <div class="col-sm-12 col-md-6 col-lg-3 mb-3">
                                                <div class="form-floating">
                                                    <div class="form-floating">
                                                        <input class="form-control" name="inputUsuario" id="inputUsuario" type="text" placeholder="Ingrese su usuario" value="<?php echo $tipoUser ?>" readonly />
                                                        <label for="selectTipoUsuario">Tipo de usuario</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-6 col-lg-3 ">
                                                <div class="form-floating">
                                                    <div class="form-floating">
                                                        <input class="form-control" name="inputEstadoUsuario" id="inputEstadoUsuario" type="text" placeholder="Ingrese el estado de su usuario" value="<?php echo $tipoEstado ?>" readonly />
                                                        <label for="selectTipoUsuario">Estado del usuario</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--FIN-->
                                        <div class="d-flex align-items-center justify-content-center mt-4 mb-0 btn-reservar">
                                            <a href="usuarios_cambiar_password.php" class="btn btn-primary text-white pb-2 pt-2 pr-2 mx-2">Cambiar contraseña</a>
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
    <script src="../admin/js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="../admin/js/datatables-simple-demo.js"></script>
</body>

</html>