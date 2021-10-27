<?php

if(!isset($_SESSION)) 
{ 
    session_start(); 
} 

if(!isset($_SESSION['random_id'])){
  $_SESSION['random_id'] = $_SERVER['REMOTE_ADDR'];
}
if(!isset($pageTitle)){
  $pageTitle = '';
}
if($pageTitle == ""){
  $pageTitle = "GemVote";
}


// session_destroy();

?>
<!doctype html>
<html lang="en">
  <head>

    <meta >
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://kit.fontawesome.com/b690895109.js" crossorigin="anonymous"></script>
    <link rel="shortcut icon" href="assets/images/fav-icon.png" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- include summernote css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <?php
      if(!isset($router)){
        $request = $_SERVER['REQUEST_URI'];
        $router  = str_replace('/gemvotes','',$request);
      }
      $arr1 = explode('/',$router);
      $profix_url='';
      if(isset($arr1[2])){
        $profix_url ='../';
      }
      else{
        $profix_url='';
      }
      ?>
      <link rel="stylesheet" href="<?php echo $profix_url;?>assets/css/style.css?v=<?php echo time();?>">
      <title><?php echo $pageTitle;?></title>
 
  </head>
  <body>
    <nav class="navbar header-nav navbar-expand-lg navbar-light bg-light p-0">
      <div class="container">
        <a class="navbar-brand py-2" href="<?php echo $profix_url;?>index.php"><img src="<?php echo $profix_url;?>assets/images/logo.png?v=<?php echo time();?>" alt=""></a>
        <div class="d-flex align-items-center">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        </div>
       
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0" style="flex: 1 ; justify-content: center;">
          
          </ul>
          <div class="header-right-links">
            <a href="https://t.me/gemvotes" class="r-a"><span class="d-lg-none d-block">Follow us on Telegram!</span><i class="fa fa-telegram"></i></a>
            <a href="https://twitter.com/gemvotes" class="r-a"><span class="d-lg-none d-block">Follow us on twitter!</span><i class="fa fa-twitter"></i></a>
            <a href="<?php echo $profix_url;?>addcoin.php"><button class="btn btn-outline-success ">Add a Coin</button></a>
            <?php
            if(isset($_SESSION['user_info'])){
              echo' <a href="'.$profix_url.'mycoins.php"><button class="btn btn-outline-success mx-lg-2 mt-lg-0 mt-2">My Coins</button></a>  ';
            }
            ?>  
             <a href="<?php echo $profix_url;?>advertise-with-us.php"><button class="btn btn-fade-1 mx-lg-2 mt-lg-0 mt-2">Promote | Traffic Stats</button></a> 
             <a href="<?php echo $profix_url;?>earn.php"><button class="btn btn-fade-1 mx-lg-2 mt-lg-0 mt-2">Earn with Us</button></a>
          </div>
        </div>
       
      </div>
    </nav>

<div class="modal fade" tabindex="-1" id="votemodal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header border-0">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body pb-5 d-flex justify-content-center  flex-column">
        <h4 class="text-center">Thanks For Voting 🚀</h4>
        <!-- <small class="w-100 text-center pb-2">To Continue Complete Captcha</small>
        <div class=" d-flex justify-content-center">
          <div class="g-recaptcha " data-sitekey="6LfMgvcbAAAAAM4Ey6uYjM3BTwTcOZMKEBITXXxX" data-callback="checkcaptcha">Submit</div>
        </div> -->
      </div>
      
    </div>
  </div>
</div>

 

