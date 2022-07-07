<?php
ob_start();
//   session_start();

 header_title("Đặt hàng");

 $ship_money = 23000;


  if( !empty($_SESSION['cart']) && isset($_POST['checkout'])){
      // user in
      // print_r($_SESSION['user_info']);

      // no user in
      if(!isset($_SESSION['user_info'])){
        header("location: ?page=login");
      }
     
  } else {
      header("location: ?page=");
  }

  // echo "<pre>";
  // print_r($_SESSION);
  // echo "</pre>";

  if(isset($_SESSION['cart']) && $_SESSION['total'] != 0) {
    $_SESSION['total'] = calculateTotalCart($_SESSION['cart'])+$ship_money;
  }

  function getInfoUser($info){
    if(isset($info)) 
      return $info;
    return "";  
  }

?> 


    <section id="checkout">
        <div class="container text-center mt-3 pt-5">
            <h2 class="form-weight-bold form-title">Đặt Hàng</h2>
            <hr class="mx-auto">
        </div>
        <div class="mx-auto container">
            <form action="server/place_order.php" method="POST" class="row" id="checkout-form">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h4>Thông tin khách hàng</h4>
                    <div class="form-group checkout-small-element">
                        <label for="email">Email</label>
                        <input type="text" name="email" value="<?php echo getInfoUser($_SESSION['user_info']['user_email']); ?>" id="email" placeholder="email" class="form-control" required>
                    </div>
                    <div class="form-group checkout-small-element">
                        <label for="first-name">Tên</label>
                        <input type="text" name="first_name" value="<?php echo getInfoUser($_SESSION['user_info']['first_name']); ?>" id="first_name" placeholder="First name" class="form-control" required>
                    </div>
                    <div class="form-group checkout-small-element">
                        <label for="last-name">Họ tên đệm</label>
                        <input type="text" name="last_name" value="<?php echo getInfoUser($_SESSION['user_info']['last_name']); ?>" id="last-name" placeholder="Last name" class="form-control" required>
                    </div>
                    <div class="form-group checkout-small-element">
                        <label for="phone-number">Số điện thoại</label>
                        <input type="text" name="phone_number" id="phoneNumber" placeholder="Phone number" class="form-control" required pattern="^[0-9]{10,11}">
                    </div>
                   
                    <div class="form-group checkout-large-element">
                        <label for="">Tỉnh/ Thành Phố</label>
                        <select name="provinces" required class="form-control">
                            <option value="">Tỉnh / Thành phố</option>
                        </select>
                        
                    </div>
                    
                    <div class="form-group checkout-large-element">
                        <label for="" class="">Quận/ Huyện</label>
                        <select name="district" required class="form-control">
                        <option value="">Quận / Huyện</option>
                        </select>
                        <input class="billing_address_1" name="" type="hidden" value="">
                        <input class="billing_address_2" name="" type="hidden" value="">
                    </div>

                    <div class="form-group checkout-large-element">
                        <label for="address">Địa chỉ</label>
                        <input type="text" name="address" id="address" placeholder="Address" class="form-control" required>
                    </div>
                    
                </div>

                    <div class="col-lg-5 col-md-6 col-sm-12">
                        <h4>Thông tin đơn hàng</h4>
                        <div class="bill-container">

                 
                        <div class="product-infor">
                            <table class="table">
                                <tbody>
                                <tr style="background: #d2fe85cc;">
                                    <td>Tên sản phẩm</td>    
                                    <td>Tổng</td>    
                                </tr>
                                    <?php if(isset($_SESSION['cart'])) {
                                        foreach ($_SESSION['cart'] as $key => $product) {
                                    ?>
                                    <tr>
                                        <td><?php echo $product['product_name'].'x'.$product['product_quantity']; ?></td>
                                        <td><?php echo $product['product_price']*$product['product_quantity']; ?> đ</td>
                                    </tr>

                                    <?php } } ?>
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="form-group">
                            <div>
                                <input type="radio" name="payments" id="cod" value="cod">
                                <label for="cod">Thanh toán tại nhà</label>
                            </div>
                            <div>
                                <input type="radio" name="payments" id="onl" value="onl">
                                <label for="onl">Thanh toán online</label>
                            </div>
                        </div>


                        <table class="table">
                                <tr style="text-align:left;">
                                    <td>Tiền ship:</td>
                                    <td><?php echo $ship_money; ?> đ</td>
                                </tr>
                                <tr>
                                    <td>Tổng tiền:</td>
                                    <td><?php if($_SESSION['total'] != 0) echo $_SESSION['total'];  ?> đ</td>
                                </tr>
                            </table>
                        <div class="checkout-btn-container">
                            <input type="submit" value="Đặt Hàng" class="btn" name="place_order" id="checkout-btn" class="form-control">
                            <!-- <a type="submit" href="checkout?act=checkout&status=1" class="btn" name="place_order" id="checkout-btn" class="form-control">Đặt hàng</a> -->
                        </div>
                        </div>

                    </div>


            </form>
          
        </div>
    </section>


