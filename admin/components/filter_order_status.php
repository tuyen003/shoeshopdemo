<?php
require("../../server/connect.php");
$orders = array();

$order_status  = $_POST["order_status"];


if($order_status === 'all') {
    $sql = "SELECT *  FROM orders";
} else {
    $sql = "SELECT * FROM orders WHERE order_status='{$order_status}'";
}
$result = mysqli_query($conn,$sql);
if($result) {
    while($row = mysqli_fetch_assoc($result)){
        $orders[] = $row;
    }
}

$data = json_encode($orders);
echo $data;

