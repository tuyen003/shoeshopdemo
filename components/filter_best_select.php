<?php
require('../server/connect.php');
$type = $_POST['selectType'];
$products =  array();


if($type === 'seller') {
    $sql = "SELECT * FROM products WHERE product_special_offer > 0 LIMIT 4";
} else if($type == 'arrival') {
    $sql = "SELECT * FROM products ORDER BY product_price DESC LIMIT 4";
} else if($type == "trending") {
    $sql = "SELECT * FROM products WHERE product_special_offer > 0 LIMIT 4";
}


$result = mysqli_query($conn,$sql);
if($result) {
    while($row = mysqli_fetch_assoc($result)){
        $products[] = $row;
    }
}

$data = json_encode($products);
echo $data;