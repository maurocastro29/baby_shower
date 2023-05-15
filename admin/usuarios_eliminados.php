<?php
session_start();
if (empty($_SESSION['userBabyShowerActive'])) {
    header('location: ../login.php');
}
if ($_SESSION['id_tipo'] != 1) {
    header('location: ../');
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
    <title>Usuarios eliminados - SA Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="../admin/css/styles.css" rel="stylesheet" />
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
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4 text-center">Usuarios eliminados</h1>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Datos de los usuarios eliminados
                        </div>
                        <div class="card-body">
                            <div class="btn-add">
                                <div class="btn-add-usuario">
                                    <a href="usuarios.php" class="btn btn-danger text-white">Atras</a>
                                </div>
                            </div>
                            <table class="table table-striped table-bordered" id="datatablesSimple">
                                <thead class="bg-dark text-white">
                                    <tr>
                                        <th>Nombres</th>
                                        <th>Apellidos</th>
                                        <th>Usuario</th>
                                        <th>Tipo</th>
                                        <th>Estado</th>
                                        <th>Ultimo ingreso</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tfoot class="bg-dark text-white">
                                    <tr>
                                        <th>Nombres</th>
                                        <th>Apellidos</th>
                                        <th>Usuario</th>
                                        <th>Tipo</th>
                                        <th>Estado</th>
                                        <th>Ultimo ingreso</th>
                                        <th>Acciones</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                    include('../conexion.php');
                                    $estadoConsulta = 2;
                                    $sql = "SELECT u.*, e.estado, tu.tipo " .
                                        "FROM usuarios AS u " .
                                        "INNER JOIN estados AS e ON e.id_estado = u.id_estado " .
                                        "INNER JOIN tipo_usuarios AS tu ON tu.id_tipo = u.id_tipo " .
                                        "WHERE u.id_estado = '$estadoConsulta'";
                                    $query = mysqli_query($conexion, $sql);
                                    $result = mysqli_num_rows($query);
                                    if ($result) {
                                        while ($fila = mysqli_fetch_assoc($query)) {
                                    ?>
                                            <tr>
                                                <td><?php echo $fila['nombres'] ?></td>
                                                <td><?php echo $fila['apellidos'] ?></td>
                                                <td><?php echo $fila['usuario'] ?></td>
                                                <td><?php echo $fila['tipo'] ?></td>
                                                <td><?php echo $fila['estado'] ?></td>
                                                <td><?php echo $fila['ultimo_ingreso'] ?></td>
                                                <td>
                                                    <a href="usuarios_restaurar.php?id=<?php echo $fila['id_usuario']; ?>" class="btn btn-success"><i class='fas fa-edit'></i></a>

                                                    </form>
                                                </td>
                                            </tr>
                                    <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
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