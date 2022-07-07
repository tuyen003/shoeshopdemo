$("#order_filter").change(function () {
  //   alert($(this).val());
  var order_status = $(this).val();
  $.ajax({
    url: "components/filter_order_status.php",
    method: "POST",
    data: { order_status: order_status },
    dataType: "json",
    success: function (data) {
      console.log(data);
      $("#table-order-body").html(getDataHtml(data));
    },
  });
});

function getDataHtml(order) {
  let text = "";

  for (let i = 0; i < order.length; i++) {
    text += `
        <tr>
        <td>${order[i].order_id}</td>    
        <td>${statusOrder(order[i].order_status)}</td>    
        <td>${order[i].user_id}</td>    
        <td>${order[i].order_date}</td>    
        <td>${order[i].user_phone}</td>    
        <td>${order[i].user_address}</td>    
        <td><a href="<?php //echo "order.php?product_id=".$order['order_id']; ?>" class="btn btn-warning">Delete</a></td>    
        <!-- <td><a href="<?php //echo "edit_product.php?product_id=".$order['order_id']; ?>" class="btn btn-primary">Edit</a></td>     -->
        </tr>
    `;
  }

  return text;
}

function statusOrder(status) {
  let str = "";

  switch (status) {
    case "on_hold":
      str = "Đang chờ duyệt";
      break;
    case "delivered":
      str = "Đã giao hàng";
      break;
    case "cancel":
      str = "Hủy đơn hàng";
      break;
    case "on_shipping":
      str = "Đang giao";
      break;
    case "success":
      str = "Thành công";
      break;
    default:
      str = "";
      break;
  }

  return str;
}
