<?php
require('../server/connect.php');
$str_search = $_POST['strSearch'];
$products =  array();


$sql = "SELECT * FROM products WHERE product_name LIKE '%{$str_search}%' ";

$result = mysqli_query($conn,$sql);
if($result) {
    while($row = mysqli_fetch_assoc($result)){
        $products[] = $row;
    }
}

$data = json_encode($products);
echo $data;