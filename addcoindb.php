<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
include ('admin/config.php');

$coinNameAuth = $_POST['coinname'];
$iscoinexisit =  mysqli_num_rows(mysqli_query($con,"SELECT * FROM `coins` where coinname='$coinNameAuth' "));


if(isset($_POST['coinname']) && $iscoinexisit == '0'){

    $coinname = $_POST['coinname'];
    $Symbol = $_POST['Symbol'];
    $NetworkChain = $_POST['NetworkChain'];
    $Marketcap = $_POST['Marketcap'];
    $price = $_POST['price'];
    $contract_address = $_POST['contract_address'];
    $Description = $_POST['Description'];
    $Website = $_POST['Website'];
    $Launchdate = $_POST['Launchdate'];
    $Telegram = $_POST['Telegram'];
    $Twitter = $_POST['Twitter'];
    $information = $_POST['information'];


    $file= $_FILES['Logo'];	
    $filename = $file['name'];
    $fileerror = $file['error'];
    $filetmp = $file['tmp_name'];
    $filestore = explode('.',$filename);
    $filecheck = strtolower(end($filestore));
    $filecheckstore = array('jpg','png','jpeg');
    $destinationfile ='images/'.$filename;
    move_uploaded_file($filetmp,$destinationfile);

    if(isset($_SESSION['user_info'])){
        $user_id = $_SESSION['user_info']['id'];
    }
    else{
        $user_id =$_SESSION['random_id'];
    }


    // echo $destinationfile;


    $sql =  mysqli_query($con,"INSERT INTO `coins`(`coinname`, `Symbol`, `NetworkChain`,`Marketcap` ,`price`,`contract_address`, `Description`, `Logo`,`information`, `Launchdate`, `Website`, `Telegram`, `Twitter`, `created_by`) VALUES('$coinname','$Symbol','$NetworkChain','$Marketcap','$price','$contract_address','$Description','$destinationfile','$information','$Launchdate','$Website','$Telegram','$Twitter','$user_id')");



    // $sql =  mysqli_query($con,"INSERT INTO `coins`(`coinname`, `Symbol`, `NetworkChain`, `presale`, `contract_address`, `Description`, `Logo`, `Launchdate`, `Website`, `Telegram`, `Twitter`, `Discord`, `created_by`) VALUES('2','2','2','2','2','2','2','$Launchdate','2','2','2','2','2')");

    if($sql){
        header('location:index.php');
    }
    else{
        echo mysqli_error($con);
    }
}else{
    $_SESSION['coin_error'] = '<div class="alert alert-danger text-center" role="alert">
        Coin already Exist ! 
    </div>';
    header('location:addcoin.php');
}





?>