<?php

require_once "../models/userModel.php";
if($_SERVER["REQUEST_METHOD"]=="POST"){

    $name=$_POST['name'];
    $email=$_POST['email'];
    $phone=$_POST['phone'];
    $password=$_POST['password'];
    $role=$_POST['role'];
    if(checkEmail($email)){
        echo "email already exists";
        exit();
    }

    $result=registerUser($name,$email,$phone,$password,$role);

    if($result){
        header("Location: ../views/login.php");
        exit();
    }else{
        echo "Registration failed";
    }

}
?>