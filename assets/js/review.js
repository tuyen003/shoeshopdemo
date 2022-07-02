$("#review-btn").click(function (e) {
  e.preventDefault();
  var product_id = $("#review-product-id").val();
  var user_id = $("#review-user-id").val();
  var user_name = $("#review-user-name").val();
  var content = $("#content").val();
  var rate = $("#rate").val();
  //   alert(product_id + user_id + content + rate);

  $.ajax({
    url: "components/review_product.php",
    method: "POST",
    data: {
      product_id: product_id,
      user_id: user_id,
      user_name: user_name,
      content: content,
      rate: rate,
    },
    dataType: "json",
    success: function (data) {
      console.log(data);

      switch (data.mess) {
        case "not_user":
          swal("", "Vui lòng đăng nhập để bình luận", "warning");
          break;
        case "error":
          swal("", "Đánh giá thất bại", "error");
          break;
        case "success":
          swal("", "Đã thêm đánh giá thành công", "success");
          break;
      }
    },
  });
});
