<?php
  // session_start();
  include("layouts/header.php");
  require("lib/lib.php");
  header_title("Giỏ hàng");

  if(isset($_POST['add_to_cart'])) {

    // if user has already added a product to cart
    if(isset($_SESSION['cart'])){
      $products_array_ids = array_column($_SESSION['cart'],'product_id'); // [2,3,....]
    
      // Check product has already been added cart or not
      if(!in_array($_POST['product_id'], $products_array_ids)) {
 
        $product_array = array(
                        'product_id' => $_POST['product_id'],
                        'product_name' => $_POST['product_name'],
                        'product_price' => $_POST['product_price'],
                        'product_image' => $_POST['product_image'],
                        'product_quantity' => $_POST['product_quantity'],
                        'product_sale' => $_POST['product_sale'],
                        'product_size' => $_POST['size']
        );
      
        $_SESSION['cart'][$_POST['product_id']] = $product_array;
      } else {
        //  echo "<script>swal('Sản phẩm đã được thêm vào giỏ hàng!');</script>"; 
        // $_SESSION['cart'][$_POST['product_id']]['product_quantity'] += $_POST['product_quantity'];
      }


      // if this is the first product
    } else {
      $product_id  = $_POST['product_id'];
      $product_name  = $_POST['product_name'];
      $product_price  = $_POST['product_price'];
      $product_image  = $_POST['product_image'];
      $product_quantity  = $_POST['product_quantity'];
      $product_sale  = $_POST['product_sale'];
      $product_size = $_POST['size'];
    
      $product_array = array(
                      'product_id' => $product_id,
                      'product_name' => $product_name,
                      'product_price' => $product_price,
                      'product_image' => $product_image,
                      'product_quantity' => $product_quantity,
                      'product_sale' => $product_sale,
                      'product_size' => $product_size
      );
    
      $_SESSION['cart'][$product_id] = $product_array;
      
      // [2 => [], 3 =>[],....]
    }

  } else if(isset($_POST['remove_product'])) {
    unset($_SESSION['cart'][$_POST['product_id']]);
  }else if(isset($_POST['edit_quantity'])) {
   
      $product_id = $_POST['product_id'];
      $product_array = $_SESSION['cart'][$product_id];

      $product_array['product_quantity'] = $_POST['quantity'];

      $_SESSION['cart'][$product_id] = $product_array;

  }
  
  if(isset($_SESSION['cart'])){
    $_SESSION['total'] = calculateTotalCart($_SESSION['cart']);
  }
  
  // print_r($_SESSION);
 
?> 


    <section class="cart container my-5 py-5">
      <div class="container mt-5">
        <h2 class="font-weight-bold form-title">Giỏ hàng</h2>
        <hr>
      </div>

      <table class="mt-5 pt-5">
        <tr>
          <th>Sản phẩm</th>
          <th>Size</th>
          <th>Số lượng</th>
          <th>Tổng giá</th>
        </tr>
        <?php
          if(isset($_SESSION['cart'])) {
            $cart = $_SESSION['cart'];
            foreach( $cart  as $key => $value) { 
          ?>
        <tr>
          <td data-label="Sản phẩm">
            <div class="product-info">
              <img src="./assets/images/products/<?php echo $value['product_image']; ?>" alt="product">
              <div class="product-container">
                <p><?php echo $value['product_name']; ?></p>
                <div class="price-container">
                  <?php
                    if($value['product_sale'] != 0){
                      echo '<small>'.round($value["product_price"] - ($value['product_sale']*$value["product_price"]/100),-3).' đ</small>';
                      echo '<small class="price-sale">'.$value['product_price'].'đ</small>';
                    } else {
                      echo '<small>'.$value["product_price"].' đ</small>';
                    }
                  ?>
                 
                
                </div>
                <br>
                <form action="cart.php" method="POST">
                  <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>">
                  <button type="submit" value="Remove" name="remove_product" class="remove-btn">xóa</button>
                </form>
              </div>
            </div>
          </td>
          <td>
            <?php echo $value['product_size']; ?>

          </td>

          <td>
            <div class="box-center">
              <form action="cart.php" method="post">
                <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>" class="id">
                <button type="button" class="btn-minus-cart btn-cart btn-quantity" id="btn-minus">-</button>
                <input type="number"  value="<?php echo $value['product_quantity']; ?>" min="1" name="quantity" class="quantity" id="quantity" >
                <button type="button" class="btn-plus-cart btn-cart btn-quantity"  id="btn-plus">+</button>
                <input class="btn edit-btn" value="edit" type="submit" name="edit_quantity">
            </form>  
            </div>
          </td>

          <td data-label="Giá">
            <div class="box-center">
              <span class="product-price" id="<?php echo "sub-total-".$value['product_id']; ?>" >
              <?php 
              $price =  $value['product_quantity'] * round($value["product_price"] - ($value['product_sale']*$value["product_price"]/100),-3);
              echo $price; ?>
               đ</span>

            </div>
          </td>
        </tr>
        <?php 
            }
          } 
        ?>
      </table>


      <div class="cart-total">
      <table>
          <tr>
            <td>Tổng tiền</td>
            <td class="total" id="total"><?php if(isset($_SESSION['cart'])) echo $_SESSION['total']; else echo 0; ?> đ</td>
          </tr>
        </table>
      </div>


      <div class="checkout-container">
        <form action="checkout.php" method="post">
          <button type="submit" class="checkout-btn" name="checkout">Đặt hàng</button>
        </form>
      </div>
    </section>



<?php
  include("layouts/footer.php");
?>


<script>


</script>