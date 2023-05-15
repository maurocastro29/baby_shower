<?php

    session_start();
    if (empty($_SESSION['userBabyShowerActive'])) {
        session_destroy();
        header('location: ../login.php');
    }else{
        session_destroy();
        header('location: ../login.php');
    }

?>