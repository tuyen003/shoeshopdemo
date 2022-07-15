<?php
    session_start();

    if(isset($_SESSION['admin_info'])){
        unset($_SESSION['admin_info']);
        unset($_SESSION['admin_logged_in']);
        header("location: ../login.php");
        exit;
    } else {
        header("location: ../login.php");
    }

?>