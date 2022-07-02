
<?php
  include("layouts/header.php");
  include("server/connect.php");
  header_title("Sản phẩm");
  
  if(isset($_GET['search'])) {
    // echo "Đã search";
    $category = $_GET['category'];
    $price = $_GET['price'];
    if( $category === 'all') {
      $stmt = $conn->prepare("SELECT * FROM products");
      $stmt->execute();
      $products = $stmt->get_result();

    } else {
      $stmt = $conn->prepare("SELECT * FROM products WHERE product_category = ? AND product_price <  ?");
      $stmt->bind_param('si',$category,$price);
      $stmt->execute();
      
      $products = $stmt->get_result();
    }
    
  } else {
    // $stmt = $conn->prepare("SELECT * FROM products");
    // $stmt->execute();
    // $products = $stmt->get_result();
    if(isset($_GET['page_no']) && $_GET['page_no'] !== ""){
      //when user entered page then page number is a number selected 
      $page_no = $_GET['page_no'];

    } else {
      // if user just entered the page then default page
      $page_no = 1;
    }
    //  else {
      //return number of products
      $stmt1 = $conn->prepare("SELECT COUNT(*) AS total_records FROM products");
      $stmt1 ->execute();
      $stmt1->bind_result($total_records);
      $stmt1->store_result();
      $stmt1->fetch();

      //Product per page
      $total_records_per_page = 8;
      $offset = ($page_no - 1) * $total_records_per_page;
      $previous_page = $page_no -1;
      $next_page = $page_no +1;

      // $adjacents = "2";
      $total_no_of_pages = ceil($total_records/$total_records_per_page);

      // get all product
      $stmt2 = $conn->prepare("SELECT * FROM products LIMIT $offset,$total_records_per_page");
      $stmt2->execute();

      $products = $stmt2->get_result();
    // }

  }
  
  // echo $page_no;


?> 


  <section class="container my-5 py-5 mx-auto">
    <div class="row mx-auto">
    <section id="search" class="col-lg-2 col-md-3 col-sm-12" >
        <form action="shop.php" method="GET" >
          <div class="row mx-auto container">
            <div class="col-lg-12 col-md-12 col-sm-12">

              <p class="type-check">Danh mục</p>
              <hr class="mb-5">

              <div class="form-check">
                <input type="radio" name="category" value="all" id="category_all" checked class="form-check-input" >
                <label for="category_all" class="form-check-label">Tất cả</label>
              </div>
              <div class="form-check">
                <input type="radio" name="category" value="nam" id="category_men" class="form-check-input" >
                <label for="category_men" class="form-check-label">Nam</label>
              </div>
              <div class="form-check">
                <input type="radio" name="category" value="nữ" id="category_women" class="form-check-input" >
                <label for="category_women" class="form-check-label">Nữ</label>
              </div>
              <div class="form-check">
                <input type="radio" name="category" value="thể thao" id="category_sports" class="form-check-input" >
                <label for="category_sports" class="form-check-label">Thể thao</label>
              </div>
            </div>

            <!-- <div class="row mx-auto container mt-5"> -->
              <div class="form-group col-lg-12 col-md-12 col-sm-12 mt-5">
                <p class="type-check">Giá</p>
                <hr class="mb-5">
                <div class="form-check">
                 <input type="radio" name="price" value="ASC" id="price-increase" class="form-check-input" >
                 <label for="price-increase" class="form-check-label">Tăng dần</label>
                </div>
                <div class="form-check">
                 <input type="radio" name="price" value="DESC" id="price-decrease" class="form-check-input" >
                 <label for="price-decrease" class="form-check-label">Giảm dần</label>
                </div>
              </div>

              <!-- <div class="form-group my-3">
                <input type="submit" name="search" value="Search" class="btn btn-primary" >
              </div> -->
            <!-- </div> -->

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
                while($row = $products->fetch_assoc()) { 
                    $numbRand = rand(0,100);
             ?>
              <li class="col-lg-3 col-md-4 col-sm-6">
                <div class="product mb-4" >
                  <?php
                    if($numbRand > 25) echo '<div class="tag-new">new</div>';
                   ?>
                
                  <?php if($row['product_special_offer'] != 0) {
                    echo "<div class='tag-sale'>-{$row['product_special_offer']}<span>%</span></div>";
                  }?>
                      
                  <div class="product-icon">
                    <span class="like-btn" data-product-id="<?php echo $row['product_id']; ?>"><i class="fa-solid fa-heart"></i></span>
               
                  </div>
                  <div class="product-img-container">
                    <img
                      src="assets/images/products/<?php echo $row['product_image']; ?>"
                      alt=""
                      class="w-100 product-img"
                    />
                  </div>
                  <a class="d-flex justify-content-between pt-4" href="<?php echo "single_product.php?product_id=".$row['product_id']; ?>" >
                    <h4 class="product-name"><?php echo $row['product_name']; ?></h4>
                  
                  </a>
                  <div class="price-container">
                    <?php
                      if($row['product_special_offer'] != 0){
                        $price = round($row["product_price"] - ($row['product_special_offer']*$row["product_price"]/100),-3);
                        echo '<span class="product-price-new">'.$price.' đ</span>';
                        echo '<span class="product-price">'.$row['product_price'].'đ</span>';
                      } else {
                        echo '<span class="product-price-new">'.$row["product_price"].' đ</span>';
                      }
                    ?>
                  </div>
                </div>
              </li>
              <?php
                }
              }; ?>
            </ul>
           

            
            <?php 

                $start_pg = '<ul class="pagination mt-5">';
                if($page_no > 1) {
                    $start_pg .= "<li class=\"page-item\">
                    <a href=\"shop?page_no={$previous_page}\" class=\"page-link\">Prev</a>
                </li>";
                }

                for($i = 1; $i <= $total_no_of_pages; $i++){
                    $active ='';
                    if($i == $page_no) $active = "active-pg";
                    $start_pg .= "<li class=\"page-item\">
                                    <a href=\"shop?page_no={$i}\" class=\"page-link  {$active}\">{$i}</a>
                                </li>";

                            }
                if($page_no < $total_no_of_pages) {
                    $start_pg .="<li class=\"page-item\">
                    <a href=\"shop?page_no={$next_page}\" class=\"page-link\">Next</a>
                    </li>";
                } else if($page_no = $total_no_of_pages) {
                    $start_pg .="<li class=\"page-item disabled\">
                    <a href=\"shop?page_no={$page_no}\" class=\"page-link\">Next</a>
                    </li>";
                }
                $start_pg .="</ul>";

                ?>
                <nav aria-label="Page navigation" class="text-right d-flex justify-content-end">
                <?php echo $start_pg; ?>
                </nav>

          </div>
      
    </section>




    </div>

  </section>




<?php 
    include("layouts/footer.php");
 ?>


<script src="assets/js/filter_product.js?v<?php echo time();?>"></script>