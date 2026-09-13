<?php
session_start();
 
require_once "../vendor/autoload.php";
require_once "../config/mail.php";
 
if(isset($_SESSION['otp_type'])){
   $otp=rand(100000,999999);
 
    $_SESSION['reset_otp']=$otp;
    $_SESSION['otp_time']=time();

     
if(isset($_SESSION['otp_type'])=="registration"){
    $email=$_SESSION['register_email'];
 
    sendOtp($email,$otp,"registration");}
    elseif($_SESSION['otp_type']=="reset"){
         $email=$_SESSION['reset_email'];
        sendOtp($email,$otp,"reset");
        }
 
 
    header("Location:../views/verify_otp.php");
    exit();
 
}
else{
    echo "Session expired";
}

?>