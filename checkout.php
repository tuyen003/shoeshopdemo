<?php

//   session_start();
 include("layouts/header.php");
 header_title("Đặt hàng");
 include("lib/lib.php");


 $ship_money = 23000;


  if( !empty($_SESSION['cart']) && isset($_POST['checkout'])){
      // user in
      // print_r($_SESSION['user_info']);

      // no user in
  } else {
      header("location: index.php");
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
            <form action="checkout.php" method="POST" class="row" id="checkout-form">
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
                        <input type="text" name="phone_number" id="phoneNumber" placeholder="Phone number" class="form-control" required>
                    </div>
                    <!-- <div class="form-group checkout-large-element">
                        <label for="city">Thành phố/ Tỉnh</label>
                        <input type="text" name="city" id="city" placeholder="City" class="form-control" required>
                    </div> -->
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
                            <!-- <input type="submit" value="Đặt Hàng" class="btn" name="place_order" id="checkout-btn" class="form-control"> -->
                            <a type="submit" href="checkout?act=checkout&status=1" class="btn" name="place_order" id="checkout-btn" class="form-control">Đặt hàng</a>
                        </div>
                        </div>

                    </div>


            </form>
          
        </div>
    </section>




<?php
  include("layouts/footer.php");
?>


<script src='assets/js/lib/districts.min.js?v<?php echo time();?>'> </script>
<script>//<![CDATA[
if (address_2 = localStorage.getItem('address_2_saved')) {
  $('select[name="district"] option').each(function() {
    if ($(this).text() == address_2) {
      $(this).attr('selected', '')
    }
  })
  $('input.billing_address_2').attr('value', address_2)
}
if (district = localStorage.getItem('district')) {
  $('select[name="district"]').html(district)
  $('select[name="district"]').on('change', function() {
    var target = $(this).children('option:selected')
    target.attr('selected', '')
    $('select[name="district"] option').not(target).removeAttr('selected')
    address_2 = target.text()
    $('input.billing_address_2').attr('value', address_2)
    district = $('select[name="district"]').html()
    localStorage.setItem('district', district)
    localStorage.setItem('address_2_saved', address_2)
  })
}
$('select[name="provinces"]').each(function() {
  var $this = $(this),
    stc = ''
  c.forEach(function(i, e) {
    e += +1
    stc += '<option value=' + e + '>' + i + '</option>'
    $this.html('<option value="">Tỉnh / Thành phố</option>' + stc)
    if (address_1 = localStorage.getItem('address_1_saved')) {
      $('select[name="provinces"] option').each(function() {
        if ($(this).text() == address_1) {
          $(this).attr('selected', '')
        }
      })
      $('input.billing_address_1').attr('value', address_1)
    }
    $this.on('change', function(i) {
      i = $this.children('option:selected').index() - 1
      var str = '',
        r = $this.val()
      if (r != '') {
        arr[i].forEach(function(el) {
          str += '<option value="' + el + '">' + el + '</option>'
          $('select[name="district"]').html('<option value="">Quận / Huyện</option>' + str)
        })
        var address_1 = $this.children('option:selected').text()
        var district = $('select[name="district"]').html()
        localStorage.setItem('address_1_saved', address_1)
        localStorage.setItem('district', district)
        $('select[name="district"]').on('change', function() {
          var target = $(this).children('option:selected')
          target.attr('selected', '')
          $('select[name="district"] option').not(target).removeAttr('selected')
          var address_2 = target.text()
          $('input.billing_address_2').attr('value', address_2)
          district = $('select[name="district"]').html()
          localStorage.setItem('district', district)
          localStorage.setItem('address_2_saved', address_2)
        })
      } else {
        $('select[name="district"]').html('<option value="">Quận / Huyện</option>')
        district = $('select[name="district"]').html()
        localStorage.setItem('district', district)
        localStorage.removeItem('address_1_saved', address_1)
      }
    })
  })
})
//]]></script> 






<?php
ob_start();
// session_start();
require('server/connect.php');
if(isset($_POST['act'])) {
  // if(isset($_POST['status'])){

    //1. get user info and store it in DB
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $city = $_POST['provinces'];
    $district = $_POST['district'];
    $address = $_POST['address'];
    $order_cost = $_SESSION['total'];
    $order_status = 'on_hold';
    $user_id = $_SESSION['user_info']['user_id'];
    $user_name = $_SESSION['user_info']['user_name'];
    $order_date = date('Y-m-d H:i:s');

    echo "Đã chạy";
    //3. issue new order and store order info in DB
    $stmt = $conn->prepare("INSERT INTO orders (order_cost,order_status,user_id,user_name,user_email,user_phone,user_city,user_district,user_address, order_date)
                VALUES (?,?,?,?,?,?,?,?,?,?); ");

    $stmt->bind_param('isississss',$order_cost,$order_status,$user_id,$user_name,$email,$phone_number,$city,$district,$address,$order_date);
    
    $stmt->execute();

    $order_id = $stmt->insert_id;
    //2. get products from cart (from session)
    foreach ($_SESSION['cart'] as $key => $value) {
        # code...
        $product = $_SESSION['cart'][$key];
        $product_id = $product['product_id'];
        $product_name = $product['product_name'];
        $product_image = $product['product_image'];
        $product_price = $product['product_price'];
        $product_quantity = $product['product_quantity'];
        $product_size = $product['product_size'];

        //4. store each single item in order_items DB
        $stmt1 = $conn->prepare("INSERT INTO order_items (order_id,product_id,product_name,product_image,product_price,product_quantity,user_id,order_date,product_size)
                        VALUES (?,?,?,?,?,?,?,?,?);");
        $stmt1->bind_param('iissiiisi',$order_id,$product_id,$product_name,$product_image,$product_price,$product_quantity,$user_id,$order_date,$product_size);
        $stmt1->execute();
    }
    
    echo "Đã chạy";
    //5. Remove everything from cart --> delay until payment is done
    unset($_SESSION['cart']);

    //6. inform user whether everything is fine or there is a problem
    header('location: cart.php?order_status="order payment successfully"');
    
  // }
} else {
  
  header('location: checkout.php?order_status="order error"');
}
?>