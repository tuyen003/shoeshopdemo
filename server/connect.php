<?php
    $server = 'sql309.epizy.com';
    $user  = 'epiz_31937328';
    $password = 'mLeaXYzyiiW6e';
    $db ='epiz_31937328_shoes';

    $conn = mysqli_connect($server,$user,$password,$db) or die("Kết nối thất bại");
    // $conn = mysqli_connect('localhost','root','','shoes') or die("Kết nối thất bại");
    // $conn = mysqli_connect('remotemysql.com','v1QylMCmMH','oLf6hZPY3M','v1QylMCmMH') or die("Kết nối thất bại");

?>
