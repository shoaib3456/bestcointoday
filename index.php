<?php 


// php routing
$request = $_SERVER['REQUEST_URI'];
$router  = str_replace('/gemvotes','',$request);
if($router == '/' || $router=='/index.php' || $router=='/home' || isset($_GET['page'])){
  include('home.php');
}
if($router == '/details' || preg_match("/details\/[0-9]/i",$router)){
  include('coininfo.php');
}



// php routing



?>
