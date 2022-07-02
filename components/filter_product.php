<?php
require('../server/connect.php');
$category =''; $price = '';

if(isset($_POST['category']))
    $category = "WHERE product_name LIKE '%".$_POST['category']."%' OR product_category = '".$_POST['category']."'";
if(isset($_POST['price'])) $price = ' ORDER BY product_price '.$_POST['price'];
    $products =  array();
    
    if($category === 'all') {
        $sql = "SELECT * FROM products {$price}";
    } else {
        $sql = "SELECT * FROM products {$category} {$price}";
    }
$result = mysqli_query($conn,$sql);
if($result) {
    while($row = mysqli_fetch_assoc($result)){
        $products[] = $row;
    }
}


$data = json_encode($products);
echo $data;