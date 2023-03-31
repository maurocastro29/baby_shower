<?php

    session_start();
    if (empty($_SESSION['userActive'])) {
        session_destroy();
        header('location: ../login.php');
    }else{
        session_destroy();
        header('location: ../login.php');
    }

?>