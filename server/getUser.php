<?php
function getUser($id) {
    include("connect.php");
    $user = array();
    $sql = "SELECT * FROM users WHERE user_email = '{$id}'";
    $result = mysqli_query($conn,$sql);

    while($row = mysqli_fetch_assoc($result)){
        $user[] = $row;
    }

    return $user;
}


function checkUserExists($where) {
    include("connect.php");
    
    $sql = "SELECT * FROM users WHERE user_email = '{$where}'";
    $result = mysqli_query($conn,$sql);

    $numb =  mysqli_num_rows($result);
    

    return $numb;
}

function setUser($fname,$lname,$user_email,$user_password) {
    include("connect.php");
    $user = array();
    $sql = "INSERT INTO `users`(`first_name`, `last_name`, `user_email`, `user_password`)
    VALUES ('{$fname}','{$lname}','{$user_email}','{$user_password}')";
    $result = mysqli_query($conn,$sql);

    if(result) return true;

    return false;
}
