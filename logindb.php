<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
include ('admin/config.php');


if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    if(!empty($email) && !empty($password)){
        // $sql = mysqli_query($con,"SELECT  * FROM `user` where email='$email' and password='' ");
        if(mysqli_fetch_array(mysqli_query($con,"SELECT * FROM user where email='$email'"))[3] == ''){
            $_SESSION['error'] = '<div class="alert alert-danger text-center" role="alert">
            You already have an account<br>
            Sign in with Google to continue.
            </div>'; 
            header('location:login.php');
        }
        else{
            if(mysqli_num_rows(mysqli_query($con,"SELECT * FROM user where email='$email' AND password='$password'")) > 0){
                $sql=  mysqli_query($con,"SELECT * from `user` WHERE email='$email'");
                $user_id_fetch= mysqli_fetch_assoc($sql);
                $_SESSION['user_info'] = $user_id_fetch;
                header('location:login.php');
            }
            else{
                $_SESSION['error'] = '<div class="alert alert-danger text-center" role="alert">
                Wrong Email And Password
            </div>'; 
            header('location:login.php');
            }
        }   
    }
}


if(isset($_POST['register'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    if(!empty($email) && !empty($password) && !empty($name)){
        if(mysqli_num_rows(mysqli_query($con,"SELECT * FROM user where email='$email'")) == 0){
           if(mysqli_query($con,"INSERT INTO `user`(`email`, `name`, `password`) VALUES ('$email','$name','$password')")){
            $sql=  mysqli_query($con,"SELECT * from `user` WHERE email='$email'");
            $user_id_fetch= mysqli_fetch_assoc($sql);
            $_SESSION['user_info'] = $user_id_fetch;
            header('location:index.php');
           }
        }
        else{
            $_SESSION['error'] = '<div class="alert alert-danger text-center" role="alert">
                Email has already Exist
            </div>'; 
            header('location:register.php');
        }
    }
}


?>