$(".update-image-btn").each(function () {
  $(this).click(function (e) {
    e.preventDefault();
    $("#pop-up").addClass("active-popup-details");
    var product_id = $(this).attr("data-img-id");
    var product_name = $(this).attr("data-img-name");
    $("#pop-up-form-container").html(setFormPopup(product_id, product_name));
    $("#edit-img-form").on("submit", function (e) {
      e.preventDefault();

      var formData = new FormData(this);
      console.log(formData);
      $.ajax({
        url: "components/update_image_product.php",
        method: "POST",
        data: formData,
        dataType: "json",
        processData: false,
        contentType: false,
        success: function (data) {
          console.log(data);
          switch (data.message) {
            case "success":
              swal(
                "Thành công",
                "Chỉnh sửa thông tin ảnh thành công",
                "success"
              );
              break;

            default:
              swal("Thất bại", "Chỉnh sửa thông tin ảnh thất bại", "error");
              break;
          }
        },
      });
    });
  });
});

if ($("#pop-up-bg")) {
  $("#pop-up-bg").click(function () {
    $("#pop-up").removeClass("active-popup-details");
  });
}
if ($("#pop-up-close")) {
  $("#pop-up-close").click(function () {
    $("#pop-up").removeClass("active-popup-details");
  });
}

function setFormPopup(id, name) {
  return `
    <form action="all_products.php" method="POST" id="edit-img-form" enctype="multipart/form-data"  >
        <input type="hidden" name="product_id" value="${id}">
        <input type="hidden" name="product_name" value="${name}">
        <div class="form-group mt-2">
            <label for=image1">Product Image 1</label>
            <input type="file" value="" name="product_img1" placeholder="Image 1"id="product-img1" required class="form-control">
        </div>
        <div class="form-group mt-2">
            <label for=image2">Product Image 2</label>
            <input type="file" value="" name="product_img2" placeholder="Image 2" id="product-img2" required class="form-control">
        </div>
        <div class="form-group mt-2">
            <label for=image3">Product Image 3</label>
            <input type="file" value="" name="product_img3" placeholder="Image 3" id="product-img3" required class="form-control">
        </div>
        <div class="form-group mt-2">
            <label for=image4">Product Image 4</label>
            <input type="file" value="" name="product_img4" placeholder="Image 4" id="product-img4" required class="form-control">
        </div>

        
        <div class="form-group mt-2">
            <input type="submit" class="btn btn-primary" id="update-img-btn" name="update_img_btn" data-id-product="<?php if(isset($product_id)) echo $product_id;  ?>" value="Update">
        </div>
    </form>`;
}
