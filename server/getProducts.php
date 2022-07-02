<?php
function getProducts() {
    include("connect.php");
    $products = array();
    $sql = "SELECT * FROM products LIMIT 4";
    $result = mysqli_query($conn,$sql);

    while($row = mysqli_fetch_assoc($result)){
        $products[] = $row;
    }

    return $products;
}


function getProduct($id) {
    include("connect.php");
    $product = array();
    $sql = "SELECT * FROM products WHERE product_id = {$id}";
    $result = mysqli_query($conn,$sql);

    while($row = mysqli_fetch_assoc($result)){
        $product[] = $row;
    }

    return $product;
}

function getRelateProducts($where = '') {
    include("connect.php");
    $products = array();
    $sql = "SELECT * FROM products $where LIMIT 4";
    $result = mysqli_query($conn,$sql);

    while($row = mysqli_fetch_assoc($result)){
        $products[] = $row;
    }

    return $products;
}