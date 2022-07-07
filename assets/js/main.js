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
    let check = $("#product_quantity_remain").text;
    // if (Number(quantity.value) < Number(check)) {
    ++quantity.value;
    // }
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
          </div>
          <div class="product-img-container">
            <img
              src="assets/images/products/${data[i].product_image}"
              alt=""
              class="w-100 product-img"
            />
          </div>
          <a class="d-flex justify-content-between pt-4" href="?page=product&product_id=${
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

/// Get Tỉnh Thành pHố

if ((address_2 = localStorage.getItem("address_2_saved"))) {
  $('select[name="district"] option').each(function () {
    if ($(this).text() == address_2) {
      $(this).attr("selected", "");
    }
  });
  $("input.billing_address_2").attr("value", address_2);
}
if ((district = localStorage.getItem("district"))) {
  $('select[name="district"]').html(district);
  $('select[name="district"]').on("change", function () {
    var target = $(this).children("option:selected");
    target.attr("selected", "");
    $('select[name="district"] option').not(target).removeAttr("selected");
    address_2 = target.text();
    $("input.billing_address_2").attr("value", address_2);
    district = $('select[name="district"]').html();
    localStorage.setItem("district", district);
    localStorage.setItem("address_2_saved", address_2);
  });
}
$('select[name="provinces"]').each(function () {
  var $this = $(this),
    stc = "";
  c.forEach(function (i, e) {
    e += +1;
    console.log(e, i);
    stc +=
      '<option value="' +
      i +
      '" data-provinces="' +
      e +
      '" >' +
      i +
      "</option>";
    $this.html('<option value="">Tỉnh / Thành phố</option>' + stc);
    if ((address_1 = localStorage.getItem("address_1_saved"))) {
      $('select[name="provinces"] option').each(function () {
        if ($(this).text() == address_1) {
          $(this).attr("selected", "");
        }
      });
      $("input.billing_address_1").attr("data-provinces", address_1);
    }
    $this.on("change", function (i) {
      i = $this.children("option:selected").index() - 1;
      var str = "",
        r = $this.val();
      if (r != "") {
        arr[i].forEach(function (el) {
          str += '<option value="' + el + '">' + el + "</option>";
          $('select[name="district"]').html(
            '<option value="">Quận / Huyện</option>' + str
          );
        });
        var address_1 = $this.children("option:selected").text();
        var district = $('select[name="district"]').html();
        localStorage.setItem("address_1_saved", address_1);
        localStorage.setItem("district", district);
        $('select[name="district"]').on("change", function () {
          var target = $(this).children("option:selected");
          target.attr("selected", "");
          $('select[name="district"] option')
            .not(target)
            .removeAttr("selected");
          var address_2 = target.text();
          $("input.billing_address_2").attr("value", address_2);
          district = $('select[name="district"]').html();
          localStorage.setItem("district", district);
          localStorage.setItem("address_2_saved", address_2);
        });
      } else {
        $('select[name="district"]').html(
          '<option value="">Quận / Huyện</option>'
        );
        district = $('select[name="district"]').html();
        localStorage.setItem("district", district);
        localStorage.removeItem("address_1_saved", address_1);
      }
    });
  });
});
