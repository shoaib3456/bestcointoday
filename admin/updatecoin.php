<?php 

if(!isset($_GET['id'])){
    header('location:index.php');
}
include 'header.php'; 
$update_id;
$result;
if(isset($_GET['id'])){
    $update_id = $_GET['id'];
    $sql = mysqli_query($con,"SELECT * FROM `coins` WHERE id='$update_id'");
    $result  = mysqli_fetch_assoc($sql);
}








if(isset($_POST['submitt'])){
    $upid = $_POST['upid'];
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


    if($_FILES['Logo']['name']!=''){
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
        echo 'this is name'.$_FILES['Logo']['name'];
    }
    
    else{
        $destinationfile = $_POST['logodefault'];
    }
    if(isset($_SESSION['admin'])){
        $user_id = $_SESSION['admin']['id'];
    }
  

    $sql =  mysqli_query($con,"UPDATE `coins` SET `coinname`='$coinname', `Symbol`='$Symbol', `NetworkChain`='$NetworkChain',`Marketcap`='$Marketcap' ,`price`='$price',`contract_address`='$contract_address', `Description`='$Description', `Logo`='$destinationfile',`information`='$information', `Launchdate`='$Launchdate', `Website`='$Website', `Telegram`='$Telegram', `Twitter`='$Twitter',`updated_at`=now() WHERE id='$upid'");

    if(!$sql){
        echo '<script> alert("connection error") </script>';
    }
}

?>

<style>
    .req-small{
        color: rgb(255, 0, 128);
    }
</style>

<div class="container-fluid">
    <div class="card-body bg-white rounded d-flex flex-column">
        <div class="d-flex justify-content-between align-items-center">
            <h3>Update Coin</h3>
            <img src="../<?php echo $result['Logo']?>" style="width:100px;">
        </div>
        <form id="" class="d-flex flex-column" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
        <input type="hidden"  name="upid" value="<?php echo $_GET['id']; ?>">
        <input type="hidden"  name="logodefault" value="<?php echo $result['Logo']; ?>">
            <div class="row mx-0">
                <div class="col-lg-6 col-12 ">
                    <label for="exampleInputEmail1" class="form-label font-weight-600"  >Name <small class="req-small">Reduired</small></label>
                    <input type="text" name="coinname" value="<?php echo $result['coinname']; ?>" class="form-control cs-inp-1 req-inp" placeholder="Name" required="">
                    <div class="pt-3">
                        <label for="exampleInputEmail1" class="form-label font-weight-600">Symbol <small class="req-small">Reduired</small> </label>
                        <input type="text" name="Symbol" value="<?php echo $result['Symbol']; ?>" class="form-control cs-inp-1 req-inp" placeholder="BTC" required="">
                    </div>
                    <div class="my-3">
                        <label for="exampleInputPassword1" class="form-label font-weight-600">Description <small class="req-small">Reduired</small></label>
                        <textarea type="text" name="Description" id="Description"  class="form-control cs-inp-1 req-inp" placeholder="Describe your coin here. What is the goal, plans, why is this coin unique?"><?php echo $result['Description']; ?></textarea>
                    </div>
                    <div class="my-3">
                        <label for="exampleInputPassword1" class="form-label font-weight-600">Market Cap in USD <small class="req-small">Reduired</small></label>
                        <input type="number" step="any" name="Marketcap" value="<?php echo $result['Marketcap']; ?>" class="form-control cs-inp-1 req-inp" placeholder="0.000" required="">
                    </div>
                    <div class="my-3">
                        <label for="exampleInputPassword1" class="form-label font-weight-600">Price <small class="req-small">Reduired</small></label>
                        <input type="number" step="any" name="price" value="<?php echo $result['price']; ?>" class="form-control cs-inp-1 "   placeholder="0.000">
                    </div>

                    <div class="my-3">
                        <label for="exampleInputPassword1" class="form-label font-weight-600">Launch Date <small class="req-small">Reduired</small></label>
                        <input type="date" value="<?php echo $result['Launchdate']; ?>" name="Launchdate" class="form-control cs-inp-1 req-inp" placeholder="https://coinsniper.net" required="">
                    </div>
                    <h5>Contract addresses</h5>
        
                    <div class="pt-3">
                        <label for="exampleInputEmail1" class="form-label  font-weight-600" >Chain <small class="req-small">Reduired</small> </label>
                        <div class="select-wrapper">
                            <select name="NetworkChain" class="form-control cs-inp-1 " >
                                <option value="bsc" <?php if($result['NetworkChain']=='bsc'){echo 'selected="" ';}?> >Binance Smart Chain (BSC)</option>
                                <option value="eth" <?php if($result['NetworkChain']=='eth'){echo 'selected="" ';}?>>Ethereum (ETH)</option>
                                <option value="matic" <?php if($result['NetworkChain']=='matic'){echo 'selected="" ';}?>>Polygon (MATIC)</option>
                                <option value="trx" <?php if($result['NetworkChain']=='trx'){echo 'selected="" ';}?>>Tron (TRX)</option>
                            </select>
                        </div>
                    </div>
                    <div class="my-3" id="contract_add">
                        <label for="exampleInputPassword1" class="form-label font-weight-600"> Address <small class="req-small">Reduired</small></label>
                        <input type="text" name="contract_address" value="<?php echo $result['contract_address']; ?>" class="form-control cs-inp-1 req-inp" placeholder="" required="">
                    </div>
                </div>
                <div class="col-lg-6 col-12 ">
                    
                    <div class="my-3 mt-0">
                        <label for="exampleInputPassword1" class="form-label font-weight-600">Website </label>
                        <input type="text" name="Website" value="<?php echo $result['Website']; ?>" class="form-control cs-inp-1 " placeholder="https://coinsniper.net">
                    </div>
                   
                    <div class="my-3">
                        <label for="exampleInputPassword1" class="form-label font-weight-600">Telegram <small class="req-small">Reduired</small></label>
                        <input type="text" name="Telegram" value="<?php echo $result['Telegram']; ?>" class="form-control cs-inp-1 req-inp" placeholder="https://t.me/coinsniper" required="">
                    </div>
                    <div class="my-3">
                        <label for="exampleInputPassword1" class="form-label font-weight-600">Twitter </label>
                        <input type="text" name="Twitter" value="<?php echo $result['Twitter']; ?>" class="form-control cs-inp-1" placeholder="https://twitter.com/coinsniper">
                    </div>
                    <div class="">
                        <label for="exampleInputEmail1" class="form-label font-weight-600 ">Logo </label>
                        <div class="custom-file ">
                            <input type="file" class="custom-file-input"   name="Logo" id="Logo" >
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                    </div>
                    <div class="my-3">
                        <label for="exampleInputPassword1" class="form-label font-weight-600">Additional information, other links and addresses</label>
                        <textarea type="text" name="information" id="information"   class="form-control cs-inp-1 " placeholder=""><?php echo $result['information']; ?></textarea>
                    </div>
                   
                </div>
            </div>
            

            <div class="row mx-0 justify-content-center mb-3">
                <input type="submit" id="coinsubbtn" name="submitt" class="btn btn-success col-lg-3 " style="padding: 10px; text-transform: uppercase;" value="Submit ">
            </div>
        </form>
    </div>
</div>




<?php include 'footer.php'; ?>