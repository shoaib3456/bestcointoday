<?php
include('config.php');
session_start();

if(isset($_POST['submitt']) && isset($_SESSION["admin"])){

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
    $destinationfilemove ='../images/'.$filename;
    move_uploaded_file($filetmp,$destinationfilemove);

    if(isset($_SESSION['admin'])){
        $user_id = $_SESSION['admin']['id'];
    }
  

    $sql =  mysqli_query($con,"INSERT INTO `coins`(`coinname`, `Symbol`, `NetworkChain`,`Marketcap` ,`price`,`contract_address`, `Description`, `Logo`,`information`, `Launchdate`, `Website`, `Telegram`, `Twitter`, `created_by`) VALUES('$coinname','$Symbol','$NetworkChain','$Marketcap','$price','$contract_address','$Description','$destinationfile','$information','$Launchdate','$Website','$Telegram','$Twitter','$user_id')");

    header("location:newcoin.php");

}

?>