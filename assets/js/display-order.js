$(".detail_order_btn").each(function () {
  $(this).click(function (e) {
    e.preventDefault();
    // alert("ok");
    var order_id = $(this).attr("data-order-id");
    $.ajax({
      url: "components/order_detail_item.php",
      method: "POST",
      data: { order_id: order_id },
      dataType: "json",
      success: function (data) {
        console.log(data);
        $("#order-details").addClass("active-order-details");
        $("#table-orders").html(getDataHtmlTable(data));
      },
    });
  });
});

if ($("#overlay-bg")) {
  $("#overlay-bg").click(function () {
    $("#order-details").removeClass("active-order-details");
  });
}
if ($("#close_popup")) {
  $("#close_popup").click(function () {
    $("#order-details").removeClass("active-order-details");
  });
}

function getDataHtmlTable(data) {
  let textData = `<tr>
            <th>Tên sản phẩm</th>
            <th>Size</th>
            <th style="text-align:left;">Giá</th>
            <th>Số lượng</th>

          </tr>`;

  for (let i = 0; i < data.length; i++) {
    textData += `
        <tr>
            <td>
            <div class="product-info">
                <img src="assets/images/products/${data[i].product_image}" alt="product" >
                <div>
                <p class="mt-3">${data[i].product_name}</p>
       
                </div>
            </div>
            </td>
            <td>
            <span class="mt-3">${data[i].product_size}</span>
            </td>
            <td>
            <span class="mt-3">${data[i].product_price} đ</span>
            </td>
            
            <td>
            <span class="mt-3">${data[i].product_quantity}</span>
            </td>
        </tr>
        `;
  }

  return textData;
}
