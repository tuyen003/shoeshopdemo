<?php
  ob_start();
  // session_start();
  
  include("layouts/header.php");
  require("lib/lib.php");
  require("server/connect.php");
  header_title("Thông tin tài khoản");
  

  if(!isset($_SESSION['logged_in'])) {
      header("location: login.php");
      ob_end_flush();
      exit;
    }
    
    if(isset($_POST['change_password_btn'])){
      $user_email = $_SESSION['user_info']['user_email'];
      $password =  $_POST['password'];
      $confirm_password =  $_POST['confirm_password'];
      
      if($password !== $confirm_password){
        header("location: account.php?error=password dont match with confirm password");
        ob_end_flush();
        
      } else if(strlen($password) < 6){
        
        header("location: account.php?error=password must at least 6 characters");
        ob_end_flush();
      } else {
        $stmt = $conn->prepare("UPDATE users SET user_password = ? WHERE user_email= ?");
        $stmt->bind_param('ss', md5($password),$user_email);
        
        if($stmt->execute()){
          header("location: account.php?message=password update successfully");
          ob_end_flush();
        } else {
          header("location: account.php?error=password has been update successfully");
          ob_end_flush();

      }
    }
  
  }


  //Get orders
  if(isset($_SESSION['logged_in'])) {
    $user_id = $_SESSION['user_info']['user_id'];
    $stmt = $conn ->prepare("SELECT * FROM orders WHERE user_id = ?");
    $stmt->bind_param('i', $user_id);
    $stmt->execute();

    $orders = $stmt->get_result();
  }

  if(isset($_GET['logout'])) {
    include('ggapi/config.php');

    //Reset OAuth access token
    $google_client->revokeToken();

    unset($_SESSION['logged_in']);
    unset($_SESSION['user_info']);
    //Destroy entire session data.
    session_destroy();

    //redirect page to index.php
    header("location: login.php");
    exit;
  }



?> 

    <section class="account py-5 my-5">
        <div class="row container mx-auto">
            <div class="text-center col-lg-6 col-md-12 col-sm-12">
                <h3 class="font-weight-bold form-title">Thông tin khách hàng</h3>
                <hr class="mx-auto">
                <div class="account-info">
                    <div class="avatar mb-3">
                        <span class="avatar"><?php echo $_SESSION['user_info']['user_name'][0];  ?></span>
                    </div>
                    <p class="">Tên: <span id="user-name"><?php echo $_SESSION['user_info']['user_name'];  ?></span></p>
                    <p class="">Email: <span id="user-email"><?php echo $_SESSION['user_info']['user_email'];  ?></span></p>
                    <div class="account-btn-container">
                      <a href="account#orders" id="order-btn">Lịch sử mua hàng</a>
                      <a href="account.php?logout=1" id="logout-btn">Đăng xuất</a>
                    </div>
                    
                </div>
            </div>

            <div class="col-lg-6 col-md-12 col-md-12">
                <form action="account.php" method="POST" id="account-form">
                  <p><?php if(isset($_GET['error'])) echo $_GET['error'] ;  ?></p>   
                  <p><?php if(isset($_GET['message'])) echo $_GET['message'] ;  ?></p>   
                <h3>Đổi mật khẩu</h3>
                    <hr class="mx-auto">

                    <div class="form-group">
                        <label for="account-password">Password</label>
                        <input type="password" name="password" value="" id="account-password" placeholder="Password" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="account-password-conform">Confirm Password</label>
                        <input type="password" name="confirm_password" id="account-password-confirm" placeholder="Confirm Password" class="form-control">
                    </div>

                    <div class="form-group mt-4">
                        <input type="submit" name="change_password_btn" value="Change Password" class="btn" id="change-password-btn">
                    </div>
                </form>
            </div>
        </div>
    </section>

    <section id="orders" class="orders container my-5 py-5">
        <div class="container mt-5">
          <h2 class="font-weight-bold text-center">Lịch sử mua hàng</h2>
          <hr class="mx-auto">
        </div>
        <div class="container">
          <select name="order_status" id="order_filter" class="form-control">
            <option value="on_hold">Đang chờ duyệt</option>
            <option value="on_shipping">Đang giao hàng</option>
            <option value="success">Thành công</option>
            <option value="cancel">Đơn hàng hủy</option>
          </select>
        </div>
        <table class="mt-5 pt-5">
          <tr>
            <th>Mã</th>
            <th style="text-align:left;">Tổng tiền</th>
            <th>Trạng thái</th>
            <th>Ngày đặt</th>
            <th>Chi tiết</th>
          </tr>
          <?php while($row = $orders->fetch_assoc()) { ?>
            <tr>
              <td>
                <span><?php echo $row['order_id'];?></span>
              </td>
              
              <td>
                <span><?php echo $row['order_cost'];?> đ</span>
              </td>
              <td>
                <span><?php echo statusOrder($row['order_status']);?></span>
              </td>
              <td>
                <span><?php echo $row['order_date'];?></span>
              </td>
              <td>
                <form action="order_detail.php" method="GET">
                  <input type="hidden" name="order_id" value="<?php echo $row['order_id']; ?>" >
                  <input type="submit" value="Xem chi tiết" class="detail_order_btn" name="order_detail_btn" class="btn" data-order-id="<?php echo $row['order_id']; ?>" >
                </form>
              </td>
              
            </tr>
            <?php } ?>
          </table>
  
      </section>


      <section id="order-details">
        <div id="overlay-bg"></div>
        <div class="order-detail-container">
        <div id="close_popup"><i class="fa-solid fa-xmark"></i></div>
      <div class="container mt-5">
          <h2 class="font-weight-bold text-center form-title">Chi tiết đơn hàng</h2>
          <hr class="mx-auto">
        </div>
  
        <table class="mt-5 pt-5" id="table-orders">
          <!-- <tr>
            <th>Product Name</th>
            <th style="text-align:left;">Price</th>
            <th>Quantity</th>

          </tr> -->
     
          </table>
          </div>
      </section>



<?php
  include("layouts/footer.php");
?>

