/// Get YEAR
var date = new Date();
document.getElementById("year").innerText = date.getFullYear();
// END GET YEAR

// CHANGE VALUE WHEN CLICK BTN PLUS & MINUS
if (document.querySelector(".btn-plus")) {
  document.querySelector(".btn-plus").addEventListener("click", function () {
    let quantity = document.querySelector(".form-type-number #quantity");
    // quantity.value = quantity.value + 1;
    // console.log(quantity.value);
    let check = $("#product_quantity_remain").val();
    if (Number(quantity.value) < Number(check)) {
      ++quantity.value;
    }
  });
}

if (document.querySelector(".btn-minus")) {
  document.querySelector(".btn-minus").addEventListener("click", function () {
    let quantity = document.querySelector(".form-type-number #quantity");
    // quantity.value = quantity.value - 1;
    if (quantity.value <= 1) {
      quantity.value = 1;
    } else {
      --quantity.value;
    }
  });
}

// Navbar CLick
document
  .querySelector(".dropdown-icon")
  .addEventListener("click", function (e) {
    e.preventDefault();
    document
      .querySelector(".navbar-dropdown")
      .classList.toggle("active-navbar");
  });

// Scroll Fixed Navbar
window.addEventListener("scroll", function (e) {
  // console.log(e);
  // console.log(window.pageYOffset);
  if (window.pageYOffset > 350) {
    document.querySelector("nav.navbar").classList.add("navbar-fixed");
  } else {
    document.querySelector("nav.navbar").classList.remove("navbar-fixed");
  }
});

// SEARCH PRODUCTS

if ($("#search-btn")) {
  $("#search-btn").click(function (e) {
    e.preventDefault();
    var strSearch = $("#searchs").val();
    $.ajax({
      url: "components/search_products.php",
      method: "POST",
      data: { strSearch: strSearch },
      dataType: "json",
      success: function (data) {
        // console.log(data);
        var product = getDataHtml(data);
        $("#products").html(product);
      },
    });

    // alert(strSearch);
  });

  $(document).keypress(function (event) {
    var keycode = event.keyCode ? event.keyCode : event.which;
    if (keycode == "13") {
      var strSearch = $("#searchs").val();
      $.ajax({
        url: "components/search_products.php",
        method: "POST",
        data: { strSearch: strSearch },
        dataType: "json",
        success: function (data) {
          // console.log(data);
          var product = getDataHtml(data);
          $("#products").html(product);
        },
      });
    }
  });
}

if ($(".like-btn")) {
  $(".like-btn").each(function () {
    $(this).click(function (e) {
      console.log($(this).attr("data-product-id"));
      var id = $(this).attr("data-product-id");
      $.ajax({
        url: "components/wishlist_products.php",
        method: "POST",
        data: { product_id: id },
        dataType: "json",
        success: function (data) {
          console.log(data);

          if (data.error == "user") {
            swal("", "Vui lòng đăng nhập để sử dụng tính năng này", "error");
          } else if (data.error == "exists") {
            swal("", "Sản phẩm đã được thêm vào mục yêu thích", "warning");
          } else if (data.error == "success") {
            swal("", "Bạn đã thêm sản phẩm vào mục yêu thích", "success");
          }
        },
      });
    });
  });
}

// Get data HTML FROM SERVER
function getDataHtml(data) {
  var text = "";
  // console.log(text);
  for (var i = 0; i < data.length; i++) {
    text += `
    <li  class="col-lg-3 col-md-4 col-sm-6">
    <div class="product mb-4">
          <div class="tag-new">new</div>

          <div class="tag-sale" style="display: ${
            data[i].product_special_offer == 0 ? "none" : "block"
          }">- ${data[i].product_special_offer} <span>%</span></div>
          <div class="product-icon">
            <span><i class="fa-solid fa-heart"></i></span>
            <span><i class="fa-solid fa-cart-shopping"></i></span>
            <span><i class="fa-solid fa-magnifying-glass"></i></span>
          </div>
          <div class="product-img-container">
            <img
              src="assets/images/products/${data[i].product_image}"
              alt=""
              class="w-100 product-img"
            />
          </div>
          <a class="d-flex justify-content-between pt-4" href="single_product.php?product_id=${
            data[i].product_id
          }">
            <div class="product-name">${data[i].product_name}</div>
            <div class="product-rate">
              <i class="fa-solid fa-star"></i>
              <i class="fa-regular fa-star"></i>
              <i class="fa-regular fa-star"></i>
              <i class="fa-regular fa-star"></i>
              <i class="fa-regular fa-star"></i>
            </div>
          </a>
          <div class="price-container">
          <span class="product-price-new">${
            data[i].product_price -
            (data[i].product_price * data[i].product_special_offer) / 100
          } đ</span>
          <span class="product-price" style="display: ${
            data[i].product_special_offer == 0 ? "none" : "inline-block"
          }">${data[i].product_price} đ</span>
          </div>
        </div>
  </li>
        `;
  }
  return text;
}
