<?php
session_start();
require('../server/connect.php');
$product_id = $_POST['product_id'];
$products =  array();

if(!isset($_SESSION['logged_in'])) {
    $products['error_user'] = true;
} else {
    $user_id = $_SESSION['user_info']['user_id'];
    $sql = "DELETE FROM `wishlist` WHERE `user_id`= {$user_id}  AND `product_id` = {$product_id}";
    $result = mysqli_query($conn,$sql);
    if($result){
        $products['error'] = true;
    } else {
        $products['error'] = false;
    }

}


$data = json_encode($products);
echo $data;