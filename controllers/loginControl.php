<?php

session_start();
require_once "../models/userModel.php";

if(isset($_POST['login'])){

$email = $_POST['email'];
$password = $_POST['password'];
$user = loginUser($email,$password);

if($user){
 
$_SESSION['user_id']=$user['user_id'];
$_SESSION['name']=$user['name'];
$_SESSION['role']=$user['role'];

if($user['role']=="admin"){
    header("location:../controllers/adminControls.php?page=dashboard");
}
elseif($user['role']=="jobseeker"){
    header("location:../controllers/jobSeekerControls.php?page=dashboard");
}
elseif($user['role']=="employer"){
   header("Location:../controllers/employerControls.php?page=dashboard");
}
exit();
 }
}
else{
    echo "Invalid email or password";
    }

?>