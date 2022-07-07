if (document.querySelector("#description-detail")) {
  CKEDITOR.replace("description-detail", {
    filebrowserBrowseUrl: "ckfinder/ckfinder.html",
    filebrowserUploadUrl:
      "admin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files",
  });
}
