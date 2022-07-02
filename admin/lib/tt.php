<?php

    // Subscribe my channel if you are using this code
    // Subscribe my channel if you are using this code
    // Subscribe my channel if you are using this code
    // Subscribe my channel if you are using this code
    // Subscribe my channel if you are using this code


    use PHPMailer\PHPMailer\PHPMailer;
    function sendmail(){
        $name = "Shoe Shop";  // Name of your website or yours
        $to = "tuyenpv2703@gmail.com";  // mail of reciever
        $subject = "Tutorial or any subject";
        $body = "Send Mail Using PHPMailer - MS The Tech Guy";
        $from = "shoeshop1245@gmail.com";  // you mail
        $password = "nrsqecvgsgtkhsht";  // your mail password

        // Ignore from here

        require_once "PHPMailer/PHPMailer.php";
        require_once "PHPMailer/SMTP.php";
        require_once "PHPMailer/Exception.php";
        $mail = new PHPMailer();

        // To Here

        //SMTP Settings
        $mail->isSMTP();
        // $mail->SMTPDebug = 3;  Keep It commented this is used for debugging                          
        $mail->Host = "smtp.gmail.com"; // smtp address of your email
        $mail->SMTPAuth = true;
        $mail->Username = $from;
        $mail->Password = $password;
        $mail->Port = 587;  // port
        $mail->SMTPSecure = "tls";  // tls or ssl
        $mail->smtpConnect([
        'ssl' => [
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
            ]
        ]);

        //Email Settings
        $mail->isHTML(true);
        $mail->setFrom($from, $name);
        $mail->addAddress($to); // enter email address whom you want to send
        $mail->Subject = ("$subject");
        $mail->Body = $body;
        if ($mail->send()) {
            echo "Email is sent!";
        } else {
            echo "Something is wrong: <br><br>" . $mail->ErrorInfo;
        }
    }


        // sendmail();  // call this function when you want to

        if (isset($_GET['sendmail'])) {
            sendmail();
        }
?>


<html>
    <head>
        <title>Send Mail</title>
    </head>
    <body>
        <form method="get">
            <button type="submit" name="sendmail">sendmail</button>
        </form>
    </body>
</html>















<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
include("includes/header.php");
require("../server/connect.php");
require("lib/lib.php");
require("lib/sendMail.php");


if(!isset($_SESSION['admin_logged_in'])){
    header("location: login.php");
    exit;
}


if(isset($_GET['order_id'])){
    $order_id = $_GET['order_id'];
    $stmt = $conn->prepare("SELECT * FROM orders WHERE order_id = ?");
    $stmt -> bind_param("i",$order_id);
    $stmt->execute();
    $orders = $stmt ->get_result(); // []
    
    foreach ($orders as $order) {
        $_SESSION['Email']  =  $order['user_email'];
        $_SESSION['Name']  = $order['user_name'];
    }
    // no product not found
} else if(isset($_POST['edit_order'])) {
    $order_status = $_POST['order_status'];
    $order_status_cost = $_POST['order_status_cost'];
    $order_id = $_POST['order_id'];

    $stmt = $conn ->prepare("UPDATE `orders` SET `order_status`=?, `order_status_cost`=? WHERE `order_id`= ? ");
    $stmt ->bind_param('ssi',$order_status,$order_status_cost,$order_id);

    if($stmt->execute()) {

        if(sendMail( $_SESSION['Email'], $_SESSION['Name'])){
            unset( $_SESSION['Email']);
            unset( $_SESSION['Name']);
            header('location: orders.php?success=order update status successfully');
            exit;
        } else {
            echo sendMail($_SESSION['Email'],$_SESSION['Name']);
        }
     
    } else {
        header('location: orders.php?error=order update status error');
        exit;
    }

}

print_r($_SESSION);

?>

<?php 
    include("includes/navbar.php");
?>

     
            <div class="container-fluid">
                <h2>Theo dõi đơn hàng</h2>
                <hr>
            </div>
            <!-- /.container-fluid -->

            <div class="container-fluid">
                <div class="table-responsive">
                    <form action="order_edit.php" method="POST" enctype="multipart/form-data"  >

                    <?php foreach ($orders as $order) {
                        
                    ?>

                        <div class="form-group my-3">
                            <label for="">Mã đơn hàng</label>
                            <input type="text" value="<?php echo $order['order_id'];?>" class="form-control" disabled>
                            
                        </div>
                        <div class="form-group my-3">
                            <label for="">Tổng tiền đơn hàng</label>
                            <input type="text" value="<?php echo $order['order_cost'];?>" class="form-control" disabled>
                            
                            </div>
                        <div class="form-group my-3">
                            <label for="">Trạng thái đơn hàng</label>

                            <select name="order_status" id="" required class="form-select form-control">
                                <option value="on_hold" <?php if($order['order_status'] == 'on_hold') echo "selected"; ?> >Đang chờ duyệt</option>   
                                <option value="cancel" <?php if($order['order_status'] == 'cancel') echo "selected"; ?>>Hủy đơn hàng</option>   
                                <option value="on_shipping" <?php if($order['order_status'] == 'on_shipping') echo "selected"; ?>>Đang giao hàng</option>   
                                  
                                <option value="delivered" <?php if($order['order_status'] == 'delivered') echo "selected"; ?>>Thành công</option>   

                                </select>

                        </div>
                        <div class="form-group my-3">
                            <label for="">Trạng thái thanh toán</label>

                            <select name="order_status_cost" id="" required class="form-select form-control">
                                <option value="paid">Đã thanh toán</option>   
                                <option value="not_paid">Chưa thanh toán</option>   
                                <option value="onl_paid">Chưa thanh toán</option>   
                              
                                </select>

                        </div>
                        
                        <div class="form-group my-3">
                            <label for="">Ngày đặt hóa đơn</label>
                            <input type="text" value="<?php echo $order['order_date'];?>" class="form-control" disabled>
                        </div>

                            <div class="form-group mt-2">
                                <input type="hidden" name="order_id" value="<?php echo $order['order_id'];?>" >
                                <input type="submit" class="btn btn-primary" name="edit_order" id="update-btn" value="Cập nhật">
                            </div>
                    
                    <?php } ?>
                    </form>
                </div>
            </div>


<?php
include("includes/footer.php");

?>
