<?php

function getProductCategory($cate){
    include("connect.php");
    $products = array();
    if(!empty($cate)){
        $where = "WHERE product_category = '$cate[0]'";
        for ($i=1; $i < count($cate) ; $i++) { 
            $where .= " OR product_category = '$cate[1]'";
        }
        $sql = "SELECT * FROM products {$where}";
    } 
  
    $result = mysqli_query($conn,$sql);

    while($row = mysqli_fetch_assoc($result)){
        $products[] = $row;
    }
    // echo $where;
    return $products;
}
