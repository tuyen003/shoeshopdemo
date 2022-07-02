<?php
function show_array($arr){
  echo "<pre>";
  print_r($arr);
  echo "</pre>";
}

 
function  calculateTotalCart($arr) {
  $total = 0;
  if(isset($arr)) {
    foreach ($arr as $key => $value) {
      $product = $arr[$key];
  
      // $price = $product['product_price'];
      $quantity = $product['product_quantity'];
      $price = round($product["product_price"] - ($product['product_sale']*$product["product_price"]/100),-3);
      
      $total = $total + ($price * $quantity);
    }
  }
  
  return $total;
}

function statusOrder($status){
  $str = "";

  switch ($status) {
    case 'on_hold':
      $str = "Đang chờ duyệt";
      break;
    case 'delivered':
      $str = "Đã giao hàng";
      break;
    case 'cancel':
      $str = "Hủy đơn hàng";
      break;
    case 'on_shipping':
      $str = "Đang giao";
      break;
    case 'success':
        $str = "Thành công";
        break;
    default:
      $str = "";
      break;
  }

  return $str;
}

function statusPaid($status){
  $str = "";

  switch ($status) {
    case 'paid':
      $str = "Đã thanh toán";
      break;
    case 'not_paid':
      $str = "Chưa thanh toán";
      break;
    case 'onl_paid':
      $str = "Thanh toán online";
      break;
 
  }

  return $str;
}

function statusRate($status){
  $str = "";

  switch ($status) {
    case 'bad':
      $str = "Tệ";
      break;
    case 'normal':
      $str = "Bình thường";
      break;
    case 'good':
      $str = "Tốt";
      break;
    case 'very good':
      $str = "Rất tốt";
      break;
 
  }

  return $str;
}



function getSizeName($size){
  $str = "";

  switch ($size) {
    case 'size_37':
      $str = "37";
      break;
    case 'size_38':
      $str = "38";
      break;
    case 'size_39':
      $str = "39";
      break;
    case 'size_40':
      $str = "40";
      break;
    case 'size_41':
      $str = "41";
      break;
    case 'size_42':
      $str = "42";
      break;
   
 
  }

  return $str;
}