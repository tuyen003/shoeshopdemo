<?php

//   session_start();
    include("layouts/header.php");
    header_title("Đặt hàng");

//   if( !empty($_SESSION['cart']) && isset($_POST['checkout'])){
//       // user in


//       // no user in
//   } else {
//       header("location: index.php");
//   }



?> 


    <section class="py-5 my-5">
        <div class="container text-center mt-3 pt-5">
            <h2 class="form-weight-bold">Payment</h2>
            <hr class="mx-auto">
        </div>
        <div class="mx-auto container text-center">
            <form action="" method="POST" id="checkout-form">

                    <p class="my-2" ><?php echo $_GET['order_status'];?></p>
                    <p class="my-2" >Total amount: $ <?php echo $_SESSION['total']; ?></p>
                    <input type="submit" value="Pay now" class="btn btn-primary mt-4" name="place_order" id="payment-btn" class="form-control">
              
             
            </form>
        </div>
    </section>



<?php
  include("layouts/footer.php");
?>