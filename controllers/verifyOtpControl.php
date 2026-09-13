
 <?php
session_start();
require_once"../models/userModel.php";
 
if(isset($_POST['verify'])){
 
    $otp=$_POST['otp'];

    if(time()-$_SESSION['otp_time']>120){
        echo "OTP expired";
        exit();
    }
 
    if($otp==$_SESSION['reset_otp'] && $_SESSION['otp_type']=="registration"){
            $result=registerUser(
                $_SESSION['register_name'],
                $_SESSION['register_email'],
                $_SESSION['register_phone'],
                $_SESSION['register_password'],
                $_SESSION['register_role']
            );
            if($result){
                unset(
                $_SESSION['register_name'],
                 $_SESSION['register_email'],
                $_SESSION['register_phone'],
                $_SESSION['register_password'],
                $_SESSION['register_role'],
                $_SESSION['reset_otp'],
                $_SESSION['otp_time'],
                $_SESSION['otp_type']);
                header("Location:../views/login.php");
                exit();

            }
            else{
 
        echo "Registration failed";
 
    }
        }
        else{
        header("Location:../views/resetPass.php");
        exit();
    } }
    else{
        echo"Invalid OTP";
    }
 
    

?>