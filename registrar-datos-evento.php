
<?php 
session_start();

// Verificar que primerNombre no esté vacío
if(!$_SESSION["datos-bebe"]){
    if (isset($_POST['sexoBebe'])) {
        // Asignar valores a la sesión
        $_SESSION["nombre-bebe"] = trim($_POST["nombreBebe"]);
        $_SESSION["sexo-bebe"] = trim($_POST["sexoBebe"]);
        header("Location: registrar-datos-acceso.php");
        exit(); // Asegura que el script se detenga después de la redirección
    }else{
        $message = "El campo de sexo del bebé es obligatorio. elija una de las opciones";
    }
}else{
    $_SESSION["datos-bebe"] = false;
}


?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registrar los datos del baby shower</title>
  <!-- Agrega las bibliotecas de Bootstrap -->
  <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="style_articulos.css">
  <link rel="stylesheet" href="style.css">
</head>

<body class="bg-light">

<!-- Page Content -->
<section class="py-5">
  <div class="container">
    <h2 class="fw-light text-center pb-3">Registro de usuario</h2>
    <div class="container mt-2">
        <div class="row justify-content-center my-5">
            <div class="col-md-4 rounded border bg-white shadow py-5">
            <h5 class="text-center mt-1 mb-5 text-primary"><b>Registra los datos del Baby Shower</b></h5>
            <?php 
                if(!empty($message)){
                    echo '<div class="bg-warning border rounded mb-2"><p class="mx-2 my-1">'.$message.'</p></div>';
                }
            ?>
            <form method="post" id="formRegistroEvento">
                <p class="text-secondary text-samll">Ingrese los siguientes datos</p>
                <!-- Agrega un contenedor para los mensajes de error -->
                <div id="errores" class="alert alert-danger" style="display: none;"></div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <input type="text" class="form-control" id="nombreBebe" name="nombreBebe" placeholder="Nombre del bebé">
                    </div>
                    <div class="form-group col-md-12">
                        <select class="form-control" id="sexoBebe" name="sexoBebe" required>
                            <option value="">Sexo del bebé</option>
                            <option value="1">Niño</option>
                            <option value="2">Niña</option>
                            <option value="3">Secreto no digas todavia</option>
                        </select>
                        <span class="text-danger small font-italic">(obligatorio)</span>
                    </div>
                </div>
                <div class="d-flex justify-content-center pt-4">
                    <a class="nav-link mx-2 text-danger" href="home.php">Cancelar</a>
                    <a class="nav-link mx-2 text-danger" href="registrar-datos-acceso.php">omitir</a>
                    <input class="btn btn-primary pe-5 ps-5" type="submit" value="Siguiente">
                </div>
            </form>
            </div>
        </div>
        </div>
  </div>
</section>
<script src="js/registrarDatosEvento.js"></script>
</body>
</html>
