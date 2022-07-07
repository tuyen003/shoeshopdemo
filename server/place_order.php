<?php
session_start();
require('connect.php');
if(isset($_POST['place_order'])) {

    //1. get user info and store it in DB
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $city = $_POST['provinces'];
    $district = $_POST['district'];
    $address = $_POST['address'];
    $order_cost = $_SESSION['total'];
    $order_status = 'on_hold';
    $user_id = $_SESSION['user_info']['user_id'];
    $user_name = $_SESSION['user_info']['user_name'];
    $order_date = date('Y-m-d H:i:s');


//3. issue new order and store order info in DB
    $stmt = $conn->prepare("INSERT INTO orders (order_cost,order_status,user_id,user_name,user_email,user_phone,user_city,user_district,user_address, order_date)
                VALUES (?,?,?,?,?,?,?,?,?,?); ");

    $stmt->bind_param('isississss',$order_cost,$order_status,$user_id,$user_name,$email,$phone_number,$city,$district,$address,$order_date);
    
    $stmt->execute();

    $order_id = $stmt->insert_id;
    //2. get products from cart (from session)
    foreach ($_SESSION['cart'] as $key => $value) {
        # code...
        $product = $_SESSION['cart'][$key];
        $product_id = $product['product_id'];
        $product_name = $product['product_name'];
        $product_image = $product['product_image'];
        $product_price = $product['product_price'];
        $product_quantity = $product['product_quantity'];
        $product_size = $product['product_size'];

        //4. store each single item in order_items DB
        $stmt1 = $conn->prepare("INSERT INTO order_items (order_id,product_id,product_name,product_image,product_price,product_quantity,user_id,order_date,product_size)
                        VALUES (?,?,?,?,?,?,?,?,?);");
        $stmt1->bind_param('iissiiisi',$order_id,$product_id,$product_name,$product_image,$product_price,$product_quantity,$user_id,$order_date,$product_size);
        $stmt1->execute();
    }
    

    //5. Remove everything from cart --> delay until payment is done
    unset($_SESSION['cart']);

    //6. inform user whether everything is fine or there is a problem
    header('location: ../?page=cart&order_status="order payment successfully"');


} else {
    # code...
}