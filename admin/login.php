<?php
session_start();
include('includes/header.php'); 
require("../server/connect.php");


//   print_r($_SESSION);
if(isset($_SESSION['admin_logged_in'])) {
    header("location: index.php");
    exit;
} 

//   print_r($_POST);
if(isset($_POST['login_btn'])) {
    $admin_email = $_POST['email'];
    $admin_password = md5($_POST['password']);
  
    $stmt = $conn->prepare("SELECT admin_id,admin_fullname,admin_email,admin_password FROM admin WHERE admin_email  = ? AND admin_password = ?");  
    $stmt->bind_param('ss',$admin_email,$admin_password);
    if($stmt->execute()){
          $stmt->bind_result($admin_id,$admin_fullname,$admin_email,$admin_password);
          $stmt->store_result();

          if($stmt->num_rows() == 1){
              $stmt->fetch();
              
              $_SESSION['admin_info']['admin_id'] = $admin_id;
              $_SESSION['admin_info']['admin_name'] = $admin_fullname;
              $_SESSION['admin_info']['admin_email'] = $admin_email;
              $_SESSION['admin_logged_in'] = true;
             
              header("location: index.php");
          }else {
              header("location: login.php?error=login fail");
          }
      } 
   
  } 


?>




<div class="container">

<!-- Outer Row -->
<div class="row justify-content-center">

  <div class="col-xl-6 col-lg-6 col-md-6">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-12">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Đăng nhập Admin</h1>
                <?php

                    if(isset($_SESSION['status']) && $_SESSION['status'] !='') 
                    {
                        echo '<h2 class="bg-danger text-white"> '.$_SESSION['status'].' </h2>';
                        unset($_SESSION['status']);
                    }
                ?>
              </div>

                <form class="user" action="login.php" method="POST">

                    <div class="form-group">
                    <input type="email" name="email" class="form-control form-control-user" placeholder="Enter Email Address...">
                    </div>
                    <div class="form-group">
                    <input type="password" name="password" class="form-control form-control-user" placeholder="Password">
                    </div>
            
                    <button type="submit" name="login_btn" class="btn btn-login btn-user btn-block"> Đăng nhập </button>
                    <hr>
                </form>


            </div>

          </div>
        </div>
      </div>
    </div>

  </div>

</div>

</div>


<?php
include('includes/scripts.php'); 
?>