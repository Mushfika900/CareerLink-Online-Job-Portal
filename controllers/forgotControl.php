<?php
session_start();
require_once "../models/userModel.php";

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $email=$_POST['email'];

    if(checkEmail($email)){
        $otp=rand(100000,999999);
        $_SESSION['reset_email']=$email;
        $_SESSION['reset_otp']=$otp;
        
        header("Location:../views/verify_otp.php");
        exit();
    }else{
        echo "Email not found";
    }
}
?>