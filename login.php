<?php
ob_start();
//   session_start();
include("layouts/header.php");

require("server/connect.php");
require("server/getUser.php");
header_title("Đăng nhập");
$_SESSION['forgot_pass'] = 0;

if(isset($_SESSION['logged_in'])) {
    header("location: account.php");
    exit;
} 

if(isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $stmt = $conn->prepare("SELECT user_id,first_name,last_name,user_name,user_email,user_password FROM users WHERE user_email = ? AND user_password = ?");  
    $stmt->bind_param('ss',$email,$password);
    if($stmt->execute()){
        $stmt->bind_result($user_id,$first_name,$last_name,$user_name,$user_email,$user_password);
        $stmt->store_result();

        if($stmt->num_rows() == 1){
            $stmt->fetch();
            
            $_SESSION['user_info']['user_id'] = $user_id;
            $_SESSION['user_info']['user_name'] = $user_name;
            $_SESSION['user_info']['first_name'] = $first_name;
            $_SESSION['user_info']['last_name'] = $last_name;
            $_SESSION['user_info']['user_email'] = $user_email;
            $_SESSION['logged_in'] = true;
            
            header("location: account.php");
        }else {
            $_SESSION['forgot_pass'] =  $_SESSION['forgot_pass'] + 1;
            header("location: login.php?error=login fail");
        }
    } 
     
 } 

// ob_end_flush();

?> 
<?php

// Login với gg
// ob_start();
//Include Configuration File
include('ggapi/config.php');


if(isset($_GET["code"]))
{

 $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);


 if(!isset($token['error']))
 {
 
    $google_client->setAccessToken($token['access_token']);

    
    $_SESSION['access_token'] = $token['access_token'];


    $google_service = new Google_Service_Oauth2($google_client);

    
    $data = $google_service->userinfo->get();



    
    if(!empty($data['given_name']))
    {
    $_SESSION['user_info']['first_name'] = $data['given_name'];
    }

    if(!empty($data['family_name']))
    {
        $_SESSION['user_info']['last_name'] = $data['family_name'];
    }
    if(!empty($data['name']))
    {
        $_SESSION['user_info']['user_name'] = $data['name'];
    }

    if(!empty($data['email']))
    {
        $_SESSION['user_info']['user_email'] = $data['email'];
    }

    $_SESSION['logged_in'] = true; 
    $user_email_temp =  $_SESSION['user_info']['user_email'];
    if(checkUserExists($user_email_temp)) {
        $user = getUser($user_email_temp);
            $_SESSION['user_info']['user_id'] = $user[0]['user_id'];
            header("location: account.php");
            // exit;
    } else {
        $fname = $_SESSION['user_info']['first_name'];
        $lname = $_SESSION['user_info']['last_name'];
        $pass = md5($user_email_temp);
        if(setUser($fname,$lname,$user_email_temp,$pass)){
            $user = getUser($user_email_temp);
            $_SESSION['user_info']['user_id'] = $user[0]['user_id'];
            header("location: account.php");
            // exit;
        }
    }

 }
}

// ob_end_flush();
?>




<section class="login py-5">
        <div class="container text-center pt-2">
            <h2 class="form-weight-bold form-title">Đăng nhập</h2>
            <hr class="mx-auto">
        </div>
        <div class="mx-auto container">
            <form action="login.php" method="POST" id="login-form">
                <p><?php if(isset($_GET['error'])){ echo $_GET['error']; } ?></p>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" placeholder="email" class="form-control" required>
                </div>
                <div class="form-group mt-4">
                    <label for="password">Mật khẩu</label>
                    <input type="password" name="password" placeholder="Password" class="form-control id="password" required>
                </div>
                <div class="form-group mt-6">   
                <?php
                    echo '<a href="'.$google_client->createAuthUrl().'" class="btn btn-google btn-block btn-outline"><i class="fa-brands fa-google"></i> Đăng nhập bằng Google</a>';
                ?>
                
                </div>

                <div class="form-group">
                    <input type="submit" value="Đăng nhập" class="btn" name="login" id="login-btn" class="form-control">
                </div>
              

                <div class="form-group">
                    <a href="register.php" id="register-url" class="btn">Bạn chưa có tài khoản? Đăng ký</a>
                </div>

                <?php if($_SESSION['forgot_pass'] > 3){
                    echo '<div class="form-group">
                    <a href="register.php" id="register-url" class="btn">Quên mật khẩu</a>
                    </div>';
                    $_SESSION['forgot_pass'] = 0;
                }
                ?>

            </form>
        </div>
    </section>

<?php
  include("layouts/footer.php");
?>