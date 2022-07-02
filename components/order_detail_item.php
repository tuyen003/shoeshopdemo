<?php
require('../server/connect.php');

$orders =  array();
$order_id = $_POST['order_id'];

$sql = "SELECT * FROM order_items WHERE order_id = '{$order_id}'";

$result = mysqli_query($conn,$sql);
if($result) {
    while($row = mysqli_fetch_assoc($result)){
        $orders[] = $row;
    }
}

$data = json_encode($orders);
echo $data;