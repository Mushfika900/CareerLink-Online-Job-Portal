
 <?php
session_start();
 
if(isset($_POST['verify'])){
 
    $otp=$_POST['otp'];

    if(time()-$_SESSION['otp_time']>120){
        echo "OTP expired";
        exit();
    }
 
    if($otp==$_SESSION['reset_otp']){
 
        header("Location:../views/resetPass.php");
        exit();
 
    }
    
    else{
 
        echo "Invalid otp";
 
    }
 
}
?>