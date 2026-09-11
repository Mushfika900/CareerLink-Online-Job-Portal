<?php
session_start();
 
require_once "../vendor/autoload.php";
require_once "../config/mail.php";
 
if(isset($_SESSION['reset_email'])){
 
    $email=$_SESSION['reset_email'];
 
    $otp=rand(100000,999999);
 
    $_SESSION['reset_otp']=$otp;
    $_SESSION['otp_time']=time();
 
    sendOtp($email,$otp);
 
    header("Location:../views/verify_otp.php");
    exit();
 
}
else{
    echo "Session expired";
}
?>