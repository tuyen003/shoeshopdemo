<?php
function getSizeOfProduct($id) {
    include("connect.php");
    $sizes = array();
    $sql = "SELECT * FROM product_size WHERE product_id = {$id}";
    $result = mysqli_query($conn,$sql);

    while($row = mysqli_fetch_assoc($result)){
        $sizes[] = $row;
    }

    return $sizes;
}
