<?php 

include 'header.php'; 

if(isset($_GET['promoted'])){
    $promoted_id = $_GET['promoted'];
    mysqli_query($con,"UPDATE `coins` SET `ispromote`='1' , `updated_at`=NOW() WHERE id='$promoted_id' ");
}
if(isset($_GET['unpromote'])){
    $promoted_id = $_GET['unpromote'];
    mysqli_query($con,"UPDATE `coins` SET `ispromote`='0' , `updated_at`=NOW() WHERE id='$promoted_id' ");
}

if(isset($_GET['approved'])){
    $approved_id = $_GET['approved'];
    mysqli_query($con,"UPDATE `coins` SET `adminapproval`='1', `updated_at`=NOW() WHERE id='$approved_id' ");
}
if(isset($_GET['reject'])){
    $approved_id = $_GET['reject'];
    mysqli_query($con,"UPDATE `coins` SET `adminapproval`='0', `updated_at`=NOW() WHERE id='$approved_id' ");
}
if(isset($_GET['delete'])){
    $approved_id = $_GET['delete'];
    mysqli_query($con,"DELETE FROM `coins` WHERE id='$approved_id' ");
}

?>
<div class="container-fluid">
    <h3>New Coins</h3>

    <div class="row">
        <div class="col-12">
            <div class="card">

                <!-- /.card-header -->
                <div class="card-body">
                    <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div class="d-flex  align-items-center pb-3 pl-2">
                            <p class="mb-0">Click here to add new coin</p>
                            <a href="addcoin.php" class="btn btn-primary  ml-3">Add Coins</a>
                        </div>
                        <div class="row">
                            <div class="col-sm-12" style="overflow-x: scroll;">
                                <table id="example2" class="table table-bordered table-hover dataTable dtr-inline"
                                    role="grid" aria-describedby="example2_info">
                                    <thead>
                                        <tr role="row">
                                            <th class="sorting sorting_asc">Id</th>
                                            <th class="sorting sorting_asc">Logo</th>
                                            <th class="sorting sorting_asc">Coin name</th>
                                            <th class="">Total Votes</th>
                                            <th class="sorting sorting_asc">Symbol</th>
                                            <th class="sorting sorting_asc">Description</th>
                                            <th class="sorting sorting_asc">Launce Date</th>
                                            <th class="sorting sorting_asc">Market Cap</th>
                                            <th class="sorting sorting_asc">Network Chain</th>
                                            <th class="sorting sorting_asc">Website</th>
                                            <th class="sorting sorting_asc">Telegram</th>
                                            <th class="sorting sorting_asc">Twitter</th>
                                            <th class="sorting sorting_asc">Created At</th>
                                            <th class="sorting sorting_asc">Created By</th>
                                            <th class="sorting sorting_asc">Votes</th>
                                            <th class="sorting sorting_asc">Status</th>
                                            <th class="sorting sorting_asc">Admin Approved</th>
                                            <th class="sorting sorting_asc">Approved</th>
                                            <th class="sorting sorting_asc text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                    $sql = mysqli_query($con,"SELECT * FROM `coins` ORDER BY created_at DESC ");
                                    if(mysqli_num_rows($sql) > 0){
                                        foreach($sql as $result){
                                            $approved_state = '<span class="text-danger"> Rejected </span>';
                                            if($result['adminapproval']){
                                                $approved_state  = '<span class="text-success"> Approved </span>';
                                            }
                                            $ispromote = '<span class="text-danger">Not Promoted</span>';
                                            if($result['ispromote'] == '1'){
                                                $ispromote = '<span class="text-success"> Promoted</span>';
                                            }
                                            echo '
                                            <tr class="odd">
                                            <td>'.$result['id'].'</td>
                                            <td class=" text-center" tabindex="0">
                                                <img src="../'.$result['Logo'].'"
                                                    width="30px" alt="">
                                            </td>
                                            <td>'.$result['coinname'].'</td>
                                            <td>'.$result['votes'].'
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#voteModal" data-whatever="'.$result['id'].'">
                                                Add votes
                                            </button>
                                            
                                            </div>
                                            </td>
                                            <td>'.$result['Symbol'].'</td>
                                            <td class="td-decs">'.$result['Description'].'</td>
                                            <td>'.$result['Launchdate'].'</td>
                                            <td>'.$result['Marketcap'].'</td>
                                            <td>'.$result['NetworkChain'].'</td>
                                            <td>'.$result['Website'].'</td>
                                            <td>'.$result['Telegram'].'</td>
                                            <td>'.$result['Twitter'].'</td>
                                            <td>'.$result['created_at'].'</td>
                                            <td>'.$result['created_by'].'</td>
                                            <td>'.$result['votes'].'</td>
                                            <td>'.$approved_state.'</td>
                                            <td>'.$ispromote.'</td>
                                            <td>
                                                <!-- Example single danger button -->
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-light dropdown-toggle"
                                                        data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        Action
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="'.$_SERVER['PHP_SELF']."?approved=".$result['id'].'">Approved</a>
                                                        <a class="dropdown-item" href="'.$_SERVER['PHP_SELF']."?reject=".$result['id'].'">Reject</a>
                                                        <a class="dropdown-item" href="'.$_SERVER['PHP_SELF']."?promoted=".$result['id'].'">promote</a>
                                                        <a class="dropdown-item" href="'.$_SERVER['PHP_SELF']."?unpromote=".$result['id'].'">Un promote</a>
                                                        
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center" >
                                            <a href="updatecoin.php?id='.$result['id'].'" class="btn btn-success">Edit</a>
                                            <a href="'.$_SERVER['PHP_SELF']."?delete=".$result['id'].'" class="btn btn-danger">Delete Coin</a>
                                            </td>
                                        </tr>
                                            ';
                                        }
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

<div class="modal fade" id="voteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Votes</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <label>Enter No of Votes you want to Add</label>
                <form method="post">
                    <input type="hidden" value="" name="id" id="hidenId" >
                    <input type="number" class="form-control" name="votes" placeholder="Enter votes">
                    <br>
                    <button name="add" class="btn btn-primary" type="buton">Add</button>
                </form>
            </div>
        </div>
    </div>


    <?php include 'footer.php'; 
if(isset($_POST['add'])){
    $adminId= $_SESSION["admin"]['id'];
    $id=$_POST['id'];
    $votes=$_POST['votes'];
    $get=mysqli_query($con,"SELECT votes FROM `coins` WHERE id='$id'");
    $loop0=mysqli_fetch_assoc($get);
    $previous=$loop0['votes'];
    $updated=$previous+$votes;
    $query=mysqli_query($con,"UPDATE `coins` SET votes='$updated'  WHERE id='$id' ");
    $query=mysqli_query($con,"INSERT INTO  `votes` (`user_id`,`coin_id`,`coin`) VALUES('$adminId','$id','$votes') ");
    if($query){
        echo "<script>window.location = 'newcoin.php';</script>";
        echo'<script>alert("Votes Added")</script>';
    }
}
$_POST = array();
?>


<script>
    $('#voteModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('whatever') // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = $(this)
  modal.find('.modal-body #hidenId').val(recipient)
})
</script>