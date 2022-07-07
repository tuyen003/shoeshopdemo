<?php
require('../server/connect.php');
// session_start();

$message = array();
session_start();

$product_id = $_POST["product_id"];
$user_id = $_POST["user_id"];
$user_name = $_POST["user_name"];
$user_email = isset($_SESSION['user_info']) ? $_SESSION['user_info']["user_email"] :"";
$content = $_POST["content"];
$rate = $_POST["rate"];
$date = date("Y-m-d");




if(!isset($_SESSION['user_info'])){
    $message['mess'] = "not_user";
} else {
    if(empty($content)) {
        $message['mess'] = "error";
    } else {
        $sql = "INSERT INTO `rating_products`(`product_id`, `user_id`,`user_name`,`user_email`,`rate_content`, `rate_status`, `rate_date`)
        VALUES ('{$product_id}','{$user_id}','{$user_name}','{$user_email}','{$content}','{$rate}','{$date}')";
        $result = mysqli_query($conn,$sql);
    
        if($result) {
            $message['mess'] = "success";
        } else {
            $message['mess'] = "error";
        }
    }



   
}


$data = json_encode($message);

echo $data;