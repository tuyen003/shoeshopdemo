<?php
  include("layouts/header.php");
  require("server/getProducts.php");
  include("server/getReview.php");
  include("server/getProductSize.php");
  include("lib/lib.php");
  header_title("Thông tin sản phẩm");
  $product_single = array();

  


  $id = 0;
  if(isset($_GET['product_id'])){
    $product_id = $_GET['product_id'];
    $id = $_GET['product_id'];
    $products = getProduct($product_id);

    // no product not found
  } else {
      header("location: 404page.php");
  }

  // print_r(getSizeOfProduct($id)[0]);
  $sizes = getSizeOfProduct($id);

  $productRelated = getRelateProducts();
?> 
 
 <section class="container single-product my-5 pt-5">
   <?php foreach ($products as $row) { 
          $product_single['detail']  = $row['product_description_detail'];
     ?>
        <div class="row mt-5">
            <div class="col-lg-5 col-md-6 col-sm-12 xzoom-container">

                <img src="assets/images/products/<?php echo $row['product_image']; ?>" alt="shoes" xoriginal="assets/images/products/<?php echo $row['product_image']; ?>" class="xzoom img-fluid w-100 pb-1" id="main-img">
                <div class="small-img-group xzoom-thumbs">
                    
                    <div class="small-img-col">
                        <img src="assets/images/products/<?php echo $row['product_image']; ?>" xpreview="assets/images/products/<?php echo $row['product_image']; ?>" alt="shoes" width="100%" class="xzoom-gallery small-img active">
                    </div>
                    <div class="small-img-col">
                        <img src="assets/images/products/<?php echo $row['product_image2']; ?>" alt="shoes" width="100%" class="xzoom-gallery small-img">
                    </div>
                    <div class="small-img-col">
                        <img src="assets/images/products/<?php echo $row['product_image3']; ?>" alt="shoes" width="100%" class="xzoom-gallery small-img">
                    </div>
                    <div class="small-img-col">
                        <img src="assets/images/products/<?php echo $row['product_image4']; ?>" alt="shoes" width="100%" class="xzoom-gallery small-img">
                    </div>
                
                </div>
            </div>

            <div class="col-lg-6 col-md-12 col-12 product-wrapper">
              
                <div class="sale-off" style="display: <?php echo $row['product_special_offer'] !== 0 ?"block":"none"; ?>">
                  <span class="sale-off-price"><?php echo $row['product_special_offer']; ?></span>
                  <span class="sale-off-text">% off</span>
                </div>
                <!-- <h6 class="path">Men/Shoes</h6> -->
                <h3 class="pt-4 product-name"><?php echo $row['product_name']; ?></h3>
                <p class="product-rating">đánh giá: </p>
                <h2 class="price"><span></span> <?php echo $row['product_price']; ?> đ</h2>
                <h5>tình trạng: <span class="available">còn hàng</span></h5>
                <h5>Số lượng: <span class="available"><?php echo getQuantityProduct($row['product_id']);?></span></h5>
                <h5>danh mục: <span class="categories"><?php echo $row['product_category']; ?></span></h5>
                <h5 class="mb-55">Màu sắc: <span class="tags"><?php echo $row['product_color']; ?></span></h5>
              
                <form action="cart" method="post"  >
                    <input type="hidden" name="product_id" value="<?php echo $row['product_id'];?>" >
                    <?php $id = $row['product_id'];?>
                    <input type="hidden" name="product_image" value="<?php echo $row['product_image'];?>" >
                    <input type="hidden" name="product_name" value="<?php echo $row['product_name'];?>" >
                    <input type="hidden" name="product_price" value="<?php echo $row['product_price'];?>" >
                    <input type="hidden" name="product_sale" value="<?php echo $row['product_special_offer'];?>" >
                    <div class="size-container">
                        <label for="size">Size:</label>
                        <select name="size" id="size" class="form-control">
                        <?php foreach ($sizes[0] as $size => $quantity) { 
                                if( str_contains($size,'size')  && $quantity != 0 && !str_contains($size,'size_id')){?>
                                  <option value="<?php echo getSizeName($size); ?>"><?php echo getSizeName($size); ?></option>
                        <?php } } ?>
                        </select>
                    </div> 
                   <div class="btn-addcart-container d-flex">
                   <div class="form-type-number">
                      <div class="btn-minus">-</div>
                      <input type="number" value="1"  min="1" name="product_quantity" id="quantity">
                      <div class="btn-plus">+</div>
                    </div>
                    
                    <button type="submit" name="add_to_cart" class="btn btn--buy"><i class="fa-solid fa-cart-shopping"></i> Thêm giỏ hàng</button>
                   </div>
                   
                </form>   
            </div>
          </div>
          <?php } ?>
          
        </section>
        
        <section class="container product-description-detail py-4">
          <div class="row">
            <h2>Mô tả sản phẩm</h2>
              <div class="col-12">
                  <?php echo html_entity_decode($product_single['detail']); ?>
              </div>
            </div>
          </section>


        <section id="rating-product" class="py-5">
          <div class="container mb-5">
            <h2 class="form-title">Tất cả đánh giá</h2>
            <hr>
          </div>
          <div class="container">
            <div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="rating-container">
                  <ul class="rating-list-comment" id="review-list">
                    <?php
                    $numbReview = getNumbReviewOfProduct($id);
                    
                    if($numbReview < 1){
                        echo "<p>Không có đánh giá nào</p>";
                    } else{
                      $reviews = getReviewOfProduct($id);
                      foreach ($reviews as $review) {
                       $h = rand(0,359); $s = rand(0,100); $l = rand(0,100);
                      ?>
                    <li class="rating-item">
                   
                      <div class="review ">
                        <div class="review-left">
                          <div class="avatar" style="background: <?php echo "hsl({$h},{$s}%,{$l}%)"; ?>"><?php echo $review["user_name"][0];?></div>
                        </div>
                        <div class="review-right">
                          <h3 class="review-name"><?php echo $review["user_name"];?>  <span class="review-date"><?php echo $review["rate_date"];?></span></h3>
                          <p class="review-content">
                            <?php echo $review["rate_content"];?>
                          </p>
                          <span class="review-rate">
                          <?php echo statusRate($review["rate_status"]);?>
                          </span>
                        </div>
                      </div>
                    </li>

                    <?php } } ?>
                  </ul>

                  <div class="review-new-content">
                    <h4>Thêm đánh giá</h4>
                    <hr>
                    <form action="" method="post" id="form-review">
                      <div class="form-group">
                        <label for="content">Nội dung</label>
                        <textarea name="review_content" id="content"  class="form-control"></textarea>
                      </div>

                      <div class="form-group">
                        <label for="rate">Đánh giá</label>
                        <select name="rating" id="rate" class="form-control">
                          <option value="bad">Tệ</option>
                          <option value="normal">Bình thường</option>
                          <option value="good">Tốt</option>
                          <option value="very good">Rất tốt</option>
                        </select>
                      </div>

                      <div class="form-group">
                        <button type="submit" name="review_btn" id="review-btn" class="btn">
                          Gửi đánh giá
                        </button>
                        <input type="hidden" name="" id="review-product-id" value="<?php echo $id;?>">
                        <input type="hidden" name="" id="review-user-id" value="<?php if(isset($_SESSION['user_info'])) echo $_SESSION['user_info']['user_id'];?>">
                        <input type="hidden" name="" id="review-user-name" value="<?php if(isset($_SESSION['user_info'])) echo $_SESSION['user_info']['user_name'];?>">
                      </div>
                    </form>
                  </div>

                </div>
              </div>
            </div>
          </div>


        </section>



          
    <section class="product-related container py-5">
        <h2 class="font-weight-bold py-3">Sản phẩm liên quan</h2>
        <hr>

        <div class="row ">
        <?php foreach ($productRelated as $row) {
         ?>
          <div class="col-lg-3 col-md-3 col-sm-6">
            <a class="product mb-4" href="<?php echo "single_product.php?product_id={$row['product_id']}"; ?>">
              <div class="tag-new">new</div>
              <!-- <div class="tag-sale">-5 <span>%</span></div> -->
              <?php if($row['product_special_offer'] != 0) {
                    echo "<div class='tag-sale'>-{$row['product_special_offer']}<span>%</span></div>";
                  }?>
              <div class="product-icon">
              <span class="like-btn" data-product-id="<?php echo $product['product_id']; ?>"><i class="fa-solid fa-heart" ></i></span>
                
              </div>
              <div class="product-img-container">
                <img
                  src="assets/images/products/<?php echo $row["product_image"]; ?>"
                  alt=""
                  class="w-100 product-img"
                  data-img="assets/images/products/<?php echo $row["product_image2"]; ?>"
                />
              </div>
              <div class="d-flex justify-content-between pt-4">
                <div class="product-name"><?php echo $row["product_name"]; ?></div>
              
              </div>
              <div class="price-container">
              <?php if($row['product_special_offer'] != 0){
                      $price = round($row["product_price"] - ($row['product_special_offer']*$row["product_price"]/100),-3);
                      echo '<span class="product-price-new">'.$price.' đ</span>';
                      echo '<span class="product-price">'.$row['product_price'].'đ</span>';
                    } else {
                      echo '<span class="product-price-new">'.$row["product_price"].' đ</span>';
                    }
                    ?>
              </div>
            </a>
          </div>
            <?php }; ?>
        </div>




    </section>






<?php 

    include("layouts/footer.php");
 ?>
<script src="assets/js/review.js?v<?php echo time();?>"></script>


<script>
  $(function(){
    $(".xzoom,.xzoom-gallery").xzoom({
      zoomWidth: 350,
      tint: "#333",
      Xoffset:15,
    })
  })
</script>
