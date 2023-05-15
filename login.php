<?php
session_start();
date_default_timezone_set('America/Bogota');
if (!empty($_SESSION['userBabyShowerActive'])) {
    header('location: index.php');
} else {
    if (!empty($_POST)) {
        $alert = '';
        if (empty($_POST['inputUsuario']) || empty($_POST['inputPassword'])) {
            $alert = '<div class="alert alert-danger" role="alert">
            Ingrese su usuario y su clave
            </div>';
        } else {
            require_once "conexion.php";
            $user = mysqli_real_escape_string($conexion, $_POST['inputUsuario']);
            $clave = md5(mysqli_real_escape_string($conexion, $_POST['inputPassword']));
            $query = mysqli_query($conexion, "SELECT u.*, t.tipo AS tipo_user FROM usuarios As u INNER JOIN tipo_usuarios AS t ON t.id_tipo = u.id_tipo WHERE u.usuario = '$user' AND u.password = '$clave' AND u.id_estado = 1");

            $resultado = mysqli_num_rows($query);
            if ($resultado > 0) {
                date_default_timezone_set('America/Bogota');
                $dato = mysqli_fetch_array($query);
                $_SESSION['userBabyShowerActive'] = true;
                $_SESSION['idUser'] =  $dato['id_usuario'];
                $_SESSION['nombre'] = $dato['nombres'];
                $_SESSION['apellido'] = $dato['apellidos'];
                $_SESSION['usuario'] = $dato['usuario'];
                $_SESSION['id_tipo'] = $dato['id_tipo'];
                $_SESSION['tipo'] = $dato['tipo_user'];

                $fechaActual = date('d/m/Y H:i:s');
                $isuser = $_SESSION['idUser'];
                $sql_update = "UPDATE usuarios set ultimo_ingreso = '$fechaActual' WHERE id_usuario = '$isuser'";

                if ($_SESSION['id_tipo'] == 1) {
                    mysqli_query($conexion, $sql_update);
                    header('location: ./admin/index.php');
                } else if ($_SESSION['id_tipo'] == 2) {
                    mysqli_query($conexion, $sql_update);
                    header('location: index.php');
                }
            } else {
                $alert = '<div class="alert alert-danger" role="alert">
                Usuario y/o Contraseña Incorrecta
                </div>';
                session_destroy();
            }
            mysqli_close($conexion);
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
    <title>Login - SB Admin</title>
    <link href="../admin/css/styles.css" rel="stylesheet" />
    <link href="../admin/css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
</head>

<body class="fondo-base">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header centrar-contenido">
                                    <h1 class="text-center">Iniciar sesión</h1>
                                </div>
                                <div class="card-body">
                                    <p class="small color-text-aux">Las credenciales se les fueron enviadas junto con el enlace de esta página. si no los tiene vuelva a solicitarlos</p>
                                    <form method="POST">
                                        <?php echo isset($alert) ? $alert : ''; ?>
                                        <div class=" mb-4">
                                            <input class="form-control" id="inputUsuario" name="inputUsuario" type="text" placeholder="Ingrese su usuario" />
                                        </div>
                                        <div class=" mb-4">
                                            <input class="form-control" id="inputPassword" name="inputPassword" type="password" placeholder="Ingrese su contraseña" />
                                        </div>
                                        <div class="d-flex align-items-center justify-content-center mt-4 mb-0">
                                            <input class="btn btn-primary pe-5 ps-5" type="submit" value="ingresar">
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center py-3">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="../admin/js/scripts.js"></script>
    <script src="../admin/js/usuarios.js"></script>
</body>

</html>