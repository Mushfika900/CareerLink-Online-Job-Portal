<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function sendOTP($email,$otp){
  $mail = new PHPMailer(true);

  try{
 
    $mail->isSMTP();
    $mail->Host="smtp.gmail.com";
    $mail->SMTPAuth=true;
    $mail->Username="mushfikaafia@gmail.com";
    $mail->Password="gvbg ubqz vkeg gyyz";
    $mail->SMTPSecure="tls";
    $mail->Port=587;
    $mail->setFrom("mushfikaafia@gmail.com","CareerLink");
    $mail->addAddress(trim($email));
    $mail->Subject="Password Reset OTP";
    $mail->Body="Your OTP is ".$otp;
     $mail->send();
     return true;

    }
    catch(Exception $e)
    {
        return false; 
    }
}
?>