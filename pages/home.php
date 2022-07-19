

<?php 
ob_start();
header_title("Trang chủ");
ob_end_flush();
include("layouts/slideshow.php"); ?>

<section id="sale-product" class="sale-product my-5 py-5">
   
   <div class="container">
     <h2 class="form-title text-center">Sản phẩm mới</h2>
     <hr class="mx-auto">


 <!-- <div class="products row my-5 py-5"> -->
 <ul class="products row mt-5" id="products_best">
   <?php 
     foreach ($products as $product) {
   ?>
     <li  class="col-lg-3 col-md-4 col-sm-6">
       <div  class="product">
         <div class="tag-new">new</div>
           <?php if($product['product_special_offer'] != 0) {
             echo "<div class='tag-sale'>-{$product['product_special_offer']}<span>%</span></div>";
           }?>
         <div class="product-icon">
             <span class="like-btn" data-product-id="<?php echo $product['product_id']; ?>"><i class="fa-solid fa-heart" ></i></span>
         
           </div>
           <div class="product-img-container">
             <img
               src="assets/images/products/<?php echo $product['product_image']; ?>"
               alt=""
               class="w-100 product-img"
             />
           </div>
           <a class="d-flex justify-content-between pt-4 " href="<?php echo "?page=product&product_id=".$product['product_id']; ?>">
             <div class="product-name"><?php echo $product['product_name']; ?></div>
           </a>
           <div class="price-container">
             <?php if($product['product_special_offer'] != 0){
               $price = round($product["product_price"] - ($product['product_special_offer']*$product["product_price"]/100),-3);
               echo '<span class="product-price-new">'.$price.' đ</span>';
               echo '<span class="product-price">'.$product['product_price'].'đ</span>';
             } else {
               echo '<span class="product-price-new">'.$product["product_price"].' đ</span>';
             }
             ?>
           </div>
       </div>
     </li>
   <?php }; ?>
 </ul>
 <!-- </div> -->
</div>
</section>

<section id="sale-product" class="sale-product my-5 py-5">
        <div class="container">
            <h2 class="form-title text-center">Sản phẩm giảm giá</h2>
            <hr class="mx-auto">
        <!-- <div class="products row my-5 py-5"> -->
        <ul class="products row mt-5" id="products_best">
         
          <?php 
            $sale_products = getRelateProducts("WHERE product_special_offer > 0");
            foreach ($sale_products as $product) {
          ?>
            <li  class="col-lg-3 col-md-4 col-sm-6">
              <div  class="product">
                <!-- <div class="tag-new">new</div> -->
                  <?php if($product['product_special_offer'] != 0) {
                    echo "<div class='tag-sale'>-{$product['product_special_offer']}<span>%</span></div>";
                  }?>
                <div class="product-icon">
                    <span class="like-btn" data-product-id="<?php echo $product['product_id']; ?>"><i class="fa-solid fa-heart" ></i></span>
                  </div>
                  <div class="product-img-container">
                    <img
                      src="assets/images/products/<?php echo $product['product_image']; ?>"
                      alt=""
                      class="w-100 product-img"
                    />
                  </div>
                  <a class="d-flex justify-content-between pt-4 " href="<?php echo "?page=product&product_id=".$product['product_id']; ?>">
                    <div class="product-name"><?php echo $product['product_name']; ?></div>
                  
                  </a>
                  <div class="price-container">
              
                    <?php if($product['product_special_offer'] != 0){
                      $price = round($product["product_price"] - ($product['product_special_offer']*$product["product_price"]/100),-3);
                      echo '<span class="product-price-new">'.$price.' đ</span>';
                      echo '<span class="product-price">'.$product['product_price'].'đ</span>';
                    } else {
                      echo '<span class="product-price-new">'.$product["product_price"].' đ</span>';
                    }
                    ?>
                  </div>
              </div>
            </li>
          <?php }; ?>
        </ul>
        <!-- </div> -->
      </div>
</section>

