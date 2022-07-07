
<?php
  include("../layouts/header.php");
  include("../server/getProductCategory.php");
  header_title("Sản phẩm");

  $products = getProductCategory($_GET['cate']);

?> 


  <section class="container my-5 py-5 mx-auto">
    <div class="row mx-auto">
    <section id="search" class="col-lg-2 col-md-3 col-sm-12" >
        <div class="">
          <p class="title">Search products</p>
          <hr>
        </div>

        <form action="shop.php" method="GET" class="py-5" >
          <div class="row mx-auto container">
            <div class="col-lg-12 col-md-12 col-sm-12">

              <p class="type-check">Category</p>
              <hr class="mb-5">

              <div class="form-check">
                <input type="radio" name="category" value="all" id="category_all" checked class="form-check-input" >
                <label for="category_all" class="form-check-label">All</label>
              </div>
              <div class="form-check">
                <input type="radio" name="category" value="men" id="category_men" class="form-check-input" >
                <label for="category_men" class="form-check-label">Men</label>
              </div>
              <div class="form-check">
                <input type="radio" name="category" value="women" id="category_women" class="form-check-input" >
                <label for="category_women" class="form-check-label">Women</label>
              </div>
              <div class="form-check">
                <input type="radio" name="category" value="sport" id="category_sports" class="form-check-input" >
                <label for="category_sports" class="form-check-label">Sports</label>
              </div>
            </div>
          </div>
        </form>

    </section>

    <section class="all-product col-lg-10 col-md-9 col-sm-12">
        <div class="d-flex justify-content-between align-items-center">
          <div>
            <h5 class="title">Tất cả sản phẩm</h5>
            <hr>
          </div>
          <div class="search-container">
              <input type="text" name="searchs" id="searchs" placeholder="tìm kiếm" class="search-form">
              <label for="searchs" id="search-btn"><i class="fa-solid fa-magnifying-glass"></i></label>
          </div>
        </div>

        <div class="container">
            <ul id="products" class="products row py-5">
            <?php
              if(isset($products) && !empty($products)) {
                foreach ($products as $product) {
                
             ?>
              <li class="col-lg-3 col-md-4 col-sm-6">
                <div class="product mb-4" >
                  <div class="tag-new">new</div>
                  <?php
                        if($product['product_special_offer'] != 0)
                            echo "<div class='tag-sale'>-{$product['product_special_offer']}<span>%</span></div>";
                  ?>
              
                  <div class="product-icon">
                    <span class="like-btn" data-product-id="<?php echo $product['product_id']; ?>"><i class="fa-solid fa-heart"></i></span>
                    <!-- <span><i class="fa-solid fa-cart-shopping"></i></span> -->
                    <!-- <span><i class="fa-solid fa-magnifying-glass"></i></span> -->
                  </div>
                  <div class="product-img-container">
                    <img
                      src="assets/images/products/<?php echo $product['product_image']; ?>"
                      alt=""
                      class="w-100 product-img"
                    />
                  </div>
                  <a class="d-flex justify-content-between pt-4" href="<?php echo "?page=product&product_id=".$product['product_id']; ?>" >
                    <h4 class="product-name"><?php echo $product['product_name']; ?></h4>
                    <!-- <div class="product-rate">
                      <i class="fa-solid fa-star"></i>
                      <i class="fa-regular fa-star"></i>
                      <i class="fa-regular fa-star"></i>
                      <i class="fa-regular fa-star"></i>
                      <i class="fa-regular fa-star"></i>
                    </div> -->
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
              <?php
                }
              }; ?>
            </ul>
           

         
      
    </section>




    </div>

  </section>

<?php 
    include("../layouts/footer.php");
 ?>
