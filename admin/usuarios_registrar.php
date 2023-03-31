<?php
session_start();
if (empty($_SESSION['userActive'])) {
    header('location: login.php');
}
if ($_SESSION['id_tipo'] != 1) {
    header('location: ../');
}
date_default_timezone_set('America/Bogota');
include_once("../conexion.php");
if (!empty($_POST)) {
    $alert = "";
    if (
        empty($_POST['inputFirstName'])
        || empty($_POST['inputFirstApellido'])
        || empty($_POST['inputUsuario'])
        || empty($_POST['selectTipoUsuario'])
        || empty($_POST['inputPassword'])
        || empty($_POST['inputPasswordConfirm'])
    ) {
        $alert = '<div class="alert alert-danger" role="alert">
            Verifique los campos que son obligatorios
            </div>';
    } else {
        /**CAPTURA DE DATOS DEL USUARIO */
        $nombres = $_POST['inputFirstName'];
        $apellidos = $_POST['inputFirstApellido'];
        $usuario = $_POST['inputUsuario'];
        $tipoUsuario = $_POST['selectTipoUsuario'];
        $passw = md5($_POST['inputPassword']);
        $confirmarPassword = md5($_POST['inputPasswordConfirm']);
        $resultEstado = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT id_estado FROM estados where estado = 'ACTIVO'"));
        $estado =    $resultEstado['id_estado'];

        /**ZONA DE VALIDACIONES */
        $queryUsuario = mysqli_query($conexion, "SELECT * FROM usuarios where usuario = '$usuario'");
        $resultUsuario = mysqli_fetch_array($queryUsuario);

        if ($resultUsuario > 0) {
            $alertUsuario = '<div class="alert alert-warning" role="alert">
                            Este usuario ya existe
                        </div>';
        }
        if ($passw != $confirmarPassword) {
            $alertpassword = '<div class="alert alert-warning" role="alert">
                                    Las contraseñas no coinciden
                                </div>';
        }
        /**FIN ZONA DE VALIDACIONES */

        //INSERSION DE NUEVO USUARIO
        if ($resultUsuario < 1 && $passw == $confirmarPassword) {
            $sql = "INSERT INTO usuarios (nombres, apellidos, usuario, password, id_tipo, id_estado) 
                    VALUES('$nombres', '$apellidos', '$usuario', '$passw',  '$tipoUsuario', '$estado')";
            $result = mysqli_query($conexion, $sql);
            if (!$result) {
                $alert = '<div class="alert alert-danger" role="alert">
                        Error al registrar usuario
                    </div>';
            } else {
                $alert = '<div class="alert alert-primary" role="alert">
                            Usuario registrado
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
    <title>Registrar usuarios - SA Admin</title>
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
                                    <h3 class="text-center font-weight-light my-4">Crear nuevo usuario</h3>
                                </div>
                                <div class="card-body">
                                    <p>los campos marcados con <b style="color:red;">*</b> son obligatorios</p>
                                    <form action="" method="post" autocomplete="off"> <!--id="crear-usuarios-form"-->
                                        <!--INICIO-->
                                        <?php echo isset($alert) ? $alert : ''; ?>
                                        <div class="row">
                                            <div class="col-sm-6 col-md-6 col-lg-4 mb-3">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" name="inputFirstName" id="inputFirstName" type="text" placeholder="Ingrese su primer nombre" required />
                                                    <label for="inputFirstName">Nombres<spam style="color:red; text-decoration:none;">*</spam></label>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-6 col-lg-4 mb-3">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" name="inputFirstApellido" id="inputFirstApellido" type="text" placeholder="Ingrese su primer apellido" required />
                                                    <label for="inputFirstApellido">Apellidos<spam style="color:red; text-decoration:none;">*</spam></label>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-6 col-lg-4 mb-3">
                                                <?php echo isset($alertUsuario) ? $alertUsuario : ''; ?>
                                                <div class="form-floating">
                                                    <input class="form-control" name="inputUsuario" id="inputUsuario" type="text" placeholder="Ingrese su usuario" required />
                                                    <label for="inputUsuario">Usuario<spam style="color:red; text-decoration:none;">*</spam></label>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-6 col-lg-4 mb-3">
                                                <div class="form-floating">
                                                    <select class="form-select" for="selectTipoUsuario" name="selectTipoUsuario" id="selectTipoUsuario" placeholder="Tipo de usuario" required>
                                                        <option value=""></option>
                                                        <?php
                                                        include_once('../conexion2.php');
                                                        $sql = "SELECT id_tipo, tipo FROM tipo_usuarios";
                                                        $query = mysqli_query($conexion, $sql);
                                                        $result = mysqli_num_rows($query);
                                                        if ($result) {
                                                            while ($fila = mysqli_fetch_assoc($query)) {
                                                                echo '<option value=' . $fila['id_tipo'] . '>' . $fila['tipo'] . '</option>';
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                    <label for="selectTipoUsuario">Tipo de usuario <spam style="color:red; text-decoration:none;">*</spam></label>
                                                </div>
                                            </div>
                                            <?php echo isset($alertpassword) ? $alertpassword : ''; ?>
                                            <div class="col-sm-6 col-md-6 col-lg-4 mb-3">
                                                <div class="form-floating">
                                                    <input class="form-control" name="inputPassword" id="inputPassword" type="password" placeholder="Crea una contraseña" required />
                                                    <label for="inputPassword">Contraseña <spam style="color:red; text-decoration:none;">*</spam></label>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-6 col-lg-4 mb-3">
                                                <div class="form-floating">
                                                    <input class="form-control" name="inputPasswordConfirm" id="inputPasswordConfirm" type="password" placeholder="Confirma la contraseña" required />
                                                    <label for="inputPasswordConfirm">Confirmar contraseña <spam style="color:red; text-decoration:none;">*</spam></label>
                                                </div>
                                            </div>
                                        </div>
                                        <!--FIN-->
                                        <div class="d-flex align-items-center justify-content-center mt-4 mb-0 btn-reservar">
                                            <button type="submit" class="btn btn-success text-white pb-2 pt-2 pr-2 mx-2">Crear usuario</button>
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="../admin/js/datatables-simple-demo.js"></script>
    <script src="../admin/js/scripts.js"></script>
    <script src="../admin/js/usuarios.js"></script>
</body>

</html>