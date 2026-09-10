<?php
require_once __DIR__."/../config/dbConnect.php";

function loginUser($email,$password){
    global $conn;
    $sql="SELECT * FROM users WHERE email='$email'";
    $result=mysqli_query($conn,$sql);
    
    if(mysqli_num_rows($result)==1){
        $user=mysqli_fetch_assoc($result);

        if(password_verify($password,$user['password'])){
            return $user;
        }

    }
    return false;
}
function checkEmail($email){
    global $conn;

    $sql="SELECT * FROM users WHERE email='$email'";
    $result=mysqli_query($conn,$sql);

    return mysqli_num_rows($result)>0;
}

function registerUser($name,$email,$phone,$password,$role){
    global $conn;
    $password=password_hash($password,PASSWORD_DEFAULT);
    $sql="INSERT INTO users(name,email,phone,password,role)
     VALUES('$name','$email','$phone','$password','$role')";
    return mysqli_query($conn,$sql);
}
?>