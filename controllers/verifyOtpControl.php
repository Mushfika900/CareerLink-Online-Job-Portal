<?php
session_start();
if (isset($_POST['verify'])){
    $otp=$_POST['otp'];
    if($otp==$_SESSION['reset_otp']){
        header("Location:../views/resetPass.php");
        exit();
    }
    else{
        echo "Invalid otp";
    }
}


?>