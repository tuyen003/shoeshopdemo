if ($(".product-remove-btn")) {
  $(".product-remove-btn").each(function () {
    $(this).click(function () {
      console.log($(this).attr("data-id"));
      var id = $(this).attr("data-id");

      $.ajax({
        url: "components/wishlist_delete.php",
        method: "POST",
        data: { product_id: id },
        dataType: "json",
        success: function (data) {
          // console.log(data);
          if (data.error) {
            swal("", "Đã xóa sản phẩm khỏi mục yêu thích", "success");
            $("[data-id=" + id + "]")
              .parents("li")
              .css({ display: "none" });
          } else {
            swal("", "Xóa thất bại", "error");
          }
        },
      });
    });
  });
}
