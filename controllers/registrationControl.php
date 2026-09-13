<?php
session_start();

require_once "../vendor/autoload.php";
require_once "../models/userModel.php";
require_once "../config/mail.php";

if($_SERVER["REQUEST_METHOD"]=="POST")
{
    $name=trim($_POST["name"]);
    $email=trim($_POST["email"]);
    $phone=trim($_POST["phone"]);
    $password=$_POST["password"];
    $role=$_POST["role"]??"";

    $hasError=false;

    $nameError="";
    $emailError="";
    $phoneError="";
    $passError="";
    $roleError="";

    if(empty($name))
    {
        $nameError="Name cannot be empty";
        $hasError=true;
    }
    elseif(!preg_match('/^[a-zA-Z\' -]+$/',$name))
    {
        $nameError="Name can contain letters only";
        $hasError=true;
    }

    if(empty($email))
    {
        $emailError="Email cannot be empty";
        $hasError=true;
    }
    elseif(!filter_var($email,FILTER_VALIDATE_EMAIL))
    {
        $emailError="Provide a valid email";
        $hasError=true;
    }
    elseif(checkEmail($email))
    {
        $emailError="Email already exists";
        $hasError=true;
    }

    if(empty($phone))
    {
        $phoneError="Phone cannot be empty";
        $hasError=true;
    }

    if(empty($password))
    {
        $passError="Password cannot be empty";
        $hasError=true;
    }
    elseif(strlen($password)<8)
    {
        $passError="Password must be at least 8 characters";
        $hasError=true;
    }

    if(empty($role))
    {
        $roleError="Please select a role";
        $hasError=true;
    }

    if($hasError)
    {
        $url="../views/registration.php?nameError=".urlencode($nameError)
        ."&emailError=".urlencode($emailError)
        ."&phoneError=".urlencode($phoneError)
        ."&passError=".urlencode($passError)
        ."&roleError=".urlencode($roleError);

        header("Location:".$url);
        exit();
    }
    else
    {
        $otp=rand(100000,999999);

        $_SESSION['register_name']=$name;
        $_SESSION['register_email']=$email;
        $_SESSION['register_phone']=$phone;
        $_SESSION['register_password']=$password;
        $_SESSION['register_role']=$role;

        $_SESSION['reset_otp']=$otp;
        $_SESSION['otp_time']=time();
        $_SESSION['otp_type']="registration";

        if(sendOTP($email,$otp,"registration"))
        {
            header("Location:../views/verify_otp.php");
            exit();
        }
        else
        {
            echo "OTP sending failed";
        }
    }
}
?>