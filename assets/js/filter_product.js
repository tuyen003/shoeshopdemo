$(document).ready(function () {
  $("input[name='category']").change(function () {
    var category = $("input[name='category']:checked").val();

    $.ajax({
      url: "components/filter_product.php",
      method: "POST",
      data: { category: category },
      dataType: "json",
      success: function (data) {
        var product = getDataHtml(data);
        $("#products").html(product);
      },
    });
  });

  $("input[name='price']").change(function () {
    var price = $("input[name='price']:checked").val();

    $.ajax({
      url: "components/filter_product.php",
      method: "POST",
      data: { price: price },
      dataType: "json",
      success: function (data) {
        var product = getDataHtml(data);
        $("#products").html(product);
      },
    });
  });
});

function getDataHtml(data) {
  var text = "";
  console.log(data);
  for (var i = 0; i < data.length; i++) {
    text += `
        <div class="col-lg-3 col-md-4 col-sm-6">
        <a class="product mb-4" href="?page=product&product_id=${
          data[i].product_id
        }" >
          <div class="tag-new">new</div>
          <div class="tag-sale" style="display:${
            data[i].product_special_offer != 0 ? "block" : "none"
          };" >- ${data[i].product_special_offer}<span>%</span></div>
          <div class="product-icon">
            <span class="like-btn" data-product-id="${
              data[i].product_id
            }"><i class="fa-solid fa-heart"></i></span>
           
          </div>
          <div class="product-img-container">
            <img
              src="assets/images/products/${data[i].product_image}"
              alt=""
              class="w-100 product-img"
            />
          </div>
          <div class="d-flex justify-content-between pt-4">
            <div class="product-name">${data[i].product_name}</div>
           
          </div>
          <div class="price-container">
          <span class="product-price-new">${
            data[i].product_price -
            (data[i].product_price * data[i].product_special_offer) / 100
          } đ</span>
          <span class="product-price">${data[i].product_price}</span>
          </div>
        </a>
      </div> 
        `;
  }
  return text;
}
