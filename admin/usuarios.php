<?php
session_start();
if (empty($_SESSION['userBabyShowerActive'])) {
    header('location: ../home.php');
}
if ($_SESSION['id_tipo'] != 1) {
    header('location: ../');
}
$usuarioMaestro = $_SESSION['usuario_maestro'];
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Usuarios - BS Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="../admin/css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" href="../admin/js/jquery-ui/jquery-ui.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    <style>
        .fas.fa-trash-alt {
            display: inline-block;
        }
    </style>
</head>

<body class="sb-nav-fixed">
    <?php include('menus/menu_superior.php'); ?>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <?php include('menus/menu_lateral.php'); ?>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="btn-add">
                    <div class="btn-add-usuario">
                        <a href="usuarios_registrar.php" class="btn btn-primary text-white"><i class="fas fa-plus"></i></a>
                        <a href="usuarios_eliminados.php" class="btn btn-primary text-white">Usuarios eliminados</a>
                    </div>
                </div>
                <div class="container-fluid px-4">
                    <h1 class="mt-4 text-center">Usuarios</h1>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Datos de los usuarios
                        </div>
                        <div class="card-body">
                            <?php if ($_SESSION['id_tipo'] == 101) {

                            ?>
                                <div class="btn-add">
                                    <div class="btn-add-usuario">
                                        <a href="../admin/usuarios_registrar.php" class="btn btn-primary text-white"><i class="fas fa-plus"></i></a>
                                        <a href="../admin/usuarios_eliminados.php" class="btn btn-primary text-white">Usuarios eliminados</a>
                                    </div>
                                </div>
                            <?php } ?>
                            <table class="table table-striped table-bordered" id="datatablesSimple">
                                
                                <thead>
                                    <tr>
                                        <th class="bg-dark text-white">Nombres</th>
                                        <th class="bg-dark text-white">Apellidos</th>
                                        <th class="bg-dark text-white">Usuario</th>
                                        <th class="bg-dark text-white">Tipo</th>
                                        <th class="bg-dark text-white">Estado</th>
                                        <th class="bg-dark text-white">Ultimo ingreso</th>
                                        <th class="bg-dark text-white">Acciones</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    <?php
                                    include('../conexion.php');
                                    $estadoConsulta = 1;
                                    $sql = "SELECT u.*, e.estado, tu.tipo " .
                                        "FROM usuarios AS u " .
                                        "INNER JOIN estados AS e ON e.id_estado = u.id_estado " .
                                        "INNER JOIN tipo_usuarios AS tu ON tu.id_tipo = u.id_tipo " .
                                        "WHERE u.id_estado = '$estadoConsulta' AND id_maestro_usuario = '$usuarioMaestro'";
                                    $query = mysqli_query($conexion, $sql);
                                    $result = mysqli_num_rows($query);
                                    if ($result) {
                                        while ($fila = mysqli_fetch_assoc($query)) {
                                            if($fila['id_usuario'] != 3){
                                    ?>
                                            <tr>
                                                <td><?php echo $fila['nombres'] ?></td>
                                                <td><?php echo $fila['apellidos'] ?></td>
                                                <td><?php echo $fila['usuario'] ?></td>
                                                <td><?php echo $fila['tipo'] ?></td>
                                                <td><?php echo $fila['estado'] ?></td>
                                                <td><?php echo $fila['ultimo_ingreso'] ?></td>
                                                <td>
                                                    <a href="usuarios_editar.php?id=<?php echo $fila['id_usuario']; ?>" class="btn btn-success">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pencil-alt icono-izq" viewBox="0 0 16 16">
                                                                <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                                            </svg>
                                                    </a>
                                                    <form action="usuarios_eliminar.php?id=<?php echo $fila['id_usuario']; ?>" method="post" class="confirmar d-inline">
                                                        <button class="btn btn-danger" type="submit">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x-lg icono-der" viewBox="0 0 16 16">
                                                                <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z" />
                                                            </svg>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                    <?php
                                            }else if($fila['id_usuario'] == 3 && $fila["id_usuario"] == $_SESSION['idUser']){
                                                echo '<tr>'.
                                                        '<td>'.$fila['nombres'].'</td>'.
                                                        '<td>'.$fila['apellidos'].'</td>'.
                                                        '<td>'.$fila['usuario'].'</td>'.
                                                        '<td>'.$fila['tipo'].'</td>'.
                                                        '<td>'.$fila['estado'].'</td>'.
                                                        '<td>'.$fila['ultimo_ingreso'].'</td>'.
                                                        '<td>'.
                                                            '<a href="usuarios_editar.php?id='.$fila['id_usuario'].'" class="btn btn-success"><i class="fas fa-edit"></i></a>'.
                                                            '<form action="usuarios_eliminar.php?id='.$fila['id_usuario'].'" method="post" class="confirmar d-inline">'.
                                                                '<button class="btn btn-danger" type="submit"><i class="fas fa-trash-alt"></i> </button>'.
                                                                
                                                            '</form>'.
                                                        '</td>'.
                                                    '</tr>';
                                            }
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