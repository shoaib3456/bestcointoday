<?php
  if(!isset($_SESSION)) 
  { 
      session_start(); 
  } 
if(isset($_SESSION['user_info'])){
    header('location:index.php');
} 
include('header.php');
?>


<div class="row mx-0 py-5 justify-content-center">
    <div class="wrapper-1 col-lg-5 col-11">
        <?php
            if(isset($_SESSION['error'])){
                echo $_SESSION['error'];
                unset($_SESSION['error']);
            }
        ?>
        <h2 class="head">Register</h2>
        <p>Create your account at CoinSniper to unlock new features.</p>
        <form action="logindb.php" method="POST">
            <div class="mb-3">
                <label for="exampleInputEmail1"  class="form-label font-weight-600">Name </label>
                <input type="text" name="name" class="form-control cs-inp-1" placeholder="Name" required>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label font-weight-600">Email </label>
                <input type="email" name="email" class="form-control cs-inp-1" placeholder="Email" required>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label font-weight-600">Password</label>
                <input type="password" name="password" class="form-control cs-inp-1" placeholder="Password" required>
            </div>
            <input name="register" type="submit" class="btn btn-success w-100 mt-3" value="Register"/>
        </form>
        <div class="text-center pt-3 end">
            <span>Already have an account? <a href="login.php">Login</a></span>
        </div>
    </div>
</div>


<?php 
include('footer.php');
?>