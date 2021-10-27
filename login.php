<?php 

if(!isset($_SESSION)) 
{ 
    session_start(); 
} 






include('google-config.php');
include('admin/config.php');



$login_button = '';

if(isset($_GET["code"]))
{

    $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);

    if(!isset($token['error']))
    {
    
    $google_client->setAccessToken($token['access_token']);

    $_SESSION['access_token'] = $token['access_token'];

    $google_service = new Google_Service_Oauth2($google_client);
    
    $data = $google_service->userinfo->get();

   
    $name = $data['given_name'];
    $email = $data['email'];

    
        // insert new user into db
        $check_new_user = mysqli_num_rows(mysqli_query($con,"SELECT * FROM user where email='$email'"));
        if($check_new_user == 0){
            mysqli_query($con,"INSERT INTO `user`(`email`, `name`)
            VALUES ('$email','$name')");
            $user_id=  mysqli_query($con,"SELECT * from `user` WHERE email='$email'");
            $user_id_fetch = mysqli_fetch_assoc($user_id);
            $_SESSION['user_info'] = $user_id_fetch;
        }
        else{
            $sql=  mysqli_query($con,"SELECT * from `user` WHERE email='$email'");
            if(mysqli_num_rows($sql) > 0){
                $user_id_fetch= mysqli_fetch_assoc($sql);
                $_SESSION['user_info'] = $user_id_fetch;
            }
        }
    }
}


    if(!isset($_SESSION['access_token']))
    {
        $login_button = $google_client->createAuthUrl();
    }

    if(isset($_SESSION['user_info'])){
        header('location:index.php');
    }

    include 'header.php';

?>





<div class="row mx-0 py-5 justify-content-center">

    <div class="wrapper-1 col-lg-5 col-11">

        <?php
        if(isset($_SESSION['error'])){
            echo $_SESSION['error'];
            unset($_SESSION['error']);
        }
        ?>

        <h2 class="head">Login</h2>
        <p>Log in to get access to your CoinSniper account.</p>
        <form action="logindb.php" method="POST">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label font-weight-600">Email </label>
                <input type="email" name="email" class="form-control cs-inp-1" placeholder="Email" required>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label font-weight-600">Password</label>
                <input type="password" name="password" class="form-control cs-inp-1" placeholder="Password" required>
            </div>
            <input name="submit" type="submit" class="btn btn-success w-100 mt-3" value="Login">
        </form>
   <a href="<?php echo $login_button;?>"><button class="btn btn-primary google-btn w-100 mt-3"> <i class="fa fa-google"></i> <span>Sign in with Google</span> </button></a>  
        <div class="text-center pt-3 end">
            <span>Do not have an account? <a href="register.php">Register</a></span>
        </div>
    </div>
</div>


<?php 
include('footer.php');
?>