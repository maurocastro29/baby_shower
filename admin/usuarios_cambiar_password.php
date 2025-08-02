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
    if (!empty($_SESSION['idUser'])) {
        $id = $_SESSION['idUser'];
        $user = $_SESSION['usuario'];
        $passwOld = md5($_POST['inputPasswordOld']);
        $passw = md5($_POST['inputPassword']);
        $confirmarPassword = md5($_POST['inputPasswordConfirm']);
        $sqlOld = "SELECT u.password FROM usuarios AS u WHERE u.id_usuario = '$id' AND u.usuario = '$user' and u.password = '$passwOld'";
        $resulOld = mysqli_query($conexion, $sqlOld);
        $resulOld2 = mysqli_num_rows($resulOld);
        if ($resulOld) {
            if ($passw == $confirmarPassword) {
                if ($passwOld != $passw) {
                    $sql  = "UPDATE usuarios AS u SET u.password='$passw' WHERE u.id_usuario = '$id' AND u.usuario = '$user'";
                    $query_update = mysqli_query($conexion, $sql);
                    if ($query_update) {
                        $alert = '<div class="alert alert-success" role="alert">
                                        Contraseña modificada con exito. Se recomienda cerrar sesion y volver a ingresar con la nueva contraseña
                                    </div>';
                    } else {
                        $alert = '<div class="alert alert-warning" role="alert">
                                        Ereror: No se pudo modificar la contraseña
                                    </div>';
                    }
                } else {
                    $alert = '<div class="alert alert-warning" role="alert">
                            Error: La nueva contraseña debe ser diferente a la antigua.
                        </div>';
                }
            } else {
                $alertPassword = '<div class="alert alert-warning" role="alert">
                                        Las contraseñas no coinciden
                                    </div>';
            }
        } else {
            $alertPasswordOld = '<div class="alert alert-warning" role="alert">
                            Error: Esta no es la contraseña actual
                        </div>';
        }
    }
}
/*
    function validarPasswordOld($id, $user, $passwOld){
        include("../backend/bd/conexion2.php");
        $sql = "SELECT * FROM usuarios AS u WHERE u.id_usuario = '$id' AND u.usuario = '$user' and u.password = '$passwOld'";
        $resul = mysqli_query($conexion, $sql);
        return $resul;
    }

    function validarPassword($passw, $confirmarPassword){
        return $passw == $confirmarPassword;
    }*/

$idusuario = $_SESSION['idUser'];
$user = $_SESSION['usuario'];
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Cambiar contraseña - SA Admin</title>
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
                                    <h3 class="text-center font-weight-light my-4">Cambiar contraseña</h3>
                                </div>
                                <div class="card-body">
                                    <form action="" method="post" autocomplete="off">
                                        <!--INICIO-->
                                        <?php echo isset($alert) ? $alert : ''; ?>
                                        <div class="row center">
                                            <div class="col-sm-12 col-md-6 mb-3 center-block">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" name="inputFirstName" id="inputFirstName" type="text" placeholder="Ingrese su primer nombre" value="<?php echo $user; ?>" readonly />
                                                    <label for="inputFirstName">Usuario</label>
                                                </div>
                                            </div>
                                            <?php echo isset($alertPasswordOld) ? $alertPasswordOld : ''; ?>
                                            <div class="col-sm-6 col-md-6 col-lg-4 mb-3 center-block">
                                                <div class="form-floating">
                                                    <input class="form-control" name="inputPasswordOld" id="inputPasswordOld" type="password" placeholder="Digite la contraseña antigua" required />
                                                    <label for="inputPasswordOld">Contraseña actual<spam style="color:red; text-decoration:none;">*</spam></label>
                                                </div>
                                            </div>
                                            <?php echo isset($alertPassword) ? $alertPassword : ''; ?>
                                            <div class="col-sm-6 col-md-6 col-lg-4 mb-3 center-block">
                                                <div class="form-floating">
                                                    <input class="form-control" name="inputPassword" id="inputPassword" type="password" placeholder="Crea una contraseña" required />
                                                    <label for="inputPassword">Contraseña nueva<spam style="color:red; text-decoration:none;">*</spam></label>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-6 col-lg-4 mb-3 center-block">
                                                <div class="form-floating">
                                                    <input class="form-control" name="inputPasswordConfirm" id="inputPasswordConfirm" type="password" placeholder="Confirma la contraseña" required />
                                                    <label for="inputPasswordConfirm">Confirmar nueva contraseña <spam style="color:red; text-decoration:none;">*</spam></label>
                                                </div>
                                            </div>
                                        </div>
                                        <!--FIN-->
                                        <div class="d-flex align-items-center justify-content-center mt-4 mb-0 btn-reservar">
                                            <button type="submit" class="btn btn-success text-white pb-2 pt-2 pr-2 mx-2">Confirmar</button>
                                            <a href="usuarios_perfil.php" class="btn btn-danger">Atras</a>
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