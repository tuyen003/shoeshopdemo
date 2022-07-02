$(document).ready(function () {
  getQuantityProductCart();
});

//  Set Btn Minus
$(".btn-minus-cart").each(function () {
  $(this).click(function () {
    var i = $(this).next().val();
    // alert(i);
    if (i <= 1) {
      i = 1;
    } else
      $(this)
        .next()
        .val(--i);

    var quantity = $(this).next().val();
    var id = $(this).siblings(".id").val();
    console.log(id);
    $.ajax({
      url: "components/cart_total.php",
      method: "POST",
      data: { quantity: quantity, id: id },
      dataType: "json",
      success: function (data) {
        //   console.log(data.sub_total);
        console.log(data.total);
        // console.log($(this).parent());
        $("#sub-total-" + id).text(data.sub_total + "đ");
        $("#total").text(data.total + "đ");
        $("#product-number-cart").text(data.cart_quantity);
      },
    });
  });
});

// Set btn Plus
$(".btn-plus-cart").each(function () {
  $(this).click(function () {
    var i = $(this).prev().val();
    // alert(i);
    $(this)
      .prev()
      .val(++i);

    var quantity = $(this).prev().val();
    var id = $(this).siblings(".id").val();
    console.log(id);
    $.ajax({
      url: "components/cart_total.php",
      method: "POST",
      data: { quantity: quantity, id: id },
      dataType: "json",
      success: function (data) {
        //   console.log(data.sub_total);
        console.log(data.total);
        // console.log($(this).parent());
        $("#sub-total-" + id).text(data.sub_total + "đ");
        $("#total").text(data.total + "đ");
        $("#product-number-cart").text(data.cart_quantity);
      },
    });
  });
});

function getQuantityProductCart() {
  // CART
  $(".quantity").each(function () {
    $(this).change(function () {
      var quantity = $(this).val();
      var id = $(this).siblings(".id").val();
      console.log(id);
      $.ajax({
        url: "components/cart_total.php",
        method: "POST",
        data: { quantity: quantity, id: id },
        dataType: "json",
        success: function (data) {
          //   console.log(data.sub_total);
          console.log(data.total);
          // console.log($(this).parent());
          $("#sub-total-" + id).text(data.sub_total + "đ");
          $("#total").text(data.total + "đ");
          $("#product-number-cart").text(data.cart_quantity);
        },
      });
    });
  });
  // END CART
}

function setPriceQuantity() {}
