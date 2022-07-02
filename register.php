<?php
    ob_start();
    // session_start();
    include("layouts/header.php");
    require("server/connect.php");
    header_title("Đăng ký tài khoản");
    $error = array();
    
  if(isset($_SESSION['logged_in'])){
    header("location: account.php");
    exit;
  }

  if(isset($_POST['register'])) {
      
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        if($password !== $confirm_password){
            $error['password_match'] = "Mật khẩu không trùng khớp";
        }

        if(strlen($password) < 6){
            $error['password'] = "Độ dài mật khẩu quá ngắn";
        }
        //check whether there is a user with this email
        $stmt = $conn->prepare("SELECT count(*) FROM users WHERE user_email = ?");
        $stmt ->bind_param("s",$email);
        $stmt ->execute();
        $stmt->store_result();
        $stmt->bind_result($num_rows);
        $stmt->fetch();
        if($num_rows !=0 ){
            $error['eamil'] = "Email này đã tồn lại";
            // header("location: register.php?error=user with this email already exists");  
        }
        
        if(empty($error)) {
            $stmt1 = $conn->prepare("INSERT INTO users(first_name,last_name,user_email,user_password)
            VALUES (?,?,?,?)");
            $password = md5($password);
            $stmt1 ->bind_param('ssss',$first_name,$last_name,$email,$password);

            if($stmt1->execute()) {
            $user_id = $stmt1->insert_id;

            $_SESSION['user_info']['user_id'] = $user_id;
            $_SESSION['user_info']['user_email'] = $email;
            $_SESSION['user_info']['first_name'] = $first_name;
            $_SESSION['user_info']['last_name'] = $last_name;
            $_SESSION['user_info']['user_name'] = $first_name.' '.$last_name;
            $_SESSION['logged_in'] = true;

            header("location: account.php?register=Your register successfully");
            }

        } else {
                // header("location: register.php?error=Could not create an account at the moment");
                echo '<script>swal("Đăng ký thất bại", "", "error");</script>';
                // sleep(10);

        }
    }

    ob_end_flush();

?> 


    <section class="register py-5">
        <div class="container text-center pt-2">
            <h2 class="form-weight-bold  form-title">Đăng ký tài khoản</h2>
            <hr class="mx-auto">
        </div>
        <div class="mx-auto container">
            <form action="register.php" method="POST" id="register-form">
                <p > <?php if(isset($_GET['error'])) echo $_GET['error']; ?></p>
                <div class="form-group">
                    <label for="firstname">Tên</label>
                    <input type="text" name="first_name" value="<?= isset($first_name)? "{$first_name}":""; ?>" id="firstname" placeholder="firstname" class="form-control" required>
                </div>
                <div class="form-group mt-4">
                    <label for="lastname">Họ tên đệm</label>
                    <input type="text" name="last_name" id="lastname" value="<?= isset($last_name)? "{$last_name}":""; ?>" placeholder="lastname" class="form-control" required>
                </div>
                <div class="form-group mt-4">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" value="<?= isset($email)? "{$email}":""; ?>" placeholder="email" class="form-control" required pattern="^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$">
                </div>
                <div class="form-group mt-4">
                    <label for="password">Mật khẩu</label>
                    <input type="password" name="password" value="<?= isset($password)? "{$password}":""; ?>" id="password" placeholder="password" class="form-control" required>
                </div>
                <div class="form-group mt-4">
                    <label for="confirm-password">Nhập lại mật khẩu</label>
                    <input type="password" name="confirm_password" value="<?= isset($confirm_password)? "{$confirm_password}":""; ?>" id="confirm-password" placeholder="confirm password" class="form-control" required>
                </div>
                <div class="form-group mt-6">
                    <input type="submit" value="Đăng ký" class="btn" name="register" id="register-btn" class="form-control" required>
                </div>
                <div class="form-group">
                    <a href="login.php" id="login-url" class="btn" >Bạn đã có tài khoản chưa? Đăng nhập</a>
                </div>

            </form>
        </div>
    </section>

    



 <?php 
    include("layouts/footer.php");
 ?>
