<?php
include('config.php');
session_start();
if(isset($_POST['btnlogin']))
{
    $username = $_POST['email'];
    $password = $_POST['password'];
    $result = mysqli_query($con,"SELECT * FROM admin  WHERE email='$username'&& password='$password'");

    if(mysqli_num_rows($result)>0)
        {
            foreach($result as $data)
            {
                $_SESSION["admin"]=$data;
                header("location:index.php");
            }
        }
        else
		{
                $_SESSION["errormsg"] ="Wrong Username And Password ";
			    header("location:login.php");
            
		}

    }
else{
    header("location:login.php");
	$_SESSION["errormsg"] ="Wrong Username And Password ";
}

?>