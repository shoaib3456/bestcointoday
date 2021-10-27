<?php 
include 'header.php' ;
include('admin/config.php');
require 'vendor/autoload.php';
use Carbon\Carbon;


if(isset($_GET['delete'])){
    $c_id  = $_GET['delete'];
    mysqli_query($con,"DELETE FROM `coins` WHERE id='$c_id' ");
}


?>

<div class="container">
    <div class="row justify-content-center">
        <?php 
        $banner  = mysqli_query($con,"SELECT * FROM `banner`");
        if(mysqli_num_rows($banner)>0){
            foreach ($banner as $key => $result) {
                $src = explode('../',$result['image'])[1];
                echo '
                <a href="'.$result['link'].'" class="col-lg-10 col-12 pt-3">
                    <img src="'.$src.'" class="w-100  " style="border-radius: 10px;"  >
                </a>
                ';
            }
        }
        ?>
    </div>
</div>

<div class="container  py-2">
  <div class="ads-class">
    <?php
            $sql = mysqli_query($con,"SELECT * FROM `slider` ");
            foreach ($sql as $key => $value) {
              $src = explode('../',$value['image'])[1];
              echo '<a href="'.$value['link'].'" class="slice-ad-items-1" ><img src="'.$src.'" alt=""></a>';
            } 
          ?>
  </div>
</div>



<div class="container  table-wrapper ">

  <table class="table table-coin-1">
    <thead>
      <tr class="">
        <th scope="col " class="text-center">Name </th>
        <th scope="col " class="text-center hide-on-mobile">Symbol</th>
        <th scope="col " class="text-center hide-on-mobile">Launch</th>
        <th scope="col " class="text-center ">Market Cap</th>
        <th scope="col " class="text-center">Upvotes</th>
        <th scope="col " class="text-center">Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php
                $user_id = $_SESSION['user_info']['id'];
                $sql = mysqli_query($con,"SELECT * FROM `coins` where created_by='$user_id' ORDER BY votes + 0 DESC ");
                if(mysqli_num_rows($sql)>0){
                foreach($sql as $result){
                    $isactive = "";
                        $cid = $result['id'];
                        if(isset($_SESSION['user_info'])){
                            $uid = $_SESSION['user_info']['id'];
                            if(mysqli_num_rows(mysqli_query($con,"SELECT * FROM `votes` WHERE coin_id='$cid' AND user_id='$uid'")) > 0){
                                $isactive = 'active';
                            }
                        }
                        else{
                            $uid = $_SESSION['random_id'];
                            if(mysqli_num_rows(mysqli_query($con,"SELECT * FROM `votes` WHERE coin_id='$cid' AND user_id='$uid'")) > 0){
                                $isactive = 'active';
                            }
                        }
                        $human_dt =  Carbon::now()->diffForHumans($result['Launchdate']);
                        if(strpos($human_dt, 'after') !== false){
                          $human_dt  = explode("after",$human_dt)[0] .' '. explode("after",$human_dt)[1] = 'ago' ; 
                        } 
                        if(strpos($human_dt, 'before') !== false){
                          $human_dt  =explode("before",$human_dt)[1] = 'In'.' ' . explode("before",$human_dt)[0]; 
                        } 
                        if(strpos($human_dt, 'hours')){
                            $human_dt = "Launched Today";
                        }       
                        echo '
                          <tr>
                          <td class="td-logo" onclick="coininfo('.$result['id'].')"><img src="'.$result['Logo'].'" alt=""> <small>'.$result['coinname'].'</small></td>
                          <td class="text-center hide-on-mobile" onclick="coininfo('.$result['id'].')"><span>'.$result['Symbol'].'</span></td>
                            <td class="text-center hide-on-mobile" onclick="coininfo('.$result['id'].')"><span>'.$human_dt.'</span></td>
                            <td class="text-center" onclick="coininfo('.$result['id'].')"><span>$'.$result['Marketcap'].'</span></td>
                            <td class="text-center"><span onclick="voteit(this)" id="promote-'.$result['id'].'"><button class="btn btn-outline-success btn-over-off '.$isactive.'" >🚀 '.$result['votes'].'</button></span></td>
                            <td class="text-center" ><span><a href="?delete='.$result['id'].'" class="btn btn-danger ">Delete Coin</a></span> </td> 
                            </tr>
                          ';
                          }
                      }
                      else{
                        echo '<tr><td class="w-100 text-center text-danger py-3 font-weight-600" colspan="6">  Coins Not Found !</td></tr>';
                      }
                  ?>
    </tbody>
  </table>
</div>


<?php
  include('footer.php');
?>

<script>
  $('.ads-class').slick({
    autoplay: true,
    autoplaySpeed: 2000,
    infinite: true,
    slidesToShow: 3,
    slidesToScroll: 1,
    dots: false,
    prevArrow: false,
    nextArrow: false,
    responsive: [
      {
        breakpoint: 700,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1,
        }
      },
      {
        breakpoint: 400,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
        }
      }
    ]
  });
</script>


<script src="assets/js/votes.js"></script>
<script src="assets/js/votesbest.js"></script>






<script>

  function coininfo(e) {
    window.location.href = "coininfo.php?name=" + e
  }

</script>

