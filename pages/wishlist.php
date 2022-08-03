<?php

  header_title("Sản phẩm yêu thích");
  
  $product_wishlist = array();

  if(isset($_SESSION['logged_in'])){
    $user_id = $_SESSION['user_info']['user_id'];
    $sql = "SELECT * FROM `wishlist` WHERE `user_id` = {$user_id}";
    $result = mysqli_query($conn,$sql);
    while($row = mysqli_fetch_assoc($result)){
      $product_wishlist[] = $row;
    }
  }

?> 

<section class="wishlist py-5" id="wishlist">
    <div class="container text-center">
        <h5 class="form-title">Sản phẩm yêu thích</h5>
        <hr class="mx-auto">
    </div>

    <div class="container">
        <ul class="row">
          <?php if(!empty($product_wishlist)) {
                  foreach ($product_wishlist as $product) {
          ?>
            <li class="col-lg-3 col-md-4 col-sm-12">
            <div  class="product">
                <div class="tag-new">new</div>
                <div class="product-remove-btn" data-id="<?= $product['product_id']; ?>" ><i class="fa-solid fa-trash"></i></div>
                  <div class="product-img-container">
                    <img
                      src="assets/images/products/<?= $product['product_image']; ?>"
                      alt=""
                      class="w-100 product-img"
                    />
                  </div>
                  <a class="d-flex justify-content-between pt-4 " href="<?php echo "?page=product&product_id=".$product['product_id']; ?>">
                    <div class="product-name"><?= $product['product_name']; ?></div>
                    <div class="product-rate">
                      <i class="fa-solid fa-star"></i>
                      <i class="fa-regular fa-star"></i>
                      <i class="fa-regular fa-star"></i>
                      <i class="fa-regular fa-star"></i>
                      <i class="fa-regular fa-star"></i>
                    </div>
                  </a>
                  <div class="price-container">
                    <!-- <span class="product-price">$700.00</span> -->
                    <span class="product-price-new"><?= $product['product_price']; ?> đ</span>
                  </div>
              </div>
            </li>

            <?php } } ?>
        </ul>
    </div>

</section>



