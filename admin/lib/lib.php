<?php
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


