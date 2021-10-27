<?php 

include 'header.php'; 
// include 'config.php'; 


if(isset($_POST['submitadd'])){
    $link = $_POST['link'];
    $file= $_FILES['imageadd'];	
    $filename = $file['name'];
    $fileerror = $file['error'];
    $filetmp = $file['tmp_name'];
    $filestore = explode('.',$filename);
    $filecheck = strtolower(end($filestore));
    $filecheckstore = array('jpg','png','jpeg');
    $destinationfile ='../images/banner/'.$filename;
    move_uploaded_file($filetmp,$destinationfile);
    mysqli_query($con,"INSERT INTO `banner`(`image`,`link`) VALUE('$destinationfile','$link')");


}

if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    mysqli_query($con,"DELETE FROM `banner` WHERE id='$id'");
}




?>
<div class="container-fluid">
    <h3>banner Images</h3>

    <div class="row">
        <div class="col-12">
            <div class="card">

                <!-- /.card-header -->
                <div class="card-body">
                    <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                            <div class="col-sm-12 col-md-6"></div>
                            <div class="col-sm-12 col-md-6"></div>
                        </div>
                        
                        <div class="row mx-0 px-0 ">
                            <div class="col-12 py-3 px-0 mx-0 ">
                                <h5 class="font-weight-bold">Add Banner</h5>
                                    <form action="" method="POST" class="d-flex" enctype="multipart/form-data">
                                        <div class="input-group col-9 pl-0 row mx-0">
                                            <div class="custom-file col-lg-6">
                                              <input type="file" name="imageadd" class="custom-file-input" id="exampleInputFile" required>
                                              <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                            </div>
                                            <div class="col-lg-6">
                                                <input type="text" name="link" class="form-control  " placeholder="link ex ( https://gemvotes.com )">
                                            </div>
                                          </div>
                                        <input type="submit" name="submitadd" class="form-control btn btn-primary" value="Add">
                                    </form>
                            </div>
                            <div class="col-sm-12 px-0" style="overflow-x: scroll;">
                                <table id="example2" class="table table-bordered table-hover dataTable dtr-inline"
                                    role="grid" aria-describedby="example2_info">
                                    <thead>
                                        <tr role="row">
                                            <th class="sorting sorting_asc">Id</th>
                                            <th class="sorting sorting_asc">Image</th>
                                            <th class="sorting sorting_asc">Link</th>
                                            <th class="sorting sorting_asc text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                        $sql = mysqli_query($con,"SELECT * FROM `banner`");

                                        foreach ($sql as $result) {
                                            echo '
                                            <tr role="row">
                                            <td class="sorting sorting_asc">'.$result['id'].'</td>
                                            <td class="sorting sorting_asc"><a href="'.$result['image'].'" class="w-100"><img src="'.$result['image'].'" width="100%"></a> </td>
                                            <td class="sorting sorting_asc">'.$result['link'].'</td>
                                            
                                            <td class="sorting sorting_asc d-flex ">
                                                <a href="?delete='.$result['id'].'" class="btn btn-danger w-100 mr-1">Delete</a>
                                                <a href="updatebanner.php?id='.$result['id'].'" class="btn btn-success w-100">Update</a>
                                            </td>
                                             </tr>';
                                        }
                                        
                                        ?>
                                    
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->


            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</div>
<?php include 'footer.php'; ?>