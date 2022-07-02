<?php
function getReviewOfProduct($id) {
    include("connect.php");
    $reviews = array();
    $sql = "SELECT * FROM rating_products WHERE product_id = {$id}";
    $result = mysqli_query($conn,$sql);

    while($row = mysqli_fetch_assoc($result)){
        $reviews[] = $row;
    }

    return $reviews;
}

function getNumbReviewOfProduct($id) {
    include("connect.php");

    $sql = "SELECT *  FROM rating_products WHERE product_id = {$id}";
    $result = mysqli_query($conn,$sql);

    $num = mysqli_num_rows($result);

    return $num;
}


