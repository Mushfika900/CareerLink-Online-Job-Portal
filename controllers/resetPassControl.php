<?php
session_start();
require_once "../models/userModel.php";

if(isset($_POST['newPass'])){

$newPass = $_POST['newPass'];
$confirmPass = $_POST['confirmPass'];
if($newPass==$confirmPass){
    $email=$_SESSION['reset_email'];
    updatePassword($email,$newPass);
    session_destroy();
    header("Location:../views/resetPass_success.php");
    exit();    
    }
    else{
        echo "Password not matched";
    }
}
?>