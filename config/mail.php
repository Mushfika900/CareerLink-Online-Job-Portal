<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function sendOTP($email,$otp,$type="reset"){
  $mail = new PHPMailer(true);

  try{
 
    $mail->isSMTP();
    $mail->Host="smtp.gmail.com";
    $mail->SMTPAuth=true;
    $mail->Username="mushfikaafia@gmail.com";
    $mail->Password="tjpp tggz evvl vveu";
    $mail->SMTPSecure="tls";
    $mail->Port=587;
    $mail->setFrom("mushfikaafia@gmail.com","CareerLink");
    $mail->addAddress(trim($email));
    if($type=="registration"){
      $mail->Subject="CareerLink Email Verification";
      $mail->Body="Your CareerLink registration verification code is ".$otp;
      }
      else{
       $mail->Subject="Password Reset OTP";
       $mail->Body="Your Password reset OTP is ".$otp;
      }
   
    $mail->send();
    return true;

    }
    catch(Exception $e)
    {
        return false; 
    }
}
?>