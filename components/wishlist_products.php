<?php
session_start();
require('../server/connect.php');
$product_id = $_POST['product_id'];
$products =  array();

if(!isset($_SESSION['logged_in'])) {
    $products['error'] = 'user';
} else {
    $user_id = $_SESSION['user_info']['user_id'];
    $product_temp = array();
    
    $sql = "SELECT * FROM `wishlist` WHERE `product_id` = {$product_id} AND `user_id` = {$user_id}";
    $result = mysqli_query($conn,$sql);
    if(mysqli_num_rows($result) == 0) {
        $sql = "SELECT product_id,product_name,product_image,product_price,product_special_offer FROM products WHERE product_id = {$product_id}";
        $result = mysqli_query($conn,$sql);
        while($row = mysqli_fetch_assoc($result)){
            $product_temp[] = $row;

        }
        $sql1 = "INSERT INTO `wishlist`(`user_id`, `product_id`, `product_name`, `product_image`, `product_price`, `product_special_offer`)
        VALUES ('{$user_id}','{$product_temp['0']['product_id']}','{$product_temp['0']['product_name']}','{$product_temp['0']['product_image']}','{$product_temp['0']['product_price']}','{$product_temp['0']['product_special_offer']}')";

        $result = mysqli_query($conn,$sql1);
        if($result){
            $products['error'] = 'success';
        } else {
            $products['error'] = 'fail';
        }
    } else {
        $products['error'] = 'exists';
      
    }
    



}


$data = json_encode($products);
echo $data;