<?php
session_start();

$data = array();
$id = $_POST['id'];
$quantity = $_POST['quantity'];
$_SESSION['cart'][$id]['product_quantity'] = $quantity;
// $price = round($product["product_price"] - ($product['product_sale']*$product["product_price"]/100),-3);
$data['sub_total'] =$_SESSION['cart'][$id]['product_quantity'] *  round($_SESSION['cart'][$id]['product_price'] - ($_SESSION['cart'][$id]['product_price']*$_SESSION['cart'][$id]['product_sale']/100),-3);
$data['total'] = 0;
$data['cart_quantity'] = 0;
foreach ($_SESSION['cart'] as $value) {
    # code...
    // $data['total'] += $value['product_price'] * $value['product_quantity'];
    $data['total'] += round($value['product_quantity']*($value["product_price"] - ($value['product_sale']*$value["product_price"]/100)),-3);;
    $data['cart_quantity'] += $value['product_quantity'];

}

// $data['total'] = round($data['total'],2);
// print_r($_SESSION);

$data = json_encode($data);

echo $data;




