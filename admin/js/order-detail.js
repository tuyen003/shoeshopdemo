$(".btn-order-detail").each(function () {
  $(this).click(function (e) {
    e.preventDefault();
    $("#pop-up").addClass("active-popup-details");
    var order_id = $(this).attr("data-order-id");
    // $("#pop-up-form-container").html(setFormPopup(product_id, product_name));

    e.preventDefault();
    $.ajax({
      url: "components/order_detail_product.php",
      method: "POST",
      data: { order_id: order_id },
      dataType: "json",
      success: function (data) {
        var content = getDataHtmlTable(data);
        $("#pop-up-form-container").html(
          setFormPopup("Chi tiết đơn hàng", content)
        );
      },
    });
  });
});

function setFormPopup(title, content) {
  return `
    <h2 class="font-weight-bold text-center form-title">${title}</h2>
    <hr class="mx-auto">
        ${content}
      `;
}

function getDataHtmlTable(data) {
  let textData = `
        <table class="mt-5 pt-5" id="table-orders">
            <tr>
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
                  <img src="../assets/images/products/${data[i].product_image}" alt="product" width="80px" height="80px">
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

  textData += "</table>";

  return textData;
}
