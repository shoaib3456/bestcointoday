<?php 

if(!isset($_GET['id'])){
    header('location:banner.php');
}

include 'header.php'; 
$update_id;
$result;
if(isset($_GET['id'])){
    $update_id = $_GET['id'];
    $sql = mysqli_query($con,"SELECT * FROM `banner` WHERE id='$update_id'");
    $result  = mysqli_fetch_assoc($sql);
}


if(isset($_POST['submitt'])){
    $link = $_POST['link'];
    $ban_id = $_POST['banner_id'];


    $sql;
    if($_FILES['Logo']['name']!=''){
        $file= $_FILES['Logo'];	
        $filename = $file['name'];
        $fileerror = $file['error'];
        $filetmp = $file['tmp_name'];
        $filestore = explode('.',$filename);
        $filecheck = strtolower(end($filestore));
        $filecheckstore = array('jpg','png','jpeg');
        $destinationfile ='images/banner/'.$filename;
        $destinationfilemove ='../images/banner/'.$filename;
        move_uploaded_file($filetmp,$destinationfilemove);
        echo 'this is name'.$_FILES['Logo']['name'];

        $destinationfile ='../'. $destinationfile;
        $sql =  mysqli_query($con,"UPDATE `banner` SET `link`='$link' ,`image`='$destinationfile'  WHERE id='$ban_id'");
    }
    else{
        $destinationfile ='../'. $destinationfile;
        $sql =  mysqli_query($con,"UPDATE `banner` SET `link`='$link'   WHERE id='$ban_id'");
    }
  
   

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
        <div class="d-flex justify-content-between align-items-center py-2">
            <h3>Update Coin</h3>
        </div>
        <img src="<?php echo $result['image']?>" style="width:100%;">
        <form id="" class="d-flex flex-column py-3" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
            <div class="row mx-0 ">
                <div class="col-lg-6">
                    <input type="text" name="banner_id"  value="<?php echo $result['id']; ?>" class="form-control " hidden>
                    <input type="text" name="logodefault"  value="<?php echo $result['image']; ?>" class="form-control " hidden>
                    <label for="exampleInputEmail1" class="form-label font-weight-600"  >Id </label>
                    <input type="text"  value="<?php echo $result['id']; ?>" class="form-control cs-inp-1 req-inp" readonly>
                    <label for="exampleInputEmail1" class="form-label font-weight-600 pt-2"  >Link <small class="req-small">Reduired</small></label>
                    <input type="text" name="link" value="<?php echo $result['link']; ?>" class="form-control cs-inp-1 req-inp" required >
                    <div class="col-12 px-0">
                        <label for="exampleInputEmail1" class="form-label font-weight-600 ">Logo </label>
                        <div class="custom-file ">
                            <input type="file" class="custom-file-input"   name="Logo" id="Logo"  >
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                    </div>
                    <div class="py-3">
                        <input type="submit" id="coinsubbtn" name="submitt" class="btn btn-success col-lg-3 " style="padding: 10px; text-transform: uppercase;" value="Submit ">
                    </div>
                </div>
                </div>
            </div>
        </form>
    </div>
</div>




<?php include 'footer.php'; ?>