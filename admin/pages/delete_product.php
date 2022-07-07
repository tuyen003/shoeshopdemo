<?php
require("../server/connect.php");

// $mess = 0;

// $id = $_POST['id'];
// // DELETE FROM `products` WHERE `product_id` = 
// $stmt = $conn->prepare("DELETE FROM `products` WHERE `product_id` = ?");
// $stmt->bind_param('i',$id);

// if($stmt->execute()){
//     $mess = 1;
// } else {
//     $mess = 0;
// }

// echo $mess;
echo $_GET['product_id'];