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
   $result= mysqli_query($conn,$sql);
    if($result){
        $user_id=mysqli_insert_id($conn);
        if($role=="jobseeker"){
            $sql1="INSERT INTO jobseekers(user_id,resume_file,skills,education,experience) 
            VALUES ('$user_id','','','','')";
            mysqli_query($conn,$sql1);
 
        }
        elseif($role=="employer"){
            $sql2="INSERT INTO employers(user_id,company_name,company_address) 
            VALUES ('$user_id','','')";
            mysqli_query($conn,$sql2);
        }
        return true;
    }
    return false;
}
 
function updatePassword($email,$password){
    global $conn;
    $hashedPass=password_hash($password,PASSWORD_DEFAULT);
    $sql="UPDATE users SET password='$hashedPass' WHERE email='$email'";
    return mysqli_query($conn,$sql);
 
    
}
?>