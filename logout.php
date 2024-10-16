<?php

    session_start();
    if (empty($_SESSION['userBabyShowerActive'])) {
        session_destroy();
        restaurarValoresSesion();
        header('location: home.php');
    }else{
        session_destroy();
        restaurarValoresSesion();
        header('location: home.php');
    }

    function restaurarValoresSesion(){
        $_SESSION['userBabyShowerActive'] = false;
        $_SESSION['idUser'] = '';
        $_SESSION['nombre'] = '';
        $_SESSION['apellido'] = '';
        $_SESSION['usuario'] = '';
        $_SESSION['id_tipo'] = '';
        $_SESSION['tipo'] = '';
        $_SESSION['usuario_maestro'] = '';
    }

?>