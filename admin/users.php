<?php 

include 'header.php'; 
// include 'config.php'; 

if(isset($_GET['block'])){
    $id = $_GET['block'];
    mysqli_query($con,"UPDATE `user` set `status`='0'  WHERE id='$id'");
}
if(isset($_GET['approve'])){
    $id = $_GET['approve'];
    mysqli_query($con,"UPDATE `user` set `status`='1'  WHERE id='$id'");
}


?>
<div class="container-fluid">
    <h3>Users</h3>

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
                            
                            <div class="col-sm-12 px-0" style="overflow-x: scroll;">
                                <table id="example2" class="table table-bordered table-hover dataTable dtr-inline"
                                    role="grid" aria-describedby="example2_info">
                                    <thead>
                                        <tr role="row">
                                            <th class="sorting sorting_asc">Id</th>
                                            <th class="sorting sorting_asc">Name</th>
                                            <th class="sorting sorting_asc">Email</th>
                                            <th class="sorting sorting_asc">Status</th>
                                            <th class="sorting sorting_asc">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                        $sql = mysqli_query($con,"SELECT * FROM `user`");

                                        foreach ($sql as $result) {
                                            $status = '<span class="text-danger"> Un Approved </span>';
                                            if($result['status'] == '1'){
                                                $status = '<span class="text-success">  Approved </span>';
                                            }
                                            echo '
                                            <tr role="row">
                                            <td class="sorting sorting_asc">'.$result['id'].'</td>
                                            <td class="sorting sorting_asc">'.$result['name'].'</td>
                                            <td class="sorting sorting_asc">'.$result['email'].'</td>
                                            <td class="sorting sorting_asc">'.$status.'</td>
                                            <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown">
                                                    Action
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="?approve='.$result['id'].'">Approved </a>
                                                    <a class="dropdown-item" href="?block='.$result['id'].'">Block</a>
                                                </div>
                                             </div>
                                            </td>
                                             </tr>';
                                        }
                                        
                                        ?>
                                    
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- <div class="row mt-3">
                            <div class="col-sm-12 col-md-5">
                                <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing
                                    1 to 10 of 57 entries</div>
                            </div>
                            <div class="col-sm-12 col-md-7">
                                <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                                    <ul class="pagination">
                                        <li class="paginate_button page-item previous disabled" id="example2_previous">
                                            <a href="#" aria-controls="example2" data-dt-idx="0" tabindex="0"
                                                class="page-link">Previous</a>
                                        </li>
                                        <li class="paginate_button page-item active"><a href="#"
                                                aria-controls="example2" data-dt-idx="1" tabindex="0"
                                                class="page-link">1</a></li>
                                        <li class="paginate_button page-item "><a href="#" aria-controls="example2"
                                                data-dt-idx="2" tabindex="0" class="page-link">2</a></li>
                                        <li class="paginate_button page-item "><a href="#" aria-controls="example2"
                                                data-dt-idx="3" tabindex="0" class="page-link">3</a></li>
                                        <li class="paginate_button page-item "><a href="#" aria-controls="example2"
                                                data-dt-idx="4" tabindex="0" class="page-link">4</a></li>
                                        <li class="paginate_button page-item "><a href="#" aria-controls="example2"
                                                data-dt-idx="5" tabindex="0" class="page-link">5</a></li>
                                        <li class="paginate_button page-item "><a href="#" aria-controls="example2"
                                                data-dt-idx="6" tabindex="0" class="page-link">6</a></li>
                                        <li class="paginate_button page-item next" id="example2_next"><a href="#"
                                                aria-controls="example2" data-dt-idx="7" tabindex="0"
                                                class="page-link">Next</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div> -->
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