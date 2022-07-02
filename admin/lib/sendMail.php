<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function sendMail($toMail,$name){

    require 'PHPMailer/Exception.php';
    require 'PHPMailer/PHPMailer.php';
    require 'PHPMailer/SMTP.php';

    $mail = new PHPMailer(true);

    try {
        //Server settings
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->SMTPDebug = 0;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'shoeshop1245@gmail.com';                     //SMTP username
        $mail->Password   = 'nrsqecvgsgtkhsht';                               //SMTP password
        $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        $mail->CharSet = 'UTF-8';
   
        //Recipients
        $mail->setFrom('shoeshop1245@gmail.com', 'Shoe Shop');
        $mail->addAddress($toMail, $name);     //Add a recipient
        $mail->addReplyTo('shoeshop1245@gmail.com', 'Shoe Shop');


        //Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Shoe Shop - Thông báo đơn hàng';
        $mail->Body    = 'Đơn hàng của <b><i>'.$name.'</i></b> đã được duyệt. Đơn hàng sẽ được giao đến  <b>trong 3- 5 ngày</b>.';
        // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
       return true;
    } catch (Exception $e) {
        // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        return false;
    }
}


// sendMail('tuyenpv2703@gmail.com','Tuyển PV');